<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view("login.index");
    }

    public function store(Request $request)
    {
        if (!Auth::attempt($request->only(["email", "password"]))) {
            return redirect()->back()->withErrors("Usuário ou senha inválido!");
        }
        return to_route('series.index');
    }

    public function destroy()
    {
        Auth::logout();
        //return to_route('login');
        return redirect()->route('login');
    }
}
