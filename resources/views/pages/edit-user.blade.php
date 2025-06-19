<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit User - Admin</title>
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
            <a class="nav-link" href="{{ url('ruangan-admin') }}"><i class="fas fa-door-open me-1"></i> Ruangan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{ url('user_pov_admin') }}"><i class="fas fa-users me-1"></i> User</a>
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
    <h2 class="mb-4"><i class="fas fa-edit me-2"></i>Edit User</h2>
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
        <form method="POST" action="{{ url('user-admin/'.$user->nim.'/update') }}">
          @csrf
          <div class="mb-3">
            <label for="nama_user" class="form-label">Nama User</label>
            <input type="text" class="form-control" id="nama_user" name="nama_user" required value="{{ old('nama_user', $user->nama_user) }}">
          </div>
          <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" class="form-control" id="nim" name="nim" value="{{ old('nim', $user->nim) }}">
            <input type="hidden" name="nim_lama" value="{{ $user->nim }}">
          </div>
          <div class="mb-3">
            <label for="email_user" class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="email_user" name="email_user" required value="{{ old('email_user', $user->email_user) }}" placeholder="user@students.unnes.ac.id">
            <div class="form-text">Hanya boleh email @students.unnes.ac.id</div>
          </div>
          <div class="mb-3">
            <label for="no_telepon" class="form-label">No Telepon</label>
            <input type="text" class="form-control" id="no_telepon" name="no_telepon" required value="{{ old('no_telepon', $user->no_telepon) }}">
          </div>
          <div class="mb-3">
            <label for="password_user" class="form-label">Password (kosongkan jika tidak diubah)</label>
            <input type="password" class="form-control" id="password_user" name="password_user">
          </div>
          <div class="d-flex justify-content-between">
            <a href="{{ url('user-admin') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan Perubahan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 