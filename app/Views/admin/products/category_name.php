<div>
    <h2>Add Product</h2>


    <h3>Categories:</h3>
    <ul>
        <?php foreach ($categories as $category): ?>
            <li><?= esc($category['name']) ?></li>  <!-- Assuming each category has a 'name' field -->
        <?php endforeach; ?>
    </ul>
    
</div>