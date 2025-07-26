<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        // جلب آخر 50 رسالة مع معلومات المستخدم
        $messages = Message::with('user')
            ->latest()
            ->take(50)
            ->get()
            ->reverse();

        return view('chatAll.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
            'edit_message_id' => 'nullable|exists:messages,id'
        ]);

        // إذا كان هناك رسالة للتعديل
        if ($request->filled('edit_message_id')) {
            $message = Message::findOrFail($request->edit_message_id);

            // التحقق من أن المستخدم هو صاحب الرسالة
            if ($message->user_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'error' => 'غير مصرح لك بتعديل هذه الرسالة'
                ], 403);
            }

            // تحديث الرسالة
            $message->update(['message' => $request->message]);

            return response()->json([
                'success' => true,
                'message' => 'تم تحديث الرسالة بنجاح',
                'data' => [
                    'id' => $message->id,
                    'user_id' => $message->user_id,
                    'message' => $message->message,
                    'created_at' => $message->created_at,
                    'user' => [
                        'name' => $message->user->name,
                        'profile_photo_url' => $message->user->profile_photo_url
                    ]
                ]
            ]);
        }

        $message = Message::create([
            'user_id' => Auth::id(),
            'message' => $request->message
        ]);

        return response()->json([
            'success' => true,
            'message' => 'تم إرسال الرسالة بنجاح',
            'data' => [
                'id' => $message->id,
                'user_id' => $message->user_id,
                'message' => $message->message,
                'created_at' => $message->created_at,
                'user' => [
                    'name' => $message->user->name,
                    'profile_photo_url' => $message->user->profile_photo_url
                ]
            ]
        ]);
    }

    public function destroy(Message $message)
    {
        // التحقق من أن المستخدم هو صاحب الرسالة
        if ($message->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'error' => 'غير مصرح لك بحذف هذه الرسالة'
            ], 403);
        }

        $message->delete();

        return response()->json([
            'success' => true,
            'message' => 'تم حذف الرسالة بنجاح'
        ]);
    }
}
