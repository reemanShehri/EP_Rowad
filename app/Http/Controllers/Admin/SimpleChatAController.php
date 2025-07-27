<?php

namespace App\Http\Controllers\Admin;

use App\Models\SimpleChat;
use Illuminate\Http\Request;
use App\Models\SimpleMessage;
use App\Http\Controllers\Controller;

class SimpleChatAController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $chats = SimpleMessage::with('user')->latest()->paginate(20);
    return view('admin.simple_chat.index', compact('chats'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $id)
{
    $chat = \App\Models\SimpleMessage::findOrFail($id);
    $chat->delete();

    return redirect()->back()->with('success', 'تم حذف الرسالة بنجاح');
}

}
