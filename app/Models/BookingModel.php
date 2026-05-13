<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'booking_id';
    protected $allowedFields = ['user_id', 'cottage_id', 'booking_date', 'start_time', 'end_time', 
                                  'total_hours', 'total_amount', 'status', 'payment_status', 'booking_reference'];
    protected $useTimestamps = true;

    public function createBooking($data)
    {
        $db = \Config\Database::connect();
        return $db->query("INSERT INTO bookings (user_id, cottage_id, booking_date, start_time, end_time, total_hours, total_amount, booking_reference, status) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'pending')",
            [$data['user_id'], $data['cottage_id'], $data['booking_date'], $data['start_time'], 
             $data['end_time'], $data['total_hours'], $data['total_amount'], $data['booking_reference']]);
    }

    public function getUserBookings($user_id, $limit = null)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT b.*, c.cottage_name, c.price_per_hour 
                FROM bookings b 
                JOIN cottages c ON c.cottage_id = b.cottage_id 
                WHERE b.user_id = ? 
                ORDER BY b.created_at DESC";
        
        if ($limit) {
            $sql .= " LIMIT " . (int)$limit;
        }
        
        $query = $db->query($sql, [$user_id]);
        return $query->getResultArray();
    }

    public function getAllBookings($limit = null)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT b.*, c.cottage_name, u.full_name, u.username 
                FROM bookings b 
                JOIN cottages c ON c.cottage_id = b.cottage_id 
                JOIN users u ON u.user_id = b.user_id 
                ORDER BY b.created_at DESC";
        
        if ($limit) {
            $sql .= " LIMIT " . (int)$limit;
        }
        
        $query = $db->query($sql);
        return $query->getResultArray();
    }

    public function updateStatus($id, $status)
    {
        $db = \Config\Database::connect();
        return $db->query("UPDATE bookings SET status = ? WHERE booking_id = ?", [$status, $id]);
    }

    public function countUserBookings($user_id)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT COUNT(*) as count FROM bookings WHERE user_id = ?", [$user_id]);
        $result = $query->getRowArray();
        return $result['count'];
    }

    public function countAllBookings()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT COUNT(*) as count FROM bookings");
        $result = $query->getRowArray();
        return $result['count'];
    }

    public function countPendingBookings()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT COUNT(*) as count FROM bookings WHERE status = 'pending'");
        $result = $query->getRowArray();
        return $result['count'];
    }
}