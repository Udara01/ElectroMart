<?php

namespace App\Controllers;
use App\Models\CartModel;
use App\Models\ProductModel;
use CodeIgniter\Controller;


class Cart extends BaseController

{ 
    public function add_cart()
    {

        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to(base_url('login'))->with('error', 'Please log in to add items to your cart.');
        }

        $userId = $session->get('user_id');
        $productId = $this->request->getPost('product_id');

        $cartModel = new CartModel();

        // Check if this product is already in the cart
        $existing = $cartModel->where(['user_id' => $userId, 'product_id' => $productId])->first();

        if ($existing) {
            // Update quantity
            $cartModel->update($existing['id'], [
                'quantity' => $existing['quantity'] + 1
            ]);
        } else {
            // Insert new cart item
            $cartModel->insert([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => 1
            ]);
        }

        return redirect()->back()->with('success', 'Item added to cart!');
        return redirect()->to('/manageProducts')->with('message', 'Product and specs added successfully!');
    }


    public function view_cart()
    {
        $userId = session()->get('user_id');

        $cartModel = new CartModel();
        $productModel = new ProductModel();

        $cartItems = $cartModel->where('user_id', $userId)->findAll();

        $cartDetails = [];
        foreach ($cartItems as $item) {
            $product = $productModel->find($item['product_id']);
            if ($product) {
                $cartDetails[] = [
                    'id' => $item['id'],
                    'product_id' => $product['id'],
                    'name' => $product['name'],
                    'image' => $product['image'],
                    'price' => $product['price'],
                    'quantity' => $item['quantity'],
                    'total' => $product['price'] * $item['quantity'],
                ];
            }
        }

        echo view('layouts/header');
        echo view('layouts/navbar');
        echo view('components/user_cart', ['cartItems' => $cartDetails]);
        echo view('layouts/footer');
    }


    public function remove($id)
        {
            $userId = session()->get('user_id');
            $cartModel = new \App\Models\CartModel();

            $item = $cartModel->find($id);
            if ($item && $item['user_id'] == $userId) {
                $cartModel->delete($id);
                return redirect()->to('/cart')->with('message', 'Item removed successfully.');
            }

            return redirect()->to('/cart')->with('error', 'Invalid action.');
        }


        public function checkout()
{
    $userId = session()->get('user_id');
    $selectedItems = $this->request->getPost('selected_items');

    if (empty($selectedItems)) {
        return redirect()->to('/cart')->with('error', 'No items selected.');
    }

    $cartModel = new \App\Models\CartModel();
    $productModel = new \App\Models\ProductModel();

    $cartDetails = [];
    foreach ($selectedItems as $cartItemId) {
        $cartItem = $cartModel->find($cartItemId);
        if (!$cartItem || $cartItem['user_id'] != $userId) {
            continue;
        }

        $product = $productModel->find($cartItem['product_id']);
        if ($product) {
            $cartDetails[] = [
                'id' => $cartItem['id'],
                'product_id' => $product['id'],
                'name' => $product['name'],
                'quantity' => $cartItem['quantity'],
                'price' => $product['price'],
                'total' => $product['price'] * $cartItem['quantity'],
            ];
        }
    }

    if (empty($cartDetails)) {
        return redirect()->to('/cart')->with('error', 'Invalid cart items selected.');
    }

    echo view('layouts/header');
    echo view('layouts/navbar');
    echo view('components/checkout', [
        'selectedItems' => $cartDetails,
        'selectedCartIds' => array_column($cartDetails, 'id')
    ]);
    echo view('layouts/footer');
}

public function place_order()
{
    $session = session();
    $userId = $session->get('user_id');

    $name = $this->request->getPost('name');
    $phone = $this->request->getPost('phone');
    $address = $this->request->getPost('address');
    $city = $this->request->getPost('city');
    $postalCode = $this->request->getPost('postal_code');
    $paymentMethod = $this->request->getPost('payment_method');
    $selectedItems = $this->request->getPost('selected_items');

    $cartModel = new \App\Models\CartModel();
    $productModel = new \App\Models\ProductModel();
    $orderModel = new \App\Models\OrderModel();
    $orderItemModel = new \App\Models\OrderItemModel();

    $totalAmount = 0;
    $orderItems = [];

    foreach ($selectedItems as $cartItemId) {
        $cartItem = $cartModel->find($cartItemId);
        if (!$cartItem || $cartItem['user_id'] != $userId) {
            continue;
        }

        $product = $productModel->find($cartItem['product_id']);
        if (!$product) {
            continue;
        }

        $subtotal = $product['price'] * $cartItem['quantity'];
        $totalAmount += $subtotal;

        $orderItems[] = [
            'product_id' => $product['id'],
            'name' => $product['name'],
            'quantity' => $cartItem['quantity'],
            'price' => $product['price'],
            'subtotal' => $subtotal
        ];
    }

    if (empty($orderItems)) {
        return redirect()->to('/cart')->with('error', 'No valid items.');
    }

    $trackingId = strtoupper(uniqid('TRACK'));

    // Save order
    $orderData = [
        'user_id' => $userId,
        'name' => $name,
        'phone' => $phone,
        'address' => $address,
        'city' => $city,
        'postal_code' => $postalCode,
        'tracking_id' => $trackingId,
        'payment_method' => $paymentMethod,
        'total_amount' => $totalAmount,
        'created_at' => date('Y-m-d H:i:s'),
        
    ];

    $orderId = $orderModel->insert($orderData);

    // Save order items
    foreach ($orderItems as &$item) {
        $item['order_id'] = $orderId;
    }
    $orderItemModel->insertBatch($orderItems);

    // Delete purchased items from cart
    $cartModel->whereIn('id', $selectedItems)->delete();

    return redirect()->to('/order-success/' . $trackingId);
}
public function order_success($trackingId)
{
    $orderModel = new \App\Models\OrderModel();

    // Find the order by tracking ID
    $order = $orderModel->where('tracking_id', $trackingId)->first();

    if (!$order) {
        return redirect()->to('/cart')->with('error', 'Invalid order tracking ID.');
    }

    echo view('layouts/header');
    echo view('layouts/navbar');
    echo view('components/order_success', ['order' => $order]);
    echo view('layouts/footer');
}

}