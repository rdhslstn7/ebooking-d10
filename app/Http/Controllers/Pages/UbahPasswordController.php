<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UbahPasswordController extends Controller
{
    public function index()
    {
        if (!session('email') || session('role') != 'user') {
            return redirect('login');
        }
        return view('pages.ubah-password');
    }

    public function update(Request $request)
    {
        if (!session('email') || session('role') != 'user') {
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
            return redirect('profil-user?pesan=Konfirmasi password baru tidak cocok!');
        }
        $user = \DB::table('tbl_user')->where('email_user', $email)->first();
        if ($user && $user->password_user === $password_lama) {
            $updated = \DB::table('tbl_user')->where('email_user', $email)->update([
                'password_user' => $password_baru
            ]);
            if ($updated) {
                return redirect('profil-user?pesan=Password berhasil diubah!');
            } else {
                return redirect('profil-user?pesan=Gagal mengubah password.');
            }
        } else {
            return redirect('profil-user?pesan=Password lama salah!');
        }
    }
} 