<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Регистрация пользователя. Принимает имя, пароль и код роли, возвращает токен авторизации.
     *
     * @param Request $request
     * @return void
     */
    public function register (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role_id' => 'required|integer|exists:roles,id',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $request['password']=Hash::make($request['password']);
        $user = User::create($request->toArray());
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $response = ['token' => $token];
        return response($response, 200);
    }
    
    /**
     * Вход пользователя в систему. Принимает логин, пароль, проверяет наличие пользователя в базе и совпадение пароля. Возвращает токен авторизации.
     *
     * @param Request $request
     * @return void
     */
    public function login (Request $request) {
        $user = User::where('name', $request->name)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];
                return response($response, 200);
            } else {
                $response = "Password missmatch";
                return response($response, 422);
            }
        } else {
            $response = 'User does not exist';
            return response($response, 422);
        }
    }

    /**
     * Выход пользователя из системы
     *
     * @param Request $request
     * @return void
     */
    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = 'You have been succesfully logged out!';
        return response($response, 200);
    }
}
