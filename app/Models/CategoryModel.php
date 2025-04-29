<?php
namespace App\Models;
use CodeIgniter\Model;


class CategoryModel extends Model{

    protected $table = 'categories'; // Table name in the database work with the model
    protected $primaryKey = 'id'; // Primary key of the table

    protected $allowedFields = ['name']; // Fields that can be inserted or updated in the table
} 

