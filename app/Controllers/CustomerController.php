<?php

namespace App\Controllers;

class CustomerController extends BaseController
{
    public function dashboard()
    {
        $db = \Config\Database::connect();
        $user_id = session()->get('user_id');
        
        $statsQuery = $db->query("SELECT 
            COUNT(*) as total_bookings,
            SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending,
            SUM(CASE WHEN status = 'confirmed' THEN 1 ELSE 0 END) as confirmed,
            SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed
            FROM bookings WHERE user_id = ?", [$user_id]);
        
        $stats = $statsQuery->getRowArray();
        
        if (!$stats) {
            $stats = [
                'total_bookings' => 0,
                'pending' => 0,
                'confirmed' => 0,
                'completed' => 0
            ];
        }
        
        $data = [
            'title' => 'Customer Dashboard',
            'page_title' => 'Dashboard',
            'showHero' => true,
            'stats' => $stats
        ];
        
        return view('customer/layout/header', $data)
             . view('customer/dashboard', $data)
             . view('customer/layout/footer');
    }
    
    public function cottages()
    {
        $db = \Config\Database::connect();
        $cottages = $db->query("SELECT * FROM cottages WHERE status = 'available' ORDER BY price_per_day ASC")->getResultArray();
        
        if (!$cottages) {
            $cottages = [];
        }
        
        $data = [
            'title' => 'Our Cottages',
            'page_title' => 'Our Luxurious Cottages',
            'page_subtitle' => 'Experience comfort and elegance in every stay',
            'showHero' => false,
            'cottages' => $cottages
        ];
        
        return view('customer/layout/header', $data)
             . view('customer/cottages/index', $data)
             . view('customer/layout/footer');
    }
    
    public function viewCottage($id)
    {
        $db = \Config\Database::connect();
        $cottage = $db->query("SELECT * FROM cottages WHERE cottage_id = ?", [$id])->getRowArray();
        
        if (!$cottage) {
            session()->setFlashdata('error', 'Cottage not found');
            return redirect()->to('/cottages');
        }
        
        $data = [
            'title' => $cottage['cottage_name'],
            'page_title' => $cottage['cottage_name'],
            'page_subtitle' => 'Book your perfect getaway',
            'showHero' => false,
            'cottage' => $cottage
        ];
        
        return view('customer/layout/header', $data)
             . view('customer/cottages/view', $data)
             . view('customer/layout/footer');
    }
    
    public function myBookings()
    {
        $db = \Config\Database::connect();
        $user_id = session()->get('user_id');
        
        $bookings = $db->query("SELECT b.*, c.cottage_name FROM bookings b 
            JOIN cottages c ON b.cottage_id = c.cottage_id 
            WHERE b.user_id = ? ORDER BY b.created_at DESC", [$user_id])->getResultArray();
        
        if (!$bookings) {
            $bookings = [];
        }
        
        $data = [
            'title' => 'My Bookings',
            'page_title' => 'My Bookings',
            'page_subtitle' => 'Manage and track your reservations',
            'showHero' => false,
            'bookings' => $bookings
        ];
        
        return view('customer/layout/header', $data)
             . view('customer/bookings/my_bookings', $data)
             . view('customer/layout/footer');
    }
    
    public function createBooking($cottage_id)
    {
        $db = \Config\Database::connect();
        $cottage = $db->query("SELECT * FROM cottages WHERE cottage_id = ?", [$cottage_id])->getRowArray();
        
        if (!$cottage) {
            session()->setFlashdata('error', 'Cottage not found');
            return redirect()->to('/cottages');
        }
        
        $data = [
            'title' => 'Book Now',
            'page_title' => 'Complete Your Booking',
            'page_subtitle' => $cottage['cottage_name'],
            'showHero' => false,
            'cottage' => $cottage
        ];
        
        return view('customer/layout/header', $data)
             . view('customer/bookings/create', $data)
             . view('customer/layout/footer');
    }
    
    // THIS IS THE MISSING METHOD - MAKE SURE IT EXISTS
    public function saveBooking()
    {
        $db = \Config\Database::connect();
        
        $cottage_id = $this->request->getPost('cottage_id');
        $check_in = $this->request->getPost('check_in');
        $check_out = $this->request->getPost('check_out');
        $special_requests = $this->request->getPost('special_requests') ?? '';
        
        // Validate input
        if (!$cottage_id || !$check_in || !$check_out) {
            session()->setFlashdata('error', 'Please fill in all required fields');
            return redirect()->back();
        }
        
        // Calculate days
        $start = new \DateTime($check_in);
        $end = new \DateTime($check_out);
        $days = $start->diff($end)->days;
        
        if ($days <= 0) {
            session()->setFlashdata('error', 'Check-out must be after check-in');
            return redirect()->back();
        }
        
        // Get cottage
        $cottage = $db->query("SELECT * FROM cottages WHERE cottage_id = ?", [$cottage_id])->getRowArray();
        
        if (!$cottage) {
            session()->setFlashdata('error', 'Cottage not found');
            return redirect()->to('/cottages');
        }
        
        $total = $days * $cottage['price_per_day'];
        
        // Get user
        $user = $db->query("SELECT * FROM users WHERE user_id = ?", [session()->get('user_id')])->getRowArray();
        
        if (!$user) {
            session()->setFlashdata('error', 'User not found');
            return redirect()->to('/logout');
        }
        
        $ref = 'RES' . date('Ymd') . rand(1000, 9999);
        
        $result = $db->query("INSERT INTO bookings 
            (booking_reference, user_id, cottage_id, customer_name, customer_email, customer_phone, 
             booking_date, start_time, end_time, total_days, total_amount, special_requests, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, '09:00:00', '18:00:00', ?, ?, ?, 'pending')",
            [$ref, $user['user_id'], $cottage_id, $user['full_name'], $user['email'], $user['phone'],
             $check_in, $days, $total, $special_requests]);
        
        if ($result) {
            session()->setFlashdata('success', 'Booking created successfully! Reference: ' . $ref);
        } else {
            session()->setFlashdata('error', 'Failed to create booking');
        }
        
        return redirect()->to('/my-bookings');
    }
    
    public function cancelBooking($id)
    {
        $db = \Config\Database::connect();
        
        $booking = $db->query("SELECT * FROM bookings WHERE booking_id = ? AND user_id = ?", 
            [$id, session()->get('user_id')])->getRowArray();
        
        if (!$booking) {
            session()->setFlashdata('error', 'Booking not found');
            return redirect()->to('/my-bookings');
        }
        
        if ($booking['status'] != 'pending') {
            session()->setFlashdata('error', 'Only pending bookings can be cancelled');
            return redirect()->to('/my-bookings');
        }
        
        $result = $db->query("UPDATE bookings SET status = 'cancelled' WHERE booking_id = ? AND user_id = ?", 
            [$id, session()->get('user_id')]);
        
        if ($result) {
            session()->setFlashdata('success', 'Booking cancelled successfully');
        } else {
            session()->setFlashdata('error', 'Failed to cancel booking');
        }
        
        return redirect()->to('/my-bookings');
    }
    
    public function myAccount()
    {
        $db = \Config\Database::connect();
        $user_id = session()->get('user_id');
        
        $user = $db->query("SELECT * FROM users WHERE user_id = ?", [$user_id])->getRowArray();
        
        $data = [
            'title' => 'My Account',
            'page_title' => 'My Account',
            'page_subtitle' => 'Manage your profile information',
            'showHero' => false,
            'user' => $user
        ];
        
        return view('customer/layout/header', $data)
             . view('customer/account/my_account', $data)
             . view('customer/layout/footer');
    }
    
    public function updateAccount()
    {
        $db = \Config\Database::connect();
        $user_id = session()->get('user_id');
        
        $full_name = $this->request->getPost('full_name');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');
        
        $errors = [];
        if (empty($full_name)) $errors[] = 'Full name is required';
        if (empty($email)) $errors[] = 'Email is required';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Invalid email format';
        if (empty($phone)) $errors[] = 'Phone number is required';
        
        if (!empty($errors)) {
            session()->setFlashdata('error', implode('<br>', $errors));
            return redirect()->to('/my-account');
        }
        
        $checkEmail = $db->query("SELECT * FROM users WHERE email = ? AND user_id != ?", [$email, $user_id])->getRowArray();
        if ($checkEmail) {
            session()->setFlashdata('error', 'Email already used by another account');
            return redirect()->to('/my-account');
        }
        
        $result = $db->query("UPDATE users SET full_name = ?, email = ?, phone = ? WHERE user_id = ?", 
            [$full_name, $email, $phone, $user_id]);
        
        if ($result) {
            session()->set('full_name', $full_name);
            session()->setFlashdata('success', 'Account updated successfully!');
        } else {
            session()->setFlashdata('error', 'Failed to update account');
        }
        
        return redirect()->to('/my-account');
    }
    
    public function changePassword()
    {
        $data = [
            'title' => 'Change Password',
            'page_title' => 'Change Password',
            'page_subtitle' => 'Update your security credentials',
            'showHero' => false
        ];
        
        return view('customer/layout/header', $data)
             . view('customer/account/change_password', $data)
             . view('customer/layout/footer');
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
        
        $user = $db->query("SELECT * FROM users WHERE user_id = ? AND password = ?", 
            [$user_id, md5($current_password)])->getRowArray();
        
        if (!$user) {
            session()->setFlashdata('error', 'Current password is incorrect');
            return redirect()->to('/change-password');
        }
        
        $result = $db->query("UPDATE users SET password = ? WHERE user_id = ?", 
            [md5($new_password), $user_id]);
        
        if ($result) {
            session()->setFlashdata('success', 'Password changed successfully!');
        } else {
            session()->setFlashdata('error', 'Failed to change password');
        }
        
        return redirect()->to('/my-account');
    }
}