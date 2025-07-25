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
            // استبدل هذا بالاتصال بAPI الذكاء الاصطناعي الخاص بك
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
        // 1. الخيار الأول: استخدام خدمة خارجية مثل OpenAI
        /*
        $apiKey = env('OPENAI_API_KEY');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json'
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $message]
            ],
            'temperature' => 0.7
        ]);

        return $response->json()['choices'][0]['message']['content'] ?? 'لا يمكن تفسير الرد';
        */

        // 2. الخيار الثاني: ردود مبرمجة مسبقاً (للاختبار)
        $responses = [
            "مرحبا" => "مرحباً بك! كيف يمكنني مساعدتك اليوم؟",
            "كيف حالك" => "أنا بخير، شكراً لسؤالك! كيف يمكنني مساعدتك؟",
            "شكرا" => "العفو! هل هناك أي شيء آخر تحتاج مساعدتي فيه؟",
            "default" => "أنا أفهم أنك تقول: '$message'. للأسف أنا حالياً في وضع الاختبار. يمكنك تكوين اتصال بAPI الذكاء الاصطناعي المفضل لديك."
        ];

        return $responses[strtolower($message)] ?? $responses['default'];
    }
}
