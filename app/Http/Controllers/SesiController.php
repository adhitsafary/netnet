<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    function index()
    {
        return view('login.login');
    }

    function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => 'Email Wajib diisi',
                'password.required' => 'Password wajib diisi',
            ]
        );

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            if (Auth::user()->role == 'teknisi') {
                return redirect('masuk/teknisi');
            } else if (Auth::user()->role == 'admin') {
                return redirect('masuk/admin');
            } else if (Auth::user()->role == 'superadmin') {
                return redirect('masuk/superadmin');
            }

        } else {
            return redirect()->back()->withErrors('Username dan Password yang dimasukkan tidak sesuai')->withInput();
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
