<?php

namespace App\Controllers;
use App\Models\ProductSalesModel;
use App\Models\ProductModel;
use App\Models\ProductSpaceModel;
use App\Models\CategoryModel;
use App\Models\Product;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
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
    
    
   /* public function my_orders()
    {
        $userId = session()->get('user_id');
        $orderModel = new OrderModel();

        $orders = $orderModel->where('user_id', $userId)->orderBy('created_at', 'DESC')->findAll();

        echo view('layouts/header');
        echo view('layouts/navbar');
        echo view('Order/my_orders', ['orders' => $orders]);
        echo view('layouts/footer');
    }*/

    public function my_orders()
{
    $userId = session()->get('user_id');
    $orderModel = new OrderModel();
    $orderItemModel = new OrderItemModel();
    $productModel = new ProductModel();

    $orders = $orderModel->where('user_id', $userId)->orderBy('created_at', 'DESC')->findAll();

    foreach ($orders as &$order) {
        $orderItems = $orderItemModel->where('order_id', $order['id'])->findAll();
        $productNames = [];

        foreach ($orderItems as $item) {
            $product = $productModel->find($item['product_id']);
            if ($product) {
                $productNames[] = $product['name'];
            }
        }

        $order['product_names'] = implode(', ', $productNames); // Store product names as a string
    }

    echo view('layouts/header');
    echo view('layouts/navbar');
    echo view('Order/my_orders', ['orders' => $orders]);
    echo view('layouts/footer');
}


    public function order_detail($trackingId)
    {
        $orderModel = new OrderModel();
        $orderItemModel = new OrderItemModel();
        $productModel = new ProductModel(); // Load ProductModel
    
        $order = $orderModel->where('tracking_id', $trackingId)->first();
        if (!$order) {
            return redirect()->to('/my-orders')->with('error', 'Order not found.');
        }
    
        $items = $orderItemModel->where('order_id', $order['id'])->findAll();
    
        // Fetch product names and attach them to each item
        foreach ($items as &$item) {
            $product = $productModel->find($item['product_id']);
            $item['product_name'] = $product ? $product['name'] : 'Unknown Product';
        }
    
        echo view('layouts/header');
        echo view('layouts/navbar');
        echo view('Order/order_detail', ['order' => $order, 'items' => $items]);
        echo view('layouts/footer');
    }
    



    public function track_order()
    {
        echo view('layouts/header');
        echo view('layouts/navbar');
        echo view('Order/track_order');
        echo view('layouts/footer');
    }


    public function track_order_result()
    {
        $trackingId = $this->request->getPost('tracking_id');
        $orderModel = new OrderModel();

        $order = $orderModel->where('tracking_id', $trackingId)->first();

        echo view('layouts/header');
        echo view('layouts/navbar');
        echo view('Order/track_order_result', ['order' => $order]);
        echo view('layouts/footer');
    }

}
