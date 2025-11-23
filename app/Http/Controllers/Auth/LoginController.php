<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success','Sessão Finalizada com sucesso');
    }
}
