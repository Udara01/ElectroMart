<?php
namespace App\Models;
use CodeIgniter\Model;

class SpecificationModel extends Model
{
    protected $table = 'specifications';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name'];
}
