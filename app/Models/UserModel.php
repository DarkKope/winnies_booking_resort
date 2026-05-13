<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['username', 'password', 'email', 'full_name', 'phone', 'role'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = false;
    protected $skipValidation = true;

    public function login($username, $password)
    {
        return $this->where('username', $username)
                    ->where('password', $password)
                    ->first();
    }

    public function register($data)
    {
        return $this->insert($data);
    }

    public function countAll()
    {
        return $this->countAllResults();
    }
    
    // Fix for bind error - use simple query
    public function getUserByUsername($username)
    {
        $builder = $this->db->table('users');
        $builder->where('username', $username);
        $query = $builder->get();
        return $query->getRowArray();
    }
    
    public function getUserByEmail($email)
    {
        $builder = $this->db->table('users');
        $builder->where('email', $email);
        $query = $builder->get();
        return $query->getRowArray();
    }
}