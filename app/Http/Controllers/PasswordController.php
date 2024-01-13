<?php

// En app/Http/Controllers/PasswordController.php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function cambiarContrasena(Request $request)
    {
        $request->validate([
            'contrasena_actual' => 'required',
            'nueva_contrasena' => 'required|min:8',
            'confirmar_contrasena' => 'required|same:nueva_contrasena',
        ]);

        $usuario = $request->user();

        // Verifica la contraseña actual
        if (!Hash::check($request->contrasena_actual, $usuario->password)) {
            return response()->json(['message' => 'La contraseña actual es incorrecta'], 422);
        }

        // Cambia la contraseña
        $usuario->password = bcrypt($request->nueva_contrasena);
        $usuario->save();

        return response()->json(['message' => 'Contraseña cambiada con éxito']);

    }
// app/Http/Controllers/ForgotPasswordController.php




    // public function sendResetLinkEmail(Request $request): JsonResponse
    //     {
    //         $request->validate(['email' => 'required|email']);
    //         $status = Password::sendResetLink($request->only('email'));

    //         return $status === Password::RESET_LINK_SENT
    //             ? response()->json(['status' => __('passwords.sent')], 200)
    //             : response()->json(['error' => __('passwords.user')], 422);
    //     }


}
