<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RuanganAdminController extends Controller
{
    public function index()
    {
        if (!session('role') || session('role') !== 'admin') {
            return redirect('login');
        }
        $ruangan = \DB::table('tbl_ruangan')->get();
        return view('pages.ruangan-admin', compact('ruangan'));
    }

    public function create()
    {
        if (!session('role') || session('role') !== 'admin') {
            return redirect('login');
        }
        return view('pages.tambah-ruangan');
    }

    public function store(Request $request)
    {
        if (!session('role') || session('role') !== 'admin') {
            return redirect('login');
        }
        $request->validate([
            'id_ruangan' => 'required|unique:tbl_ruangan,id_ruangan',
            'nama_ruangan' => 'required',
            'status_ruangan' => 'required',
            'gambar' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'required',
            'kapasitas' => 'required|integer|min:1',
            'fasilitas' => 'required',
        ]);
        $gambar = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $gambar = uniqid('ruang_') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/ruangan'), $gambar);
        }
        \DB::table('tbl_ruangan')->insert([
            'id_ruangan' => $request->id_ruangan,
            'nama_ruangan' => $request->nama_ruangan,
            'status_ruangan' => $request->status_ruangan,
            'gambar' => $gambar,
            'deskripsi' => $request->deskripsi,
            'kapasitas' => $request->kapasitas,
            'fasilitas' => $request->fasilitas,
        ]);
        return redirect('ruangan-admin')->with('success', 'Ruangan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        if (!session('role') || session('role') !== 'admin') {
            return redirect('login');
        }
        $ruangan = \DB::table('tbl_ruangan')->where('id_ruangan', $id)->first();
        if (!$ruangan) return redirect('ruangan-admin')->with('error', 'Ruangan tidak ditemukan!');
        return view('pages.edit-ruangan', compact('ruangan'));
    }

    public function update(Request $request, $id)
    {
        if (!session('role') || session('role') !== 'admin') {
            return redirect('login');
        }
        $request->validate([
            'nama_ruangan' => 'required',
            'status_ruangan' => 'required',
            'deskripsi' => 'required',
            'kapasitas' => 'required|integer|min:1',
            'fasilitas' => 'required',
            'gambar' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);
        $ruangan = \DB::table('tbl_ruangan')->where('id_ruangan', $id)->first();
        $gambar = $ruangan->gambar;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $gambar = uniqid('ruang_') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/ruangan'), $gambar);
        }
        \DB::table('tbl_ruangan')->where('id_ruangan', $id)->update([
            'nama_ruangan' => $request->nama_ruangan,
            'status_ruangan' => $request->status_ruangan,
            'gambar' => $gambar,
            'deskripsi' => $request->deskripsi,
            'kapasitas' => $request->kapasitas,
            'fasilitas' => $request->fasilitas,
        ]);
        return redirect('ruangan-admin')->with('success', 'Ruangan berhasil diupdate!');
    }

    public function destroy($id)
    {
        if (!session('role') || session('role') !== 'admin') {
            return redirect('login');
        }
        \DB::table('tbl_ruangan')->where('id_ruangan', $id)->delete();
        return redirect('ruangan-admin')->with('success', 'Ruangan berhasil dihapus!');
    }
} 