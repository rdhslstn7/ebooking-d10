<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Profil Pengguna</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
      .alert-custom {
      border: 1px solid #dc3545;
      padding: 20px;
      background-color: #f8d7da;
      color:rgb(125, 7, 18);
    }
  </style>
</head>
<body class="bg-light">
<!-- Navbar User -->
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
          <i class="fas fa-user me-2"></i> {{ $user->nama_user ?? 'User' }}
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

@if(request()->get('pesan'))
  <div class="alert alert-custom alert-dismissible fade show" role="alert">
    {{ request()->get('pesan') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<div class="container mt-5">
  <a href="{{ url('ruangan') }}" class="btn btn-secondary mb-3">← Kembali ke Daftar Ruangan</a>
  <!-- Data Profil -->
  <div class="card mb-4">
    <div class="card-header bg-primary text-white">
      Profil Pengguna
    </div>
    <div class="card-body">
      <table class="table table-bordered">
        <tr>
          <th>NIM</th>
          <td>{{ $user->nim ?? '' }}</td>
        </tr>
        <tr>
          <th>Nama</th>
          <td>{{ $user->nama_user ?? '' }}</td>
        </tr>
        <tr>
          <th>Email</th>
          <td>{{ $user->email_user ?? '' }}</td>
        </tr>
        <tr>
          <th>No Telepon</th>
          <td>{{ $user->no_telepon ?? '' }}</td>
        </tr>
      </table>
    </div>
    <!-- Tombol Ubah Password (modal)-->
    <div class="text-center mb-4">
      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ubahPasswordModal">
        <i class="fas fa-key me-1"></i> Ubah Password
      </button>
    </div>
  </div>

  <!-- Riwayat Peminjaman -->
  <div class="card">
    <div class="card-header bg-primary text-white">
      Riwayat Peminjaman Ruangan
    </div>
    <div class="card-body">
      <form method="GET" class="mb-3" action="{{ url('profil-user') }}">
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
      @if(isset($result) && count($result) > 0)
        <div class="table-responsive">
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
                  <td>{{ \Carbon\Carbon::parse($data->tanggal_peminjaman)->format('d-m-Y') }}</td>
                  <td>{{ $data->waktu_peminjaman }}</td>
                  <td>
                    <span class="badge bg-{{ $data->status_persetujuan == 'Disetujui' ? 'success' : ($data->status_persetujuan == 'Tidak Disetujui' ? 'danger' : 'warning') }}">
                      {{ $data->status_persetujuan }}
                    </span>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <p class="text-center">Anda belum memiliki riwayat peminjaman.</p>
      @endif
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Modal Ubah Password -->
<div class="modal fade" id="ubahPasswordModal" tabindex="-1" aria-labelledby="ubahPasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="{{ url('ubah-password') }}">
        @csrf
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="ubahPasswordModalLabel"><i class="fas fa-key me-2"></i>Ubah Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="password_lama" class="form-label">Password Lama</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-lock"></i></span>
              <input type="password" class="form-control" name="password_lama" required>
            </div>
          </div>
          <div class="mb-3">
            <label for="password_baru" class="form-label">Password Baru</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-key"></i></span>
              <input type="password" class="form-control" name="password_baru" required>
            </div>
          </div>
          <div class="mb-3">
            <label for="konfirmasi" class="form-label">Konfirmasi Password Baru</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-check"></i></span>
              <input type="password" class="form-control" name="konfirmasi" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html> 