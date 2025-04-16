<?php
namespace App\Models;
use CodeIgniter\Model;


class ProductSpaceModel extends Model{

    protected $table = 'product_specs'; // Table name in the database work with the model
    protected $primaryKey = 'id'; // Primary key of the table

    protected $allowedFields = ['product_id', 'spec_key', 'spec_value']; // Fields that can be inserted or updated in the table
}   //this imidiately give uv to acces to the all the crud operations in the table