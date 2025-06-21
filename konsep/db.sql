CREATE DATABASE `ebooking2`;
USE `ebooking2`;

-- Tabel: tbl_admin
CREATE TABLE `tbl_admin` (
  `id_admin` varchar(10) NOT NULL,
  `email_admin` varchar(255) NOT NULL,
  `password_admin` varchar(16) NOT NULL,
  `nama_admin` char(50) NOT NULL,
  PRIMARY KEY (`id_admin`),
  UNIQUE KEY `email_admin` (`email_admin`)
);

INSERT INTO `tbl_admin` (`id_admin`, `email_admin`, `password_admin`, `nama_admin`) VALUES
  ('ADM1', 'alfanfarhanulahyar@gmail.com', '1111', 'M Alpan'),
  ('ADM2', 'rdh.slstn@gmail.com', '123', 'Ridho Sulistiono'),
  ('ADM3', 'fianalfiankjn@gmail.com', '1111', 'Alfian Adi Pratama'),
  ('ADM4', 'wahyudinoviansyah1@gmail.com', '1111', 'Wahyudi Noviansyah');

CREATE TABLE `tbl_user` (
  `nim` varchar(50) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `nama_user` char(50) NOT NULL,
  `password_user` varchar(16) NOT NULL,
  `no_telepon` varchar(14) NOT NULL,
  `foto_user` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nim`),
  UNIQUE KEY `email_user` (`email_user`)
);


INSERT INTO `tbl_user` (`nim`, `email_user`, `nama_user`, `password_user`, `no_telepon`, `foto_user`) VALUES
	('2304010008', 'adipratamaalfian45@students.unnes.ac.id', 'Alfian Adi Pratama', '1111', '085292347543', NULL),
	('2304010017', 'alfanfarhanulahyar@students.unnes.ac.id', 'M Alpan', '1111', '089654502870', NULL),
	('2304010022', 'wahyudinoviansyah1@students.uunnes.ac.id', 'Wahyudi Noviansyah', '1111', '085882259188', NULL),
	('2304010035', 'rdhslstn23@students.unnes.ac.id', 'Ridho Sulistiono', 'asdf', '089502621900', 'foto_684c059c85433.jpg');
	
-- Tabel: tbl_ruangan
CREATE TABLE `tbl_ruangan` (
  `id_ruangan` varchar(10) NOT NULL,
  `nama_ruangan` varchar(50) NOT NULL,
  `status_ruangan` enum('Tersedia','Tidak Tersedia') NOT NULL DEFAULT 'Tersedia',
  `deskripsi` text,
  `kapasitas` int DEFAULT NULL,
  `fasilitas` text,
  `gambar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_ruangan`)
);

INSERT INTO `tbl_ruangan` (`id_ruangan`, `nama_ruangan`, `status_ruangan`, `deskripsi`, `kapasitas`, `fasilitas`, `gambar`) VALUES
  ('D10.172', 'Ruang Workshop', 'Tersedia', 'Laboratorium Pengembangan Media Pembelajaran Matematika merupakan fasilitas bagi mahasiswa untuk merancang media pembelajaran seperti modul, video, dan alat peraga. Laboratorium ini mendorong kreativitas calon guru dalam menciptakan media yang efektif dan menarik guna mendukung pemahaman matematika di kelas.', 50, 'Proyektor, AC, Kursi dan Meja, Sound System, Alat, Smart TV', '/img/workshop2.jpg'),
	('D10.176', 'Lab. Sains Data & Multimedia', 'Tersedia', 'Laboratorium Multimedia dan Sains Data mendukung pengembangan keterampilan analisis data dan teknologi multimedia. Mahasiswa belajar mengelola, menganalisis, dan memvisualisasikan data dengan software seperti Python, R, dan MATLAB, serta mengembangkan media pembelajaran interaktif. Laboratorium ini membekali mahasiswa untuk menghadapi tantangan era digital di bidang pendidikan, industri, dan penelitian.', 20, 'PC, Internet Cepat, Software Multimedia, Ruangan Interview, Sound System', '/img/lab sains data.jpg'),
	('D10.178', 'Ruang Microteaching', 'Tersedia', 'Laboratorium Microteaching di Program Studi Pendidikan Matematika berfungsi sebagai tempat latihan mengajar bagi mahasiswa melalui simulasi di kelas kecil. Mahasiswa berperan sebagai guru dan siswa, lalu kegiatan direkam dan dievaluasi untuk mengidentifikasi kelebihan dan kekurangan. Fasilitas ini membantu mereka mempersiapkan diri sebelum terjun langsung ke dunia pendidikan.', 50, 'Proyektor, AC, Meja, Kursi, Smart TV, Alat', '/img/Microteaching.jpg'),
	('D10.286', 'Smart Classroom', 'Tersedia', 'Smart Classroom adalah ruangan pembelajaran modern yang dilengkapi tiga monitor besar dan dirancang untuk mendukung proses belajar yang interaktif dan kolaboratif. Dengan tata letak kursi yang mendukung diskusi, ruangan ini memungkinkan pemaparan materi dari berbagai sudut serta mendorong partisipasi aktif dan pembelajaran berbasis proyek.', 50, 'Proyektor, AC, Meja Kelompok, Papan Tulis, Smart TV', '/img/Smartclass.jpg'),
	('D10.289', 'Ruang Seminar', 'Tersedia', 'Ruangan seminar berkapasitas lebih dari 100 orang ini dilengkapi dengan fasilitas audio-visual modern dan sistem pendingin udara (AC), sehingga sangat cocok untuk kegiatan seperti seminar, workshop, pelatihan, dan presentasi. Fasilitas yang tersedia mendukung penyampaian materi secara efektif serta menciptakan suasana yang nyaman bagi seluruh peserta.', 80, 'Proyektor, AC, Meja Kelompok, Sound System, Papan Tulis, Smart TV', '/img/Seminar.jpg'),
	('D10.370A', 'Lab. Komputer 2', 'Tersedia', 'Laboratorium komputer di bidang matematika mendukung pembelajaran, penelitian, dan proyek komputasi dengan software seperti MATLAB, Python, dan R. Fasilitas ini membantu pengguna mengembangkan keterampilan analitis dan komputasi dalam menyelesaikan persoalan matematika, statistika, dan sains data.', 50, 'Proyektor, AC, Meja dan Komputer, Papan Tulis', '/img/Lab programming.jpg'),
	('D10.370B', 'Lab. Jaringan', 'Tersedia', 'Laboratorium Jaringan digunakan untuk mempelajari, merancang, dan menguji sistem jaringan komputer. Dilengkapi perangkat seperti router, switch, dan server, laboratorium ini mendukung simulasi jaringan, keamanan siber, serta analisis data. Fasilitas ini membantu pengguna memahami konsep jaringan secara praktis dan mengembangkan keterampilan di bidang infrastruktur dan teknologi komunikasi.', 50, 'Proyektor, AC, Kursi dan Meja, Alat Jaringan, Papan Tulis', '/img/lab_jaringan.jpg'),
	('D10.373', 'Lab. Komputer 1', 'Tersedia', 'Laboratorium komputer di bidang matematika mendukung pembelajaran, penelitian, dan proyek komputasi dengan software seperti MATLAB, Python, dan R. Fasilitas ini membantu analisis data, simulasi, dan visualisasi, serta meningkatkan keterampilan analitis dan kualitas penelitian di bidang matematika, statistika, dan sains data.', 70, 'Proyektor, AC, Meja dan Komputer, Papan Tulis', '/img/lab1.jpg'),
  ('D10.Tes', 'Tes ruangan', 'Tidak Tersedia', 'ww', 25, 'qgh', 'ruang_682b48f3d0a9e.png');
  
-- Tabel: tbl_peminjaman
CREATE TABLE `tbl_peminjaman` (
  `id_auto` int NOT NULL AUTO_INCREMENT,
  `id_peminjaman` varchar(10) NOT NULL,
  `nim` varchar(50) NOT NULL,
  `nama_peminjam` char(50) NOT NULL DEFAULT '',
  `nama_kegiatan` char(255) NOT NULL,
  `organisasi` enum('BPH','Himatika','KIM','KWU Matematika','LPOM','MCC','MEC','MJC','MSC','PMC','SIGMA','The Mate','Rombel Matematika','Program Studi') NOT NULL,
  `dokumen_pendukung` varchar(255) NOT NULL,
  `status_persetujuan` enum('Disetujui','Menunggu','Tidak Disetujui') NOT NULL DEFAULT 'Menunggu',
  `id_ruangan` varchar(10) NOT NULL,
  `sudah_dibaca` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `waktu_mulai` time DEFAULT NULL,
  `waktu_selesai` time DEFAULT NULL,
  PRIMARY KEY (`id_auto`),
  UNIQUE KEY `id_peminjaman` (`id_peminjaman`),
  KEY `nim` (`nim`),
  KEY `id_ruangan` (`id_ruangan`),
  CONSTRAINT `tbl_peminjaman_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `tbl_user` (`nim`) ON DELETE CASCADE,
  CONSTRAINT `tbl_peminjaman_ibfk_2` FOREIGN KEY (`id_ruangan`) REFERENCES `tbl_ruangan` (`id_ruangan`) ON DELETE CASCADE
);
