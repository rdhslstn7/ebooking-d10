<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    // Tambahkan method sesuai logic di PROJECT PHP/php/riwayat.php

    public function index(Request $request)
    {
        if (!session('email') || session('role') != 'user') {
            return redirect('login');
        }
        $nama_user = session('nama') ?? 'User';
        $nim = session('nim');
        $status = $request->query('status', '');
        $sort = $request->query('sort', 'desc');
        $query = \DB::table('tbl_peminjaman as p')
            ->join('tbl_ruangan as r', 'p.id_ruangan', '=', 'r.id_ruangan')
            ->select('p.nama_kegiatan', 'p.organisasi', 'p.tanggal_peminjaman', 'p.waktu_peminjaman', 'p.status_persetujuan', 'r.id_ruangan', 'r.nama_ruangan', 'p.created_at')
            ->where('p.nim', $nim);
        if ($status && in_array($status, ['Disetujui', 'Menunggu', 'Tidak Disetujui'])) {
            $query->where('p.status_persetujuan', $status);
        }
        $result = $query->orderBy('p.created_at', $sort == 'asc' ? 'asc' : 'desc')->get();

        if ($request->query('ajax') === 'notif') {
            $notifikasi = \DB::table('tbl_peminjaman as p')
                ->join('tbl_ruangan as r', 'p.id_ruangan', '=', 'r.id_ruangan')
                ->select(
                    'p.id_peminjaman',
                    'p.nama_kegiatan',
                    'p.organisasi',
                    'p.tanggal_peminjaman',
                    'p.waktu_peminjaman',
                    'p.status_persetujuan',
                    'r.id_ruangan',
                    'r.nama_ruangan',
                    'p.created_at'
                )
                ->where('p.nim', session('nim'))
                ->whereIn('p.status_persetujuan', ['Disetujui', 'Tidak Disetujui'])
                ->where('p.sudah_dibaca', 0)
                ->orderByDesc('p.id_peminjaman')
                ->get();
            return response()->json([
                'count' => $notifikasi->count(),
                'notifikasi' => $notifikasi
            ]);
        }

        return view('pages.riwayat', compact('nama_user', 'result', 'status', 'sort'));
    }
} 