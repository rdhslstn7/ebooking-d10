<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        // Cek user
        $user = \DB::table('tbl_user')
            ->where('email_user', $email)
            ->where('password_user', $password)
            ->first();

        // Cek admin
        $admin = \DB::table('tbl_admin')
            ->where('email_admin', $email)
            ->where('password_admin', $password)
            ->first();

        if ($user) {
            session([
                'email' => $user->email_user,
                'nama' => $user->nama_user,
                'nim' => $user->nim,
                'no_telepon' => $user->no_telepon,
                'role' => 'user',
                'user_id' => $user->id ?? $user->nim ?? null,
            ]);
            return redirect('ruangan');
        } elseif ($admin) {
            session([
                'email' => $admin->email_admin,
                'nama' => $admin->nama_admin,
                'role' => 'admin',
                'user_id' => $admin->id ?? null,
            ]);
            return redirect('admin-dashboard');
        } else {
            return redirect('login')->with('error', 'Email atau password salah!');
        }
    }
} 