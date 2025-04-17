<?php
namespace App\Models;
use CodeIgniter\Model;


class CartModel extends Model
{
    protected $table = 'user_cart';
    protected $primaryKey = 'id';

    protected $allowedFields = ['user_id', 'product_id', 'quantity', 'created_at'];

}