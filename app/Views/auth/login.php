<!DOCTYPE html>
<html>
<head>
    <title>Login - Winnie's Resort</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            border: none;
        }
        .btn-primary {
            background: #1e88e5;
            border: none;
            padding: 12px;
            border-radius: 25px;
        }
        .btn-primary:hover {
            background: #0d47a1;
        }
        .form-control {
            border-radius: 25px;
            padding: 12px 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <i class="fas fa-umbrella-beach fa-3x" style="color: #1e88e5;"></i>
                            <h2 class="mt-3">Winnie's Resort</h2>
                            <p class="text-muted">Login to your account</p>
                        </div>
                        
                        <?php if(session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>
                        
                        <?php if(session()->getFlashdata('success')): ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>
                        
                        <form action="/doLogin" method="post">
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fas fa-envelope text-muted"></i>
                                    </span>
                                    <input type="email" name="email" class="form-control border-start-0" 
                                           placeholder="Email Address" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fas fa-lock text-muted"></i>
                                    </span>
                                    <input type="password" name="password" class="form-control border-start-0" 
                                           placeholder="Password" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>
                        </form>
                        
                        <hr>
                        <p class="text-center mb-0">
                            Don't have an account? <a href="/register">Create Account</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>