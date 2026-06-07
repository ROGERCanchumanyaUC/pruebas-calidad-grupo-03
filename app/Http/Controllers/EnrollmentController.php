<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'course_name' => ['required', 'string', 'max:200'],
            'level'       => ['required', 'string', 'max:40'],
            'price'       => ['required', 'numeric', 'min:0'],
        ]);

        $already = Enrollment::where('user_id', auth()->id())
            ->where('course_name', $data['course_name'])
            ->exists();

        if ($already) {
            return response()->json(['ok' => false, 'msg' => 'Ya estás inscrito en este curso.'], 422);
        }

        Enrollment::create([
            'user_id'     => auth()->id(),
            'course_name' => $data['course_name'],
            'level'       => $data['level'],
            'price'       => $data['price'],
        ]);

        return response()->json(['ok' => true, 'msg' => '¡Inscripción exitosa! Ve a Mi Cuenta para verla.']);
    }
}
