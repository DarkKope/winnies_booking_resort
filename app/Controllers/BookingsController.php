<?php

namespace App\Controllers;

class BookingsController extends BaseController
{
    public function myBookings()
    {
        $db = \Config\Database::connect();
        $user_id = session()->get('user_id');
        
        $bookings = $db->query("SELECT b.*, c.cottage_name, c.price_per_day FROM bookings b 
            JOIN cottages c ON b.cottage_id = c.cottage_id 
            WHERE b.user_id = ? ORDER BY b.created_at DESC", [$user_id])->getResultArray();
        
        return view('layout/header', ['title' => 'My Bookings'])
             . view('layout/sidebar')
             . view('bookings/my_bookings', ['bookings' => $bookings])
             . view('layout/footer');
    }
    
    public function create($cottage_id)
    {
        $db = \Config\Database::connect();
        $cottage = $db->query("SELECT * FROM cottages WHERE cottage_id = ?", [$cottage_id])->getRowArray();
        
        if (!$cottage) {
            return redirect()->to('/cottages');
        }
        
        return view('layout/header', ['title' => 'Book Now'])
             . view('layout/sidebar')
             . view('bookings/create', ['cottage' => $cottage])
             . view('layout/footer');
    }
    
    public function save()
    {
        $db = \Config\Database::connect();
        
        // Get POST data
        $cottage_id = $this->request->getPost('cottage_id');
        $check_in_date = $this->request->getPost('check_in_date');
        $check_out_date = $this->request->getPost('check_out_date');
        $special_requests = $this->request->getPost('special_requests') ?? '';
        
        // Validate input
        if (empty($cottage_id) || empty($check_in_date) || empty($check_out_date)) {
            session()->setFlashdata('error', 'Please fill in all required fields');
            return redirect()->back();
        }
        
        // Calculate number of days
        $check_in = new \DateTime($check_in_date);
        $check_out = new \DateTime($check_out_date);
        $interval = $check_in->diff($check_out);
        $total_days = $interval->days;
        
        if ($total_days <= 0) {
            session()->setFlashdata('error', 'Check-out date must be after check-in date');
            return redirect()->back();
        }
        
        // Get cottage price per day
        $cottage = $db->query("SELECT * FROM cottages WHERE cottage_id = ?", [$cottage_id])->getRowArray();
        
        if (!$cottage) {
            session()->setFlashdata('error', 'Cottage not found');
            return redirect()->to('/cottages');
        }
        
        $total_amount = $total_days * $cottage['price_per_day'];
        
        // Get user info
        $user_id = session()->get('user_id');
        
        if (!$user_id) {
            session()->setFlashdata('error', 'Please login again');
            return redirect()->to('/login');
        }
        
        // Get user data from database
        $userResult = $db->query("SELECT * FROM users WHERE user_id = ?", [$user_id]);
        $user = $userResult->getRowArray();
        
        if (!$user) {
            session()->setFlashdata('error', 'User not found. Please login again.');
            return redirect()->to('/login');
        }
        
        // Generate unique booking reference
        $booking_reference = 'RES' . date('Ymd') . rand(1000, 9999);
        
        // Prepare data for insert
        $sql = "INSERT INTO bookings (
            booking_reference, 
            user_id, 
            cottage_id, 
            customer_name, 
            customer_email, 
            customer_phone, 
            booking_date, 
            start_time, 
            end_time, 
            total_days, 
            total_amount, 
            special_requests, 
            status, 
            payment_status
        ) VALUES (?, ?, ?, ?, ?, ?, ?, '09:00:00', '18:00:00', ?, ?, ?, 'pending', 'unpaid')";
        
        $result = $db->query($sql, [
            $booking_reference,
            $user_id,
            $cottage_id,
            $user['full_name'],
            $user['email'],
            $user['phone'],
            $check_in_date,
            $total_days,
            $total_amount,
            $special_requests
        ]);
        
        if ($result) {
            session()->setFlashdata('success', 'Booking created successfully! Reference: ' . $booking_reference . ' | ' . $total_days . ' day(s)');
        } else {
            $error = $db->error();
            session()->setFlashdata('error', 'Failed to create booking. Error: ' . ($error['message'] ?? 'Unknown error'));
        }
        
        return redirect()->to('/my-bookings');
    }
    
    public function cancel($id)
    {
        $db = \Config\Database::connect();
        $user_id = session()->get('user_id');
        
        // Check if booking exists and belongs to user
        $booking = $db->query("SELECT * FROM bookings WHERE booking_id = ? AND user_id = ?", [$id, $user_id])->getRowArray();
        
        if (!$booking) {
            session()->setFlashdata('error', 'Booking not found');
            return redirect()->to('/my-bookings');
        }
        
        // Only allow cancellation of pending bookings
        if ($booking['status'] != 'pending') {
            session()->setFlashdata('error', 'Only pending bookings can be cancelled');
            return redirect()->to('/my-bookings');
        }
        
        // Update booking status
        $result = $db->query("UPDATE bookings SET status = 'cancelled' WHERE booking_id = ?", [$id]);
        
        if ($result) {
            session()->setFlashdata('success', 'Booking cancelled successfully');
        } else {
            session()->setFlashdata('error', 'Failed to cancel booking');
        }
        
        return redirect()->to('/my-bookings');
    }
}