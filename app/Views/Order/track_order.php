<div class="container mt-5">
    <h2>Track Your Order</h2>
    <form action="<?= base_url('track-order') ?>" method="post" class="mt-4">
        <div class="mb-3">
            <label for="tracking_id" class="form-label">Enter Tracking ID:</label>
            <input type="text" name="tracking_id" id="tracking_id" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Track</button>
    </form>
</div>
