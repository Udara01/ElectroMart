<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Your Cart</h2>

    <?php if (empty($cartItems)): ?>
        <div class="alert alert-info">Your cart is empty.</div>
    <?php else: ?>
        <form action="<?= base_url('cart/buy-selected') ?>" method="post">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Select</th>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price (Rs)</th>
                        <th>Quantity</th>
                        <th>Total (Rs)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): ?>
                        <tr>
                            <td>
                                <input 
                                    type="checkbox" 
                                    name="selected_items[]" 
                                    value="<?= esc($item['id']) ?>" 
                                    class="select-item" 
                                    data-total="<?= esc($item['total']) ?>"
                                >
                            </td>
                            <td><img src="<?= base_url('uploads/' . $item['image']) ?>" width="80"></td>
                            <td><?= esc($item['name']) ?></td>
                            <td><?= esc($item['price']) ?></td>
                            <td><?= esc($item['quantity']) ?></td>
                            <td><?= esc($item['total']) ?></td>
                            <td>
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeFromCart(<?= $item['id'] ?>)">Remove</button>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="text-end mb-3">
                <h5>Selected Total: Rs. <span id="selectedTotal">0</span></h5>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-success">Buy Selected</button>
            </div>
        </form>
    <?php endif; ?>
</div>

<script>
// JavaScript to calculate selected total
document.addEventListener('DOMContentLoaded', function () {
    const checkboxes = document.querySelectorAll('.select-item');
    const selectedTotal = document.getElementById('selectedTotal');

    function updateTotal() {
        let total = 0;
        checkboxes.forEach(function (checkbox) {
            if (checkbox.checked) {
                total += parseFloat(checkbox.getAttribute('data-total'));
            }
        });
        selectedTotal.textContent = total.toFixed(2); // show two decimal points
    }

    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', updateTotal);
    });
});

function removeFromCart(itemId) {
    if (confirm('Are you sure you want to remove this item?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '<?= base_url('cart/remove') ?>/' + itemId;

        document.body.appendChild(form);
        form.submit();
    }
}


</script>

</body>
</html>
