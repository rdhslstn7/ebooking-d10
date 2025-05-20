<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    // Tambahkan method sesuai logic di PROJECT PHP/php/admin-dashboard.php

    public function index()
    {
        if (!session('role') || session('role') !== 'admin') {
            return redirect('login');
        }
        $pending = \DB::table('tbl_peminjaman')->where('status_persetujuan', 'Menunggu')->count();
        $total_rooms = \DB::table('tbl_ruangan')->count();
        $total_users = \DB::table('tbl_user')->count();
        return view('pages.admin-dashboard', compact('pending', 'total_rooms', 'total_users'));
    }
} 