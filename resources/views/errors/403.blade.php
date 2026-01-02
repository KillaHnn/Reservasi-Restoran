<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Dibatasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #A31B31;
            --bg: #F8F0E3;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin: 0;
        }

        .card {
            background: white;
            padding: 50px;
            border-radius: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border-bottom: 5px solid var(--primary);
        }

        .icon {
            font-size: 80px;
            color: #ffc107;
            margin-bottom: 20px;
        }

        h1 {
            color: #333;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .btn {
            background: var(--primary);
            color: white;
            padding: 12px 25px;
            border-radius: 10px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="icon"><i class="fas fa-user-lock"></i></div>
        <h1>Area Terlarang!</h1>
        <p>Maaf, Anda tidak memiliki izin untuk masuk ke halaman ini.<br>Silakan hubungi Admin jika ini adalah
            kesalahan.</p>
        <a href="{{ auth()->check()
            ? (auth()->user()->role == 'admin'
                ? route('admin.dashboard')
                : (auth()->user()->role == 'cashier'
                    ? route('cashier.dashboard')
                    : route('customer.dashboard')))
            : url('/') }}"
            class="btn">
            Kembali ke Dashboard
        </a>
    </div>
</body>

</html>
