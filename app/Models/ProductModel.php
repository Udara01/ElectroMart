<?php
namespace App\Models;
use CodeIgniter\Model;

/*class ProductModel extends Model{

    protected $table = 'products'; // Table name in the database work with the model
    protected $primaryKey = 'id'; // Primary key of the table

    protected $allowedFields = ['name', 'description', 'price', 'image']; // Fields that can be inserted or updated in the table
}   //this imidiately give uv to acces to the all the crud operations in the table


*/
/*
class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'name',
        'description',
        'price',
        'image',
        'category_name',
        'created_at',
        'category_id'
    ];

    //protected $useTimestamps = true;
    //protected $createdField  = 'created_at';
}
*/
// app/Models/ProductModel.php
class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'name', 'description', 'price', 'image',
        'category_name', 'created_at', 'category_id'
    ];

    public function getFilteredProducts($filters = [])
    {
        $builder = $this->select('products.*, categories.name as category_name')
                        ->join('categories', 'categories.id = products.category_id', 'left');

        if (!empty($filters['department']) && $filters['department'] !== 'all') {
            $builder->where('products.category_id', $filters['department']);
        }

        if (!empty($filters['price'])) {
            switch ($filters['price']) {
                case '1': $builder->where('products.price <', 25); break;
                case '2': $builder->where('products.price <', 50); break;
                case '3': $builder->where('products.price <', 100); break;
                case '4': $builder->where('products.price <', 200); break;
                case '5': $builder->where('products.price >=', 200); break;
            }
        }

        return $builder->findAll();
    }
}
