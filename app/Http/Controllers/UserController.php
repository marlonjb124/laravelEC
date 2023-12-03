<?php

// UserController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\NewAccessToken;

class UserController extends Controller
{
    public function createUser(Request $request)
    {
        $userData = $request->all();
        $userData['password'] = Hash::make($userData['password']);

        $newUser = User::create($userData);
        $tokenName = $request->token_name ? $request->token_name : 'authToken';


        // Crea un token de acceso para el nuevo usuario utilizando Sanctum
        $token = $newUser->createToken($tokenName);

        return response()->json(['user' => $newUser, 'access_token' => $token->plainTextToken]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = User::where('email',$request->email)->first();
            
            // Crea un token de acceso para el usuario autenticado utilizando Sanctum
            $tokenName = $request->token_name ? $request->token_name : 'authToken';
            // Crea un token de acceso para el usuario autenticado utilizando Sanctum
            $token = $user->createToken($tokenName);

            return response()->json(['access_token' => $token->plainTextToken, 'token_type' => 'bearer']);
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
    }
    public function logout(Request $request){
        $user = $request->user();
        $user->tokens()->delete();
        return response()->json(['message' => 'Logout successful']);
    }




    public function getUsers()
    {
        $users = User::all();

        return response()->json(['users' => $users]);
    }

    public function getUserByEmail($email)
    {
        $user = User::where('email', $email)->first();

        return response()->json(['user' => $user]);
    }

    public function getUserByUsername($username)
    {
        $user = User::where('username', $username)->first();

        return response()->json(['user' => $user]);
    }

    public function getUserById($id)
    {
        $user = User::find($id);

        return response()->json(['user' => $user]);
    }

    public function me()
    {
        $user = auth()->user();

        return response()->json(['user' => $user]);
    }

    public function addToFavs(Request $request)
    {
        // $user = auth()->user();
        $user = User::where('email',$request->email)->first();

        if ($user) {
            $productId = $request->input('product_id');

            if ($user->fav === null) {
                $user->fav = [];
            }

            if (!in_array($productId, $user->fav)) {
                array_push($user->fav, $productId);
                $user->save();

                return response()->json(['favs' => $user->fav]);
            }
        }

        return response()->json(['error' => 'User not found'], 404);
    }

    public function getFavs()
    {
        $user = auth()->user();

        if ($user) {
            return response()->json(['favs' => $user->fav]);
        }

        return response()->json(['error' => 'User not found'], 404);
    }
}

    // Resto del código ...

//     public function addToFavs(Request $request)
//     {
//         $user = User::where('username',$request->username)->first();

//         if ($user) {
//             $productId = $request->input('product_id');

//             if ($user->fav === null) {
//                 $user->fav = [];
//             }

//             if (!in_array($productId, $user->fav)) {
//                 array_push($user->fav, $productId);
//                 $user->save();

//                 return response()->json(['favs' => $user->fav]);
//             }
//         }

//         return response()->json(['error' => 'User not found'], 404);
//     }

//     public function getFavs()
//     {
//         $user = auth()->user();

//         if ($user) {
//             return response()->json(['favs' => $user->fav]);
//         }

//         return response()->json(['error' => 'User not found'], 404);
//     }
// }

