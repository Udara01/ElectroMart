<?php

namespace App\Models;
use CodeIgniter\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $allowedFields = ['id', 'name', 'category_id', 'price', 'image'];

    public function getFilteredProducts($filters = [])
    {
        $builder = $this->select('products.*, categories.name as category_name')
                        ->join('categories', 'categories.id = products.category_id');

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

    public function getAllCategories()
    {
        return $this->db->table('categories')->get()->getResultArray();
    }
}
