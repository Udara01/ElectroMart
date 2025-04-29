<div>
    <h2>Add Product</h2>


    <h3>Categories:</h3>
    <ul>
        <?php foreach ($categories as $category): ?>
            <li><?= esc($category['name']) ?></li> 
        <?php endforeach; ?>
    </ul>
    
</div>