<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard - E-Booking D10</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    .card-dashboard {
      transition: all 0.3s;
      border-left: 4px solid;
    }
    .card-dashboard:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .card-pending {
      border-left-color: #ffc107;
    }
    .card-rooms {
      border-left-color: #0d6efd;
    }
    .card-users {
      border-left-color: #198754;
    }
    .stat-number {
      font-size: 2.5rem;
      font-weight: bold;
    }
    .recent-activity {
      max-height: 400px;
      overflow-y: auto;
    }
  </style>
</head>
<body>
  <!-- Navbar Admin -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ url('admin-dashboard') }}">Admin D10</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link active" href="{{ url('admin-dashboard') }}"><i class="fas fa-tachometer-alt me-1"></i> Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('approval') }}"><i class="fas fa-clipboard-check me-1"></i> Approval</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('ruangan-admin') }}"><i class="fas fa-door-open me-1"></i> Ruangan</a>
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
  <!-- Main Content -->
  <div class="container-fluid mt-4">
    <h2 class="mb-4"><i class="fas fa-tachometer-alt me-2"></i>Dashboard Admin</h2>
    <!-- Stats Cards -->
    <div class="row mb-4">
      <div class="col-md-4">
        <div class="card card-dashboard card-pending h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div>
                <h5 class="card-title">Pending Approval</h5>
                <p class="card-text">Permintaan menunggu persetujuan</p>
              </div>
              <i class="fas fa-clock fa-3x text-warning"></i>
            </div>
            <div class="stat-number text-warning">{{ $pending ?? 0 }}</div>
            <a href="{{ url('approval') }}" class="btn btn-outline-warning mt-2">Lihat Semua</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-dashboard card-rooms h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div>
                <h5 class="card-title">Total Ruangan</h5>
                <p class="card-text">Ruangan tersedia</p>
              </div>
              <i class="fas fa-door-open fa-3x text-primary"></i>
            </div>
            <div class="stat-number text-primary">{{ $total_rooms ?? 0 }}</div>
            <a href="{{ url('ruangan-admin') }}" class="btn btn-outline-primary mt-2">
              <i class="fas fa-plus me-1"></i> Edit Ruangan
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-dashboard card-users h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div>
                <h5 class="card-title">Total User</h5>
                <p class="card-text">Pengguna terdaftar</p>
              </div>
              <i class="fas fa-users fa-3x text-success"></i>
            </div>
            <div class="stat-number text-success">{{ $total_users ?? 0 }}</div>
            <a href="{{ url('user-admin') }}" class="btn btn-outline-success mt-2">
              <i class="fas fa-user-plus me-1"></i> Edit User
            </a>
          </div>
        </div>
      </div>
    </div>
    <!-- Modals (Add Room & Add User) -->
    <!-- ... (bagian modal tidak berubah) ... -->
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 