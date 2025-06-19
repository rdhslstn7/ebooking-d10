<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Peminjaman Ruangan - E-Booking D10</title>
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
<div class="container mt-5">
  <a href="{{ url('ruangan') }}" class="btn btn-secondary mb-3">← Kembali ke Daftar Ruangan</a>
  <div class="card">
    <div class="card-header bg-primary text-white">
      Form Peminjaman Ruangan
    </div>
    <div class="card-body">
      @if (session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
      @endif
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <div id="notif-area"></div>
      <form id="formPeminjaman" action="{{ url('form-peminjaman') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Informasi User -->
        <div class="mb-3">
          <label class="form-label">Nama</label>
          <input type="text" name="nama" class="form-control" value="{{ $nama ?? '' }}" readonly>
        </div>
        <div class="mb-3">
          <label class="form-label">NIM</label>
          <input type="text" name="nim" class="form-control" value="{{ $nim ?? '' }}" readonly>
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="{{ $email ?? '' }}" readonly>
        </div>
        <!-- Informasi Peminjaman -->
        <div class="mb-3">
          <label class="form-label">Nama Ruangan</label>
          <input type="text" class="form-control" value="{{ $nama_ruangan ?? '' }} ({{ $id_ruangan ?? '' }})" readonly>
          <input type="hidden" name="no_ruangan" value="{{ $id_ruangan ?? '' }}">
        </div>
        <div class="mb-3">
          <label class="form-label">Nama Kegiatan</label>
          <input type="text" name="nama_kegiatan" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Organisasi Penyelenggara</label>
          <select name="organisasi" class="form-select" required>
            <option value="">-- Pilih Organisasi --</option>
            @foreach($organisasiList as $org)
              <option value="{{ $org }}">{{ $org }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">No. Telepon</label>
          <input type="text" name="no_telepon" class="form-control" value="{{ $no_telepon ?? '' }}" readonly>
        </div>
        <div class="mb-3">
          <label class="form-label">Tanggal Mulai</label>
          <input type="date" name="tanggal_mulai" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Tanggal Selesai</label>
          <input type="date" name="tanggal_selesai" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Waktu Mulai</label>
          <input type="time" name="waktu_mulai" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Waktu Selesai</label>
          <input type="time" name="waktu_selesai" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Dokumen Pendukung (PDF/JPG/PNG)</label>
          <input type="file" name="dokumen" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Ajukan Peminjaman</button>
      </form>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  // Validasi form
  document.querySelector('form').addEventListener('submit', function(event) {
    let valid = true;
    let errorMessage = "";
    document.querySelectorAll('input[required], select[required]').forEach(function(input) {
      if (!input.value) {
        valid = false;
        errorMessage += input.name + " harus diisi.\n";
      }
    });
    if (!valid) {
      event.preventDefault();
      alert(errorMessage);
    }
  });

  // Blokir jam yang sudah dipinjam
  $(function() {
    function fetchBookedTimes() {
      var id_ruangan = $('input[name="no_ruangan"]').val();
      var tanggal = $('input[name="tanggal_mulai"]').val();
      if (!id_ruangan || !tanggal) return;
      $.getJSON('/form-peminjaman/booked-times', { id_ruangan: id_ruangan, tanggal: tanggal }, function(res) {
        if (res.success) {
          var booked = res.data;
          // Reset
          $('input[name="waktu_mulai"]').prop('disabled', false).val("");
          $('input[name="waktu_selesai"]').prop('disabled', false).val("");
          if (booked.length > 0) {
            // Buat array blokir jam
            var blocks = booked.map(function(b) {
              return { mulai: b.waktu_mulai, selesai: b.waktu_selesai };
            });
            // Validasi overlap waktu mulai & selesai
            function checkOverlap(mulai, selesai, blocks) {
              return blocks.some(function(b) {
                return mulai < b.selesai && selesai > b.mulai;
              });
            }
            function validateTimeInputs() {
              var mulai = $('input[name="waktu_mulai"]').val();
              var selesai = $('input[name="waktu_selesai"]').val();
              if (mulai && selesai) {
                var overlap = checkOverlap(mulai, selesai, blocks);
                $('input[name="waktu_mulai"]')[0].setCustomValidity(overlap ? 'Waktu yang dipilih sudah terdaftar di peminjaman lain' : '');
                $('input[name="waktu_selesai"]')[0].setCustomValidity(overlap ? 'Waktu yang dipilih sudah terdaftar di peminjaman lain' : '');
              } else {
                $('input[name="waktu_mulai"]')[0].setCustomValidity('');
                $('input[name="waktu_selesai"]')[0].setCustomValidity('');
              }
            }
            $('input[name="waktu_mulai"], input[name="waktu_selesai"]').on('input', validateTimeInputs);
          } else {
            $('input[name="waktu_mulai"]').off('input');
            $('input[name="waktu_selesai"]').off('input');
          }
        }
      });
    }
    $('input[name="tanggal_mulai"], input[name="no_ruangan"]').on('change', fetchBookedTimes);
    // Trigger saat load jika sudah ada value
    if ($('input[name="tanggal_mulai"]').val()) fetchBookedTimes();
  });

  // Submit form via AJAX
  $('#formPeminjaman').on('submit', function(e) {
    e.preventDefault();
    var form = this;
    var formData = new FormData(form);
    $('#notif-area').html('');
    $.ajax({
      url: form.action,
      method: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(res) {
        if (res.success) {
          window.location.href = '/ruangan';
        } else {
          $('#notif-area').html('<div class="alert alert-danger">'+(res.message || 'Terjadi kesalahan!')+'</div>');
        }
      },
      error: function(xhr) {
        var msg = 'Terjadi kesalahan!';
        if (xhr.responseJSON && xhr.responseJSON.message) {
          msg = xhr.responseJSON.message;
        } else if (xhr.responseText) {
          try {
            var r = JSON.parse(xhr.responseText);
            if (r.message) msg = r.message;
          } catch {}
        }
        $('#notif-area').html('<div class="alert alert-danger">'+msg+'</div>');
      }
    });
  });
</script>
</body>
</html> 