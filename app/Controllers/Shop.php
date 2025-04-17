<?php
namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\ProductSpaceModel;

class Shop extends BaseController
{
    private function getCategorySpecs($category_name) {
        $map = [
            'Laptops' => ['Brand', 'Model', 'Processor', 'RAM', 'Storage', 'Graphics Card', 'Screen Size'],
            "PC's" => ['Brand', 'Model', 'Processor', 'RAM', 'Storage', 'Graphics Card', 'Motherboard'],
            'Smartphones' => ['Brand', 'Model', 'Processor', 'RAM', 'Storage', 'Camera', 'Battery'],
        ];
        return $map[$category_name] ?? [];
    }

    public function product_list()
    {
        $productModel = new ProductModel();
        $productSpaceModel = new ProductSpaceModel();
        $categoryModel = new CategoryModel();

        $filters = $this->request->getGet();

        // Get all categories
        $categories = $categoryModel->findAll();
        $selectedCategory = null;

        // Identify selected category name
        foreach ($categories as $cat) {
            if ($cat['id'] == ($filters['department'] ?? null)) {
                $selectedCategory = $cat['name'];
                break;
            }
        }

        // Load specs only for selected category
        $relevantSpecs = $this->getCategorySpecs($selectedCategory);
        $allSpecs = $productSpaceModel->findAll();

        // Group unique spec values
        $specValues = [];
        foreach ($relevantSpecs as $specKey) {
            $specValues[$specKey] = [];
            foreach ($allSpecs as $spec) {
                if (strtolower($spec['spec_key']) == strtolower($specKey)) {
                    $specValues[$specKey][] = $spec['spec_value'];
                }
            }
            $specValues[$specKey] = array_unique($specValues[$specKey]);
        }

        // Filter products
        $products = $productModel->getFilteredProducts($filters);

        // Further filter by spec key/values
        $filtered = [];
        foreach ($products as $product) {
            $match = true;
            foreach ($filters as $key => $val) {
                if (!in_array($key, ['department', 'price']) && $val !== '') {
                    $matchSpec = false;
                    foreach ($allSpecs as $spec) {
                        if (
                            $spec['product_id'] == $product['id'] &&
                            strtolower($spec['spec_key']) == strtolower($key) &&
                            strtolower($spec['spec_value']) == strtolower($val)
                        ) {
                            $matchSpec = true;
                            break;
                        }
                    }
                    if (!$matchSpec) {
                        $match = false;
                        break;
                    }
                }
            }
            if ($match) {
                $filtered[] = $product;
            }
        }

        $data = [
            'products' => $filtered,
            'product_spaces' => $allSpecs,
            'categories' => $categories,
            'filters' => $filters,
            'specOptions' => $specValues
        ];

        echo view('layouts/header');
        echo View('layouts/navbar');
        echo view('pages/shop', $data);
    }
}
