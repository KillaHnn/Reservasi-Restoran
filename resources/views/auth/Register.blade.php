<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Reservation Restaurant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="register-container">
        <div class="reg-image-side"></div>

        <div class="reg-form-side">
            <div class="reg-form-wrapper">
                <h1 class="reg-title">Join Us!</h1>
                <p class="reg-subtitle text-center">Create your account to start making reservations</p>

                <form method="POST" action="{{ route('register.process') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Ayu Sekar"
                            value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone_number" class="form-control" placeholder="0812..."
                            value="{{ old('phone_number') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="name@example.com"
                            value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password"
                            class="form-control p-3 reg-input @error('password') is-invalid @enderror" id="password"
                            placeholder="Create a password.." required>
                        @error('password')
                            <div class="text-danger small mt-1">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">Create Account</button>
                </form>

                <div class="text-center mt-3">
                    Already have an account? <a href="/login" class="reg-link">Log In</a>
                </div>

                <div class="reg-separator">Or register with</div>

                <div class="d-flex gap-2 mt-3">
                    <button class="btn btn-outline-secondary w-100"><i class="fab fa-google text-danger"></i>
                        Google</button>
                    <button class="btn btn-outline-secondary w-100"><i class="fab fa-facebook-f text-primary"></i>
                        Facebook</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
