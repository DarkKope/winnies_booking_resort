<?php

namespace App\Controllers;

class CottagesController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $cottages = $db->query("SELECT * FROM cottages WHERE status = 'available' ORDER BY price_per_day ASC")->getResultArray();
        
        return view('layout/header', ['title' => 'Cottages'])
             . view('layout/sidebar')
             . view('cottages/index', ['cottages' => $cottages])
             . view('layout/footer');
    }
    
    public function view($id)
    {
        $db = \Config\Database::connect();
        $cottage = $db->query("SELECT * FROM cottages WHERE cottage_id = ?", [$id])->getRowArray();
        
        if (!$cottage) {
            session()->setFlashdata('error', 'Cottage not found');
            return redirect()->to('/cottages');
        }
        
        return view('layout/header', ['title' => $cottage['cottage_name']])
             . view('layout/sidebar')
             . view('cottages/view', ['cottage' => $cottage])
             . view('layout/footer');
    }
}