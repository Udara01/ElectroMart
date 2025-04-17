<?php

namespace App\Controllers;
use App\Models\ProductSalesModel;
use App\Models\ProductModel;
use App\Models\ProductSpaceModel;
use App\Models\CategoryModel;
use App\Models\Product;
use Dompdf\Dompdf;
use Dompdf\Options;

class OrderController extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }


    // This function updates the sold quantity when orders are placed
    public function quantity_sold($cartItems = [])
    {
        $productSalesModel = new ProductSalesModel();

        foreach ($cartItems as $item) {
            $existing = $productSalesModel->where('product_id', $item['product_id'])->first();

            if ($existing) {
                $productSalesModel->update($existing['id'], [
                    'quantity_sold' => $existing['quantity_sold'] + $item['quantity']
                ]);
            } else {
                $productSalesModel->insert([
                    'product_id' => $item['product_id'],
                    'quantity_sold' => $item['quantity']
                ]);
            }
        }

        return true; // Or redirect to a confirmation page
    }

    public function showTopSelling()
    {
        $productModel = new ProductModel();
        $productSpaceModel = new ProductSpaceModel();
        $categoryModel = new CategoryModel();
    
        $topSelling = $productModel->getTopSelling();
        $newProducts = $productModel->getNewProducts();
    
        // Attach specs to all topSelling products
        foreach ($topSelling as $product) {
            $product['specs'] = $productSpaceModel->where('product_id', $product['id'])->findAll();
        }
    
        // Attach specs to all new products
        foreach ($newProducts as &$product) {
            $product['specs'] = $productSpaceModel->where('product_id', $product['id'])->findAll();
        }
        
    
        $data = [
            'topSelling' => $topSelling,
            'newProducts' => $newProducts,
            'products' => $productModel->getFilteredProducts(),
            'product_spaces' => $productSpaceModel->findAll(),
            'categories' => $categoryModel->findAll(),
        ];
    
        return view('components/cart', $data);
    }
    
    


}
