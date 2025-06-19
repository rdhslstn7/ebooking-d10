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
        $enumStr = \DB::selectOne("SHOW COLUMNS FROM tbl_peminjaman WHERE Field = 'organisasi'")->Type;
        preg_match('/enum\\((.*)\\)/', $enumStr, $matches);
        $enum = [];
        if (isset($matches[1])) {
            $enum = array_map(function($v) {
                return trim($v, "'");
            }, explode(',', $matches[1]));
        }
        $organisasiList = $enum;
        return view('pages.form-peminjaman', compact('id_ruangan', 'nama_ruangan', 'nama', 'nim', 'email', 'no_telepon', 'nama_user', 'organisasiList'));
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
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
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
        $status = 'Menunggu';
        // Validasi overlap waktu
        $id_ruangan = $request->input('no_ruangan');
        $tanggal = $request->input('tanggal_mulai');
        $waktu_mulai = $request->input('waktu_mulai');
        $waktu_selesai = $request->input('waktu_selesai');
        $overlap = \DB::table('tbl_peminjaman')
            ->where('id_ruangan', $id_ruangan)
            ->where('status_persetujuan', 'Disetujui')
            ->whereDate('tanggal_mulai', '<=', $tanggal)
            ->whereDate('tanggal_selesai', '>=', $tanggal)
            ->where(function($q) use ($waktu_mulai, $waktu_selesai) {
                $q->where(function($q2) use ($waktu_mulai, $waktu_selesai) {
                    $q2->where('waktu_mulai', '<', $waktu_selesai)
                       ->where('waktu_selesai', '>', $waktu_mulai);
                });
            })
            ->exists();
        if ($overlap) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Waktu yang dipilih sudah terdaftar di peminjaman lain'], 422);
            }
            return redirect('form-peminjaman?id=' . $id_ruangan);
        }
        try {
            \DB::table('tbl_peminjaman')->insert([
                'id_peminjaman' => $id_peminjaman,
                'nim' => $request->input('nim'),
                'nama_peminjam' => $request->input('nama'),
                'nama_kegiatan' => $request->input('nama_kegiatan'),
                'organisasi' => $request->input('organisasi'),
                'dokumen_pendukung' => $nama_file,
                'tanggal_mulai' => $request->input('tanggal_mulai'),
                'tanggal_selesai' => $request->input('tanggal_selesai'),
                'waktu_mulai' => $request->input('waktu_mulai'),
                'waktu_selesai' => $request->input('waktu_selesai'),
                'status_persetujuan' => $status,
                'id_ruangan' => $request->input('no_ruangan'),
            ]);
            if ($request->expectsJson()) {
                // Simpan pesan sukses ke session agar muncul di riwayat setelah redirect
                session()->flash('success', 'Peminjaman berhasil diajukan untuk ruangan: ' . $request->input('no_ruangan') . ' untuk tanggal: ' . $request->input('tanggal_mulai') . ' dan waktu: ' . $request->input('waktu_mulai') . ' - ' . $request->input('waktu_selesai'));
                return response()->json(['success' => true, 'message' => 'Peminjaman berhasil diajukan!']);
            }
            return redirect('riwayat')->with('success', 'Peminjaman berhasil diajukan untuk ruangan: ' . $request->input('no_ruangan') . ' untuk tanggal: ' . $request->input('tanggal_mulai'));
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Gagal menyimpan data peminjaman!'], 500);
            }
            return redirect('form-peminjaman?id=' . $request->input('no_ruangan'));
        }
    }

    public function getBookedTimes(Request $request)
    {
        $id_ruangan = $request->query('id_ruangan');
        $tanggal = $request->query('tanggal');
        if (!$id_ruangan || !$tanggal) {
            return response()->json(['success' => false, 'message' => 'Parameter kurang'], 400);
        }
        $booked = \DB::table('tbl_peminjaman')
            ->where('id_ruangan', $id_ruangan)
            ->where('status_persetujuan', 'Disetujui')
            ->whereDate('tanggal_mulai', '<=', $tanggal)
            ->whereDate('tanggal_selesai', '>=', $tanggal)
            ->select('waktu_mulai', 'waktu_selesai')
            ->get();
        return response()->json(['success' => true, 'data' => $booked]);
    }
} 