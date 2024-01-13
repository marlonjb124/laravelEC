<?php

// app/Http/Controllers/ForgotPasswordController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;

class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request): JsonResponse
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['status' => trans($status)], 200);
        } else {
            throw ValidationException::withMessages(['email' => trans($status)]);
        }
    }
}
