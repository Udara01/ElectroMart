<?php

namespace App\Controllers;

class Pages extends BaseController
{
    /*public function index(): string
    {   
        $meta_data = [
            'title' => 'Home',
            'description' => 'Welcome to our website!'
        ];

        $productModel = new \App\Models\ProductModel();
        $data = array_merge($meta_data, [
            'topSelling' => $productModel->getTopSelling(),
            'newProducts' => $productModel->getNewProducts()
        ]);
        

        return view('home', array_merge($meta_data, $data));
    }*/
    public function index(): string
        {   
            $meta_data = [
                'title' => 'Home',
                'description' => 'Welcome to our website!'
            ];

            $productModel = new \App\Models\ProductModel();
            $productSpaceModel = new \App\Models\ProductSpaceModel();
            $categoryModel = new \App\Models\CategoryModel();

            // Get products
            $topSelling = $productModel->getTopSelling();
            $newProducts = $productModel->getNewProducts();

            // Attach specs to products
            foreach ($topSelling as &$product) {
                $product['specs'] = $productSpaceModel->where('product_id', $product['id'])->findAll();
            }

            foreach ($newProducts as &$product) {
                $product['specs'] = $productSpaceModel->where('product_id', $product['id'])->findAll();
            }

            $data = array_merge($meta_data, [
                'topSelling' => $topSelling,
                'newProducts' => $newProducts,
                'products' => $productModel->getFilteredProducts(),
                'product_spaces' => $productSpaceModel->findAll(),
                'categories' => $categoryModel->findAll(),
            ]);

            return view('home', $data);
        }


    public function login(): string{

        $meta_data = [
            'title' => 'Login',
            'description' => 'Login to your account'
        ];

        return view('auth/login', $meta_data);
    }

    public function register(): string{

        $meta_data = [
            'title' => 'Register',
            'description' => 'Create a new account'
        ];

        return view('auth/register', $meta_data);
    }

    public function catalog(): string{
        
        return view('pages/shop');
    }

    /*public function manageProducts(): string{
        $categoryModel = new \App\Models\CategoryModel(); // Make sure this is the correct model
        $categories = $categoryModel->findAll(); // Get all categories

        $productModel = new \App\Models\ProductModel();
        $productSpaceModel = new \App\Models\ProductSpaceModel();
    
        $filters = [
            'department' => $this->request->getGet('department'),
            'price' => $this->request->getGet('price')
        ];
    
        $data = [
            'products' => $productModel->getFilteredProducts($filters),
            'product_spaces' => $productSpaceModel->findAll(),
            'categories' => $categoryModel->findAll(),
            'filters' => $filters
        ];

        return view('admin/products/manage_products', [
            'categories' => $categories,
            'products' => $data['products'],
            'product_spaces' => $data['product_spaces'],
        ]);
    }*/

    public function manageProducts(): string
{
    $categoryModel = new \App\Models\CategoryModel();
    $productModel = new \App\Models\ProductModel();
    $productSpaceModel = new \App\Models\ProductSpaceModel();

    $filters = [
        'department' => $this->request->getGet('department'),
        'price' => $this->request->getGet('price')
    ];

    $filteredProducts = $productModel->getFilteredProducts($filters);
    $allProducts = $productModel->findAll(); // Used for update dropdown

    return view('admin/products/manage_products', [
        'categories' => $categoryModel->findAll(),
        'products' => $filteredProducts,          // Displayed products (filtered)
        'allProducts' => $allProducts,            // For dropdowns like update form
        'product_spaces' => $productSpaceModel->findAll(),
        'filters' => $filters
    ]);
}

}
