<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #111; }
        .auth-wrapper { min-height: 100vh; }
        .auth-image {
            background: url('/images/restaurant.jpg') center/cover no-repeat;
        }
        .auth-card {
            max-width: 420px;
            width: 100%;
        }
        .btn-primary {
            background-color: #a4161a;
            border: none;
        }
        .btn-primary:hover {
            background-color: #861015;
        }
    </style>
</head>
<body>

<div class="container-fluid auth-wrapper">
    <div class="row h-100">
        <!-- IMAGE -->
        <div class="col-md-6 d-none d-md-block auth-image"></div>

        <!-- FORM -->
        <div class="col-md-6 d-flex align-items-center justify-content-center bg-white">
            <div class="auth-card p-4">
                <h2 class="fw-bold text-danger">Hello!</h2>
                <p class="text-muted">Please create an account to continue</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Create your password" required>
                    </div>

                    <div class="mb-3">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm your password" required>
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" required>
                        <label class="form-check-label">I agree to the Terms & Privacy</label>
                    </div>

                    <button class="btn btn-primary w-100 mb-3">Register</button>

                    <p class="text-center small">
                        Have an account?
                        <a href="{{ route('login') }}">Log In</a>
                    </p>

                    <hr>

                    <button type="button" class="btn btn-outline-secondary w-100 mb-2">
                        Login with Google
                    </button>
                    <button type="button" class="btn btn-outline-primary w-100">
                        Login with Facebook
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
