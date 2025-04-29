<?php

namespace App\Controllers;
use App\Models\SpecificationModel;
use App\Models\CategoryModel;
use App\Models\CategorySpecificationModel;
use CodeIgniter\Controller;

class Specification extends Controller
{
    public function viewAddSpecification()
    {
        return view('admin/products/add_specification');
    }

    public function addSpecification()
    {
        $specificationModel = new SpecificationModel();

        $specName = $this->request->getPost('specification_name');

        $data = [
            'name' => $specName,
        ];

        $specificationModel->save($data);

        return redirect()->to('/manageProducts')->with('success', 'Specification added successfully!');
    }

    public function viewAssignSpecifications()
    {
        $categoryModel = new CategoryModel();
        $specificationModel = new SpecificationModel();

        $categories = $categoryModel->findAll();
        $specifications = $specificationModel->findAll();

        return view('admin/products/assign_specifications', [
            'categories' => $categories,
            'specifications' => $specifications,
        ]);
    }

    public function assignSpecifications()
    {
        $categoryId = $this->request->getPost('category_id');
        $specifications = $this->request->getPost('specifications'); // array of specification IDs

        $categorySpecModel = new CategorySpecificationModel();

        // First delete previous assigned specifications for clean re-assigning
        $categorySpecModel->where('category_id', $categoryId)->delete();

        // Insert new assignments
        if (!empty($specifications)) {
            foreach ($specifications as $specificationId) {
                $categorySpecModel->insert([
                    'category_id' => $categoryId,
                    'specification_id' => $specificationId,
                ]);
            }
        }

        return redirect()->to('/manageProducts')->with('success', 'Specifications assigned successfully!');
    }

    public function addCategoryAjax()
{
    $categoryModel = new \App\Models\CategoryModel();
    $data = $this->request->getJSON(true);
    $categoryModel->save(['name' => $data['category_name']]);
    return $this->response->setJSON(['status' => 'success']);
}

public function addSpecificationAjax()
{
    $specModel = new \App\Models\SpecificationModel();
    $data = $this->request->getJSON(true);
    $specModel->save(['name' => $data['specification_name']]);
    return $this->response->setJSON(['status' => 'success']);
}
public function manageCategorySpecifications()
{
    $categoryModel = new CategoryModel();
    $specModel = new SpecificationModel();

    $data['categories'] = $categoryModel->findAll();
    $data['specifications'] = $specModel->findAll();

    return view('admin/products/manage_category_specifications', $data);
}
}
