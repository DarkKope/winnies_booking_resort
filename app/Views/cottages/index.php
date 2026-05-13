<h1 class="mb-4"><i class="fas fa-building"></i> Cottages & Rooms</h1>
<p class="text-muted">Choose your perfect getaway spot - Daily rates</p>

<div class="row">
    <?php foreach($cottages as $cottage): ?>
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title"><?= $cottage['cottage_name'] ?></h5>
                <p class="card-text"><?= substr($cottage['description'], 0, 100) ?>...</p>
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-users"></i> <?= $cottage['capacity'] ?> persons<br>
                        <strong class="text-primary fs-4">₱<?= number_format($cottage['price_per_day'], 2) ?></strong>
                        <small>/day</small>
                    </div>
                    <a href="/book/<?= $cottage['cottage_id'] ?>" class="btn btn-primary">Book Now <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>