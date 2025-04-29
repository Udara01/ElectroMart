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
            $query = $db->query('SELECT 1'); // simple query to test the connection
            if ($query) {
                echo "Database Connected Successfully!";
            } else {
                echo "Failed to Connect Database.";
            }
        } catch (\Exception $e) {
            echo "Connection Error: " . $e->getMessage();
        }
    }
}
