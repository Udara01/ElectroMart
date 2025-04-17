<?php
namespace App\Models;
use CodeIgniter\Model;

class ProductSalesModel extends Model {
    protected $table = 'product_sales';
    protected $primaryKey = 'id';
    protected $allowedFields = ['product_id', 'quantity_sold'];
}
