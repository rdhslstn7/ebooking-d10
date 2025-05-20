<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - E-Booking D10</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <style>
      body {
        font-family: "Poppins", sans-serif;
        background: url("/img/d10_part3.jpg") no-repeat center center/cover;
        height: 100vh;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
      }
      body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
        z-index: 0;
      }
      .login-container {
        position: relative;
        z-index: 1;
        width: 100%;
        max-width: 420px;
        background-color: #ffffff;
        padding: 35px;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      }
      .login-header {
        text-align: center;
        margin-bottom: 25px;
      }
      .login-header h3 {
        font-weight: 600;
        margin-bottom: 10px;
      }
      .login-header p {
        color: #6c757d;
        font-size: 14px;
      }
      .form-label {
        font-weight: 500;
      }
      .form-control {
        border-radius: 8px;
      }
      .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
      }
      .btn-login {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        background-color: #0d6efd;
        border: none;
        color: white;
        font-weight: 500;
        transition: background-color 0.3s ease;
      }
      .btn-login:hover {
        background-color: #0b5ed7;
      }
      .register-link {
        margin-top: 20px;
        text-align: center;
      }
      .register-link a {
        text-decoration: none;
        color: #0d6efd;
        font-weight: 500;
      }
      .register-link a:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
    <div class="login-container">
        <div class="login-header">
        <h3>Login</h3>
        <p>Masukkan email dan password Anda</p>
        </div>

        {{-- Error message --}}
        @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
        @endif

        <form method="POST" action="{{ url('login') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required />
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required />
        </div>
        <button type="submit" class="btn btn-login">Login</button>
        </form>

      <div class="register-link">
        <p>Belum punya akun? <a href="{{ url('daftar') }}">Daftar Sekarang</a></p>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html> 