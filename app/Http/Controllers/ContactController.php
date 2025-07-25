<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMessageMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    //

     public function index()
    {
        return view('contact.index');
    }

    public function send(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'nullable|string|max:20',
        'subject' => 'required|string',
        'message' => 'required|string',
    ]);


    Mail::to('r409456712@gmail.com')->send(new ContactMessageMail($request->all()));

    return back()->with('success', 'تم إرسال رسالتك بنجاح');
}

}
