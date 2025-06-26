<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống Quản lý Lớp học</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .welcome-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
        }

        .welcome-container h1 {
            color: #333;
            margin-bottom: 20px;
            font-size: 28px;
        }

        .welcome-container p {
            color: #666;
            margin-bottom: 30px;
            font-size: 16px;
        }

        .btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
            display: inline-block;
            transition: transform 0.2s;
        }

        .btn:hover {
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    <div class="welcome-container">
        <h1>🏫 Hệ thống Quản lý Lớp học</h1>
        <p>Chào mừng bạn đến với hệ thống quản lý lớp học. Vui lòng đăng nhập để tiếp tục.</p>

        @guest
        <a href="{{ route('login') }}" class="btn">Đăng nhập</a>
        @else
        <a href="{{ route('dashboard') }}" class="btn">Vào Dashboard</a>
        @endguest
    </div>
</body>

</html>