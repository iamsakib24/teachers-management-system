<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Teacher Management System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            background-color: #2c3e50;
            min-height: 100vh;
            padding: 20px;
            color: white;
        }
        .sidebar a {
            color: #ecf0f1;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            margin-bottom: 5px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .sidebar a:hover,
        .sidebar a.active {
            background-color: #3498db;
            color: white;
        }
        .sidebar h5 {
            color: #3498db;
            margin-bottom: 15px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        .content {
            padding: 30px;
        }
        .navbar {
            background-color: #34495e;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar a, .navbar span {
            color: white !important;
        }
        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #3498db;
            color: white;
            border: none;
        }
        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
        }
        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }
        .dashboard-stat {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-align: center;
            margin-bottom: 20px;
        }
        .dashboard-stat h3 {
            color: #3498db;
            font-weight: bold;
            font-size: 2rem;
            margin: 10px 0;
        }
        .dashboard-stat p {
            color: #7f8c8d;
            margin: 0;
        }
        .alert {
            border: none;
            border-radius: 5px;
        }
        table {
            background-color: white;
        }
        .form-control:focus,
        .form-select:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar" style="width: 250px;">
            <h4 class="mb-4">
                <i class="fas fa-graduation-cap"></i> TMS
            </h4>

            @auth
                @if(auth()->user()->role === 'admin')
                    <!-- Admin Sidebar -->
                    <h5><i class="fas fa-tachometer-alt"></i> Admin</h5>
                    <a href="{{ route('dashboard.admin') }}" class="@if(Route::currentRouteName() == 'dashboard.admin') active @endif">
                        <i class="fas fa-home"></i> Dashboard
                    </a>

                    <h5><i class="fas fa-users"></i> Management</h5>
                    <a href="{{ route('teachers.index') }}" class="@if(str_contains(Route::currentRouteName(), 'teachers')) active @endif">
                        <i class="fas fa-chalkboard-user"></i> Teachers
                    </a>
                    <a href="{{ route('subjects.index') }}" class="@if(str_contains(Route::currentRouteName(), 'subjects')) active @endif">
                        <i class="fas fa-book"></i> Subjects
                    </a>
                    <a href="{{ route('attendance.index') }}" class="@if(str_contains(Route::currentRouteName(), 'attendance')) active @endif">
                        <i class="fas fa-clipboard-list"></i> Attendance
                    </a>
                    <a href="{{ route('salaries.index') }}" class="@if(str_contains(Route::currentRouteName(), 'salaries')) active @endif">
                        <i class="fas fa-money-bill"></i> Salaries
                    </a>
                @else
                    <!-- Teacher Sidebar -->
                    <h5><i class="fas fa-gauge"></i> Dashboard</h5>
                    <a href="{{ route('dashboard.teacher') }}" class="@if(Route::currentRouteName() == 'dashboard.teacher') active @endif">
                        <i class="fas fa-home"></i> My Dashboard
                    </a>

                    <h5><i class="fas fa-user"></i> My Account</h5>
                    <a href="{{ route('profile.show') }}" class="@if(Route::currentRouteName() == 'profile.show') active @endif">
                        <i class="fas fa-user-circle"></i> My Profile
                    </a>
                @endif

                <hr style="border-color: #555;">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm w-100">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            @endauth
        </div>

        <!-- Main Content -->
        <div style="flex: 1;">
            <!-- Top Navigation -->
            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1">
                        <i class="fas fa-graduation-cap"></i> Teacher Management System
                    </span>
                    <div class="ms-auto">
                        @auth
                            <span class="me-3">
                                <i class="fas fa-user"></i> {{ auth()->user()->name }}
                            </span>
                        @endauth
                    </div>
                </div>
            </nav>

            <!-- Content Area -->
            <div class="content">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-triangle"></i> Validation Errors:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    @yield('scripts')
</body>
</html>
