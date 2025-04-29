<?php
namespace App\Models;
use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id', 'tracking_id', 'name', 'phone', 'address',
        'city', 'postal_code', 'payment_method', 'total_amount', 'order_status', 'created_at', 'updated_at'
    ];
}