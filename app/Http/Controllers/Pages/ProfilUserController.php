<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilUserController extends Controller
{
    // Tambahkan method sesuai logic di PROJECT PHP/php/profil-user.php

    public function index(Request $request)
    {
        if (!session('email') || session('role') != 'user') {
            return redirect('login');
        }
        $nim = session('nim');
        $user = \DB::table('tbl_user')->where('nim', $nim)->first();
        $status = $request->query('status', '');
        $sort = $request->query('sort', 'desc');
        $query = \DB::table('tbl_peminjaman as p')
            ->join('tbl_ruangan as r', 'p.id_ruangan', '=', 'r.id_ruangan')
            ->select('p.nama_kegiatan', 'p.organisasi', 'p.tanggal_mulai', 'p.tanggal_selesai', 'p.waktu_mulai', 'p.waktu_selesai', 'p.status_persetujuan', 'r.id_ruangan', 'r.nama_ruangan')
            ->where('p.nim', $nim);
        if ($status && in_array($status, ['Disetujui', 'Menunggu', 'Tidak Disetujui'])) {
            $query->where('p.status_persetujuan', $status);
        }
        $result = $query->orderBy('created_at', $sort == 'asc' ? 'asc' : 'desc')->get();
        return view('pages.profil-user', compact('user', 'result', 'status', 'sort'));
    }

    public function update(Request $request)
    {
        if (!session('email') || session('role') != 'user') {
            return redirect('login');
        }
        $request->validate([
            'nama_user' => 'required|string|max:100',
            'email_user' => 'required|email|max:100',
            'no_telepon' => 'required|string|max:20',
        ]);
        $nim = session('nim');
        try {
            $dataUpdate = [
                'nama_user' => $request->input('nama_user'),
                'email_user' => $request->input('email_user'),
                'no_telepon' => $request->input('no_telepon'),
            ];
            // Handle upload foto profil
            if ($request->hasFile('foto_user')) {
                $file = $request->file('foto_user');
                $request->validate([
                    'foto_user' => 'image|mimes:jpg,jpeg,png|max:5120', // 5MB
                ]);
                $nama_file = uniqid('foto_') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/foto-profil'), $nama_file);
                // Hapus foto lama
                $user = \DB::table('tbl_user')->where('nim', $nim)->first();
                if ($user && $user->foto_user && file_exists(public_path('uploads/foto-profil/'.$user->foto_user))) {
                    @unlink(public_path('uploads/foto-profil/'.$user->foto_user));
                }
                $dataUpdate['foto_user'] = $nama_file;
            }
            \DB::table('tbl_user')
                ->where('nim', $nim)
                ->update($dataUpdate);
            // Update session jika nama/email/no_telepon berubah
            session(['nama' => $request->input('nama_user')]);
            session(['email' => $request->input('email_user')]);
            session(['no_telepon' => $request->input('no_telepon')]);
            return redirect('profil-user?pesan=Data berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect('profil-user?pesan=Gagal memperbarui data!');
        }
    }
} 