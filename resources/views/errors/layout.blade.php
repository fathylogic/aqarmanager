<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>خطأ @yield('code')</title>
    <style>
        body {
            font-family: Tahoma, Arial;
            background: #f8f9fa;
            text-align: center;
            padding-top: 80px;
        }
        .error-box {
            background: #fff;
            padding: 40px;
            margin: auto;
            width: 420px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,.1);
        }
        h1 {
            font-size: 72px;
            color: #dc3545;
            margin: 0;
        }
        p {
            font-size: 18px;
            color: #555;
        }
    </style>
</head>
<body>
<div class="error-box">
    @yield('content')
</div>
</body>
</html>
