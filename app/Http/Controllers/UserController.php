<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        //
    }

    public function update(UserProfileRequest $request, User $user)
    {
        if ($request->password == 123456789) {
           $user->update(['username'=>$request->username]);
        }else{
            $user->update(['username'=>$request->username,'password'=>Hash::make($request->password)]);
        }
        return response('ok',200);
    }

    public function destroy(User $user)
    {

    }
    public function user()
    {   
        return Auth::check()?response(Auth::user(),200):'';
    }
}
