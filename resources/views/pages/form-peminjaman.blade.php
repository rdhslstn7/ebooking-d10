<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Peminjaman Ruangan - E-Booking D10</title>
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
<div class="container mt-5">
  <a href="{{ url('ruangan') }}" class="btn btn-secondary mb-3">← Kembali ke Daftar Ruangan</a>
  <div class="card">
    <div class="card-header bg-primary text-white">
      Form Peminjaman Ruangan
    </div>
    <div class="card-body">
      <form action="{{ url('form-peminjaman') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Informasi User -->
        <div class="mb-3">
          <label class="form-label">Nama</label>
          <input type="text" name="nama" class="form-control" value="{{ $nama ?? '' }}" readonly>
        </div>
        <div class="mb-3">
          <label class="form-label">NIM</label>
          <input type="text" name="nim" class="form-control" value="{{ $nim ?? '' }}" readonly>
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="{{ $email ?? '' }}" readonly>
        </div>
        <!-- Informasi Peminjaman -->
        <div class="mb-3">
          <label class="form-label">Nama Ruangan</label>
          <input type="text" class="form-control" value="{{ $nama_ruangan ?? '' }} ({{ $id_ruangan ?? '' }})" readonly>
          <input type="hidden" name="no_ruangan" value="{{ $id_ruangan ?? '' }}">
        </div>
        <div class="mb-3">
          <label class="form-label">Nama Kegiatan</label>
          <input type="text" name="nama_kegiatan" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Organisasi Penyelenggara</label>
          <select name="organisasi" class="form-select" required>
            <option value="">-- Pilih Organisasi --</option>
            @php
            $opsi = ["BPH", "Himatika", "KIM", "KWU Matematika", "LPOM", "MCC", "MEC", "MJC", "MSC", "PMC", "SIGMA", "The Mate", "Rombel Matematika", "Program Studi"];
            @endphp
            @foreach($opsi as $org)
              <option value="{{ $org }}">{{ $org }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">No. Telepon</label>
          <input type="text" name="no_telepon" class="form-control" value="{{ $no_telepon ?? '' }}" readonly>
        </div>
        <div class="mb-3">
          <label class="form-label">Tanggal Peminjaman</label>
          <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Waktu Peminjaman</label>
          <select name="waktu" class="form-select" required>
            <option value="">-- Pilih --</option>
            <option value="08:00 - 10:00">08:00 - 10:00</option>
            <option value="10:00 - 12:00">10:00 - 12:00</option>
            <option value="13:00 - 15:00">13:00 - 15:00</option>
            <option value="15:00 - 17:00">15:00 - 17:00</option>
            <option value="Full Day">Full Day</option>
          </select>
        </div>  
        <div class="mb-3">
          <label class="form-label">Dokumen Pendukung (PDF/JPG/PNG)</label>
          <input type="file" name="dokumen" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Ajukan Peminjaman</button>
      </form>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.querySelector('form').addEventListener('submit', function(event) {
    let valid = true;
    let errorMessage = "";
    document.querySelectorAll('input[required], select[required]').forEach(function(input) {
      if (!input.value) {
        valid = false;
        errorMessage += input.name + " harus diisi.\n";
      }
    });
    if (!valid) {
      event.preventDefault();
      alert(errorMessage);
    }
  });
</script>
</body>
</html> 