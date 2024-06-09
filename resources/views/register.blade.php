<!-- resources/views/register.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
            <h2 class="text-center mb-4">{{ __('Create an Account') }}</h2>
            <form method="POST" action="">
                @csrf

                <div class="form-group">
                    <label for="name">{{ __('Name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }}</button>
                </div>
            </form>
            
            <p class="text-center">Already have an account? <a href="{{ route('login') }}">Login here</a>.</p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
