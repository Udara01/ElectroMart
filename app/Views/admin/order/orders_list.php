<div class="container mt-5">
    <h2>All Orders</h2>

    <?php if (empty($groupedOrders)): ?>
        <div class="alert alert-info">No orders found.</div>
    <?php else: ?>
        <?php foreach ($groupedOrders as $status => $orders): ?>
            <div class="card my-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0"><?= esc($status) ?> Orders (<?= count($orders) ?>)</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Order ID</th>
                                <th>Tracking ID</th>
                                <th>User ID</th>
                                <th>Total (Rs)</th>
                                <th>Placed On</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td><?= esc($order['id']) ?></td>
                                    <td><?= esc($order['tracking_id']) ?></td>
                                    <td><?= esc($order['user_id']) ?></td>
                                    <td><?= esc($order['total_amount']) ?></td>
                                    <td><?= esc($order['created_at']) ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/order/' . $order['tracking_id']) ?>" class="btn btn-info btn-sm">View/Edit</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
