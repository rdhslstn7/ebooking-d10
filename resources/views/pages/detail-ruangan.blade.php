<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Detail Ruangan - {{ $room->nama_ruangan ?? '' }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ url('ruangan') }}">E Booking D10</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto"></ul>
        <ul class="navbar-nav">
          <!-- Profil Dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
              <i class="fas fa-user me-2"></i> {{ $nama_user ?? 'User' }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="{{ url('profil-user') }}"><i class="fas fa-user-circle me-1"></i> Profil</a></li>
              <li><a class="dropdown-item" href="{{ url('logout') }}"><i class="fas fa-sign-out-alt me-1"></i> Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Konten Detail Ruangan -->
  <div class="container mt-5">
    <a href="{{ url('ruangan') }}" class="btn btn-secondary mb-3">← Kembali ke Daftar Ruangan</a>
    <div class="card mb-4">
      @php
        $img = '/img/default-room.jpg';
        if ($room->gambar) {
          $img = \Illuminate\Support\Str::startsWith($room->gambar, '/img/') ? $room->gambar : asset('uploads/ruangan/'.$room->gambar);
        }
      @endphp
      <img src="{{ $img }}" class="card-img-top" alt="{{ $room->nama_ruangan }}">
      <div class="card-body">
        <h3 class="card-title">{{ $room->nama_ruangan }} ({{ $room->id_ruangan }})</h3>
        <p class="card-text"><strong>Deskripsi:</strong> {{ $room->deskripsi }}</p>
        <p class="card-text"><strong>Kapasitas:</strong> {{ $room->kapasitas }} orang</p>
        <p class="card-text"><strong>Fasilitas:</strong> {{ $room->fasilitas }}</p>
        <!-- Tombol Pinjam Ruangan -->
        <a href="{{ url('form-peminjaman') }}?id={{ $room->id_ruangan }}" class="btn btn-success mt-3">
          <i class="fas fa-calendar-check me-1"></i> Pinjam Ruangan
        </a>
      </div>
    </div>
  </div>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 