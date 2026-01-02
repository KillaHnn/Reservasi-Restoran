<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Meja Tidak Ditemukan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #A31B31;
            --bg: #F8F0E3;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
        }

        .container {
            text-align: center;
            padding: 20px;
            max-width: 500px;
        }

        .error-code {
            font-size: 120px;
            font-weight: 800;
            color: var(--primary);
            line-height: 1;
            margin-bottom: 20px;
            letter-spacing: -5px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        p {
            color: #666;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .btn {
            background: var(--primary);
            color: white;
            padding: 15px 30px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
            display: inline-block;
            box-shadow: 0 4px 15px rgba(163, 27, 49, 0.3);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(163, 27, 49, 0.4);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="error-code">404</div>
        <h1>Wah, Meja Kosong!</h1>
        <p>Halaman atau data yang Anda cari tidak ditemukan di resto kami. Mungkin alamatnya salah ketik atau sudah
            dihapus.</p>
        <a href="{{ auth()->check()
            ? (auth()->user()->role == 'admin'
                ? route('admin.dashboard')
                : (auth()->user()->role == 'cashier'
                    ? route('cashier.dashboard')
                    : route('customer.dashboard')))
            : url('/') }}"
            class="btn">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>
</body>

</html>
