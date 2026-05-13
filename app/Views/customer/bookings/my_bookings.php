<div class="row mb-4">
    <div class="col-12">
        <h4 class="mb-3">My Bookings</h4>
        <p class="text-muted">Manage and track your reservations</p>
    </div>
</div>

<!-- Tab Navigation -->
<ul class="nav nav-tabs mb-4" id="bookingTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab">
            <i class="fas fa-clock me-1"></i> Pending 
            <span class="badge bg-warning text-dark ms-1"><?= count(array_filter($bookings, function($b) { return $b['status'] == 'pending'; })) ?></span>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="confirmed-tab" data-bs-toggle="tab" data-bs-target="#confirmed" type="button" role="tab">
            <i class="fas fa-check-circle me-1"></i> Confirmed
            <span class="badge bg-success ms-1"><?= count(array_filter($bookings, function($b) { return $b['status'] == 'confirmed'; })) ?></span>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button" role="tab">
            <i class="fas fa-check-double me-1"></i> Completed
            <span class="badge bg-info ms-1"><?= count(array_filter($bookings, function($b) { return $b['status'] == 'completed'; })) ?></span>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="cancelled-tab" data-bs-toggle="tab" data-bs-target="#cancelled" type="button" role="tab">
            <i class="fas fa-times-circle me-1"></i> Cancelled
            <span class="badge bg-danger ms-1"><?= count(array_filter($bookings, function($b) { return $b['status'] == 'cancelled'; })) ?></span>
        </button>
    </li>
</ul>

<!-- Tab Content -->
<div class="tab-content" id="bookingTabsContent">
    
    <!-- Pending Bookings Tab -->
    <div class="tab-pane fade show active" id="pending" role="tabpanel">
        <?php 
        $pendingBookings = array_filter($bookings, function($b) { return $b['status'] == 'pending'; });
        if(empty($pendingBookings)): ?>
            <div class="card text-center p-5">
                <div class="card-body">
                    <i class="fas fa-clock fa-4x text-muted mb-3"></i>
                    <h5>No Pending Bookings</h5>
                    <p class="text-muted">You don't have any pending bookings at the moment.</p>
                    <a href="/dashboard" class="btn btn-primary mt-2">
                        <i class="fas fa-search me-2"></i> Browse Cottages
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach($pendingBookings as $booking): ?>
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-warning">
                        <div class="card-header bg-warning bg-opacity-10">
                            <div class="d-flex justify-content-between align-items-center">
                                <strong><i class="fas fa-ticket-alt me-2"></i> <?= $booking['booking_reference'] ?></strong>
                                <span class="badge bg-warning text-dark">
                                    <i class="fas fa-clock me-1"></i> Pending
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <small class="text-muted">Cottage</small>
                                    <p class="fw-bold mb-0"><?= $booking['cottage_name'] ?></p>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Total Amount</small>
                                    <p class="fw-bold mb-0 text-primary">₱<?= number_format($booking['total_amount'], 2) ?></p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <small class="text-muted">Check-in</small>
                                    <p class="mb-0"><i class="fas fa-calendar me-1"></i> <?= date('M d, Y', strtotime($booking['booking_date'])) ?></p>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Check-out</small>
                                    <p class="mb-0"><i class="fas fa-calendar me-1"></i> <?= date('M d, Y', strtotime($booking['booking_date'] . ' + ' . $booking['total_days'] . ' days')) ?></p>
                                </div>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted">Duration</small>
                                <p><i class="fas fa-hourglass-half me-1"></i> <?= $booking['total_days'] ?> night(s)</p>
                            </div>
                            <div class="mt-3">
                                <a href="/cancel-booking/<?= $booking['booking_id'] ?>" 
                                   class="btn btn-danger w-100"
                                   onclick="return confirm('Are you sure you want to cancel this booking?')">
                                    <i class="fas fa-times me-2"></i> Cancel Booking
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    
    <!-- Confirmed Bookings Tab -->
    <div class="tab-pane fade" id="confirmed" role="tabpanel">
        <?php 
        $confirmedBookings = array_filter($bookings, function($b) { return $b['status'] == 'confirmed'; });
        if(empty($confirmedBookings)): ?>
            <div class="card text-center p-5">
                <div class="card-body">
                    <i class="fas fa-check-circle fa-4x text-success mb-3"></i>
                    <h5>No Confirmed Bookings</h5>
                    <p class="text-muted">You don't have any confirmed bookings yet.</p>
                    <a href="/dashboard" class="btn btn-primary mt-2">
                        <i class="fas fa-search me-2"></i> Browse Cottages
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach($confirmedBookings as $booking): ?>
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-success">
                        <div class="card-header bg-success bg-opacity-10">
                            <div class="d-flex justify-content-between align-items-center">
                                <strong><i class="fas fa-ticket-alt me-2"></i> <?= $booking['booking_reference'] ?></strong>
                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle me-1"></i> Confirmed
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <small class="text-muted">Cottage</small>
                                    <p class="fw-bold mb-0"><?= $booking['cottage_name'] ?></p>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Total Amount</small>
                                    <p class="fw-bold mb-0 text-primary">₱<?= number_format($booking['total_amount'], 2) ?></p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <small class="text-muted">Check-in</small>
                                    <p class="mb-0"><i class="fas fa-calendar me-1"></i> <?= date('M d, Y', strtotime($booking['booking_date'])) ?></p>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Check-out</small>
                                    <p class="mb-0"><i class="fas fa-calendar me-1"></i> <?= date('M d, Y', strtotime($booking['booking_date'] . ' + ' . $booking['total_days'] . ' days')) ?></p>
                                </div>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted">Duration</small>
                                <p><i class="fas fa-hourglass-half me-1"></i> <?= $booking['total_days'] ?> night(s)</p>
                            </div>
                            <div class="alert alert-success text-center mb-0">
                                <i class="fas fa-check-circle me-2"></i> Booking Confirmed! We look forward to hosting you.
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    
    <!-- Completed Bookings Tab -->
    <div class="tab-pane fade" id="completed" role="tabpanel">
        <?php 
        $completedBookings = array_filter($bookings, function($b) { return $b['status'] == 'completed'; });
        if(empty($completedBookings)): ?>
            <div class="card text-center p-5">
                <div class="card-body">
                    <i class="fas fa-check-double fa-4x text-info mb-3"></i>
                    <h5>No Completed Bookings</h5>
                    <p class="text-muted">You haven't completed any stays yet.</p>
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach($completedBookings as $booking): ?>
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-info">
                        <div class="card-header bg-info bg-opacity-10">
                            <div class="d-flex justify-content-between align-items-center">
                                <strong><i class="fas fa-ticket-alt me-2"></i> <?= $booking['booking_reference'] ?></strong>
                                <span class="badge bg-info">
                                    <i class="fas fa-check-double me-1"></i> Completed
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <small class="text-muted">Cottage</small>
                                    <p class="fw-bold mb-0"><?= $booking['cottage_name'] ?></p>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Total Amount</small>
                                    <p class="fw-bold mb-0 text-primary">₱<?= number_format($booking['total_amount'], 2) ?></p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <small class="text-muted">Check-in</small>
                                    <p class="mb-0"><i class="fas fa-calendar me-1"></i> <?= date('M d, Y', strtotime($booking['booking_date'])) ?></p>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Check-out</small>
                                    <p class="mb-0"><i class="fas fa-calendar me-1"></i> <?= date('M d, Y', strtotime($booking['booking_date'] . ' + ' . $booking['total_days'] . ' days')) ?></p>
                                </div>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted">Duration</small>
                                <p><i class="fas fa-hourglass-half me-1"></i> <?= $booking['total_days'] ?> night(s)</p>
                            </div>
                            <div class="alert alert-info text-center mb-0">
                                <i class="fas fa-star me-2"></i> Thank you for staying with us! We hope to see you again.
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    
    <!-- Cancelled Bookings Tab -->
    <div class="tab-pane fade" id="cancelled" role="tabpanel">
        <?php 
        $cancelledBookings = array_filter($bookings, function($b) { return $b['status'] == 'cancelled'; });
        if(empty($cancelledBookings)): ?>
            <div class="card text-center p-5">
                <div class="card-body">
                    <i class="fas fa-times-circle fa-4x text-muted mb-3"></i>
                    <h5>No Cancelled Bookings</h5>
                    <p class="text-muted">You don't have any cancelled bookings.</p>
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach($cancelledBookings as $booking): ?>
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-secondary">
                        <div class="card-header bg-secondary bg-opacity-10">
                            <div class="d-flex justify-content-between align-items-center">
                                <strong><i class="fas fa-ticket-alt me-2"></i> <?= $booking['booking_reference'] ?></strong>
                                <span class="badge bg-secondary">
                                    <i class="fas fa-times-circle me-1"></i> Cancelled
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <small class="text-muted">Cottage</small>
                                    <p class="fw-bold mb-0"><?= $booking['cottage_name'] ?></p>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Total Amount</small>
                                    <p class="fw-bold mb-0 text-muted">₱<?= number_format($booking['total_amount'], 2) ?></p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <small class="text-muted">Check-in</small>
                                    <p class="mb-0"><i class="fas fa-calendar me-1"></i> <?= date('M d, Y', strtotime($booking['booking_date'])) ?></p>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Check-out</small>
                                    <p class="mb-0"><i class="fas fa-calendar me-1"></i> <?= date('M d, Y', strtotime($booking['booking_date'] . ' + ' . $booking['total_days'] . ' days')) ?></p>
                                </div>
                            </div>
                            <div class="alert alert-secondary text-center mb-0">
                                <i class="fas fa-info-circle me-2"></i> This booking has been cancelled.
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
.nav-tabs .nav-link {
    color: #555;
    border: none;
    padding: 12px 25px;
    font-weight: 500;
    transition: all 0.3s;
}

.nav-tabs .nav-link:hover {
    border: none;
    color: #1e88e5;
}

.nav-tabs .nav-link.active {
    color: #1e88e5;
    border-bottom: 3px solid #1e88e5;
    background: transparent;
}

.nav-tabs .nav-link .badge {
    font-size: 11px;
    padding: 3px 8px;
}

.card-header {
    background: transparent;
}
</style>