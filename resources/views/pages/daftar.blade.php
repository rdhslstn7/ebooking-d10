<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar - E-Booking D10</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="/css/daftar.css" />
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
</head>
<body>
  <div class="register-container">
    <div class="register-header">
      <h3>Daftar Akun</h3>
      <p>Silakan isi data Anda untuk mendaftar</p>
    </div>
    <form method="POST" action="{{ url('daftar') }}">
      @csrf
      <div class="mb-3">
        <label for="nama_user" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" id="nama_user" name="nama_user" required />
      </div>
      <div class="mb-3">
        <label for="nim" class="form-label">NIM</label>
        <input type="text" class="form-control" id="nim" name="nim" required />
      </div>
      <div class="mb-3">
        <label for="email_user" class="form-label">Email</label>
        <input type="email" class="form-control" id="email_user" name="email_user" required />
      </div>
      <div class="mb-3">
        <label for="password_user" class="form-label">Password</label>
        <input type="password" class="form-control" id="password_user" name="password_user" required />
      </div>
      <div class="mb-3">
        <label for="no_telepon" class="form-label">No Telepon</label>
        <input type="tel" class="form-control" id="no_telepon" name="no_telepon" required />
      </div>
      <!-- Tampilkan error dari query string -->
      <div>
        <div class="text-danger">
          @if(request()->get('error'))
            @switch(request()->get('error'))
              @case('empty') Semua kolom harus diisi. @break
              @case('email_format') Format email tidak valid. @break
              @case('email_domain') Gunakan email institusi UNNES. @break
              @case('db') Pendaftaran gagal. Silakan coba lagi. @break
            @endswitch
          @endif
        </div>
      </div>
      <button type="submit" class="btn btn-register mt-3">Daftar</button>
    </form>
    <div class="login-link">
      <p>Sudah punya akun? <a href="{{ url('login') }}">Login di sini</a></p>
    </div>
  </div>
</body>
</html> 