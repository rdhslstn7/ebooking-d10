<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilAdminController extends Controller
{
    public function index()
    {
        if (!session('role') || session('role') !== 'admin') {
            return redirect('login');
        }
        return view('pages.profil-admin');
    }

    public function ubahPassword()
    {
        if (!session('role') || session('role') !== 'admin') {
            return redirect('login');
        }
        return view('pages.ubah-password-admin');
    }

    public function update(Request $request)
    {
        if (!session('role') || session('role') !== 'admin') {
            return redirect('login');
        }
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required',
            'konfirmasi' => 'required',
        ]);
        $email = session('email');
        $password_lama = $request->input('password_lama');
        $password_baru = $request->input('password_baru');
        $konfirmasi = $request->input('konfirmasi');
        if ($password_baru !== $konfirmasi) {
            return redirect('profil-admin')->with('error', 'Konfirmasi password baru tidak cocok!');
        }
        $admin = \DB::table('tbl_admin')->where('email_admin', $email)->first();
        if ($admin && $admin->password_admin === $password_lama) {
            $updated = \DB::table('tbl_admin')->where('email_admin', $email)->update([
                'password_admin' => $password_baru
            ]);
            if ($updated) {
                return redirect('profil-admin')->with('success', 'Password berhasil diubah!');
            } else {
                return redirect('profil-admin')->with('error', 'Gagal mengubah password.');
            }
        } else {
            return redirect('profil-admin')->with('error', 'Password lama salah!');
        }
    }
} 