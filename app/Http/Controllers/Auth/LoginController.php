<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function authUser(Request $request){

        $data = $request->only('email','password');

        if(Auth::attempt($data)){
            return redirect()->route('home.index')->with('success','Usuário autênticado com sucesso');
        }
        return redirect()->back()->with('error','Usuário ou Senha incorretos');
    }
}
