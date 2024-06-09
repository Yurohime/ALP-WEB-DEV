<!-- resources/views/login.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        #forgotForm {
            text-align: center; /* Center the form */
        }
        #forgotForm button[type="submit"] {
            color: #DD68A0; /* Pink color */
        }
        
        .form-group {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid d-flex align-items-center justify-content-center vh-100">
        <div class="card p-3 rounded-lg" style="width: 400px;">
            <h2 class="text-center mb-4">{{ __('Login') }}</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="username">{{ __('Username') }}</label>
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username', $username) }}" required autocomplete="username" autofocus>
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password', $password) }}" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember', $remember) ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" name="login_as" value="admin">{{ __('Login as Admin') }}</button>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" name="login_as" value="customer">{{ __('Login as Customer') }}</button>
                </div>
            </form>
            
            <p class="text-center">If you don't have an account, <a href="{{ route('register') }}">register here</a>.</p>
            
            <form id="forgotForm" method="POST" action="{{ route('forgot') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-link">Forgot Password?</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
