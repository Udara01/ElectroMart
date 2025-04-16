<div class="container">
    <h2>Add Product</h2>
    <form action="<?= site_url('admin/add_product') ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?> <!-- Add this line -->
        <div>
            <label>Product Name</label>
            <input type="text" name="name" required>
        </div>
        <div>
            <label>Product Category</label>
            <select name="category" id="categorySelect" required>
                <option value="Laptops">Laptops</option>
                <option value="PC">PC'S</option>
                <option value="SmartPhone">SmartPhones</option>
                <option value="PC Accessories">PC Accessories</option>
                <option value="SmartWatch">Smart Watches</option>
                <option value="SmartTV">Smart TVs</option>
                <option value="Tablets">Tablets</option>
                <option value="HeadPhones">Head Phones</option>
            </select>
        </div>
        <div>
            <label>Category Spaces</label>
            <div id="categorySpacesContainer"></div> <!-- This will be populated dynamically based on the selected category -->
            
        </div>
        <div>
            <label>Description</label>
            <input type="text" name="description" required>
        </div>

        <div>
            <label>Price</label>
            <input type="number" name="price" step="0.01" required>
        </div>

        <div>
            <label>Image</label>
            <input type="file" name="image" required>
        </div>

        <div>
            <button type="submit">Save Product</button>
        </div>
    </form>
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
            case 'Laptops':
                categorySpaces = ['Brand', 'Model', 'Processor', 'RAM', 'Storage', 'Graphics Card', 'Screen Size'];
                break;
            case 'PC':
                categorySpaces = ['Brand', 'Model', 'Processor', 'RAM', 'Storage', 'Graphics Card', 'Motherboard'];
                break;
            case 'SmartPhone':
                categorySpaces = ['Brand', 'Model', 'Processor', 'RAM', 'Storage', 'Camera', 'Battery'];
                break;
            case 'PC Accessories':
                let accessoryType = prompt("Enter the type of accessory (e.g., Mouse, Keyboard, etc.):");
                categorySpaces = ['Brand', 'Model', 'Accessory Type', 'Connectivity', 'Color'];
                break;
            case 'SmartWatch':
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