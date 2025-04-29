<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><i class="fas fa-clipboard-list me-2 text-primary"></i> My Orders</h2>
        <a href="<?= base_url('home') ?>" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i> Continue Shopping
        </a>
    </div>

    <?php if (empty($orders)): ?>
        <div class="card border-0 shadow-sm text-center py-5">
            <div class="card-body">
                <div class="empty-state-icon mb-4">
                    <i class="fas fa-clipboard-list fa-4x text-muted"></i>
                </div>
                <h4 class="mb-3">No Orders Yet</h4>
                <p class="text-muted mb-4">You haven't placed any orders with us yet. Start shopping to see your orders here.</p>
                <a href="<?= base_url('home') ?>" class="btn btn-primary px-5">
                    <i class="fas fa-shopping-bag me-2"></i> Shop Now
                </a>
            </div>
        </div>
    <?php else: ?>
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Order #</th>
                                <th>Items</th>
                                <th>Tracking ID</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Date</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $index => $order): ?>
                            <tr>
                                <td class="ps-4 fw-bold"><?= $index + 1 ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <?php 
                                        $productNames = explode(',', $order['product_names']);
                                        $firstProduct = esc(trim($productNames[0]));
                                        $additionalCount = count($productNames) - 1;
                                        ?>
                                        <div class="me-3 bg-light rounded p-2">
                                            <i class="fas fa-box-open text-primary"></i>
                                        </div>
                                        <div>
                                            <div class="fw-medium"><?= $firstProduct ?></div>
                                            <?php if ($additionalCount > 0): ?>
                                            <small class="text-muted">+<?= $additionalCount ?> more item<?= $additionalCount > 1 ? 's' : '' ?></small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark font-monospace"><?= esc($order['tracking_id']) ?></span>
                                </td>
                                <td>
                                    <span class="badge 
                                        <?= $order['order_status'] === 'Completed' ? 'bg-success' : 
                                           ($order['order_status'] === 'Processing' ? 'bg-warning text-dark' : 
                                           ($order['order_status'] === 'Cancelled' ? 'bg-danger' : 'bg-info')) ?>">
                                        <?= esc($order['order_status']) ?>
                                    </span>
                                </td>
                                <td class="fw-bold">Rs. <?= number_format($order['total_amount'], 2) ?></td>
                                <td>
                                    <small class="text-muted"><?= date('M j, Y', strtotime($order['created_at'])) ?></small>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="<?= base_url('order-detail/' . $order['tracking_id']) ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye me-1"></i> View
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">
                Showing <?= count($orders) ?> of <?= $totalOrders ?? count($orders) ?> orders
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination mb-0">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    <?php endif; ?>
</div>

<style>
    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.05);
    }
    
    .empty-state-icon {
        opacity: 0.5;
    }
    
    .badge {
        padding: 0.35em 0.65em;
        font-size: 0.75em;
        font-weight: 600;
    }
    
    .font-monospace {
        font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
    }
    
    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        color: #6c757d;
    }
    
    @media (max-width: 768px) {
        .table-responsive {
            border: 0;
        }
        
        .table thead {
            display: none;
        }
        
        .table tr {
            display: block;
            margin-bottom: 1rem;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
        }
        
        .table td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem;
            border-bottom: 1px solid #dee2e6;
        }
        
        .table td:before {
            content: attr(data-label);
            font-weight: 600;
            text-transform: uppercase;
            color: #6c757d;
            margin-right: 1rem;
        }
        
        .table td:last-child {
            border-bottom: 0;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Make table rows clickable
    document.querySelectorAll('.table tbody tr').forEach(row => {
        row.addEventListener('click', function(e) {
            // Don't navigate if clicking on action buttons
            if (!e.target.closest('a, button')) {
                const link = this.querySelector('a');
                if (link) {
                    window.location.href = link.href;
                }
            }
        });
    });
});
</script>