<?php

namespace App\Models;

class DataModel
{
    private function initData()
    {
        if (!session()->has('users')) {
            // Initial users
            session()->set('users', [
                1 => [
                    'user_id' => 1,
                    'username' => 'admin',
                    'password' => md5('admin123'),
                    'email' => 'admin@winniesresort.com',
                    'full_name' => 'Administrator',
                    'phone' => '09123456789',
                    'role' => 'admin',
                    'created_at' => date('Y-m-d H:i:s')
                ],
                2 => [
                    'user_id' => 2,
                    'username' => 'customer1',
                    'password' => md5('customer123'),
                    'email' => 'customer@test.com',
                    'full_name' => 'John Doe',
                    'phone' => '09876543210',
                    'role' => 'customer',
                    'created_at' => date('Y-m-d H:i:s')
                ]
            ]);
        }
        
        if (!session()->has('cottages')) {
            session()->set('cottages', [
                1 => [
                    'cottage_id' => 1,
                    'cottage_name' => 'Beach Front Kubo',
                    'description' => 'Traditional nipa hut with stunning ocean view. Perfect for couples and small families.',
                    'price_per_day' => 3000,
                    'capacity' => 4,
                    'status' => 'available'
                ],
                2 => [
                    'cottage_id' => 2,
                    'cottage_name' => 'Family Villa',
                    'description' => 'Spacious villa perfect for family gatherings. Features air conditioning and private bathroom.',
                    'price_per_day' => 8000,
                    'capacity' => 10,
                    'status' => 'available'
                ],
                3 => [
                    'cottage_id' => 3,
                    'cottage_name' => 'Couple\'s Paradise',
                    'description' => 'Romantic hut for couples with beach front view. Includes king size bed.',
                    'price_per_day' => 5000,
                    'capacity' => 2,
                    'status' => 'available'
                ],
                4 => [
                    'cottage_id' => 4,
                    'cottage_name' => 'Function Hall',
                    'description' => 'Airconditioned grand hall perfect for events, parties, and weddings.',
                    'price_per_day' => 15000,
                    'capacity' => 30,
                    'status' => 'available'
                ],
                5 => [
                    'cottage_id' => 5,
                    'cottage_name' => 'Deluxe Suite',
                    'description' => 'Modern luxury suite with AC, TV, mini bar, and private bathroom.',
                    'price_per_day' => 7000,
                    'capacity' => 2,
                    'status' => 'available'
                ],
                6 => [
                    'cottage_id' => 6,
                    'cottage_name' => 'Premium Beach House',
                    'description' => 'Luxury beach house with direct beach access. Features 2 bedrooms.',
                    'price_per_day' => 12000,
                    'capacity' => 6,
                    'status' => 'available'
                ]
            ]);
        }
        
        if (!session()->has('bookings')) {
            session()->set('bookings', []);
        }
        
        if (!session()->has('next_user_id')) {
            session()->set('next_user_id', 3);
        }
        
        if (!session()->has('next_booking_id')) {
            session()->set('next_booking_id', 1);
        }
    }
    
    public function login($username, $password)
    {
        $this->initData();
        $users = session()->get('users');
        
        foreach ($users as $user) {
            if ($user['username'] == $username && $user['password'] == md5($password)) {
                return $user;
            }
        }
        return null;
    }
    
    public function register($data)
    {
        $this->initData();
        $users = session()->get('users');
        $nextId = session()->get('next_user_id');
        
        $data['user_id'] = $nextId;
        $data['created_at'] = date('Y-m-d H:i:s');
        $users[$nextId] = $data;
        
        session()->set('users', $users);
        session()->set('next_user_id', $nextId + 1);
        
        return true;
    }
    
    public function getAllCottages()
    {
        $this->initData();
        return array_values(session()->get('cottages'));
    }
    
    public function getCottage($id)
    {
        $this->initData();
        $cottages = session()->get('cottages');
        return $cottages[$id] ?? null;
    }
    
    public function createBooking($data)
    {
        $this->initData();
        $bookings = session()->get('bookings');
        $nextId = session()->get('next_booking_id');
        
        $data['booking_id'] = $nextId;
        $data['created_at'] = date('Y-m-d H:i:s');
        $bookings[$nextId] = $data;
        
        session()->set('bookings', $bookings);
        session()->set('next_booking_id', $nextId + 1);
        
        return true;
    }
    
    public function getUserBookings($userId)
    {
        $this->initData();
        $bookings = session()->get('bookings');
        $cottages = session()->get('cottages');
        $result = [];
        
        foreach ($bookings as $booking) {
            if ($booking['user_id'] == $userId) {
                $booking['cottage_name'] = $cottages[$booking['cottage_id']]['cottage_name'];
                $result[] = $booking;
            }
        }
        
        return array_reverse($result);
    }
    
    public function getAllBookings()
    {
        $this->initData();
        $bookings = session()->get('bookings');
        $users = session()->get('users');
        $cottages = session()->get('cottages');
        $result = [];
        
        foreach ($bookings as $booking) {
            $booking['customer_name'] = $users[$booking['user_id']]['full_name'];
            $booking['cottage_name'] = $cottages[$booking['cottage_id']]['cottage_name'];
            $result[] = $booking;
        }
        
        return array_reverse($result);
    }
    
    public function updateBookingStatus($bookingId, $status)
    {
        $this->initData();
        $bookings = session()->get('bookings');
        if (isset($bookings[$bookingId])) {
            $bookings[$bookingId]['status'] = $status;
            session()->set('bookings', $bookings);
            return true;
        }
        return false;
    }
    
    public function deleteBooking($bookingId)
    {
        $this->initData();
        $bookings = session()->get('bookings');
        if (isset($bookings[$bookingId])) {
            unset($bookings[$bookingId]);
            session()->set('bookings', $bookings);
            return true;
        }
        return false;
    }
    
    public function addCottage($data)
    {
        $this->initData();
        $cottages = session()->get('cottages');
        $nextId = count($cottages) + 1;
        $data['cottage_id'] = $nextId;
        $cottages[$nextId] = $data;
        session()->set('cottages', $cottages);
        return true;
    }
    
    public function updateCottage($id, $data)
    {
        $this->initData();
        $cottages = session()->get('cottages');
        if (isset($cottages[$id])) {
            $cottages[$id] = array_merge($cottages[$id], $data);
            session()->set('cottages', $cottages);
            return true;
        }
        return false;
    }
    
    public function deleteCottage($id)
    {
        $this->initData();
        $cottages = session()->get('cottages');
        if (isset($cottages[$id])) {
            unset($cottages[$id]);
            session()->set('cottages', $cottages);
            return true;
        }
        return false;
    }
    
    public function getUserById($userId)
    {
        $this->initData();
        $users = session()->get('users');
        return $users[$userId] ?? null;
    }
    
    public function updateUser($userId, $data)
    {
        $this->initData();
        $users = session()->get('users');
        if (isset($users[$userId])) {
            $users[$userId] = array_merge($users[$userId], $data);
            session()->set('users', $users);
            return true;
        }
        return false;
    }
    
    public function getUserStats($userId)
    {
        $bookings = $this->getUserBookings($userId);
        $stats = [
            'total_bookings' => count($bookings),
            'pending' => 0,
            'confirmed' => 0,
            'completed' => 0
        ];
        
        foreach ($bookings as $booking) {
            if ($booking['status'] == 'pending') $stats['pending']++;
            if ($booking['status'] == 'confirmed') $stats['confirmed']++;
            if ($booking['status'] == 'completed') $stats['completed']++;
        }
        
        return $stats;
    }
    
    public function getAdminStats()
    {
        $this->initData();
        $bookings = session()->get('bookings');
        $cottages = session()->get('cottages');
        $users = session()->get('users');
        
        $total_bookings = count($bookings);
        $pending = 0;
        $confirmed = 0;
        $completed = 0;
        $total_revenue = 0;
        
        foreach ($bookings as $booking) {
            if ($booking['status'] == 'pending') $pending++;
            if ($booking['status'] == 'confirmed') $confirmed++;
            if ($booking['status'] == 'completed') $completed++;
            if ($booking['status'] != 'cancelled') {
                $total_revenue += $booking['total_amount'];
            }
        }
        
        return [
            'total_bookings' => $total_bookings,
            'pending' => $pending,
            'confirmed' => $confirmed,
            'completed' => $completed,
            'total_cottages' => count($cottages),
            'total_customers' => count(array_filter($users, function($u) { return $u['role'] == 'customer'; })),
            'total_revenue' => $total_revenue
        ];
    }
}