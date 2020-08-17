<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if ($request->ajax()) {
            $credentials = $request->only('username','password');
            if (Auth::attempt($credentials)) {
                return Auth::user();
            }else{
                return response()->json('Credenciales Incorrectas',500);
            }
        }
    }
    public function logout(Request $request)
    {
        if ($request->ajax()) {
            Auth::logout();
        }
    }


}
