<?php
namespace App\Controllers;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\ProductSpaceModel;
use CodeIgniter\Controller;
use Config\View;
use Dompdf\Dompdf;
use Dompdf\Options;

class AdminProducts extends Controller{

    public function category_name(){

        helper(['form', 'url']);

        $categoryModel = new CategoryModel();
        
        //$categories = $categoryModel->findAll();
        //$data = [
       //     'categories' => $categories
        //];
        $data['categories'] = $categoryModel->findAll(); // Assign to $data array
    
        return view('admin/products/add_product', $data);
        //return view('admin/products/category_name', $data);
    }

/*    public function add_product(){
        helper(['form', 'url']); //load the form and url helpers

        $productModel = new ProductModel(); //create an instance of the product model
        $categoryModel = new CategoryModel(); //create an instance of the category model

        $category_id = $this->request->getPost('category'); //get the category id from the request
        $category = $categoryModel->find($category_id); //get the full category object from the database

        if (!$category) {
            return redirect()->back()->with('error', 'Invalid category selected.');
        }
        
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
            'image' => $newName, //set the image name to the new name
            'category_name' => $category['name'], //get the category name from the category object
            'created_at' => date('Y-m-d H:i:s'),
            'category_id' => $category['id'] //get the category id from the category object
        ];

        //insert the data into the database
        $productModel->save($data); //insert the data into the database or we can use the save method as well

        //redirect to the admin page
        return redirect()->to('/adminp')->with('message', 'Product added successfully!'); //redirect to the admin page
        //return view('admin/products/add_product', $data);


    }
*/
    public function add_product(){
        helper(['form', 'url']);
    
        $productModel = new ProductModel();
        $categoryModel = new CategoryModel();
        $productSpaceModel = new ProductSpaceModel(); // Add this
    
        $category_id = $this->request->getPost('category');
        $category = $categoryModel->find($category_id);
    
        if (!$category) {
            return redirect()->back()->with('error', 'Invalid category selected.');
        }
    
        // Handle image upload
        $image = $this->request->getFile('image');
        $newName = null;
        if ($image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move('uploads/', $newName);
        }
    
        // Product data
        $productData = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'image' => $newName,
            'category_name' => $category['name'],
            'created_at' => date('Y-m-d H:i:s'),
            'category_id' => $category['id']
        ];
    
        // Save product
        $productModel->save($productData);
    
        // Get the inserted product ID
        $productId = $productModel->getInsertID();
    
        // Get product spaces
        $categorySpaces = $this->request->getPost('category_spaces');
    
        if (is_array($categorySpaces)) {
            foreach ($categorySpaces as $key => $value) {
                $productSpaceData =[
                    'product_id' => $productId,
                    'spec_key' => $key,
                    'spec_value' => $value
                ];
                $productSpaceModel->save($productSpaceData); // Save each product space
            }
        }
 

    
        return redirect()->to('/manageProducts')->with('message', 'Product and specs added successfully!');
    }
    
/*
    public function product_list(){
        $productModel = new ProductModel(); //create an instance of the product model
        //$categoryModel = new CategoryModel(); //create an instance of the category model
        $productSpaceModel = new ProductSpaceModel(); //create an instance of the product space model

        //$product_data['products'] = $productModel->findAll(); //get all the products from the database
        //$data['categories'] = $categoryModel->findAll(); //get all the categories from the database
        //$space_data['product_spaces'] = $productSpaceModel->findAll(); //get all the product spaces from the database


        $data = [
            'products' => $productModel->findAll(),
            'product_spaces' => $productSpaceModel->findAll()
        ];
        
        echo view('layouts/header');
        echo view('admin/products/product_list', $data);
        
    }*/

    public function product_list()
{
    $productModel = new ProductModel();
    $productSpaceModel = new ProductSpaceModel();
    $categoryModel = new CategoryModel();

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

    echo view('layouts/header');
    echo view('admin/products/product_list', $data);
}

    public function download_pdf() {
        $productModel = new ProductModel();
        $productSpaceModel = new ProductSpaceModel();
    
        $data = [
            'products' => $productModel->findAll(),
            'product_spaces' => $productSpaceModel->findAll()
        ]; 
    
        // Load HTML view as string
        $html = view('admin/products/pdf_template', $data); // We'll create this view below
      
        // Setup dompdf
        $options = new Options();
        $options->set('isRemoteEnabled', true); // Allow images
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
    
        // Output to browser (force download)
        $dompdf->stream("products.pdf", ["Attachment" => true]);
    }



        public function get_product_details($id)
        {
            $productModel = new \App\Models\ProductModel(); // adjust if needed
            $product = $productModel->find($id);

            if ($product) {
                return $this->response->setJSON($product);
            } else {
                return $this->response->setStatusCode(404)->setJSON(['error' => 'Product not found']);
            }
        }

        public function update_product()
        {
            $productModel = new \App\Models\ProductModel();
            $id = $this->request->getPost('product_id');  

            $data = [
                'name'        => $this->request->getPost('name'),
                'price'       => $this->request->getPost('price'),
                'description' => $this->request->getPost('description'),
            ];

            if ($productModel->update($id, $data)) {
                return redirect()->back()->with('message', 'Product updated successfully!');
            } else {
                return redirect()->back()->with('error', 'Update failed');
            }
        }

        public function delete_product()
        {
            $productModel = new \App\Models\ProductModel();
            $productId = $this->request->getPost('product_id');
        
            $db = \Config\Database::connect();
        
            try {
                // Start Transaction
                $db->transStart();
        
                // Delete related records
                $db->table('product_sales')->where('product_id', $productId)->delete();
                $db->table('product_specs')->where('product_id', $productId)->delete(); // Make sure this is correct
                $db->table('user_cart')->where('product_id', $productId)->delete();
        
                // Delete the product itself
                $productModel->delete($productId);
        
                // Complete transaction
                $db->transComplete();
        
                if ($db->transStatus() === false) {
                    return redirect()->back()->with('error', 'Failed to delete product due to a database error.');
                }
        
                return redirect()->back()->with('message', 'Product deleted successfully.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An unexpected error occurred: ' . $e->getMessage());
            }
        }
        

} 

