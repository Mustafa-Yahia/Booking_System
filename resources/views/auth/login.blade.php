<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4;
        }
        .navbar {
            background-color: #4CAF50;
        }
        .navbar .nav-link {
            color: white !important;
        }
        .profile-header {
            background: linear-gradient(135deg, #4CAF50, #81c408);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .profile-container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        .form-control:focus {
            border-color: #81c408;
            box-shadow: 0 0 5px rgba(129, 196, 8, 0.5);
        }
        .btn-primary {
            background-color: #81c408;
            border-color: #81c408;
        }
        .btn-primary:hover {
            background-color: #6fa007;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>

    <div class="profile-header">
        <h2>Login</h2>
    </div>

    <div class="profile-container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <div class="text-center mt-3">
            <p>Don't have an account? <a href="{{ route('register') }}" class="text-primary">Sign up</a></p>
        </div>
        
    </div>

</body>
</html>
