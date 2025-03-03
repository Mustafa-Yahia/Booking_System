<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
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
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand text-white" href="#">MySite</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.html">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="settings.html">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger text-white" href="logout.html">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Profile Information Section -->
    <div class="profile-container mt-4">
        <h4><i class="fas fa-user-edit"></i> Update Personal Information</h4>
        <form action="{{ route('renter.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" placeholder="Enter full name" name="name">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="Enter email" name="email">
            </div>
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="number" class="form-control" placeholder="phone number" name="phone">
            </div>
            <div class="mb-3">
                <label class="form-label">address</label>
                <input type="text" class="form-control" placeholder="address" name="address">
            </div>
            <button type="submit" class="btn btn-primary w-100">Save Changes</button>
        </form>
    </div>

    <!-- Change Password Section -->
    <div class="profile-container mt-4">
        <h4><i class="fas fa-lock"></i> Change Password</h4>
        <form action="{{ route('renter.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Current Password</label>
                <input type="password" class="form-control" placeholder="Enter current password" name="current_password">
            </div>
            <div class="mb-3">
                <label class="form-label">New Password</label>
                <input type="password" class="form-control" placeholder="Enter new password" name="password">
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm New Password</label>
                <input type="password" class="form-control" placeholder="Confirm new password" name="password_confirmation">
            </div>
            <button type="submit" class="btn btn-primary w-100">Update Password</button>
        </form>
    </div>

    <!-- Back Button -->
    <div class="text-center mt-3">
        <button class="btn btn-secondary" onclick="window.history.back()"><i class="fas fa-arrow-left"></i> Go Back</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
