<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Restaurant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
    <div class="login-container">
        <div class="image-side">
        </div>

        <div class="form-side">
            <div class="form-content-wrapper">
                <h1 class="welcome-text">Welcome!</h1>
                <p class="login-info">Please log in to your account to continue</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email"
                            class="form-control p-3 @error('email') is-invalid @enderror" id="email"
                            placeholder="Enter your email.." value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <label for="password" class="form-label">Password</label>
                            <a href="{{ route('password.request') }}" class="forgot-password">*Forgot Password?</a>
                        </div>
                        <input type="password" name="password"
                            class="form-control p-3 @error('email') is-invalid @enderror" id="password"
                            placeholder="Enter your password.." required>
                    </div>

                    <button type="submit" class="btn btn-login w-100">Log In</button>
                </form>

                <div class="text-center mt-3">
                    Don't have any account? <a href="{{ route('register') }}">Sign Up</a>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
