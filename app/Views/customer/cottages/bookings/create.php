<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4><?= $cottage['cottage_name'] ?></h4>
                <p><?= $cottage['description'] ?></p>
                <p><strong>Price:</strong> ₱<?= number_format($cottage['price_per_day'], 2) ?> per day</p>
                <p><strong>Capacity:</strong> <?= $cottage['capacity'] ?> persons</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4>Booking Details</h4>
                <form action="/save-booking" method="post">
                    <input type="hidden" name="cottage_id" value="<?= $cottage['cottage_id'] ?>">
                    <div class="mb-3">
                        <label>Check-in Date</label>
                        <input type="date" name="check_in" class="form-control" min="<?= date('Y-m-d') ?>" required id="check_in">
                    </div>
                    <div class="mb-3">
                        <label>Check-out Date</label>
                        <input type="date" name="check_out" class="form-control" required id="check_out">
                    </div>
                    <div class="mb-3">
                        <label>Special Requests</label>
                        <textarea name="special_requests" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="alert alert-info" id="total_preview" style="display:none">
                        Total: ₱<span id="total_amount">0</span> for <span id="total_days">0</span> day(s)
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Confirm Booking</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function calculate() {
        let check_in = document.getElementById('check_in').value;
        let check_out = document.getElementById('check_out').value;
        let price = <?= $cottage['price_per_day'] ?>;
        
        if(check_in && check_out) {
            let start = new Date(check_in);
            let end = new Date(check_out);
            let days = (end - start) / (1000 * 60 * 60 * 24);
            if(days > 0) {
                document.getElementById('total_days').innerText = days;
                document.getElementById('total_amount').innerText = (days * price).toFixed(2);
                document.getElementById('total_preview').style.display = 'block';
            }
        }
    }
    document.getElementById('check_in').addEventListener('change', calculate);
    document.getElementById('check_out').addEventListener('change', calculate);
</script>