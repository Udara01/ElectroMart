<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use Config\Database;

class TestDB extends Controller
{
    public function index()
    {
        try {
            $db = Database::connect();
            if ($db->connID) {
                echo "✅ Database connected successfully!";
            } else {
                echo "❌ Failed to connect to the database.";
            }
        } catch (\Exception $e) {
            echo "❌ Database error: " . $e->getMessage();
        }
    }
}
