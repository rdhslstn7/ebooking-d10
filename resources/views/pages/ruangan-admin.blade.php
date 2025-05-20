<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Manajemen Ruangan - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
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
            <a class="nav-link active" href="{{ url('ruangan-admin') }}"><i class="fas fa-door-open me-1"></i> Ruangan</a>
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
  <div class="container mt-4">
    <h2 class="mb-4"><i class="fas fa-door-open me-2"></i>Manajemen Ruangan</h2>
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
      <a href="{{ url('ruangan-admin/create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Tambah Ruangan</a>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
              <tr>
                <th>ID Ruangan</th>
                <th>Nama Ruangan</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($ruangan as $r)
                <tr>
                  <td>{{ $r->id_ruangan }}</td>
                  <td>{{ $r->nama_ruangan }}</td>
                  <td>
                    <span class="badge bg-{{ $r->status_ruangan == 'Tersedia' ? 'success' : 'danger' }}">{{ $r->status_ruangan }}</span>
                  </td>
                  <td>
                    <a href="{{ url('ruangan-admin/'.$r->id_ruangan.'/edit') }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                    <form method="POST" action="{{ url('ruangan-admin/'.$r->id_ruangan.'/delete') }}" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus ruangan ini?')">
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