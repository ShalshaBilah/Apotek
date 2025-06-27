<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Apotek Telu | Register</title>
    <link rel="icon" href="{{ asset('image/images.png') }}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-2/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-2/bower_components/font-awesome/css/font-awesome.min.css') }}">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #01796f;
            /* Sesuaikan warna latar belakang dengan halaman login */
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .register-box {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            padding: 30px;
            width: 100%;
            max-width: 400px;
        }

        .register-logo a {
            font-size: 24px;
            font-weight: 600;
            color: #145a32;
            /* Sesuaikan warna dengan warna tombol login */
            text-decoration: none;
        }

        .login-box-msg {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-control {
            border-radius: 5px;
            height: 45px;
        }

        .form-group {
            position: relative;
        }

        .form-group span {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }

        .btn-primary {
            background: #01796f;
            /* Sesuaikan warna tombol dengan login */
            border: none;
            border-radius: 5px;
            transition: background 0.3s;
            font-weight: 500;
        }

        .btn-primary:hover {
            background: #01796f;
            /* Sesuaikan warna hover dengan login */
        }

        .register-footer {
            margin-top: 20px;
            text-align: center;
        }

        .register-footer a {
            color: #145a32;
            text-decoration: none;
            font-weight: 500;
        }

        .register-footer a:hover {
            text-decoration: underline;
        }

        .text-danger {
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="register-box">
        <div class="register-logo"
            style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
            <img src="{{ asset('image/remove.png') }}" alt="Apotek Telu Logo" width="80" style="margin-bottom: 15px;">
            <a href="#"><b>Apotek</b> Telu</a>
        </div>

        <p class="login-box-msg">Register a new membership</p>

        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    placeholder="Full Name" value="{{ old('name') }}" required>
                <span class="fa fa-user"></span>
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    placeholder="Email" value="{{ old('email') }}" required>
                <span class="fa fa-envelope"></span>
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                    placeholder="Password" required>
                <span class="fa fa-lock"></span>
                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password"
                    required>
                <span class="fa fa-lock"></span>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>

        <div class="register-footer">
            <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('AdminLTE-2/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('AdminLTE-2/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>

</html>