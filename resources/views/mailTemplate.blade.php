<!DOCTYPE html>
<html>

<head>
    <title>Verifikasi Akun SIMA</title>
    <style>
        body {
            font-family: sans-serif;
            color: #333;
            line-height: 1.6;
        }

        .container {
            padding: 20px;
            border: 1px solid #eee;
            border-radius: 10px;
            max-width: 600px;
            margin: auto;
        }

        .button {
            padding: 10px 20px;
            background-color: #0d6efd;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            font-size: 0.8rem;
            color: #888;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
        }

        td {
            padding: 5px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>Halo, <b>{{ $details['username'] }}</b>!</h3>
        <p>Terima kasih telah mendaftar di <b>SIMA (Sistem Informasi Mahasiswa)</b>. Berikut adalah detail akun Anda:
        </p>

        <table>
            <tr>
                <td width="150">Username</td>
                <td>: {{ $details['username'] }}</td>
            </tr>
            <tr>
                <td>Role Default</td>
                <td>: <span style="color: blue;">{{ $details['role'] }}</span></td>
            </tr>
            <tr>
                <td>Waktu Daftar</td>
                <td>: {{ $details['datetime'] }}</td>
            </tr>
        </table>

        <div style="background: #f9f9f9; padding: 20px; border-radius: 8px; text-align: center;">
            <p>Silakan klik tombol di bawah ini untuk mengaktifkan akun Anda:</p>
            <a href="{{ $details['url'] }}" class="button">Verifikasi Akun Saya</a>
            <br><br>
            <small>Atau copy link berikut ke browser Anda:</small><br>
            <code style="color: #0d6efd;">{{ $details['url'] }}</code>
        </div>

        <div class="footer">
            <p>Email ini dikirim secara otomatis oleh sistem. Jangan membalas email ini.</p>
            <p>&copy; 2026 SIMA Enterprise Edition</p>
        </div>
    </div>
</body>

</html>
