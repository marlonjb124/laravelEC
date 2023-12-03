<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function createProfile($user_id)
    {
        $newProfile = Perfil::create([
            'name' => null,
            'surname' => null,
            'address' => null,
            'phone' => null,
            'user_id' => $user_id,
            'credit_card' => null,
            'profile_pic' => null,
        ]);

        return response()->json(['profile' => $newProfile]);
    }

    public function getProfileData($user_id)
    {
        $profileData = Perfil::where('user_id', $user_id)->first();

        return response()->json(['profile' => $profileData]);
    }

    public function updateProfile($user_id, Request $request)
    {
        $profile = Perfil::where('user_id', $user_id)->first();

        if ($profile) {
            $profileData = $request->all();

            foreach ($profileData as $field => $value) {
                $profile->$field = $value;
            }

            $profile->save();

            return response()->json(['profile' => $profile]);
        }

        return response()->json(['error' => 'User does not exist'], 404);
    }
}
