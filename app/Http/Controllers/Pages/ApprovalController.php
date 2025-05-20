<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    public function index(Request $request)
    {
        if (!session('role') || session('role') !== 'admin') {
            return redirect('login');
        }
        $query = \DB::table('tbl_peminjaman as p')
            ->leftJoin('tbl_user as u', 'p.nim', '=', 'u.nim')
            ->select(
                'p.id_peminjaman', 'p.nim', 'p.nama_peminjam', 'p.nama_kegiatan',
                'p.organisasi', 'p.dokumen_pendukung', 'p.tanggal_peminjaman',
                'p.waktu_peminjaman', 'p.id_ruangan', 'p.status_persetujuan',
                'u.email_user', 'u.no_telepon', 'p.created_at'
            );
        if ($request->filled('status')) {
            $query->where('p.status_persetujuan', $request->status);
        }
        $sort = $request->input('sort', 'desc');
        $query->orderBy('p.created_at', $sort === 'asc' ? 'asc' : 'desc');
        $result = $query->get();
        return view('pages.approval', compact('result'));
    }

    public function update(Request $request)
    {
        if (!session('role') || session('role') !== 'admin') {
            return redirect('login');
        }
        $request->validate([
            'id' => 'required',
            'status' => 'required|in:Disetujui,Tidak Disetujui',
        ]);
        \DB::table('tbl_peminjaman')
            ->where('id_peminjaman', $request->input('id'))
            ->update(['status_persetujuan' => $request->input('status')]);
        return redirect('approval');
    }
} 