<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DaftarController extends Controller
{
    public function index()
    {
        return view('pages.daftar');
    }

    public function daftar(Request $request)
    {
        $request->validate([
            'nama_user' => 'required',
            'nim' => 'required',
            'email_user' => 'required|email',
            'no_telepon' => 'required',
            'password_user' => 'required',
        ]);

        $email = $request->input('email_user');
        $emailDomain = '@students.unnes.ac.id';
        $emailRegex = "/^[^\s@]+@[^\s@]+\.[^\s@]+$/";

        if (!preg_match($emailRegex, $email)) {
            return redirect('daftar?error=email_format')->withInput();
        }
        if (strpos($email, $emailDomain) === false) {
            return redirect('daftar?error=email_domain')->withInput();
        }

        try {
            \DB::table('tbl_user')->insert([
                'nama_user' => $request->input('nama_user'),
                'nim' => $request->input('nim'),
                'email_user' => $email,
                'no_telepon' => $request->input('no_telepon'),
                'password_user' => $request->input('password_user'),
            ]);
            return redirect('login?success=1');
        } catch (\Exception $e) {
            return redirect('daftar?error=db')->withInput();
        }
    }
} 