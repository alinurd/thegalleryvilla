@php
    $setting = AppSetting::first();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $details['title'] ?? $setting->title }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            background: #ffffff;
            margin: 40px auto;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .header {
            background-color: #d5a064;
            padding: 20px;
            text-align: center;
            color: #fff;
        }

        .header img {
            width: 80px;
            height: auto;
            margin-bottom: 10px;
        }

        .header h1 {
            font-size: 20px;
            margin: 0;
            font-weight: 600;
        }

        .content {
            padding: 25px 30px;
        }

        .content table {
            width: 100%;
            border-collapse: collapse;
        }

        .content th {
            text-align: left;
            vertical-align: top;
            width: 120px;
            padding: 5px 0;
            color: #333;
            font-weight: 600;
        }

        .content td {
            padding: 5px 0;
            color: #555;
        }

        .footer {
            background: #f1f5f9;
            text-align: center;
            padding: 15px;
            font-size: 13px;
            color: #777;
        }

        .footer a {
            color: #d5a064;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            {{-- <img src="{{ asset('assets/img/logo.png') }}">  --}}
            <h3>{{ $details['title'] }}</h3>
        </div>
        <div class="content">
            <p>Halo, Admin 👋</p>
            <p>Ada pesan baru yang dikirim melalui form kontak di website: </p>
            <table>
                <tr>
                    <th>Nama</th>
                    <td>{{ $details['name'] }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $details['email'] }}</td>
                </tr>
                <tr>
                    <th>Subjek</th>
                    <td>{{ $details['subject'] }}</td>
                </tr>
                <tr>
                    <th>Pesan</th>
                    <td>{{ $details['body'] }}</td>
                </tr>
            </table>

            <p style="margin-top: 25px; text-align: center">Terima kasih,<br><strong>Tim {{$setting->title}}</strong></p>
        </div>

        <div class="footer">
            {{$setting->footer_text}}  
            <br>
            <a href="{{$setting->website}}">{{$setting->website}}</a>
        </div>
    </div>
</body>

</html>
