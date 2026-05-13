<?php

namespace App\Controllers;

class AuthController extends BaseController
{
    public function login()
    {
        if (session()->get('logged_in')) {
            if (session()->get('role') == 'admin') {
                return redirect()->to('/admin/dashboard');
            }
            return redirect()->to('/dashboard');
        }
        
        return view('auth/login');
    }
    
    public function doLogin()
    {
        $db = \Config\Database::connect();
        
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password'); // Plain text password
        
        // Login using plain text password (NO MD5)
        $query = $db->query("SELECT * FROM users WHERE email = ? AND password = ?", [$email, $password]);
        $user = $query->getRowArray();
        
        if ($user) {
            session()->set([
                'user_id' => $user['user_id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'full_name' => $user['full_name'],
                'role' => $user['role'],
                'logged_in' => true
            ]);
            
            if ($user['role'] == 'admin') {
                return redirect()->to('/admin/dashboard');
            }
            return redirect()->to('/dashboard');
        }
        
        session()->setFlashdata('error', 'Invalid email or password');
        return redirect()->to('/login');
    }
    
    public function doRegister()
    {
        $db = \Config\Database::connect();
        
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $full_name = $this->request->getPost('full_name');
        $phone = $this->request->getPost('phone');
        $password = $this->request->getPost('password'); // Store as plain text
        
        // Validate
        $errors = [];
        if (strlen($password) < 6) {
            $errors[] = 'Password must be at least 6 characters';
        }
        
        // Check if email exists
        $checkEmail = $db->query("SELECT * FROM users WHERE email = ?", [$email])->getRowArray();
        if ($checkEmail) {
            $errors[] = 'Email already registered';
        }
        
        // Check if username exists
        $checkUser = $db->query("SELECT * FROM users WHERE username = ?", [$username])->getRowArray();
        if ($checkUser) {
            $errors[] = 'Username already taken';
        }
        
        if (!empty($errors)) {
            session()->setFlashdata('error', implode('<br>', $errors));
            return redirect()->to('/register');
        }
        
        // Insert new user with plain text password (NO MD5)
        $db->query("INSERT INTO users (username, email, full_name, phone, password, role) 
                    VALUES (?, ?, ?, ?, ?, 'customer')", 
                    [$username, $email, $full_name, $phone, $password]);
        
        session()->setFlashdata('success', 'Account created successfully! Please login with your email.');
        return redirect()->to('/login');
    }
    
    public function updatePassword()
    {
        $db = \Config\Database::connect();
        $user_id = session()->get('user_id');
        
        $current_password = $this->request->getPost('current_password');
        $new_password = $this->request->getPost('new_password');
        $confirm_password = $this->request->getPost('confirm_password');
        
        $errors = [];
        if (empty($current_password)) $errors[] = 'Current password is required';
        if (empty($new_password)) $errors[] = 'New password is required';
        if (strlen($new_password) < 6) $errors[] = 'New password must be at least 6 characters';
        if ($new_password != $confirm_password) $errors[] = 'Passwords do not match';
        
        if (!empty($errors)) {
            session()->setFlashdata('error', implode('<br>', $errors));
            return redirect()->to('/change-password');
        }
        
        // Verify current password (plain text comparison)
        $user = $db->query("SELECT * FROM users WHERE user_id = ? AND password = ?", 
            [$user_id, $current_password])->getRowArray();
        
        if (!$user) {
            session()->setFlashdata('error', 'Current password is incorrect');
            return redirect()->to('/change-password');
        }
        
        // Update to new plain text password
        $result = $db->query("UPDATE users SET password = ? WHERE user_id = ?", 
            [$new_password, $user_id]);
        
        if ($result) {
            session()->setFlashdata('success', 'Password changed successfully!');
        } else {
            session()->setFlashdata('error', 'Failed to change password');
        }
        
        return redirect()->to('/my-account');
    }
    
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}