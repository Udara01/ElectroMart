<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use CodeIgniter\Controller;

class OrderManageAdmin extends BaseController
{


    public function index() // This function is used to display the list of orders in the admin panel
{
    $orderModel = new OrderModel();
    $orders = $orderModel->findAll();

    $groupedOrders = [];

    foreach ($orders as $order) {
        $status = $order['order_status'] ?? 'Unknown';
        $groupedOrders[$status][] = $order;
    }

    $data = [
        'groupedOrders' => $groupedOrders,
    ];

    echo view('layouts/admin_header');
    echo view('layouts/admin_navbar');
    echo view('admin/order/orders_list', $data);
}



    // This function is used to display the details of a specific order in the admin panel
    public function view($trackingId)
{
    $orderModel = new OrderModel();
    $orderItemModel = new OrderItemModel();

    $order = $orderModel->where('tracking_id', $trackingId)->first();
    if (!$order) {
        return redirect()->to('/admin/orders')->with('error', 'Order not found.');
    }

   
    $items = $orderItemModel->where('order_id', $order['id'])->findAll();

    
    $productModel = new ProductModel(); 
    foreach ($items as &$item) {
        $product = $productModel->find($item['product_id']);
        $item['product_name'] = $product ? $product['name'] : 'Unknown Product';
    }

    echo view('layouts/admin_header');
    echo view('layouts/admin_navbar');
    echo view('admin/order/order_detail', ['order' => $order, 'items' => $items]);

}


    public function update_status($trackingId)
    {
        $orderModel = new OrderModel();
        $newStatus = $this->request->getPost('status');

        $orderModel->where('tracking_id', $trackingId)->set(['order_status' => $newStatus])->update();

        return redirect()->to('/admin/order/' . $trackingId)->with('message', 'Order status updated.');
    }


    public function invoice($trackingId)// This function is used to generate an invoice for a specific order in the admin panel
{
    $orderModel = new OrderModel();
    $orderItemModel = new OrderItemModel();

    $order = $orderModel->where('tracking_id', $trackingId)->first();
    if (!$order) {
        return redirect()->to('/admin/orders')->with('error', 'Order not found.');
    }

    $items = $orderItemModel->where('order_id', $order['id'])->findAll();

    return view('admin/order/invoice', ['order' => $order, 'items' => $items]);
}

}
