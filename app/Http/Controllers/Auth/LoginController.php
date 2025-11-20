<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function authUser(LoginRequest $request){

        $data = $request->only('email','password');

        if(Auth::attempt($data)){
            return redirect()->route('dashboard')->with('success','Usuário autênticado com sucesso');
        }
        return redirect()->back()->with('error','Usuário ou Senha incorretos');
    }
}
