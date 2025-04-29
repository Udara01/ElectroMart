<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><i class="fas fa-file-invoice me-2 text-primary"></i> Order Details</h2>
        <a href="<?= base_url('my-orders') ?>" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i> Back to Orders
        </a>
    </div>

    <div class="row">
        <!-- Order Summary -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i> Order Summary</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-light rounded-circle p-3 me-3">
                                    <i class="fas fa-barcode text-primary fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Tracking ID</h6>
                                    <p class="mb-0 text-muted"><?= esc($order['tracking_id']) ?></p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-circle p-3 me-3">
                                    <i class="fas fa-calendar-alt text-primary fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Order Date</h6>
                                    <p class="mb-0 text-muted"><?= date('F j, Y \a\t g:i A', strtotime($order['created_at'])) ?></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-light rounded-circle p-3 me-3">
                                    <i class="fas fa-tag text-primary fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Order Status</h6>
                                    <p class="mb-0">
                                        <span class="badge 
                                            <?= $order['order_status'] === 'Completed' ? 'bg-success' : 
                                               ($order['order_status'] === 'Processing' ? 'bg-warning text-dark' : 
                                               ($order['order_status'] === 'Cancelled' ? 'bg-danger' : 'bg-info')) ?>">
                                            <?= esc($order['order_status']) ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-circle p-3 me-3">
                                    <i class="fas fa-wallet text-primary fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Total Amount</h6>
                                    <p class="mb-0 text-muted">Rs. <?= number_format($order['total_amount'], 2) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping Information -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0"><i class="fas fa-truck me-2"></i> Shipping Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <h6 class="text-muted">Recipient</h6>
                            <p class="mb-1"><strong><?= esc($order['name']) ?></strong></p>
                            <p class="mb-1"><?= esc($order['phone']) ?></p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Shipping Address</h6>
                            <p class="mb-1"><?= esc($order['address']) ?></p>
                            <p class="mb-1"><?= esc($order['city']) ?>, <?= esc($order['postal_code']) ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Information -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0"><i class="fas fa-credit-card me-2"></i> Payment Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-muted">Payment Method</h6>
                            <p class="mb-1"><strong><?= esc($order['payment_method']) ?></strong></p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Payment Status</h6>
                            <p class="mb-1">
                                <span class="badge bg-danger">Unpaid</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0"><i class="fas fa-shopping-bag me-2"></i> Order Items</h5>
                </div>
                <div class="card-body">
                    <?php if (empty($items)): ?>
                        <div class="alert alert-warning mb-0">No items found in this order.</div>
                    <?php else: ?>
                        <div class="list-group list-group-flush">
                            <?php foreach ($items as $item): ?>
                            <div class="list-group-item border-0 px-0 py-3">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="mb-0"><?= esc($item['product_name']) ?></h6>
                                    <span class="text-end">Rs. <?= number_format($item['subtotal'], 2) ?></span>
                                </div>
                                <div class="d-flex justify-content-between text-muted small">
                                    <span>Qty: <?= esc($item['quantity']) ?></span>
                                    <span>Rs. <?= number_format($item['price'], 2) ?> each</span>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <hr>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <span>Rs. <?= number_format($order['total_amount'], 2) ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping:</span>
                            <span>Free</span>
                        </div>
                        <div class="d-flex justify-content-between fw-bold">
                            <span>Total:</span>
                            <span>Rs. <?= number_format($order['total_amount'], 2) ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Timeline -->
    <div class="card border-0 shadow-sm mt-4">
        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0"><i class="fas fa-history me-2"></i> Order Timeline</h5>
        </div>
        <div class="card-body">
            <div class="steps">
                <div class="step completed">
                    <div class="step-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="step-content">
                        <h6 class="mb-1">Order Placed</h6>
                        <p class="mb-0 text-muted small"><?= date('F j, g:i A', strtotime($order['created_at'])) ?></p>
                    </div>
                </div>
                
                <div class="step <?= in_array($order['order_status'], ['Processing', 'Shipped', 'Delivered', 'Completed']) ? 'completed' : '' ?>">
                    <div class="step-icon">
                        <i class="fas fa-cog"></i>
                    </div>
                    <div class="step-content">
                        <h6 class="mb-1">Processing</h6>
                        <?php if (in_array($order['order_status'], ['Processing', 'Shipped', 'Delivered', 'Completed'])): ?>
                            <p class="mb-0 text-muted small"><?= date('F j, g:i A', strtotime($order['updated_at'])) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="step <?= in_array($order['order_status'], ['Shipped', 'Delivered', 'Completed']) ? 'completed' : '' ?>">
                    <div class="step-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <div class="step-content">
                        <h6 class="mb-1">Shipped</h6>
                        <?php if (in_array($order['order_status'], ['Shipped', 'Delivered', 'Completed'])): ?>
                            <p class="mb-0 text-muted small"><?= date('F j, g:i A', strtotime($order['updated_at'])) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="step <?= in_array($order['order_status'], ['Delivered', 'Completed']) ? 'completed' : '' ?>">
                    <div class="step-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="step-content">
                        <h6 class="mb-1">Delivered</h6>
                        <?php if (in_array($order['order_status'], ['Delivered', 'Completed'])): ?>
                            <p class="mb-0 text-muted small"><?= date('F j, g:i A', strtotime($order['updated_at'])) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Support Section -->
    <div class="card border-0 shadow-sm mt-4">
        <div class="card-body text-center py-4">
            <h5 class="mb-3">Need help with your order?</h5>
            <p class="text-muted mb-4">Our customer service team is ready to assist you with any questions about your order.</p>
            <a href="<?= base_url('contact') ?>" class="btn btn-outline-primary px-4">
                <i class="fas fa-headset me-2"></i> Contact Support
            </a>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
    }
    
    .card-header {
        border-radius: 0 !important;
    }
    
    .steps {
        position: relative;
        padding-left: 45px;
    }
    
    .steps:before {
        content: '';
        position: absolute;
        left: 20px;
        top: 0;
        height: 100%;
        width: 2px;
        background-color: #e9ecef;
    }
    
    .step {
        position: relative;
        padding-bottom: 25px;
    }
    
    .step:last-child {
        padding-bottom: 0;
    }
    
    .step-icon {
        position: absolute;
        left: -45px;
        top: 0;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
    }
    
    .step.completed .step-icon {
        background-color: #198754;
        color: white;
    }
    
    .step-content {
        padding-left: 15px;
    }
    
    .list-group-item {
        border-left: 0;
        border-right: 0;
    }
    
    .list-group-item:first-child {
        border-top: 0;
        padding-top: 0;
    }
    
    .sticky-top {
        z-index: 1;
    }
    
    @media (max-width: 992px) {
        .sticky-top {
            position: relative !important;
        }
    }
</style>