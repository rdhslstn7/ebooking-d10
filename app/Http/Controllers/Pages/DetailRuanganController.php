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
        $rooms = [
            "D10.172" => [
                "name" => "Ruang Workshop",
                "image" => "/img/workshop2.jpg",
                "deskripsi" => "Laboratorium Pengembangan Media Pembelajaran Matematika merupakan fasilitas bagi mahasiswa untuk merancang media pembelajaran seperti modul, video, dan alat peraga. Laboratorium ini mendorong kreativitas calon guru dalam menciptakan media yang efektif dan menarik guna mendukung pemahaman matematika di kelas..",
                "kapasitas" => 50,
                "fasilitas" => "Proyektor, AC, Meja Kelompok, Sound System",
            ],
            "D10.176" => [
                "name" => "Lab Sains Data & Multimedia",
                "image" => "/img/lab sains data.jpg",
                "deskripsi" => "Laboratorium Multimedia dan Sains Data mendukung pengembangan keterampilan analisis data dan teknologi multimedia. Mahasiswa belajar mengelola, menganalisis, dan memvisualisasikan data dengan software seperti Python, R, dan MATLAB, serta mengembangkan media pembelajaran interaktif. Laboratorium ini membekali mahasiswa untuk menghadapi tantangan era digital di bidang pendidikan, industri, dan penelitian.",
                "kapasitas" => 20,
                "fasilitas" => "PC, Internet Cepat, Software Multimedia",
            ],
            "D10.178" => [
                "name" => "Ruang Microteaching",
                "image" => "/img/Microteaching.jpg",
                "deskripsi" => "Laboratorium Microteaching di Program Studi Pendidikan Matematika berfungsi sebagai tempat latihan mengajar bagi mahasiswa melalui simulasi di kelas kecil. Mahasiswa berperan sebagai guru dan siswa, lalu kegiatan direkam dan dievaluasi untuk mengidentifikasi kelebihan dan kekurangan. Fasilitas ini membantu mereka mempersiapkan diri sebelum terjun langsung ke dunia pendidikan.",
                "kapasitas" => 50,
                "fasilitas" => "Proyektor, AC, Meja Kelompok, Sound System",
            ],
            "D10.286" => [
                "name" => "Smart Classroom",
                "image" => "/img/Smartclass.jpg",
                "deskripsi" => "Smart Classroom adalah ruangan pembelajaran modern yang dilengkapi tiga monitor besar dan dirancang untuk mendukung proses belajar yang interaktif dan kolaboratif. Dengan tata letak kursi yang mendukung diskusi, ruangan ini memungkinkan pemaparan materi dari berbagai sudut serta mendorong partisipasi aktif dan pembelajaran berbasis proyek.",
                "kapasitas" => 80,
                "fasilitas" => "Proyektor, AC, Meja Kelompok, Sound System",
            ],
            "D10.289" => [
                "name" => "Ruang Seminar",
                "image" => "/img/Seminar.jpg",
                "deskripsi" => "Ruangan seminar berkapasitas lebih dari 100 orang ini dilengkapi dengan fasilitas audio-visual modern dan sistem pendingin udara (AC), sehingga sangat cocok untuk kegiatan seperti seminar, workshop, pelatihan, dan presentasi. Fasilitas yang tersedia mendukung penyampaian materi secara efektif serta menciptakan suasana yang nyaman bagi seluruh peserta.",
                "kapasitas" => 80,
                "fasilitas" => "Proyektor, AC, Meja Kelompok, Sound System",
            ],
            "D10.373" => [
                "name" => "Laboratorium Komputer 1",
                "image" => "/img/lab1.jpg",
                "deskripsi" => "Laboratorium komputer di bidang matematika mendukung pembelajaran, penelitian, dan proyek komputasi dengan software seperti MATLAB, Python, dan R. Fasilitas ini membantu analisis data, simulasi, dan visualisasi, serta meningkatkan keterampilan analitis dan kualitas penelitian di bidang matematika, statistika, dan sains data.",
                "kapasitas" => 70,
                "fasilitas" => "Proyektor, AC, Meja Kelompok, Sound System",
            ],
            "D10.370A" => [
                "name" => "Laboratorium Komputer 2",
                "image" => "/img/Lab programming.jpg",
                "deskripsi" => "Laboratorium komputer di bidang matematika mendukung pembelajaran, penelitian, dan proyek komputasi dengan software seperti MATLAB, Python, dan R. Fasilitas ini membantu pengguna mengembangkan keterampilan analitis dan komputasi dalam menyelesaikan persoalan matematika, statistika, dan sains data.",
                "kapasitas" => 50,
                "fasilitas" => "Proyektor, AC, Meja Kelompok, Sound System",
            ],
            "D10.370B" => [
                "name" => "Laboratorium Jaringan",
                "image" => "/img/lab_jaringan.jpg",
                "deskripsi" => "Laboratorium Jaringan digunakan untuk mempelajari, merancang, dan menguji sistem jaringan komputer. Dilengkapi perangkat seperti router, switch, dan server, laboratorium ini mendukung simulasi jaringan, keamanan siber, serta analisis data. Fasilitas ini membantu pengguna memahami konsep jaringan secara praktis dan mengembangkan keterampilan di bidang infrastruktur dan teknologi komunikasi..",
                "kapasitas" => 40,
                "fasilitas" => "Proyektor, AC, Meja Kelompok, Sound System",
            ],
        ];
        $id = $request->query('id', '');
        $room = DB::table('tbl_ruangan')->where('id_ruangan', $id)->first();
        $nama_user = session('nama') ?? 'User';
        if (!$room) {
            return response('<h3>Ruangan tidak ditemukan.</h3>');
        }
        return view('pages.detail-ruangan', compact('room', 'id', 'nama_user'));
    }
} 