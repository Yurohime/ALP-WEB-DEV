<!-- resources/views/forgot.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #FFF5FA;
        }
        /* Custom highlight color */
        .form-control:focus {
            border-color: #EFA5C9;
            box-shadow: 0 0 0 0.2rem rgba(250, 227, 239, 0.25);
        }
        .btn-primary {
            border-color: #EFA5C9;
            box-shadow: 0 0 0 0.2rem rgba(250, 227, 239, 0.25);
            color: #FFF; 
            background-color: #F1BDD6; 
        }
        .btn-primary:hover {
            border-color: #EFA5C9;
            box-shadow: 0 0 0 0.4rem rgba(250, 227, 239, 0.25);
            color: #FFF; 
            background-color: #F496C3; 
        }
        .btn-primary.focus, .btn-primary:focus {
            border-color: #EFA5C9;
            box-shadow: 0 0 0 0.2rem rgba(250, 227, 239, 0.25);
            color: #FFF; 
            background-color: #EFA5C9; 
        }
        .btn-primary.focus:hover, .btn-primary:focus:hover {
            background-color: #EFA5C9; 
        }
        .text-center a {
            color: #DD68A0; 
        }
    </style>
</head>
<body>
    <div class="container-fluid d-flex align-items-center justify-content-center vh-100">
        <div class="card p-3 rounded-lg" style="width: 400px;">
            <h2 class="text-center mb-4">{{ __('Forgot Password') }}</h2>
            <form id="forgotForm" method="GET" action="{{ route('forgot.password.link') }}">
                @csrf

                <div class="form-group">
                    <label for="email">{{ __('Email') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" onclick="sendAlertAndRedirect()">{{ __('Send Password Reset Link') }}</button>
                </div>
            </form>
            
            <p class="text-center">
                <a href="{{ route('login') }}">Back to Login</a>
            </p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function sendAlertAndRedirect() {
            alert('Password reset link sent!');
            window.location.href = 'https://www.youtube.com/watch?v=dQw4w9WgXcQ&ab_channel=RickAstley';
        }
    </script>
</body>
</html>
