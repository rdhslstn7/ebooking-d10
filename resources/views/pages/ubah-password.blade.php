<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ubah Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
</head>
<body class="bg-light">
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow w-100" style="max-width: 500px;">
        <div class="card-header bg-primary text-white text-center">
            <h5 class="mb-0"><i class="fas fa-key me-2"></i>Ubah Password</h5>
        </div>
        <div class="card-body">
            @if(request()->get('pesan'))
                <div class="alert alert-danger">{{ request()->get('pesan') }}</div>
            @endif
            <form method="POST" action="{{ url('ubah-password') }}">
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
                    <a href="{{ url('profil-user') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html> 