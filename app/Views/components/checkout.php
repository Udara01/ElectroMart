<div class="container my-5">
    <div class="row g-5">
        <!-- Left Column - Shipping & Payment -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0"><i class="fas fa-truck me-2"></i> Shipping Information</h4>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('cart/place-order') ?>" method="post" id="checkoutForm">
                        <?= csrf_field() ?>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" id="name" name="name" required placeholder="John Doe">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="tel" class="form-control" id="phone" name="phone" required placeholder="+94 76 123 4567">
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <label for="address" class="form-label">Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    <textarea class="form-control" id="address" name="address" rows="2" required placeholder="123 Main Street, Apartment 4"></textarea>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="city" class="form-label">City</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-city"></i></span>
                                    <input type="text" class="form-control" id="city" name="city" required placeholder="Colombo">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="postal_code" class="form-label">Postal Code</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-mail-bulk"></i></span>
                                    <input type="text" class="form-control" id="postal_code" name="postal_code" required placeholder="10000">
                                </div>
                            </div>
                        </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0"><i class="fas fa-credit-card me-2"></i> Payment Method</h4>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="payment_method" id="cod" value="Cash on Delivery" checked>
                            <label class="form-check-label d-flex align-items-center" for="cod">
                                <span class="payment-method-icon bg-success text-white rounded-circle me-3">
                                    <i class="fas fa-money-bill-wave"></i>
                                </span>
                                <div>
                                    <h6 class="mb-1">Cash on Delivery</h6>
                                    <small class="text-muted">Pay when you receive your order</small>
                                </div>
                            </label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="online" value="Online Payment">
                            <label class="form-check-label d-flex align-items-center" for="online">
                                <span class="payment-method-icon bg-info text-white rounded-circle me-3">
                                    <i class="fas fa-globe"></i>
                                </span>
                                <div>
                                    <h6 class="mb-1">Online Payment</h6>
                                    <small class="text-muted">Pay securely with credit/debit card</small>
                                </div>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Online Payment Fields -->
                    <div id="onlinePaymentFields" class="bg-light p-3 rounded mb-3" style="display: none;">
                        <div class="mb-3">
                            <label class="form-label">Card Number</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
                                <input type="text" class="form-control" placeholder="1234 5678 9012 3456" disabled>
                            </div>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Expiry Date</label>
                                <input type="text" class="form-control" placeholder="MM/YY" disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">CVV</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="123" disabled>
                                    <span class="input-group-text"><i class="fas fa-question-circle" data-bs-toggle="tooltip" title="3-digit code on back of card"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="terms" required>
                        <label class="form-check-label" for="terms">
                            I agree to the <a href="<?= base_url('terms') ?>">Terms and Conditions</a> and <a href="<?= base_url('privacy') ?>">Privacy Policy</a>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Order Summary -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0"><i class="fas fa-receipt me-2"></i> Order Summary</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $grandTotal = 0; ?>
                                <?php foreach ($selectedItems as $item): ?>
                                <tr>
                                    <td>
                                        <?= esc($item['name']) ?> 
                                        <span class="text-muted d-block">Qty: <?= esc($item['quantity']) ?></span>
                                    </td>
                                    <td class="text-end">Rs. <?= number_format($item['total'], 2) ?></td>
                                </tr>
                                <?php $grandTotal += $item['total']; ?>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <th>Subtotal</th>
                                    <td class="text-end">Rs. <?= number_format($grandTotal, 2) ?></td>
                                </tr>
                                <tr>
                                    <th>Shipping</th>
                                    <td class="text-end">Free</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td class="text-end fw-bold">Rs. <?= number_format($grandTotal, 2) ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                    <!-- cart item IDs -->
                    <?php foreach ($selectedCartIds as $cartId): ?>
                        <input type="hidden" name="selected_items[]" value="<?= $cartId ?>">
                    <?php endforeach; ?>
                    
                    <button type="submit" class="btn btn-success btn-lg w-100 py-3 mt-3">
                        <i class="fas fa-shopping-bag me-2"></i> Complete Order
                    </button>
                    
                    <div class="text-center mt-3">
                        <a href="<?= base_url('cart') ?>" class="text-decoration-none">
                            <i class="fas fa-arrow-left me-2"></i> Return to Cart
                        </a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .payment-method-icon {
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    .form-check-input {
        width: 1.2em;
        height: 1.2em;
        margin-top: 0.2em;
    }
    
    .card-header {
        border-radius: 0.375rem 0.375rem 0 0 !important;
    }
    
    .sticky-top {
        z-index: 1;
    }
    
    .input-group-text {
        min-width: 45px;
        justify-content: center;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle online payment fields
    const onlineRadio = document.getElementById('online');
    const codRadio = document.getElementById('cod');
    const onlinePaymentFields = document.getElementById('onlinePaymentFields');
    
    function togglePaymentFields() {
        if (onlineRadio.checked) {
            onlinePaymentFields.style.display = 'block';
        } else {
            onlinePaymentFields.style.display = 'none';
        }
    }
    
    onlineRadio.addEventListener('change', togglePaymentFields);
    codRadio.addEventListener('change', togglePaymentFields);
    
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>