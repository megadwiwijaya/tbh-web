<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Teluk Biru Homestay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');

    body {
        font-family: 'Inter', sans-serif;
        margin: 0;
        min-height: 100vh;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }
        .login-container {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
            max-width: 900px;
            width: 100%;
            overflow: hidden;
            display: flex;
            flex-wrap: wrap;
        }

        /* Bagian kiri */
        .login-left {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            color: #fff;
            flex: 1 1 40%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem 2rem;
            text-align: center;
        }

        .login-left h1 {
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 2rem;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        .login-left img {
            max-width: 80%;
            height: auto;
            border-radius: 0.5rem;
            box-shadow: 0 8px 16px rgba(0,0,0,0.3);
        }

        /* Bagian kanan */
        .login-right {
            flex: 1 1 60%;
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-right h2 {
            text-align: center;
            font-weight: 700;
            color: #4e73df;
            margin-bottom: 2rem;
            letter-spacing: 1.5px;
        }

        form {
            width: 100%;
        }

        label {
            font-weight: 600;
            color: #333;
        }

        input.form-control {
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            border: 2px solid #ddd;
            transition: border-color 0.3s ease;
        }

        input.form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 8px rgba(78, 115, 223, 0.5);
            outline: none;
        }

        button.btn-primary {
            background-color: #4e73df;
            border: none;
            font-weight: 700;
            padding: 0.75rem;
            border-radius: 0.6rem;
            width: 100%;
            font-size: 1.1rem;
            transition: background-color 0.3s ease;
        }

        button.btn-primary:hover {
            background-color: #2e59d9;
        }

        .alert {
            border-radius: 0.5rem;
        }

        .text-center p {
            margin-top: 1.5rem;
            font-weight: 500;
            color: #555;
        }

        .text-center a {
            color: #4e73df;
            text-decoration: none;
            font-weight: 600;
        }

        .text-center a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }
            .login-left,
            .login-right {
                flex: 1 1 100%;
                padding: 2rem 1.5rem;
            }
            .login-left h1 {
                font-size: 2rem;
                margin-bottom: 1.5rem;
            }
            .login-right h2 {
                font-size: 1.5rem;
                margin-bottom: 1.5rem;
            }
            .login-left img {
                max-width: 60%;
            }
        }
    </style>
</head>

<body>
    <div class="login-container shadow">
        <div class="login-left">
            <h1>Teluk Biru Homestay</h1>
        <img src="{{ asset('foto/logo-tbh.png') }}" alt="Logo" class="logo">
        </div>
        <div class="login-right">
            <h2>LOGIN</h2>

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $item)
                    <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ url('login') }}" method="POST" novalidate>
                @csrf
                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" value="{{ old('email') }}" name="email" class="form-control" required autocomplete="email" />
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" name="password" class="form-control" required autocomplete="current-password" />
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
                <div class="text-center">
                    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
