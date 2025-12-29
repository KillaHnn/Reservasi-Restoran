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

                <form>
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Your full name" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Phone number</label>
                        <input type="text" name="phone_number" class="form-control" placeholder="08xxxxxxxxxx" value="{{ old('phone_number') }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="reg-label">Email</label>
                        <input type="email" class="form-control p-3 reg-input" id="email"
                            placeholder="Enter your email..">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="reg-label">Password</label>
                        <input type="password" class="form-control p-3 reg-input" id="password"
                            placeholder="Create a password..">
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input reg-checkbox" id="terms">
                        <label class="form-check-label" for="terms">I agree to the Terms & Privacy</label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-3">Register</button>

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
