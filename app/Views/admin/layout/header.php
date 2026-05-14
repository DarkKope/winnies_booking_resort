<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Panel' ?> - Winnie's Resort Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --admin-primary: #1a1a2e;
            --admin-secondary: #16213e;
            --admin-accent: #0f3460;
            --admin-success: #00b4d8;
            --admin-warning: #fca311;
            --admin-danger: #e63946;
            --admin-sidebar: #0f0f1f;
            --admin-card: #ffffff;
            --admin-text: #2c3e50;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #f4f6f9;
            color: var(--admin-text);
            overflow-x: hidden;
        }
        
        /* Sidebar */
        .sidebar {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            width: 280px;
            z-index: 100;
            transition: all 0.3s;
            box-shadow: 2px 0 20px rgba(0,0,0,0.1);
        }
        
        .sidebar .brand {
            padding: 25px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
        }
        
        .sidebar .brand h3 {
            color: white;
            margin: 10px 0 0;
            font-size: 1.5rem;
            font-weight: 600;
        }
        
        .sidebar .brand p {
            color: rgba(255,255,255,0.7);
            font-size: 0.8rem;
            margin: 5px 0 0;
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin: 5px 15px;
            border-radius: 10px;
            transition: all 0.3s;
            font-weight: 500;
        }
        
        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            transform: translateX(5px);
        }
        
        .sidebar .nav-link.active {
            background: #0f3460;
            color: white;
        }
        
        .sidebar .nav-link i {
            width: 25px;
            margin-right: 10px;
        }
        
        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 20px;
        }
        
        /* Top Bar */
        .top-bar {
            background: white;
            padding: 15px 25px;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .top-bar h4 {
            margin: 0;
            font-weight: 600;
            color: var(--admin-primary);
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-info .badge {
            background: #00b4d8;
            padding: 5px 12px;
            border-radius: 20px;
        }
        
        /* Stats Cards */
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            border-left: 4px solid var(--admin-accent);
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .stat-card i {
            font-size: 35px;
            color: var(--admin-accent);
            margin-bottom: 10px;
        }
        
        .stat-card h3 {
            font-size: 28px;
            font-weight: 700;
            margin: 10px 0 5px;
        }
        
        .stat-card p {
            color: #666;
            margin: 0;
            font-size: 14px;
        }
        
        /* Tables */
        .data-table {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .data-table thead th {
            background: #f8f9fa;
            color: var(--admin-primary);
            font-weight: 600;
            padding: 15px;
            border-bottom: 2px solid #e0e0e0;
        }
        
        .data-table tbody td {
            padding: 12px 15px;
            vertical-align: middle;
        }
        
        .data-table tbody tr:hover {
            background: #f8f9fa;
        }
        
        /* Buttons */
        .btn-primary {
            background: var(--admin-accent);
            border: none;
            padding: 8px 20px;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background: #1a4a7a;
            transform: translateY(-2px);
        }
        
        .btn-danger {
            background: var(--admin-danger);
            border: none;
        }
        
        .btn-warning {
            background: var(--admin-warning);
            border: none;
            color: white;
        }
        
        .btn-success {
            background: var(--admin-success);
            border: none;
        }
        
        /* Forms */
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 10px 15px;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--admin-accent);
            box-shadow: 0 0 0 3px rgba(15,52,96,0.1);
        }
        
        /* Badges */
        .badge-pending {
            background: #fff3e0;
            color: #fca311;
            padding: 5px 10px;
            border-radius: 20px;
        }
        
        .badge-confirmed {
            background: #e3f2fd;
            color: #00b4d8;
            padding: 5px 10px;
            border-radius: 20px;
        }
        
        .badge-completed {
            background: #e8f5e9;
            color: #4caf50;
            padding: 5px 10px;
            border-radius: 20px;
        }
        
        .badge-cancelled {
            background: #ffebee;
            color: #e63946;
            padding: 5px 10px;
            border-radius: 20px;
        }
        
        /* Cards */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }
        
        .card-header {
            background: white;
            border-bottom: 1px solid #e0e0e0;
            padding: 15px 20px;
            font-weight: 600;
            border-radius: 15px 15px 0 0 !important;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                min-height: auto;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand">
        <i class="fas fa-umbrella-beach fa-2x" style="color: #00b4d8;"></i>
        <h3>Winnie's Resort</h3>
        <p>Administrator Panel</p>
    </div>
    
    <nav class="nav flex-column">
        <a class="nav-link" href="/admin/dashboard">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
        <a class="nav-link" href="/admin/cottages">
            <i class="fas fa-hotel"></i> Manage Cottages
        </a>
        <a class="nav-link" href="/admin/bookings">
            <i class="fas fa-calendar-check"></i> Manage Bookings
        </a>
        <a class="nav-link" href="/admin/users">
            <i class="fas fa-users"></i> Manage Users
        </a>
        <hr style="border-color: rgba(255,255,255,0.1); margin: 15px;">
        <a class="nav-link text-danger" href="/logout">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </nav>
    
    <div class="position-absolute bottom-0 p-3" style="width: 100%;">
        <small style="color: rgba(255,255,255,0.5);">
            Logged in as:<br>
            <strong style="color: white;"><?= session()->get('full_name') ?></strong>
        </small>
    </div>
</div>

<div class="main-content">
    <div class="top-bar">
        <h4><i class="fas fa-chart-line"></i> <?= $title ?? 'Dashboard' ?></h4>
        <div class="user-info">
            <span class="text-muted"><?= session()->get('username') ?></span>
            <span class="badge"><?= ucfirst(session()->get('role')) ?></span>
        </div>
    </div>
    
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>