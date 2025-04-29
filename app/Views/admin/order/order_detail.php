<div class="container mt-5">
    <h2>Order Details</h2>
    <a href="<?= base_url('admin/order/invoice/' . $order['tracking_id']) ?>" target="_blank" class="btn btn-secondary mb-3">
    <i class="bi bi-printer"></i> Print Invoice
    </a>
    <!-- Order Basic Info -->
    <div class="card mb-4">
        <div class="card-body">
            <h5>Tracking ID: <?= esc($order['tracking_id']) ?></h5>
            <p><strong>Status:</strong> <?= esc($order['order_status']) ?></p>
            <p><strong>Placed On:</strong> <?= esc($order['created_at']) ?></p>
        </div>
    </div>

    <!-- User Details -->
    <h4>User Details</h4>
    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Name:</strong> <?= esc($order['name']) ?></p>
            <p><strong>Phone:</strong> <?= esc($order['phone']) ?></p>
            <p><strong>Address:</strong> <?= esc($order['address']) ?>, <?= esc($order['city']) ?>, <?= esc($order['postal_code']) ?></p>
            <p><strong>Payment Method:</strong> <?= esc($order['payment_method']) ?></p>
            <p><strong>Total Amount:</strong> Rs <?= esc(number_format($order['total_amount'], 2)) ?></p>
        </div>
    </div>

    <!-- Update Order Status Form -->
    <h4>Update Order Status</h4>
    <form action="<?= base_url('admin/order/update-status/' . $order['tracking_id']) ?>" method="post" class="mb-4">
        <div class="mb-3">
            <select name="status" class="form-select">
                <option value="Pending" <?= ($order['order_status'] == 'Pending') ? 'selected' : '' ?>>Pending</option>
                <option value="Processing" <?= ($order['order_status'] == 'Processing') ? 'selected' : '' ?>>Processing</option>
                <option value="Shipped" <?= ($order['order_status'] == 'Shipped') ? 'selected' : '' ?>>Shipped</option>
                <option value="Delivered" <?= ($order['order_status'] == 'Delivered') ? 'selected' : '' ?>>Delivered</option>
                <option value="Cancelled" <?= ($order['order_status'] == 'Cancelled') ? 'selected' : '' ?>>Cancelled</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Status</button>
    </form>

    <!-- Order Items -->
    <h4>Order Items</h4>
    <?php if (empty($items)): ?>
        <div class="alert alert-warning">No items found in this order.</div>
    <?php else: ?>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price (Rs)</th>
                    <th>Total (Rs)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= esc($item['product_name']) ?></td>
                        <td><?= esc($item['quantity']) ?></td>
                        <td><?= esc(number_format($item['price'], 2)) ?></td>
                        <td><?= esc(number_format($item['subtotal'], 2)) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
