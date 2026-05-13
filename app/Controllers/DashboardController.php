<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $user_id = session()->get('user_id');
        
        // Get stats
        $stats = $db->query("SELECT 
            COUNT(*) as total_bookings,
            SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending_bookings,
            SUM(CASE WHEN status = 'confirmed' THEN 1 ELSE 0 END) as confirmed_bookings,
            SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed_bookings
            FROM bookings WHERE user_id = ?", [$user_id])->getRowArray();
        
        // Get recent bookings
        $recent = $db->query("SELECT b.*, c.cottage_name FROM bookings b 
            JOIN cottages c ON b.cottage_id = c.cottage_id 
            WHERE b.user_id = ? ORDER BY b.created_at DESC LIMIT 5", [$user_id])->getResultArray();
        
        $data = [
            'stats' => $stats ?? ['total_bookings' => 0, 'pending_bookings' => 0, 'confirmed_bookings' => 0, 'completed_bookings' => 0],
            'recent' => $recent
        ];
        
        return view('layout/header', ['title' => 'Dashboard'])
             . view('layout/sidebar')
             . view('dashboard/index', $data)
             . view('layout/footer');
    }
}