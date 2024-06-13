<?php

namespace App\Http\Controllers;

use App\Models\SystemRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::getAll($request);

        $users->load(['role']);

        return response()->json(["data" => $users]);
    }

    public function showCurrentUser(Request $request)
    {
        $user = $request->user();

        $user->load(['role', 'resources.resource']);

        return response(['data' => $user]);
    }

    public static function show($id)
    {
        $user = User::getUserById($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Подгружаем информацию о роли пользователя
        $user->load(['role', 'resources.resource']);

        return response()->json(['data' => $user]);
    }

    public static function update(Request $request, $id)
    {
        $user = User::getUserById($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'patronymic' => 'string|max:255',
            'role_id' => 'integer|exists:roles,id',
            'email' => 'email|unique:users,email,' . $user->id, // Исключение схожести почты для текущего пользователя
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }

        // Обновление данных пользователя
        $user->updateUser($request->all());

        $user->load(['role']);

        if ($request->has('password')) {
            $validator = Validator::make($request->all(), [
                'password' => 'string|min:8|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()->first()], 400);
            }

            $user->changePassword($request->password);
        }

        return response()->json(['message' => 'User updated successfully', 'data' => $user]);
    }

    public static function destroy(Request $request, $id)
    {
        $user = User::getUserById($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->deleteUser();

        return response()->json([
            'message' => 'User deleted successfully'
        ]);
    }
}
