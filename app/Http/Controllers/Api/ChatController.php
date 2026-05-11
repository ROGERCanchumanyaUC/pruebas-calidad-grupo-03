<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function handleChat(Request $request)
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $message = $validated['message'];
        $apiKey = config('services.gemini.key');
        $model = config('services.gemini.model', 'gemini-2.5-flash');

        if (! $apiKey) {
            Log::warning('Gemini API key is not configured.');

            return response()->json([
                'reply' => 'El asistente no tiene configurada la clave de Gemini.',
            ], 500);
        }

        $systemPrompt = "Eres el asistente virtual de 'JM y JS Alimentos', una empresa con sede en Huancayo, Perú, expertos en calidad alimentaria, BPM e ISO para el sector alimentario.
        Ofrecen:
        - Capacitaciones especializadas y cursos, como 'BPM en Alimentos' (duración de 8 semanas, precio S/ 350 por persona).
        - Asesorías a empresas en Buenas Prácticas de Manufactura (BPM) e ISO (como ISO 25010).
        - Gestión de calidad alimentaria para profesionales y PyMEs del sector.
        
        Tu tono debe ser profesional, amable, servicial y conciso. Responde siempre en español. No inventes precios ni cursos que no estén en tu conocimiento.";

        try {
            $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent";

            $response = Http::withHeaders([
                'x-goog-api-key' => $apiKey,
            ])->acceptJson()->asJson()->timeout(30)->post($url, [
                'system_instruction' => [
                    'parts' => [
                        ['text' => $systemPrompt]
                    ]
                ],
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $message]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.7,
                    'maxOutputTokens' => 500,
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $reply = data_get($data, 'candidates.0.content.parts.0.text', 'Lo siento, no pude procesar la respuesta adecuadamente.');
                
                return response()->json([
                    'reply' => $reply
                ]);
            }

            Log::warning('Gemini request failed.', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return response()->json([
                'reply' => 'Hubo un error al conectar con Google Gemini. Por favor, intenta de nuevo.'
            ], 500);

        } catch (\Throwable $e) {
            Log::error('Unexpected Gemini chat error.', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'reply' => 'Ocurrió un error inesperado al procesar tu solicitud.'
            ], 500);
        }
    }
}
