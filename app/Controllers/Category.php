<?php

namespace App\Controllers;
use App\Models\CategoryModel;
use CodeIgniter\Controller;



class Category extends Controller{


    public function ViewCategory(){

        return view('admin/add_category'); 
    }
    public function AddCategory(){

        $categoryModel = new CategoryModel(); 

        $categoryName = $this->request->getPost('category_name'); //get the category name from the request
        $data = [
            'name' => $categoryName, 
        ];

        $categoryModel->save($data); 

        return redirect()->to('/manageProducts')->with('success', 'Category added successfully!');
    }
}