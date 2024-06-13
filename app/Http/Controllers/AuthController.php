<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        if (!in_array(Auth::user()->role->name, ['Администратор'])) {
            return response()->json(['message' => "Access denied"], 403);
        }

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'patronymic' => 'nullable|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => 'required|integer|exists:roles,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }

        $role = Role::getRoleById($request->role_id);
        if ($role->name == "Администратор") {
            return response()->json(['message' => "Access denied"], 403);
        }

        $user = User::createUser($request->all());
        $user->load("role");

        return response()->json([
            'message' => "User created",
            'data' => $user,
        ], 200);
    }

    // Аутентификация пользователя и генерация токена
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['message' => 'Invalid auth credentials'], 400);
        }

        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('api-token')->plainTextToken;

        $user->load(['role']);

        return response()->json([
            'success' => true,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }

    // Выход пользователя и удаление токена
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out']);
    }

}
