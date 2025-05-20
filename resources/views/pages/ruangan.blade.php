<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ruangan - E-Booking D10</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/ruangan.css">
</head>
<body>
@php use Illuminate\Support\Str; @endphp
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
        <!-- Notifikasi -->
        <li class="nav-item dropdown me-3">
          <a class="nav-link position-relative" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-bell"></i>
            <span id="notifBadge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger d-none"></span>
          </a>
          <ul id="notifList" class="dropdown-menu dropdown-menu-end" aria-labelledby="notifDropdown">
            <li><span class="dropdown-item-text text-muted">Memuat notifikasi...</span></li>
          </ul>
        </li>
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
<!-- Konten Utama -->
<div class="container mt-5">
  <h1 class="mb-4">Daftar Ruangan D10</h1>
  <div class="row">
    @foreach($ruangan as $r)
      @php
        $img = '/img/default-room.jpg';
        if ($r->gambar) {
          $img = Str::startsWith($r->gambar, '/img/') ? $r->gambar : asset('uploads/ruangan/'.$r->gambar);
        }
      @endphp
      <div class="col-md-4 mb-4">
        <div class="card room-card h-100">
          <img src="{{ $img }}" class="card-img-top" alt="{{ $r->nama_ruangan }}">
          <div class="card-body">
            <h5 class="card-title">{{ $r->nama_ruangan }}</h5>
            <p class="card-text">Kode Ruangan: {{ $r->id_ruangan }}</p>
            @if($r->status_ruangan === 'Tersedia')
              <a href="{{ url('detail-ruangan') }}?id={{ $r->id_ruangan }}" class="btn btn-primary">Lihat Detail</a>
            @else
              <button class="btn btn-danger" disabled>Tidak Tersedia</button>
            @endif
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function loadNotifications() {
  $.ajax({
    url: '{{ url('ruangan') }}?ajax=notif',
    method: 'GET',
    dataType: 'json',
    success: function(data) {
      let badge = $('#notifBadge');
      let list = $('#notifList');
      list.empty();
      if (data.count > 0) {
        badge.text(data.count).removeClass('d-none');
        data.notifikasi.forEach(function(n) {
          let teks = 'Peminjaman ' + n.status_persetujuan.toLowerCase();
          list.append(
            `<li>
              <a class="dropdown-item" href="{{ url('ruangan') }}?id_peminjaman=${n.id_peminjaman}">
                ${teks}
              </a>
            </li>`
          );
        });
      } else {
        badge.addClass('d-none');
        list.append('<li><span class="dropdown-item-text text-muted">Tidak ada notifikasi</span></li>');
      }
    },
    error: function() {
      $('#notifList').html('<li><span class="dropdown-item-text text-danger">Gagal memuat notifikasi</span></li>');
    }
  });
}
$(document).ready(function() {
  loadNotifications();
  setInterval(loadNotifications, 10000); // per 10 detik
});
</script>
</body>
</html> 