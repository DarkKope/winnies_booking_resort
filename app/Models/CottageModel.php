<?php

namespace App\Models;

use CodeIgniter\Model;

class CottageModel extends Model
{
    protected $table = 'cottages';
    protected $primaryKey = 'cottage_id';
    protected $allowedFields = ['cottage_name', 'description', 'price_per_hour', 'capacity', 'image', 'status'];
    protected $useTimestamps = true;

    public function getAllCottages()
    {
        return $this->orderBy('cottage_id', 'DESC')->findAll();
    }

    public function getCottage($id)
    {
        return $this->find($id);
    }

    public function addCottage($data)
    {
        return $this->insert($data);
    }

    public function updateCottage($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteCottage($id)
    {
        return $this->delete($id);
    }

    public function countAll()
    {
        return $this->countAllResults();
    }
}