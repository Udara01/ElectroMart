<?php
namespace App\Models;
use CodeIgniter\Model;
use CodeIgniter\I18n\Time; 


class UserAccountModel extends Model{

    protected $table = 'users'; // Table name in the database work with the model
    protected $primaryKey = 'id'; // Primary key of the table

    protected $allowedFields = ['username', 'email', 'password', 'created_at']; 
}
?>