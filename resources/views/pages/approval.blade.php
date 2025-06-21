<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Persetujuan Peminjaman - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
  <style>
    .request-card { transition: 0.3s; margin-bottom: 20px; border-left: 4px solid #dee2e6; }
    .request-card:hover { box-shadow: 0 5px 15px rgba(0,0,0,0.08); }
    .status-pending { border-left: 4px solid #ffc107; }
    .status-approved { border-left: 4px solid #198754; }
    .status-rejected { border-left: 4px solid #dc3545; }
    .badge-pending { background-color: #ffc107; color: #000; }
    .badge-approved { background-color: #198754; }
    .badge-rejected { background-color: #dc3545; }
    .card-title { font-weight: 600; }
    .approval-actions form { display: inline-block; }
    .approval-actions .btn { min-width: 100px; }
    @media (max-width: 768px) {
      .approval-actions { flex-direction: column; gap: 8px; }
    }
  </style>
</head>
<body>
  <!-- Navbar Admin -->
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
            <a class="nav-link active" href="{{ url('approval') }}"><i class="fas fa-clipboard-check me-1"></i> Persetujuan</a>
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
  <div class="container mb-5">
    <h2 class="mb-4"><i class="fas fa-clipboard-check me-2"></i>Persetujuan Peminjaman Ruangan</h2>
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
    <form method="GET" class="mb-3" action="{{ url('approval') }}">
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
    @if(count($result) > 0)
      @foreach($result as $row)
        @php
          $badgeClass = 'bg-warning text-dark';
          $badgeText = 'Menunggu';
          if ($row->status_persetujuan === 'Disetujui') {
            $badgeClass = 'bg-success';
            $badgeText = 'Disetujui';
          } elseif ($row->status_persetujuan === 'Tidak Disetujui') {
            $badgeClass = 'bg-danger';
            $badgeText = 'Tidak Disetujui';
          }
        @endphp
        <div class="card shadow-sm mb-3">
          <div class="card-body d-flex flex-column">
            <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap">
              <div class="d-flex align-items-center gap-2">
                <span class="badge {{ $badgeClass }}">{{ $badgeText }}</span>
                <h5 class="card-title mb-0 ms-2">{{ $row->nama_kegiatan }}</h5>
              </div>
              <div class="d-flex gap-2 mt-2 mt-md-0">
                @if($row->status_persetujuan === 'Menunggu')
                  <form method="POST" action="{{ url('approval') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $row->id_peminjaman }}">
                    <input type="hidden" name="status" value="Disetujui">
                    <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-check me-1"></i> Setujui</button>
                  </form>
                  <form method="POST" action="{{ url('approval') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $row->id_peminjaman }}">
                    <input type="hidden" name="status" value="Tidak Disetujui">
                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-times me-1"></i> Tolak</button>
                  </form>
                @else
                  <span class="text-muted">-</span>
                @endif
              </div>
            </div>
            <table class="table table-borderless mb-0" style="max-width:500px">
              <tr>
                <th class="ps-0" style="width: 160px;">Ruangan</th>
                <td>: {{ $row->id_ruangan }}</td>
              </tr>
              <tr>
                <th class="ps-0">Tanggal</th>
                <td>:
                  @if($row->tanggal_mulai && $row->tanggal_selesai)
                    {{ \Carbon\Carbon::parse($row->tanggal_mulai)->format('d-m-Y') }} s/d {{ \Carbon\Carbon::parse($row->tanggal_selesai)->format('d-m-Y') }}
                  @else
                    -
                  @endif
                </td>
              </tr>
              <tr>
                <th class="ps-0">Waktu</th>
                <td>:
                  @if($row->waktu_mulai && $row->waktu_selesai)
                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $row->waktu_mulai)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $row->waktu_selesai)->format('h:i A') }}
                  @else
                    -
                  @endif
                </td>
              </tr>
              <tr>
                <th class="ps-0">Nama Peminjam</th>
                <td>: {{ $row->nama_peminjam }}</td>
              </tr>
              <tr>
                <th class="ps-0">NIM</th>
                <td>: {{ $row->nim }}</td>
              </tr>
              <tr>
                <th class="ps-0">Organisasi</th>
                <td>: {{ $row->organisasi }}</td>
              </tr>
              <tr>
                <th class="ps-0">No Telepon</th>
                <td>: {{ $row->no_telepon }}</td>
              </tr>
              <tr>
                <th class="ps-0">Email</th>
                <td>: {{ $row->email_user }}</td>
              </tr>
              <tr>
                <th class="ps-0">ID Peminjaman</th>
                <td>: {{ $row->id_peminjaman }}</td>
              </tr>
              <tr>
                <th class="ps-0">Dokumen</th>
                <td>: <a href="/uploads/{{ $row->dokumen_pendukung }}" target="_blank" class="link-primary fw-bold text-decoration-underline">Preview</a></td>
              </tr>
            </table>
          </div>
        </div>
      @endforeach
    @else
      <div class="alert alert-info">Belum ada permintaan peminjaman.</div>
    @endif
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 