<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormPeminjamanController extends Controller
{
    // Tambahkan method sesuai logic di PROJECT PHP/php/form-peminjaman.php

    public function index(Request $request)
    {
        $id_ruangan = $request->query('id', '');
        $ruangan = \DB::table('tbl_ruangan')->where('id_ruangan', $id_ruangan)->first();
        $nama_ruangan = $ruangan ? $ruangan->nama_ruangan : 'Tidak Diketahui';
        $nama = session('nama');
        $nim = session('nim');
        $email = session('email');
        $no_telepon = session('no_telepon');
        $nama_user = session('nama');
        return view('pages.form-peminjaman', compact('id_ruangan', 'nama_ruangan', 'nama', 'nim', 'email', 'no_telepon', 'nama_user'));
    }

    public function store(Request $request)
    {
        if (!session('email') || session('role') !== 'user') {
            return redirect('login');
        }
        $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'email' => 'required|email',
            'no_ruangan' => 'required',
            'nama_kegiatan' => 'required',
            'organisasi' => 'required',
            'no_telepon' => 'required',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'dokumen' => 'required|file|mimes:pdf,jpg,jpeg,png',
        ]);
        // Handle file upload
        $file = $request->file('dokumen');
        $nama_file = uniqid() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $nama_file);
        // Generate ID otomatis
        $row = \DB::table('tbl_peminjaman')
            ->selectRaw('MAX(CAST(SUBSTRING(id_peminjaman, 5) AS UNSIGNED)) AS max_id')
            ->first();
        $next_id = ($row->max_id ?? 0) + 1;
        $id_peminjaman = 'RQST' . str_pad($next_id, 3, '0', STR_PAD_LEFT);
        $waktu = $request->input('waktu');
        $waktu_peminjaman = ($waktu === 'Full Day') ? 'Full Day' : explode(' - ', $waktu)[0];
        $status = 'Menunggu';
        try {
            \DB::table('tbl_peminjaman')->insert([
                'id_peminjaman' => $id_peminjaman,
                'nim' => $request->input('nim'),
                'nama_peminjam' => $request->input('nama'),
                'nama_kegiatan' => $request->input('nama_kegiatan'),
                'organisasi' => $request->input('organisasi'),
                'dokumen_pendukung' => $nama_file,
                'tanggal_peminjaman' => $request->input('tanggal'),
                'waktu_peminjaman' => $waktu_peminjaman,
                'status_persetujuan' => $status,
                'id_ruangan' => $request->input('no_ruangan'),
            ]);
            return redirect('riwayat')->with('success', 'Peminjaman berhasil diajukan untuk ruangan: ' . $request->input('no_ruangan') . ' untuk tanggal: ' . $request->input('tanggal'));
        } catch (\Exception $e) {
            return redirect('form-peminjaman?id=' . $request->input('no_ruangan'))->with('error', 'Gagal menyimpan data peminjaman!');
        }
    }
} 