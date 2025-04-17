<?php

namespace App\Controllers;
use App\Models\CartModel;
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
}