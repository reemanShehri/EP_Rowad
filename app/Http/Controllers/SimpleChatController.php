<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SimpleMessage;
use Illuminate\Support\Facades\Auth;
use App\Models\Message; // أو SimpleMessage إذا استخدمت الجدول الجديد

class SimpleChatController extends Controller
{
    /**
     * عرض صفحة الدردشة الرئيسية
     */
    public function index()
    {
        // جلب آخر 50 رسالة مع معلومات المستخدم الأساسية
        $messages = SimpleMessage::latest()
            ->with('user:id,name') // جلب فقط id و name من المستخدم
            ->take(50)
            ->get()
            ->reverse(); // لعرض الأقدم فالأحدث

        return view('chatAll.index', compact('messages'));
    }

    /**
     * حفظ رسالة جديدة
     */
    public function store(Request $request)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'content' => 'required|string|max:1000'
        ]);

        // إنشاء الرسالة الجديدة
        $message = SimpleMessage::create([
            'user_id' => Auth::id(),
            'content' => $request->content
        ]);

        // رد JSON للطلبات الأجاكس
        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => $message->load('user:id,name')
            ]);
        }

        // رد عادي لغير الأجاكس
        return back()->with('success', 'تم إرسال الرسالة بنجاح');
    }

    /**
     * حذف رسالة
     */
public function destroy($id)
{
    try {
        $message = Message::findOrFail($id);

        if ($message->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'غير مصرح لك بحذف هذه الرسالة'
            ], 403);
        }

        $message->delete();

        return response()->json([
            'success' => true,
            'message' => 'تم الحذف بنجاح'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'حدث خطأ: ' . $e->getMessage()
        ], 500);
    }
}
}
