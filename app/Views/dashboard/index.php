<h1 class="mb-4"><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
<p class="text-muted">Welcome back, <?= session()->get('full_name') ?>!</p>

<div class="row mt-4">
    <div class="col-md-3">
        <div class="stat-card">
            <i class="fas fa-calendar-check"></i>
            <h3><?= $stats['total_bookings'] ?? 0 ?></h3>
            <p class="text-muted">Total Bookings</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <i class="fas fa-clock"></i>
            <h3><?= $stats['pending_bookings'] ?? 0 ?></h3>
            <p class="text-muted">Pending</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <i class="fas fa-check-circle"></i>
            <h3><?= $stats['confirmed_bookings'] ?? 0 ?></h3>
            <p class="text-muted">Confirmed</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <i class="fas fa-building"></i>
            <h3>6</h3>
            <p class="text-muted">Cottages</p>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="fas fa-history"></i> Recent Bookings</h5>
    </div>
    <div class="card-body">
        <?php if(empty($recent)): ?>
            <p class="text-muted text-center">No bookings yet. <a href="/cottages">Book a cottage now!</a></p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr><th>Reference</th><th>Cottage</th><th>Date</th><th>Time</th><th>Amount</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach($recent as $booking): ?>
                        <tr>
                            <td><?= $booking['booking_reference'] ?></td>
                            <td><?= $booking['cottage_name'] ?></td>
                            <td><?= date('M d, Y', strtotime($booking['booking_date'])) ?></td>
                            <td><?= date('h:i A', strtotime($booking['start_time'])) ?></td>
                            <td>₱<?= number_format($booking['total_amount'], 2) ?></td>
                            <td><span class="badge bg-<?= $booking['status'] == 'confirmed' ? 'success' : ($booking['status'] == 'pending' ? 'warning' : 'secondary') ?>"><?= ucfirst($booking['status']) ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>