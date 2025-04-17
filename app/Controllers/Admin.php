<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\Controller;

class Admin extends BaseController
{
    public function index()
    {   
        //echo view('layouts/header');
        //echo session()->getFlashdata('message') ? '<p style="color: green;">'.session()->getFlashdata('message').'</p>' : '';
        //echo view('admin/add_product');

        return view('admin/landing');

    }

    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Example hardcoded login - replace with DB check later
        if ($email === 'admin@example.com' && $password === 'admin123') {
            session()->set('isAdminLoggedIn', true);
            return redirect()->to('/manageProducts')->with('message', 'Login successful!');

        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin');
    }


// This function is used to add a product to the database
// It gets the data from the form and saves it to the database using the ProductModel
    public function add_product(){
        $productModel = new ProductModel(); //create an instance of the product model
        //$productModel = model('ProductModel');  // Instead of new ProductModel()


        //get the image from the request
        $image = $this->request->getFile('image'); //get the image from the request


        if ($image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName(); // random name for file
            $image->move('uploads/', $newName); // save in public/uploads
        } else {
            $newName = null;
        }

        //get the data from the request
        $data = [
            'name' => $this->request->getPost('name'), //get the name from the request
            'description' => $this->request->getPost('description'), //get the description from the request
            'price' => $this->request->getPost('price'), //get the price from the request
            'image' => $newName //set the image name to the new name
        ];

        //insert the data into the database
        $productModel->save($data); //insert the data into the database or we can use the save method as well

        //redirect to the admin page
        return redirect()->to('/admin')->with('message', 'Product added successfully!'); //redirect to the admin page

    }


    public function product_list(){
        $productModel = new ProductModel(); //create an instance of the product model
        $data['products'] = $productModel->findAll(); //get all the products from the database

        echo view('layouts/header');
        echo view('admin/product_list', $data); //pass the data to the view
    }


}
       