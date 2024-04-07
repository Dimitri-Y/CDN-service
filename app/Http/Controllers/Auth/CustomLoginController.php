<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use App\Http\Middleware\HashPasswordBeforeAuth;

class CustomLoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        //$this->middleware('password.hashINlogin');
    }
    public function login(Request $request)
    {
        $this->validateLogin($request);
        $credentials = $request->only('login', 'password');
        $credentials['password'] = Hash::make($credentials['password']); // Захешувати пароль

        $credentials['password'] = $request->input('password');
        if (Auth::guard()->attempt($credentials)) {
            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);
    }
}