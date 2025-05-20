<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Ubah Password Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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
            <a class="nav-link" href="{{ url('approval') }}"><i class="fas fa-clipboard-check me-1"></i> Approval</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('ruangan') }}"><i class="fas fa-door-open me-1"></i> Ruangan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('user-admin') }}"><i class="fas fa-users me-1"></i> User</a>
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
  <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow w-100" style="max-width: 500px;">
      <div class="card-header bg-primary text-white text-center">
        <h5 class="mb-0"><i class="fas fa-key me-2"></i>Ubah Password Admin</h5>
      </div>
      <div class="card-body">
        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <form method="POST" action="{{ url('ubah-password-admin') }}">
          @csrf
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
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan</button>
            <a href="{{ url('profil-admin') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 