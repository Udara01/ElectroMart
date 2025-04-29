<?php
namespace App\Models;
use CodeIgniter\Model;

class CategorySpecificationModel extends Model
{
    protected $table = 'category_specifications';
    protected $primaryKey = 'id';
    protected $allowedFields = ['category_id', 'specification_id'];
}
