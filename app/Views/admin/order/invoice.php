<!DOCTYPE html>
<html>
<head>
    <title>Invoice - <?= esc($order['tracking_id']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Invoice</h2>
        <button onclick="window.print()" class="btn btn-primary no-print">Print</button>
    </div>

    <p><strong>Tracking ID:</strong> <?= esc($order['tracking_id']) ?></p>
    <p><strong>Order Date:</strong> <?= esc($order['created_at']) ?></p>
    <hr>

    <h5>Customer Info</h5>
    <p><strong>Name:</strong> <?= esc($order['name']) ?></p>
    <p><strong>Phone:</strong> <?= esc($order['phone']) ?></p>
    <p><strong>Address:</strong> <?= esc($order['address']) ?>, <?= esc($order['city']) ?>, <?= esc($order['postal_code']) ?></p>
    <hr>

    <h5>Order Items</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price (Rs)</th>
                <th>Total (Rs)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= esc($item['product_name'] ?? 'Product') ?></td>
                    <td><?= esc($item['quantity']) ?></td>
                    <td><?= number_format($item['price'], 2) ?></td>
                    <td><?= number_format($item['subtotal'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h4 class="text-end">Grand Total: Rs <?= number_format($order['total_amount'], 2) ?></h4>
</div>
</body>
</html>
