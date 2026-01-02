<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Sedang Maintenance</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #A31B31; --bg: #F8F0E3; }
        body { font-family: 'Poppins', sans-serif; background: var(--bg); height: 100vh; display: flex; align-items: center; justify-content: center; text-align: center; margin: 0; padding: 20px; }
        .box { max-width: 600px; }
        .loader { width: 60px; height: 60px; border: 5px solid #ddd; border-top: 5px solid var(--primary); border-radius: 50%; animation: spin 1s linear infinite; margin: 0 auto 20px; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        h1 { color: var(--primary); font-size: 32px; font-weight: 800; }
        p { color: #555; font-size: 18px; line-height: 1.6; }
    </style>
</head>
<body>
    <div class="box">
        <div class="loader"></div>
        <h1>Dapur Sedang Dibersihkan</h1>
        <p>Kami sedang melakukan pemeliharaan rutin pada sistem agar pelayanan resto semakin maksimal. Tunggu sebentar ya!</p>
        <p style="margin-top: 20px; font-weight: 600; font-size: 14px; color: #A31B31;">&copy; {{ date('Y') }} Resto Management System</p>
    </div>
</body>
</html>