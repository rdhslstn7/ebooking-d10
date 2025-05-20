<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    // Tambahkan method sesuai logic di PROJECT PHP/php/ruangan.php

    public function index(Request $request)
    {
        if (!session('nim')) {
            if ($request->ajax() || $request->query('ajax') === 'notif') {
                return response()->json(['count' => 0, 'notifikasi' => []]);
            } else {
                return redirect('login');
            }
        }
        $nama_user = session('nama') ?? 'User';
        // Notifikasi AJAX
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
        // Handle klik notifikasi
        if ($request->query('id_peminjaman')) {
            \DB::table('tbl_peminjaman')
                ->where('id_peminjaman', $request->query('id_peminjaman'))
                ->update(['sudah_dibaca' => 1]);
            return redirect('riwayat');
        }
        $ruangan = \DB::table('tbl_ruangan')->get();
        return view('pages.ruangan', compact('nama_user', 'ruangan'));
    }
} 