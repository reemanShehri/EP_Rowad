<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIChatController extends Controller
{


    public function index()
    {
        return view('chat.index');
    }


    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        try {
            $response = $this->getAIResponse($request->message);

            return response()->json([
                'response' => $response
            ]);

        } catch (\Exception $e) {
            Log::error('Chat error: ' . $e->getMessage());

            return response()->json([
                'error' => 'حدث خطأ في معالجة طلبك'
            ], 500);
        }
    }

    private function getAIResponse($message)
    {
             $responses = [
            "مرحبا" => "مرحباً بك! كيف يمكنني مساعدتك اليوم؟",
            "كيف حالك" => "أنا بخير، شكراً لسؤالك! كيف يمكنني مساعدتك؟",
            "شكرا" => "العفو! هل هناك أي شيء آخر تحتاج مساعدتي فيه؟",
            "default" => "أنا أفهم أنك تقول: '$message'. للأسف أنا حالياً في وضع الاختبار. يمكنك تكوين اتصال بAPI الذكاء الاصطناعي المفضل لديك."
        ];

        return $responses[strtolower($message)] ?? $responses['default'];
    }
}
