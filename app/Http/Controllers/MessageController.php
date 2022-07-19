<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Chatroom;
use App\Events\NewMessage;
use App\Events\EditMessage;
use App\Events\DeleteMessage;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $chatroom_id
     * @return \Illuminate\Http\Response
     */
    public function index($chatroom_id)
    {
        $chatroom = Chatroom::orderBy('created_at', 'DESC')->find($chatroom_id);
        $this->authorize('viewAny', [Message::class , $chatroom]);
        return response($chatroom->messages()->with('user')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMessageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMessageRequest $request, $chatroom_id)
    {

        $chatroom = Chatroom::find($request->chatroom_id);
        $this->authorize('create', [Message::class , $chatroom]);
        $request->merge(['user_id' => auth()->id()]);
        $newMessage = $chatroom->messages()->create($request->all());

        broadcast(new NewMessage($chatroom->messages()->with('user')->latest()->first()))->toOthers();

        return response($chatroom->messages()->with('user')->latest()->first());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
    //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
    //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMessageRequest  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMessageRequest $request, int $chatroomId, Message $message)
    {
        $this->authorize('update', $message);
        $message->update([
            'message' => $request->message,
        ]);
        broadcast(new EditMessage($message))->toOthers();
        return response($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy($chatroomId, $id)
    {
        $message = Message::find($id);
        $this->authorize('delete', $message);
        broadcast(new DeleteMessage($message))->toOthers();

        $message->delete();

        return response('Message deleted.');
    }
}
