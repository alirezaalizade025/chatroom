<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChatroomUserRequest;
use App\Http\Requests\UpdateChatroomUserRequest;
use App\Models\ChatroomUser;

class ChatroomUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreChatroomUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChatroomUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChatroomUser  $chatroomUser
     * @return \Illuminate\Http\Response
     */
    public function show(ChatroomUser $chatroomUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChatroomUser  $chatroomUser
     * @return \Illuminate\Http\Response
     */
    public function edit(ChatroomUser $chatroomUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateChatroomUserRequest  $request
     * @param  \App\Models\ChatroomUser  $chatroomUser
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChatroomUserRequest $request, ChatroomUser $chatroomUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChatroomUser  $chatroomUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChatroomUser $chatroomUser)
    {
        //
    }
}
