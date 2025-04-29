<?php
namespace App\Models;
use CodeIgniter\Model;

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

        // Method to get the top-selling products
        //Check product sales count is greater than the minimum sales count
        public function getTopSelling($limit = 8, $minSales = 10)
        {
            return $this->select('products.*, product_sales.quantity_sold')
                ->join('product_sales', 'product_sales.product_id = products.id')
                ->where('product_sales.quantity_sold >=', $minSales)
                ->orderBy('product_sales.quantity_sold', 'DESC')
                ->limit($limit)
                ->findAll();
        }

        // Method to get the latest products
        public function getNewProducts($limit = 8)
            {
                return $this->orderBy('created_at', 'DESC')->limit($limit)->findAll();
            }

}

