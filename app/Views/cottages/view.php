<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h2><?= $cottage['cottage_name'] ?></h2>
                <p><?= $cottage['description'] ?></p>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <strong>Price per day:</strong><br>
                        <span class="text-primary fs-3">₱<?= number_format($cottage['price_per_day'], 2) ?></span>
                        <small>/day</small>
                    </div>
                    <div class="col-md-4">
                        <strong>Max Capacity:</strong><br>
                        <i class="fas fa-users"></i> <?= $cottage['capacity'] ?> persons
                    </div>
                    <div class="col-md-4">
                        <strong>Status:</strong><br>
                        <span class="badge bg-<?= $cottage['status'] == 'available' ? 'success' : 'danger' ?>"><?= ucfirst($cottage['status']) ?></span>
                    </div>
                </div>
                <hr>
                <a href="/book/<?= $cottage['cottage_id'] ?>" class="btn btn-primary btn-lg">Book This Cottage <i class="fas fa-calendar-check"></i></a>
                <a href="/cottages" class="btn btn-secondary btn-lg">Back to Cottages</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-light">
            <div class="card-body">
                <h5>Why Book With Us?</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-check-circle text-success"></i> Best price guarantee</li>
                    <li><i class="fas fa-check-circle text-success"></i> Free cancellation</li>
                    <li><i class="fas fa-check-circle text-success"></i> Secure payments</li>
                    <li><i class="fas fa-check-circle text-success"></i> 24/7 support</li>
                </ul>
            </div>
        </div>
    </div>
</div>