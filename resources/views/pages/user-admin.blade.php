<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Manajemen User - Admin</title>
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
            <a class="nav-link active" href="{{ url('user-admin') }}"><i class="fas fa-users me-1"></i> User</a>
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
    <h2 class="mb-4"><i class="fas fa-users me-2"></i>Manajemen User</h2>
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
    <div class="mb-3 text-end">
      <a href="{{ url('user-admin/create') }}" class="btn btn-success"><i class="fas fa-user-plus me-1"></i> Tambah User</a>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Email</th>
                <th>No Telepon</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $i => $user)
                <tr>
                  <td>{{ $i+1 }}</td>
                  <td>{{ $user->nama_user }}</td>
                  <td>{{ $user->nim }}</td>
                  <td>{{ $user->email_user }}</td>
                  <td>{{ $user->no_telepon }}</td>
                  <td>
                    <a href="{{ url('user-admin/'.$user->nim.'/edit') }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                    <form method="POST" action="{{ url('user-admin/'.$user->nim.'/delete') }}" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                      @csrf
                      <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 