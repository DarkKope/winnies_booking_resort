<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $users = $db->query("SELECT user_id, username, email, full_name, phone, role, created_at FROM users ORDER BY user_id DESC")->getResultArray();
        
        $data = [
            'title' => 'Manage Users',
            'users' => $users
        ];
        
        return view('admin/layout/header', $data)
             . view('admin/users/index', $data)
             . view('admin/layout/footer');
    }
}