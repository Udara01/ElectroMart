<div class="container mt-5">
    <h2>Track Order Result</h2>

    <?php if ($order): ?>
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Tracking ID: <?= esc($order['tracking_id']) ?></h5>
                <p><strong>Status:</strong> <?= esc($order['order_status']) ?></p>
                <p><strong>Placed On:</strong> <?= esc($order['created_at']) ?></p>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger mt-4">Order not found. Please check the tracking ID again.</div>
    <?php endif; ?>
</div>
