<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Chatroom;
use App\Models\ChatroomUser;
use Illuminate\Http\Request;
use App\Http\Resources\ChatroomResource;
use App\Http\Requests\StoreChatroomRequest;
use App\Http\Requests\UpdateChatroomRequest;

class ChatroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $chatroom = ChatroomResource::collection(auth()->user()->chatrooms()->with('users')->get());
        return response()->json($chatroom);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreChatroomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChatroomRequest $request)
    {
    //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chatroom  $chatroom
     * @return \Illuminate\Http\Response
     */
    public function show(Chatroom $chatroom)
    {
    //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chatroom  $chatroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Chatroom $chatroom)
    {
    //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateChatroomRequest  $request
     * @param  \App\Models\Chatroom  $chatroom
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateChatroomRequest $request, Chatroom $chatroom)
    {
        $this->authorize('update', $chatroom);
        $chatroom->update($request->all());
        return response()->json(['msg' => 'Chatroom updated successfully', 'data' => $chatroom]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chatroom  $chatroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chatroom $chatroom)
    {
    //
    }

    public function addAdmin(Request $request, $chatroomId)
    {
        // $this->authorize('update', $chatroom);
        $user = ChatroomUser::where([['user_id', $request->user_id], ['chatroom_id', $chatroomId]])->get()->first();
        $user->update(['role' => ($user->role == 'admin' ? 'user' : 'admin')]);
        return response($user);
    }

    public function blockUser(Request $request, $chatroomId)
    {
        // $this->authorize('update', $chatroom);
        $new = ChatroomUser::where([['user_id', $request->user_id], ['chatroom_id', $chatroomId]])->get()->first();
        $new->update(['is_blocked' => !$new->is_blocked]);
        return response($new);
    }

    public function addUser(Request $request, $chatroomId)
    {
        // $this->authorize('update', $chatroom);
        $user = User::where('username', $request->username)->get()->first();
        if (!$user) {
            return response()->json(['msg' => 'User not found']);
        }
        elseif (ChatroomUser::where([['user_id', $user->id], ['chatroom_id', $chatroomId]])->get()->first()) {
            return response()->json(['msg' => 'User already in chatroom']);
        }
        ChatroomUser::create(['user_id' => $user->id, 'chatroom_id' => $chatroomId, 'role' => 'user']);
        $chatroom = ChatroomResource::collection([Chatroom::with('users')->find($chatroomId)]);
        return response()->json(['msg' => 'User added successfully', 'data' => $chatroom->first()]);
    }
}
