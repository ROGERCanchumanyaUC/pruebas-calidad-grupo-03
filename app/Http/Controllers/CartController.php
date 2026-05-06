<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request): JsonResponse
    {
        $data = $request->validate([
            'course_name' => ['required', 'string', 'max:200'],
            'level'       => ['required', 'string', 'max:40'],
            'price'       => ['required', 'numeric', 'min:0'],
        ]);

        $cart = session()->get('cart', []);

        $exists = collect($cart)->contains('course_name', $data['course_name']);
        if ($exists) {
            return response()->json(['ok' => false, 'msg' => 'Este curso ya está en tu carrito.'], 422);
        }

        $cart[] = [
            'course_name' => $data['course_name'],
            'level'       => $data['level'],
            'price'       => (float) $data['price'],
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
        $name = $request->input('course_name');
        $cart = collect(session()->get('cart', []))
            ->reject(fn ($item) => $item['course_name'] === $name)
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
