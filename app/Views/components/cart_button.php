<!-- cart_button.php -->
<form action="<?= base_url('cart/add') ?>" method="post" class="d-inline">
    <input type="hidden" name="product_id" value="<?= esc($product_id) ?>">
    <button type="submit" class="btn btn-success">
        <i class="fa fa-shopping-cart"></i> Add to Cart
    </button>
</form>


<?php /* view('components/cart_button', ['product_id' => $product['id']]) */ ?>
