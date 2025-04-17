<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Add Product</h4>
        </div>
        <div class="card-body">
            <form action="<?= site_url('admin/add_product') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <!-- Product Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <!-- Product Category -->
                <div class="mb-3">
                    <label for="categorySelect" class="form-label">Product Category</label>
                    <select name="category" id="categorySelect" class="form-select" required>
                        <option value="">-- Select Category --</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= esc($category['id']) ?>">
                                <?= esc($category['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Dynamic Specs Area -->
                <div class="mb-3">
                    <label class="form-label">Category Specs</label>
                    <div id="categorySpacesContainer" class="row g-2">
                        <!-- JavaScript will populate based on category -->
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" name="description" id="description" class="form-control" required>
                </div>

                <!-- Price -->
                <div class="mb-3">
                    <label for="price" class="form-label">Price (LKR)</label>
                    <input type="number" name="price" id="price" class="form-control" step="0.01" required>
                </div>

                <!-- Image Upload -->
                <div class="mb-4">
                    <label for="image" class="form-label">Product Image</label>
                    <input type="file" name="image" id="image" class="form-control" required>
                </div>

                <!-- Submit -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary px-4">Save Product</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    
   /* document.getElementById('categorySelect').addEventListener('change', function(){
        var $selectedCategory = this.value; //this refers to the select element

        let categorySpaces = [];

        if($selectedCategory === 'Laptops') {
            alert('You selected Laptops!');
            categorySpaces = ['Brand', 'Model', 'Processor', 'RAM', 'Storage', 'Graphics Card', 'Screen Size'];

        } else if ($selectedCategory === 'PC') {
            alert('You selected PC!');
            categorySpaces = ['Brand', 'Model', 'Processor', 'RAM', 'Storage', 'Graphics Card', 'Motherboard'];

        } else if ($selectedCategory === 'SmartPhone') {
            alert('You selected SmartPhone!');
            categorySpaces = ['Brand', 'Model', 'Processor', 'RAM', 'Storage', 'Camera', 'Battery'];

        } else if ($selectedCategory === 'PC Accessories') {
            alert('You selected PC Accessories!');
            let accessoryType = prompt("Enter the type of accessory (e.g., Mouse, Keyboard, etc.):");
            categorySpaces = ['Brand', 'Model', 'Accessory Type', 'Connectivity', 'Color'];

        } else if ($selectedCategory === 'SmartWatch') {
            alert('You selected SmartWatch!');
            categorySpaces = ['Brand', 'Model', 'Processor', 'RAM', 'Storage', 'Battery Life'];

        } else if ($selectedCategory === 'SmartTV') {
            alert('You selected SmartTV!');
            categorySpaces = ['Brand', 'Model', 'Screen Size', 'Resolution', 'Smart Features'];

        } else if ($selectedCategory === 'Tablets') {
            alert('You selected Tablets!');
        } else if ($selectedCategory === 'HeadPhones') {
            alert('You selected HeadPhones!');
        }   
    })*/

    document.getElementById('categorySelect').addEventListener('change', function () {
        const selectedCategory = this.value;
        const container = document.getElementById('categorySpacesContainer');
        container.innerHTML = ''; // Clear previous inputs

        let categorySpaces = [];

        switch (selectedCategory) {
            case '1':
                categorySpaces = ['Brand', 'Model', 'Processor', 'RAM', 'Storage', 'Graphics Card', 'Screen Size'];
                break;
            case '2':
                categorySpaces = ['Brand', 'Model', 'Processor', 'RAM', 'Storage', 'Graphics Card', 'Motherboard'];
                break;
            case '3':
                categorySpaces = ['Brand', 'Model', 'Processor', 'RAM', 'Storage', 'Camera', 'Battery'];
                break;
            case '4':
                let accessoryType = prompt("Enter the type of accessory (e.g., Mouse, Keyboard, etc.):");
                categorySpaces = ['Brand', 'Model', 'Accessory Type', 'Connectivity', 'Color'];
                break;
            case '5':
                categorySpaces = ['Brand', 'Model', 'Processor', 'RAM', 'Storage', 'Battery Life'];
                break;
            case 'SmartTV':
                categorySpaces = ['Brand', 'Model', 'Screen Size', 'Resolution', 'Smart Features'];
                break;
            case 'Tablets':
                categorySpaces = ['Brand', 'Model', 'Processor', 'RAM', 'Storage', 'Screen Size'];
                break;
            case 'HeadPhones':
                categorySpaces = ['Brand', 'Model', 'Type', 'Connectivity', 'Battery Life'];
                break;
        }

        // Dynamically create inputs for each category space
        categorySpaces.forEach(space => {
            const label = document.createElement('label');
            label.innerText = space;

            const input = document.createElement('input');
            input.type = 'text';
            input.name = `category_spaces[${space}]`; // e.g., category_spaces[Brand]
            input.required = true;

            container.appendChild(label);
            container.appendChild(input);
            container.appendChild(document.createElement('br'));
        });
    });
</script>