<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Riwayat Peminjaman Ruangan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
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

    <form method="GET" class="mb-3" action="{{ url('riwayat') }}">
      <div class="row g-2 align-items-center">
        <div class="col-auto">
          <label for="sort" class="col-form-label">Urutkan Tanggal:</label>
        </div>
        <div class="col-auto">
          <select name="sort" id="sort" class="form-select">
            <option value="desc" {{ (request('sort', 'desc') == 'desc') ? 'selected' : '' }}>Terbaru</option>
            <option value="asc" {{ (request('sort') == 'asc') ? 'selected' : '' }}>Terlama</option>
          </select>
        </div>
        <div class="col-auto">
          <label for="status" class="col-form-label">Status:</label>
        </div>
        <div class="col-auto">
          <select name="status" id="status" class="form-select">
            <option value="">Semua</option>
            <option value="Disetujui" {{ (request('status') == 'Disetujui') ? 'selected' : '' }}>Disetujui</option>
            <option value="Menunggu" {{ (request('status') == 'Menunggu') ? 'selected' : '' }}>Menunggu</option>
            <option value="Tidak Disetujui" {{ (request('status') == 'Tidak Disetujui') ? 'selected' : '' }}>Tidak Disetujui</option>
          </select>
        </div>
        <div class="col-auto">
          <button type="submit" class="btn btn-primary">Terapkan</button>
        </div>
      </div>
    </form>

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="card">
      <div class="card-header bg-primary text-white">
        Riwayat Peminjaman Ruangan
      </div>
      <div class="card-body">
        @if(isset($result) && count($result) > 0)
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Kegiatan</th>
                <th>Organisasi</th>
                <th>Ruangan</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($result as $i => $data)
                <tr>
                  <td>{{ $i+1 }}</td>
                  <td>{{ $data->nama_kegiatan }}</td>
                  <td>{{ $data->organisasi }}</td>
                  <td>{{ $data->nama_ruangan }} ({{ $data->id_ruangan }})</td>
                  <td>{{ \Carbon\Carbon::parse($data->tanggal_mulai)->format('d-m-Y') }} s/d {{ \Carbon\Carbon::parse($data->tanggal_selesai)->format('d-m-Y') }}</td>
                  <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $data->waktu_mulai)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $data->waktu_selesai)->format('h:i A') }}</td>
                  <td>
                    <span class="badge bg-{{ $data->status_persetujuan == 'Disetujui' ? 'success' : ($data->status_persetujuan == 'Ditolak' ? 'danger' : 'warning') }}">
                      {{ $data->status_persetujuan }}
                    </span>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @else
          <p class="text-center">Anda belum memiliki riwayat peminjaman.</p>
        @endif
      </div>
    </div>
  </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</html> 