<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request): JsonResponse
    {
        $data = $request->validate([
            'course_id' => ['required', 'exists:courses,id'],
        ]);

        $course = Course::findOrFail($data['course_id']);

        // Check if the course is published
        if ($course->status !== 'publicado') {
            return response()->json(['ok' => false, 'msg' => 'Este curso no está disponible para inscripción.'], 422);
        }

        $cart = session()->get('cart', []);

        $exists = collect($cart)->contains('course_id', $course->id);
        if ($exists) {
            return response()->json(['ok' => false, 'msg' => 'Este curso ya está en tu carrito.'], 422);
        }

        $cart[] = [
            'course_id'   => $course->id,
            'course_name' => $course->name,
            'level'       => $course->level,
            'price'       => (float) $course->effective_price,
        ];

        session()->put('cart', $cart);

        return response()->json([
            'ok'    => true,
            'msg'   => '¡Curso agregado al carrito!',
            'count' => count($cart),
        ]);
    }

    public function remove(Request $request): JsonResponse
    {
        $request->validate([
            'course_id' => ['required', 'integer']
        ]);

        $courseId = (int) $request->input('course_id');
        $cart = collect(session()->get('cart', []))
            ->reject(fn ($item) => (int)$item['course_id'] === $courseId)
            ->values()
            ->all();

        session()->put('cart', $cart);

        return response()->json(['ok' => true, 'count' => count($cart)]);
    }

    public function index()
    {
        if (! auth()->check()) {
            return redirect()->route('login')->with('status', 'Inicia sesión para ver tu carrito.');
        }

        $cart  = session()->get('cart', []);
        $total = collect($cart)->sum('price');

        return view('checkout', compact('cart', 'total'));
    }
}
