<link rel="stylesheet" href="/asset/Styles/order_success.css" >

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="text-center mb-5">
                <div class="success-animation mb-4">
                    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52" width="80" height="80">
                        <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" stroke="#4CAF50" stroke-width="2"/>
                        <path class="checkmark__check" fill="none" stroke="#4CAF50" stroke-width="4" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                    </svg>
                </div>
                <h1 class="display-5 fw-bold text-success mb-3">Order Confirmed!</h1>
                <p class="lead text-muted">Your order has been placed successfully and is being processed.</p>
                <div class="d-inline-block px-3 py-2 bg-light rounded-pill mb-4">
                    <i class="fas fa-receipt me-2 text-primary"></i>
                    <strong>Tracking ID:</strong> <span class="text-primary"><?= esc($order['tracking_id']) ?></span>
                </div>
            </div>

            <div class="card border-0 shadow-lg overflow-hidden mb-5">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0"><i class="fas fa-box-open me-2"></i> Order Summary</h4>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <h5 class="mb-3"><i class="fas fa-receipt me-2 text-primary"></i> Order Details</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><strong>Order Date:</strong> <?= date('F j, Y, g:i a', strtotime($order['created_at'])) ?></li>
                                <li class="mb-2"><strong>Total Amount:</strong> Rs <?= number_format($order['total_amount'], 2) ?></li>
                                <li class="mb-2"><strong>Payment Method:</strong> <?= esc(ucfirst($order['payment_method'])) ?></li>
                                <li><strong>Status:</strong> <span class="badge bg-success">Confirmed</span></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5 class="mb-3"><i class="fas fa-truck me-2 text-primary"></i> Shipping Details</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><strong><?= esc($order['name']) ?></strong></li>
                                <li class="mb-2"><?= esc($order['address']) ?></li>
                                <li class="mb-2"><?= esc($order['city']) ?>, <?= esc($order['postal_code']) ?></li>
                                <li><i class="fas fa-phone me-2"></i> <?= esc($order['phone']) ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body text-center p-4">
                    <h5 class="mb-3">What's Next?</h5>
                    <div class="d-flex flex-wrap justify-content-center steps-timeline">
                        <div class="step mx-3">
                            <div class="step-icon bg-primary text-white rounded-circle mb-2">
                                <i class="fas fa-check"></i>
                            </div>
                            <p class="mb-0 small">Order<br>Confirmed</p>
                        </div>
                        <div class="step mx-3">
                            <div class="step-icon bg-light text-muted rounded-circle mb-2">
                                <i class="fas fa-box"></i>
                            </div>
                            <p class="mb-0 small">Processing<br>Order</p>
                        </div>
                        <div class="step mx-3">
                            <div class="step-icon bg-light text-muted rounded-circle mb-2">
                                <i class="fas fa-shipping-fast"></i>
                            </div>
                            <p class="mb-0 small">Shipped</p>
                        </div>
                        <div class="step mx-3">
                            <div class="step-icon bg-light text-muted rounded-circle mb-2">
                                <i class="fas fa-home"></i>
                            </div>
                            <p class="mb-0 small">Delivered</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="<?= base_url('/home') ?>" class="btn btn-primary btn-lg px-5 py-3 me-3">
                    <i class="fas fa-shopping-bag me-2"></i> Continue Shopping
                </a>
                <a href="<?= base_url('/my-orders') ?>" class="btn btn-outline-primary btn-lg px-5 py-3">
                    <i class="fas fa-clipboard-list me-2"></i> View Orders
                </a>
            </div>

            <div class="text-center mt-5">
                <p class="text-muted mb-2">Need help with your order?</p>
                <a href="<?= base_url('/contact') ?>" class="btn btn-link text-decoration-none">
                    <i class="fas fa-headset me-2"></i> Contact Customer Support
                </a>
            </div>
        </div>
    </div>
</div>
