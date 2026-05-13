<div class="row">
    <?php if(empty($cottages)): ?>
        <div class="col-12">
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle fa-2x"></i>
                <p class="mt-2">No cottages available at the moment. Please check back later.</p>
            </div>
        </div>
    <?php else: ?>
        <?php foreach($cottages as $index => $cottage): ?>
        <div class="col-md-4 mb-4 fade-in-up" style="animation-delay: <?= $index * 0.1 ?>s">
            <div class="card h-100">
                <div class="cottage-icon">
                    <i class="fas fa-home"></i>
                </div>
                <div class="card-body text-center">
                    <h4 class="card-title"><?= $cottage['cottage_name'] ?></h4>
                    <p class="card-text text-muted"><?= substr($cottage['description'], 0, 100) ?>...</p>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-users"></i> <?= $cottage['capacity'] ?> guests<br>
                            <span class="price-tag mt-2 d-inline-block">₱<?= number_format($cottage['price_per_day'], 2) ?>/night</span>
                        </div>
                        <a href="/book/<?= $cottage['cottage_id'] ?>" class="btn btn-primary">
                            Book Now <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>