<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Hệ thống Quản lý Lớp học</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            max-width: 450px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-header h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .login-header p {
            color: #666;
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 600;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.1);
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 25px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(102, 126, 234, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .demo-accounts {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 20px;
            border-radius: 12px;
            border-left: 4px solid #667eea;
        }

        .demo-accounts h4 {
            color: #495057;
            margin-bottom: 12px;
            font-size: 14px;
            font-weight: 600;
        }

        .account-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            padding: 8px 12px;
            background: white;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }

        .account-item:last-child {
            margin-bottom: 0;
        }

        .account-info {
            color: #495057;
            font-size: 13px;
        }

        .account-role {
            font-weight: 600;
            color: #667eea;
        }

        .account-credentials {
            font-family: 'Courier New', monospace;
            color: #6c757d;
            font-size: 12px;
        }

        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
            font-size: 14px;
        }

        .back-home {
            text-align: center;
            margin-top: 25px;
        }

        .back-home a {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .back-home a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
                margin: 10px;
            }

            .login-header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-header">
            <h1>🏫 Đăng nhập</h1>
            <p>Hệ thống Quản lý Lớp học</p>
        </div>

        @if ($errors->any())
        <div class="error-message">
            @foreach ($errors->all() as $error)
            {{ $error }}
            @endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="username">Tên đăng nhập</label>
                <input type="text"
                    id="username"
                    name="username"
                    value="{{ old('username') }}"
                    placeholder="Nhập tên đăng nhập của bạn"
                    required
                    autofocus>
            </div>

            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password"
                    id="password"
                    name="password"
                    placeholder="Nhập mật khẩu của bạn"
                    required>
            </div>

            <button type="submit" class="btn-login">
                Đăng nhập
            </button>
        </form>

        <div class="demo-accounts">
            <h4>📋 Tài khoản demo để test</h4>
      
            <div class="account-item">
                <div class="account-info">
                    <span class="account-role">👨‍🏫 Giáo viên</span>
                </div>
                <div class="account-credentials">giaovien1 / password</div>
            </div>
        </div>

        <div class="back-home">
            <a href="{{ url('/') }}">← Quay về trang chủ</a>
        </div>
    </div>
</body>

</html>