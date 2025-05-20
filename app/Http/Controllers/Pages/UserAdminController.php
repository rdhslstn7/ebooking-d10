<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserAdminController extends Controller
{
    public function index()
    {
        if (!session('role') || session('role') !== 'admin') {
            return redirect('login');
        }
        $users = \DB::table('tbl_user')->get();
        return view('pages.user-admin', compact('users'));
    }

    public function create()
    {
        if (!session('role') || session('role') !== 'admin') {
            return redirect('login');
        }
        return view('pages.tambah-user');
    }

    public function store(Request $request)
    {
        if (!session('role') || session('role') !== 'admin') {
            return redirect('login');
        }
        $request->validate([
            'nama_user' => 'required',
            'nim' => 'required',
            'email_user' => ['required', 'email', 'regex:/^[A-Za-z0-9._%+-]+@students\.unnes\.ac\.id$/'],
            'no_telepon' => 'required',
            'password_user' => 'required',
        ]);
        \DB::table('tbl_user')->insert([
            'nama_user' => $request->nama_user,
            'nim' => $request->nim,
            'email_user' => $request->email_user,
            'no_telepon' => $request->no_telepon,
            'password_user' => $request->password_user,
        ]);
        return redirect('user-admin')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id)
    {
        if (!session('role') || session('role') !== 'admin') {
            return redirect('login');
        }
        $user = \DB::table('tbl_user')->where('nim', $id)->first();
        if (!$user) return redirect('user-admin')->with('error', 'User tidak ditemukan!');
        return view('pages.edit-user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        if (!session('role') || session('role') !== 'admin') {
            return redirect('login');
        }
        $request->validate([
            'nama_user' => 'required',
            'nim' => 'required',
            'email_user' => ['required', 'email', 'regex:/^[A-Za-z0-9._%+-]+@students\.unnes\.ac\.id$/'],
            'no_telepon' => 'required',
        ]);
        $data = [
            'nama_user' => $request->nama_user,
            'nim' => $request->nim,
            'email_user' => $request->email_user,
            'no_telepon' => $request->no_telepon,
        ];
        if ($request->filled('password_user')) {
            $data['password_user'] = $request->password_user;
        }
        $nim_lama = $request->nim_lama;
        
        \DB::table('tbl_user')->where('nim', $nim_lama)->update($data);
        return redirect('user-admin')->with('success', 'User berhasil diupdate!');
    }

    public function destroy($id)
    {
        if (!session('role') || session('role') !== 'admin') {
            return redirect('login');
        }
        \DB::table('tbl_user')->where('nim', $id)->delete();
        return redirect('user-admin')->with('success', 'User berhasil dihapus!');
    }
} 