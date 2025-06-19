<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailRuanganController extends Controller
{
    // Tambahkan method sesuai logic di PROJECT PHP/php/detail-ruangan.php

    public function index(Request $request)
    {
        if (!session('email') || session('role') != 'user') {
            return redirect('login');
        }

        $id = $request->query('id', '');
        $room = DB::table('tbl_ruangan')->where('id_ruangan', $id)->first();
        $nama_user = session('nama') ?? 'User';
        if (!$room) {
            return response('<h3>Ruangan tidak ditemukan.</h3>');
        }
        return view('pages.detail-ruangan', compact('room', 'id', 'nama_user'));
    }
} 