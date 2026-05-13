<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-images me-2"></i> Cottage Gallery</h5>
            </div>
            <div class="card-body">
                <div class="main-image mb-3">
                    <img id="mainImage" src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=600&h=400&fit=crop" 
                         class="img-fluid rounded" alt="<?= $cottage['cottage_name'] ?>" style="width:100%; height:350px; object-fit:cover;">
                </div>
                <div class="gallery-thumbs row">
                    <div class="col-3 mb-2">
                        <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=150&h=100&fit=crop" 
                             class="img-fluid rounded thumb" alt="View 1" onclick="changeImage(this.src)">
                    </div>
                    <div class="col-3 mb-2">
                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=150&h=100&fit=crop" 
                             class="img-fluid rounded thumb" alt="View 2" onclick="changeImage(this.src)">
                    </div>
                    <div class="col-3 mb-2">
                        <img src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=150&h=100&fit=crop" 
                             class="img-fluid rounded thumb" alt="View 3" onclick="changeImage(this.src)">
                    </div>
                    <div class="col-3 mb-2">
                        <img src="https://images.unsplash.com/photo-1540541338287-41700207dee6?w=150&h=100&fit=crop" 
                             class="img-fluid rounded thumb" alt="View 4" onclick="changeImage(this.src)">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <h4><?= $cottage['cottage_name'] ?></h4>
                <p><?= $cottage['description'] ?></p>
                <hr>
                <div class="row">
                    <div class="col-6">
                        <small class="text-muted">Price per day</small>
                        <h4 class="text-primary">₱<?= number_format($cottage['price_per_day'], 2) ?></h4>
                    </div>
                    <div class="col-6">
                        <small class="text-muted">Capacity</small>
                        <h4><i class="fas fa-users"></i> <?= $cottage['capacity'] ?> persons</h4>
                    </div>
                </div>
                <div class="alert alert-info mt-3">
                    <i class="fas fa-info-circle"></i> Check-in: 9:00 AM | Check-out: 6:00 PM
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-calendar-plus me-2"></i> Complete Your Booking</h5>
            </div>
            <div class="card-body">
                <form action="/save-booking" method="post">
                    <input type="hidden" name="cottage_id" value="<?= $cottage['cottage_id'] ?>">
                    
                    <div class="mb-3">
                        <label class="form-label">Check-in Date</label>
                        <input type="date" name="check_in" class="form-control" min="<?= date('Y-m-d') ?>" required id="check_in">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Check-out Date</label>
                        <input type="date" name="check_out" class="form-control" required id="check_out">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Special Requests</label>
                        <textarea name="special_requests" class="form-control" rows="3" placeholder="Any special requests?"></textarea>
                    </div>
                    
                    <div id="pricePreview" class="alert alert-info mb-3" style="display: none;">
                        <div class="row text-center">
                            <div class="col-6">
                                <strong>Duration:</strong><br>
                                <span id="daysSummary" class="fs-3 fw-bold">0</span> day(s)
                            </div>
                            <div class="col-6">
                                <strong>Total:</strong><br>
                                <span id="totalAmount" class="fs-3 fw-bold text-success">₱0</span>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 btn-lg">
                        <i class="fas fa-check-circle"></i> Confirm Booking
                    </button>
                    <a href="/dashboard" class="btn btn-outline-secondary w-100 mt-2">
                        <i class="fas fa-arrow-left"></i> Back to Dashboard
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.gallery-thumbs .thumb {
    cursor: pointer;
    transition: all 0.3s;
    border: 2px solid transparent;
    height: 80px;
    width: 100%;
    object-fit: cover;
}
.gallery-thumbs .thumb:hover {
    transform: scale(1.05);
    border-color: #1e88e5;
}
</style>

<script>
function changeImage(src) {
    document.getElementById('mainImage').src = src;
}

function calculateTotal() {
    let checkIn = document.getElementById('check_in').value;
    let checkOut = document.getElementById('check_out').value;
    let price = <?= $cottage['price_per_day'] ?>;
    
    if(checkIn && checkOut) {
        let start = new Date(checkIn);
        let end = new Date(checkOut);
        let days = Math.ceil((end - start) / (1000 * 60 * 60 * 24));
        if(days > 0) {
            document.getElementById('daysSummary').innerText = days;
            document.getElementById('totalAmount').innerHTML = '₱' + (days * price).toFixed(2);
            document.getElementById('pricePreview').style.display = 'block';
        }
    }
}

document.getElementById('check_in').addEventListener('change', calculateTotal);
document.getElementById('check_out').addEventListener('change', calculateTotal);
</script>