<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Winnie\'s Resort' ?> - Luxury Resort Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --white: #ffffff;
            --off-white: #f8f9fa;
            --blue: #1e88e5;
            --blue-dark: #0d47a1;
            --blue-steel: #2c3e50;
            --brown-light: #d4a373;
            --brown: #8b5a2b;
            --shadow: 0 5px 30px rgba(0, 0, 0, 0.08);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--off-white);
            color: #333;
        }
        
        /* Top Bar */
        .top-bar {
            background: var(--blue-dark);
            color: white;
            padding: 8px 0;
            font-size: 13px;
        }
        
        .top-bar a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
        }
        
        .top-bar a:hover {
            color: var(--brown-light);
        }
        
        /* Navbar */
        .navbar {
            background: var(--white);
            padding: 1rem 2rem;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--blue-dark) !important;
        }
        
        .navbar-brand span {
            color: var(--brown);
        }
        
        .nav-link {
            font-weight: 500;
            color: #555 !important;
            margin: 0 10px;
            transition: all 0.3s;
        }
        
        .nav-link:hover {
            color: var(--blue) !important;
        }
        
        .nav-link.active {
            color: var(--blue) !important;
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--blue-steel) 0%, var(--blue-dark) 100%);
            padding: 60px 0;
            text-align: center;
            color: white;
            margin-bottom: 40px;
        }
        
        .hero-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            font-family: 'Playfair Display', serif;
        }
        
        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, var(--blue-steel) 0%, var(--blue-dark) 100%);
            padding: 40px 0;
            text-align: center;
            color: white;
            margin-bottom: 40px;
        }
        
        .page-header h2 {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        /* Cards */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--shadow);
            transition: all 0.3s;
            background: var(--white);
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
        }
        
        .card-header {
            background: var(--white);
            border-bottom: 2px solid var(--brown-light);
            padding: 15px 20px;
            font-weight: 600;
            color: var(--blue-dark);
        }
        
        /* Stat Cards */
        .stat-card {
            background: var(--white);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            box-shadow: var(--shadow);
            border-top: 4px solid var(--brown);
        }
        
        .stat-card i {
            font-size: 40px;
            color: var(--blue);
            margin-bottom: 10px;
        }
        
        .stat-card h3 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--blue-dark);
            margin-bottom: 5px;
        }
        
        /* Buttons */
        .btn-primary {
            background: var(--blue);
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background: var(--blue-dark);
            transform: translateY(-2px);
        }
        
        .btn-outline-brown {
            border: 2px solid var(--brown);
            color: var(--brown);
            background: transparent;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-outline-brown:hover {
            background: var(--brown);
            color: white;
            transform: translateY(-2px);
        }
        
        /* Gallery */
        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            cursor: pointer;
        }
        
        .gallery-link {
            text-decoration: none;
            display: block;
        }
        
        .gallery-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .gallery-item:hover img {
            transform: scale(1.1);
        }
        
        .gallery-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);
            color: white;
            padding: 20px 15px 10px;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }
        
        .gallery-item:hover .gallery-overlay {
            transform: translateY(0);
        }
        
        .gallery-overlay span {
            font-size: 16px;
            font-weight: 600;
            display: block;
        }
        
        .gallery-overlay small {
            font-size: 12px;
            opacity: 0.9;
        }
        
        /* Footer */
        .footer {
            background: var(--blue-steel);
            color: white;
            padding: 40px 0 20px;
            margin-top: 50px;
        }
        
        .footer h5 {
            color: var(--brown-light);
            margin-bottom: 15px;
        }
        
        .footer a {
            color: #ccc;
            text-decoration: none;
        }
        
        .footer a:hover {
            color: var(--brown-light);
        }
        
        .social-icons a {
            display: inline-block;
            width: 35px;
            height: 35px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            text-align: center;
            line-height: 35px;
            margin-right: 10px;
            transition: all 0.3s;
        }
        
        .social-icons a:hover {
            background: var(--brown);
            transform: translateY(-3px);
        }
        
        .divider {
            width: 60px;
            height: 3px;
            background: var(--brown);
            margin: 15px auto;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 1.8rem;
            }
            .navbar-brand {
                font-size: 1.3rem;
            }
            .gallery-item img {
                height: 200px;
            }
        }
    </style>
</head>
<body>

<!-- Top Bar -->
<div class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-md-start">
            </div>
        </div>
    </div>
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/dashboard">
            <i class="fas fa-umbrella-beach"></i> Winnie's<span>Resort</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/my-bookings">My Bookings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/my-account">My Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="/logout">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?php if(isset($showHero) && $showHero === true): ?>
<div class="hero-section">
    <div class="container">
        <h1>Welcome back, <?= session()->get('full_name') ?></h1>
        <p>Experience luxury and tranquility at Winnie's Resort</p>
        <div class="divider"></div>
    </div>
</div>
<?php elseif(isset($page_title)): ?>
<div class="page-header">
    <div class="container">
        <h2><?= $page_title ?></h2>
        <?php if(isset($page_subtitle)): ?>
            <p><?= $page_subtitle ?></p>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>

<div class="container">

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