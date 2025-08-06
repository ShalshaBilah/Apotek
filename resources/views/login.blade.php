<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Apotek Telu | Login</title>
    <link rel="icon" href="{{ asset('image/remove.png') }}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-2/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-2/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #01796f;
            color: #333;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-logo img {
            width: 80px;
            margin-bottom: 15px;
        }

        .login-logo a {
            font-size: 24px;
            font-weight: 600;
            color: #145a32;
        }

        .login-box-msg {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 5px;
            height: 45px;
        }

        .btn-primary {
            background: #01796f;
            border: none;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .btn-primary:hover {
            background: #01796f;
        }

        .checkbox label {
            font-size: 12px;
            color: #555;
        }

        .login-footer {
            margin-top: 20px;
            text-align: center;
        }

        .login-footer a {
            color: #145a32;
            text-decoration: none;
            font-weight: 500;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="login-box">
        <div class="login-logo">
            <img src="{{ asset('image/remove.png') }}" alt="Apotek Telu Logo">
            <a href="#"><b>Apotek</b> Telu</a>
        </div>
        <p class="login-box-msg">Sign in to start your session</p>
        @if ($errors->has('email'))
            <div class="alert alert-danger">
                {{ $errors->first('email') }}
            </div>
        @endif
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">

                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
            </div>
        </form>
        <div class="login-footer">
            <p>Don't have an account? <a href="{{ route('register') }}">Register now</a></p>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('AdminLTE-2/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('AdminLTE-2/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>

</html>