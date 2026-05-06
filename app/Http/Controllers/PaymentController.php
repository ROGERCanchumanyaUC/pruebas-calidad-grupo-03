<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function process(Request $request): RedirectResponse
    {
        $request->validate([
            'card_name'   => ['required', 'string'],
            'card_number' => ['required', 'string', 'min:16'],
            'card_exp'    => ['required', 'string'],
            'card_cvc'    => ['required', 'string', 'min:3'],
        ], [
            'card_name.required'   => 'Ingresa el nombre en la tarjeta.',
            'card_number.required' => 'Ingresa el número de tarjeta.',
            'card_number.min'      => 'El número debe tener al menos 16 dígitos.',
            'card_exp.required'    => 'Ingresa la fecha de expiración.',
            'card_cvc.required'    => 'Ingresa el código CVC.',
            'card_cvc.min'         => 'El CVC debe tener al menos 3 dígitos.',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cursos')
                ->with('status', 'Tu carrito estaba vacío.');
        }

        foreach ($cart as $item) {
            // Evitar duplicados si ya tiene la inscripción
            $exists = Enrollment::where('user_id', auth()->id())
                ->where('course_name', $item['course_name'])
                ->exists();

            if (! $exists) {
                Enrollment::create([
                    'user_id'     => auth()->id(),
                    'course_name' => $item['course_name'],
                    'level'       => $item['level'],
                    'price'       => $item['price'],
                    'status'      => 'pagado',
                ]);
            }
        }

        session()->forget('cart');

        return redirect()->route('pago.exito')
            ->with('paid_count', count($cart));
    }
}
