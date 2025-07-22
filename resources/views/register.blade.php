<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registrasi Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
         @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');
        body {
            background: linear-gradient(135deg, #74ebd5 0%, #ACB6E5 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
        }

        .card {
            border-radius: 1rem;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            background: white;
            max-width: 480px;
            width: 100%;
            padding: 2rem;
            font-family: 'Inter', sans-serif;
        }

        .card h2 {
            color: #4e73df;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        label {
            font-weight: 600;
            color: #333;
        }

        .form-control {
            font-family: 'Inter', sans-serif;
        }

        .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 8px rgba(78, 115, 223, 0.5);
        }

        .btn-success {
            background-color: #4e73df;
            border-color: #4e73df;
            font-weight: 600;
            transition: background-color 0.3s ease;
            font-family: 'Inter', sans-serif;
        }

        .btn-success:hover {
            background-color: #2e59d9;
            border-color: #2653d4;
        }

        .btn-secondary {
            font-weight: 600;
            margin-left: 10px;
            font-family: 'Inter', sans-serif;
        }

        .btn-secondary:hover {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .optional-text {
            font-size: 0.85rem;
            color: #888;
            font-style: italic;
        }
    </style>
</head>
<body>
<div class="card shadow">
    <h2>Registrasi Pelanggan</h2>

    <form action="{{ route('register.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="nama" class="form-label">Nama Lengkap</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label for="no_hp" class="form-label">No HP</label>
        <input type="text" name="no_hp" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Daftar</button>
</form>
</div>
</body>
</html>