<?php /* session_start(); */ ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Our CSS -->
    <link rel="stylesheet" href="/css/index.css" />
    <title>E-Booking D10</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
  </head>

  <body id="home">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">
        <a class="navbar-brand" href="#">E-Booking D10</a>
        <button class="navbar-toggler" type="button" id="customToggler" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#home">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about">Tentang</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#ruangan">Ruangan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#footer">Kontak</a>
            </li>
            {{-- Session login/logout --}}
            @if(session('user_id'))
              <li class="nav-item">
                <a class="nav-link" href="{{ url('logout') }}">Logout</a>
              </li>
            @else
              <li class="nav-item">
                <a class="nav-link" href="{{ url('login') }}">Masuk</a>
              </li>
            @endif
          </ul>
        </div>
      </div>
    </nav>

    <!-- Overlay -->
    <div class="menu-overlay" id="menuOverlay"></div>

    <!-- toggle -->
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const toggler = document.querySelector(".navbar-toggler");
        const collapse = document.querySelector(".navbar-collapse");
        const overlay = document.getElementById("menuOverlay");

        toggler.addEventListener("click", function () {
          collapse.classList.toggle("show");
          overlay.classList.toggle("show");
          toggler.classList.toggle("clicked"); // << efek timbul!
        });

        overlay.addEventListener("click", function () {
          collapse.classList.remove("show");
          overlay.classList.remove("show");
          toggler.classList.remove("clicked");
        });

        document.querySelectorAll(".nav-link").forEach((link) => {
          link.addEventListener("click", () => {
            collapse.classList.remove("show");
            overlay.classList.remove("show");
            toggler.classList.remove("clicked");
          });
        });
      });
    </script>
    <!-- End of Navbar -->

    <!-- Hero Section -->

    <section class="hero">
      <div class="overlay"></div>
      <div class="hero-content">
        <h1>Pesan Ruangan Lab Lebih Mudah, Cepat, Praktis</h1>
        <p>Pesan ruangan makin praktis lewat E-Booking Lab Matematika D10 UNNES. Tinggal klik, bisa langsung cek status peminjaman.</p>
        @if(session('user_id') || session('email'))
          <a href="{{ url('ruangan') }}" class="cta-button">Pinjam Sekarang</a>
        @else
          <a href="{{ url('login') }}" class="cta-button">Pinjam Sekarang</a>
        @endif
      </div>
    </section>

    <!-- End of Hero Section -->

    <!-- About Section -->

    <section class="about-section" id="about">
      <div class="container">
        <div class="row align-items-center">
          <!-- Text Section -->
          <div class="col-md-6 about-text">
            <h2>Tentang E-Booking D10</h2>
            <p>
              E-Booking D10 adalah aplikasi berbasis web untuk mempermudah pemesanan ruangan di Gedung D10. Pengguna cukup mengajukan permintaan jadwal, dan sistem akan memastikan tidak ada bentrok serta mengirimkan notifikasi.
            </p>
          </div>

          <!-- Image Section -->
          <div class="col-md-6 about-img text-center">
            <img src="/img/apps2.png" alt="Gedung D10" class="img-fluid" />
          </div>
        </div>
      </div>
    </section>

    <!-- End of About Section -->

    <!-- Room Section -->
    <section id="ruangan">
      <div class="container">
        <h2>Ruangan Tersedia</h2>
        <div class="ruangan-grid">
          <!-- Ruangan 1 -->
          <div class="ruangan-item">
            <img src="/img/workshop2.jpg" alt="Ruangan 1" />
            <h3>Ruang Workshop (D10.172)</h3>
            <p>Ruangan ini mendukung mahasiswa untuk merancang media pembelajaran seperti modul, video, dan alat peraga.</p>
          </div>
          <!-- Ruangan 2 -->
          <div class="ruangan-item">
            <img src="/img/lab sains data.jpg" alt="Ruangan 2" />
            <h3>Ruang Sains Data & Multimedia (D10.176)</h3>
            <p>Laboratorium yang mendukung pengembangan keterampilan analisis data dan teknologi multimedia dengan menggunakan software</p>
          </div>
          <!-- Ruangan 3 -->  
          <div class="ruangan-item">
            <img src="/img/Microteaching.jpg" alt="Ruangan 3" />
            <h3>Ruang Microteaching (D10.178)</h3>
            <p>Laboratorium ini berfungsi sebagai tempat latihan mengajar bagi mahasiswa melalui simulasi di kelas kecil.</p>
          </div>
          <!-- Ruangan 4 -->
          <div class="ruangan-item">
            <img src="/img/Smartclass2.jpg" alt="Ruangan 4" />
            <h3>Smart Classroom (D10.286)</h3>
            <p>Ruangan ini adalah ruangan pembelajaran modern yang dilengkapi tiga monitor besar dan mendukung proses belajar yang interaktif dan kolaboratif</p>
          </div>
          <!-- Ruangan 5 -->
          <div class="ruangan-item">
            <img src="/img/Seminar.jpg" alt="Ruangan 5" />
            <h3>Ruang Seminar (D10.289)</h3>
            <p>Ruang seminar untuk kegiatan dengan kapasitas 100+ orang, dilengkapi audio visual dan AC.</p>
          </div>
          <!-- Ruangan 6 -->
          <div class="ruangan-item">
            <img src="/img/lab1.jpg" alt="Ruangan 6" />
            <h3>Lab Komputer 1 (D10.373)</h3>
            <p>Laboratorium komputer matematika untuk pembelajaran dan penelitian dengan software MATLAB, Python, dan statistik.</p>
          </div>
          <!-- Ruangan 7 -->
          <div class="ruangan-item">
            <img src="/img/Lab programming.jpg" alt="Ruangan 7" />
            <h3>Lab Komputer 2 (D10.370A)</h3>
            <p>Laboratorium komputer 2 mendukung pembelajaran dan penelitian matematika dengan software untuk analisis data dan pemrograman.</p>
          </div>
          <!-- Ruangan 8 -->
          <div class="ruangan-item">
            <img src="/img/lab_jaringan.jpg" alt="Ruangan 8" />
            <h3>Lab Jaringan (D10.370B)</h3>
            <p>Ruang untuk praktik konfigurasi dan pengelolaan jaringan komputer dengan perangkat keras dan software pendukung.</p>
          </div>
        </div>
      </div>
    </section>
    <!-- End of Room Section -->

    <!-- Footer section -->

    <footer class="site-footer" id="footer">
      <div class="footer-container">
        <p>&copy; 2025 E-Booking D10. All rights reserved.</p>
        <p>Contact us: <a href="mailto:bookingd10@example.com">labmatematika@mail.unnes.ac.id</a></p>
        <a href="https://maps.app.goo.gl/crUfddnBDEg61amo7" target="_blank" rel="noopener noreferrer" class="map-link">
          <i class="fas fa-map-marker-alt me-1"></i>
          <span>Gedung D.10 FMIPA Universitas Negeri Semarang</span>
        </a>
      </div>
    </footer>

    <!--- Akhir dari footer -->

    <!-- Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Separate -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html> 