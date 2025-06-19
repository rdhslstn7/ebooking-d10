<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Ruangan - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
</head>
<body class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ url('admin-dashboard') }}">Admin D10</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin-dashboard') }}"><i class="fas fa-tachometer-alt me-1"></i> Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('approval') }}"><i class="fas fa-clipboard-check me-1"></i> Persetujuan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{ url('ruangan-admin') }}"><i class="fas fa-door-open me-1"></i> Ruangan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('user_pov_admin') }}"><i class="fas fa-users me-1"></i> User</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
              <i class="fas fa-user-cog me-1"></i> {{ session('nama') ?? 'Admin' }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="{{ url('profil-admin') }}"><i class="fas fa-user me-1"></i> Profil</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="{{ url('logout') }}"><i class="fas fa-sign-out-alt me-1"></i> Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container mt-4">
    <h2 class="mb-4"><i class="fas fa-edit me-2"></i>Edit Ruangan</h2>
    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <div class="card">
      <div class="card-body">
        <form method="POST" action="{{ url('ruangan-admin/'.$ruangan->id_ruangan.'/update') }}" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="id_ruangan" class="form-label">ID Ruangan</label>
            <input type="text" class="form-control" id="id_ruangan" name="id_ruangan" value="{{ $ruangan->id_ruangan }}" readonly>
          </div>
          <div class="mb-3">
            <label for="nama_ruangan" class="form-label">Nama Ruangan</label>
            <input type="text" class="form-control" id="nama_ruangan" name="nama_ruangan" required value="{{ old('nama_ruangan', $ruangan->nama_ruangan) }}">
          </div>
          <div class="mb-3">
            <label for="status_ruangan" class="form-label">Status Ruangan</label>
            <select class="form-select" id="status_ruangan" name="status_ruangan" required>
              <option value="Tersedia" {{ (old('status_ruangan', $ruangan->status_ruangan) == 'Tersedia') ? 'selected' : '' }}>Tersedia</option>
              <option value="Tidak Tersedia" {{ (old('status_ruangan', $ruangan->status_ruangan) == 'Tidak Tersedia') ? 'selected' : '' }}>Tidak Tersedia</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Ruangan (jpg/png)</label>
            <input type="file" class="form-control" id="gambar" name="gambar" accept="image/jpeg,image/png">
            @if($ruangan->gambar)
              <div class="mt-2">
                <img src="{{ Str::startsWith($ruangan->gambar, '/img/') ? $ruangan->gambar : asset('uploads/ruangan/'.$ruangan->gambar) }}" alt="Gambar Ruangan" style="max-width: 200px; max-height: 150px;">
                <div class="text-muted small">Gambar saat ini</div>
              </div>
            @endif
            @if($errors->has('gambar'))
              <div class="text-danger small mt-1">{{ $errors->first('gambar') }}</div>
            @endif
          </div>
          <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi Ruangan</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi', $ruangan->deskripsi) }}</textarea>
          </div>
          <div class="mb-3">
            <label for="kapasitas" class="form-label">Kapasitas</label>
            <input type="number" class="form-control" id="kapasitas" name="kapasitas" min="1" required value="{{ old('kapasitas', $ruangan->kapasitas) }}">
          </div>
          <div class="mb-3">
            <label for="fasilitas" class="form-label">Fasilitas</label>
            <textarea class="form-control" id="fasilitas" name="fasilitas" rows="2" required>{{ old('fasilitas', $ruangan->fasilitas) }}</textarea>
          </div>
          <div class="d-flex justify-content-between">
            <a href="{{ url('ruangan-admin') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan Perubahan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 