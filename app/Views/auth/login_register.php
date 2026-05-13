<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winnie's Resort - Login & Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .main-card {
            background: white;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            max-width: 1200px;
            width: 100%;
            animation: fadeInUp 0.6s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .resort-side {
            background: linear-gradient(135deg, #1e88e5, #0d47a1);
            padding: 50px;
            color: white;
            height: 100%;
        }
        
        .resort-side h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            font-weight: 700;
        }
        
        .feature-list {
            list-style: none;
            margin-top: 30px;
        }
        
        .feature-list li {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .form-side {
            padding: 50px;
        }
        
        .tab-buttons {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            border-bottom: 2px solid #e0e0e0;
        }
        
        .tab-btn {
            background: none;
            border: none;
            font-size: 1.3rem;
            font-weight: 600;
            padding: 10px 20px;
            cursor: pointer;
            color: #666;
            transition: all 0.3s;
            position: relative;
        }
        
        .tab-btn.active {
            color: #1e88e5;
        }
        
        .tab-btn.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 3px;
            background: #1e88e5;
        }
        
        .form-container {
            display: none;
            animation: fadeIn 0.4s;
        }
        
        .form-container.active {
            display: block;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            transition: all 0.3s;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #1e88e5;
            box-shadow: 0 0 0 3px rgba(30,136,229,0.1);
        }
        
        .btn-submit {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #1e88e5, #0d47a1);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(30,136,229,0.4);
        }
        
        .btn-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        
        .alert-message {
            padding: 12px 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: none;
        }
        
        .alert-message.show {
            display: block;
            animation: slideDown 0.3s;
        }
        
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.8s linear infinite;
            margin-right: 8px;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        @media (max-width: 768px) {
            .resort-side {
                display: none;
            }
            .form-side {
                padding: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="main-card">
        <div class="row g-0">
            <div class="col-md-6">
                <div class="resort-side">
                    <i class="fas fa-umbrella-beach fa-4x mb-4"></i>
                    <h1>Winnie's Resort</h1>
                    <p>Experience paradise with our beautiful cottages, stunning beach views, and world-class hospitality.</p>
                    <ul class="feature-list">
                        <li><i class="fas fa-check-circle"></i> Premium Beachfront Cottages</li>
                        <li><i class="fas fa-check-circle"></i> 24/7 Customer Support</li>
                        <li><i class="fas fa-check-circle"></i> Best Price Guarantee</li>
                        <li><i class="fas fa-check-circle"></i> Easy Online Booking</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-side">
                    <div class="tab-buttons">
                        <button class="tab-btn active" onclick="switchTab('login')">Login</button>
                        <button class="tab-btn" onclick="switchTab('register')">Register</button>
                    </div>
                    
                    <div id="alertMessage" class="alert-message"></div>
                    
                    <div id="loginForm" class="form-container active">
                        <form id="loginFormElement" onsubmit="return false;">
                            <div class="form-group">
                                <input type="text" id="loginUsername" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <input type="password" id="loginPassword" placeholder="Password" required>
                            </div>
                            <button type="button" class="btn-submit" id="loginBtn" onclick="submitLogin()">Login</button>
                        </form>
                    </div>
                    
                    <div id="registerForm" class="form-container">
                        <form id="registerFormElement" onsubmit="return false;">
                            <div class="form-group">
                                <input type="text" id="regUsername" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <input type="email" id="regEmail" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input type="text" id="regFullname" placeholder="Full Name" required>
                            </div>
                            <div class="form-group">
                                <input type="text" id="regPhone" placeholder="Phone Number" required>
                            </div>
                            <div class="form-group">
                                <input type="password" id="regPassword" placeholder="Password (min 6 characters)" required>
                            </div>
                            <button type="button" class="btn-submit" id="registerBtn" onclick="submitRegister()">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function switchTab(tab) {
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            document.getElementById('loginForm').classList.toggle('active', tab === 'login');
            document.getElementById('registerForm').classList.toggle('active', tab === 'register');
            hideAlert();
        }
        
        function showAlert(message, type) {
            const alertDiv = document.getElementById('alertMessage');
            alertDiv.innerHTML = message;
            alertDiv.className = `alert-message alert-${type} show`;
            setTimeout(() => hideAlert(), 5000);
        }
        
        function hideAlert() {
            const alertDiv = document.getElementById('alertMessage');
            alertDiv.className = 'alert-message';
        }
        
        function setLoading(buttonId, isLoading) {
            const btn = document.getElementById(buttonId);
            if (isLoading) {
                btn.disabled = true;
                btn.innerHTML = '<span class="spinner"></span> Processing...';
            } else {
                btn.disabled = false;
                btn.innerHTML = buttonId === 'loginBtn' ? 'Login' : 'Register';
            }
        }
        
        async function submitLogin() {
            const username = document.getElementById('loginUsername').value.trim();
            const password = document.getElementById('loginPassword').value;
            
            if (!username || !password) {
                showAlert('Please enter username and password', 'error');
                return;
            }
            
            setLoading('loginBtn', true);
            hideAlert();
            
            try {
                const response = await fetch('/ajax/login', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: `username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`
                });
                
                const data = await response.json();
                
                if (data.success) {
                    showAlert('Login successful! Redirecting...', 'success');
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1000);
                } else {
                    showAlert(data.message || 'Login failed', 'error');
                    setLoading('loginBtn', false);
                }
            } catch (error) {
                console.error('Error:', error);
                showAlert('Connection error. Please try again.', 'error');
                setLoading('loginBtn', false);
            }
        }
        
        async function submitRegister() {
            const username = document.getElementById('regUsername').value.trim();
            const email = document.getElementById('regEmail').value.trim();
            const fullname = document.getElementById('regFullname').value.trim();
            const phone = document.getElementById('regPhone').value.trim();
            const password = document.getElementById('regPassword').value;
            
            if (!username || !email || !fullname || !phone || !password) {
                showAlert('Please fill in all fields', 'error');
                return;
            }
            
            if (password.length < 6) {
                showAlert('Password must be at least 6 characters', 'error');
                return;
            }
            
            setLoading('registerBtn', true);
            hideAlert();
            
            try {
                const response = await fetch('/ajax/register', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: `username=${encodeURIComponent(username)}&email=${encodeURIComponent(email)}&full_name=${encodeURIComponent(fullname)}&phone=${encodeURIComponent(phone)}&password=${encodeURIComponent(password)}`
                });
                
                const data = await response.json();
                
                if (data.success) {
                    showAlert(data.message, 'success');
                    // Clear form
                    document.getElementById('regUsername').value = '';
                    document.getElementById('regEmail').value = '';
                    document.getElementById('regFullname').value = '';
                    document.getElementById('regPhone').value = '';
                    document.getElementById('regPassword').value = '';
                    // Switch to login tab
                    const loginTab = document.querySelector('.tab-btn');
                    loginTab.click();
                } else {
                    showAlert(data.message, 'error');
                }
                setLoading('registerBtn', false);
            } catch (error) {
                console.error('Error:', error);
                showAlert('Connection error. Please try again.', 'error');
                setLoading('registerBtn', false);
            }
        }
        
        // Allow Enter key to submit
        document.getElementById('loginPassword').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') submitLogin();
        });
        document.getElementById('regPassword').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') submitRegister();
        });
    </script>
</body>
</html>