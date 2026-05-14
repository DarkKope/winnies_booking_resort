<!-- Stats Row -->
<div class="row">
    <div class="col-md-3">
        <div class="stat-card">
            <i class="fas fa-calendar-check"></i>
            <h3><?= $total_bookings ?? 0 ?></h3>
            <p>Total Bookings</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <i class="fas fa-clock"></i>
            <h3><?= $pending_bookings ?? 0 ?></h3>
            <p>Pending Approval</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <i class="fas fa-check-circle"></i>
            <h3><?= ($confirmed_bookings ?? 0) + ($completed_bookings ?? 0) ?></h3>
            <p>Confirmed/Completed</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <i class="fas fa-users"></i>
            <h3><?= $total_customers ?? 0 ?></h3>
            <p>Total Customers</p>
        </div>
    </div>
</div>

<!-- Revenue Card -->
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Revenue Overview</h5>
            </div>
            <div class="card-body text-center">
                <h2 class="text-success mb-0">₱<?= number_format($total_revenue ?? 0, 2) ?></h2>
                <p class="text-muted">Total Revenue from all bookings</p>
                <canvas id="revenueChart" height="200"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-chart-pie"></i> Booking Status</h5>
            </div>
            <div class="card-body">
                <canvas id="statusChart" height="250"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Recent Bookings -->
<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-list"></i> Recent Bookings</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table data-table mb-0">
                <thead>
                    <tr>
                        <th>Reference</th>
                        <th>Customer</th>
                        <th>Cottage</th>
                        <th>Check-in</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($recent_bookings)): ?>
                        <tr>
                            <td colspan="7" class="text-center">No bookings found</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($recent_bookings as $booking): ?>
                        <tr>
                            <td><strong><?= $booking['booking_reference'] ?? 'N/A' ?></strong></td>
                            <td><?= $booking['full_name'] ?? 'N/A' ?></td>
                            <td><?= $booking['cottage_name'] ?? 'N/A' ?></td>
                            <td><?= isset($booking['booking_date']) ? date('M d, Y', strtotime($booking['booking_date'])) : 'N/A' ?></td>
                            <td>₱<?= isset($booking['total_amount']) ? number_format($booking['total_amount'], 2) : '0.00' ?></td>
                            <td>
                                <?php
                                $status = $booking['status'] ?? 'pending';
                                $badgeClass = '';
                                if($status == 'pending') $badgeClass = 'badge-pending';
                                elseif($status == 'confirmed') $badgeClass = 'badge-confirmed';
                                elseif($status == 'completed') $badgeClass = 'badge-completed';
                                else $badgeClass = 'badge-cancelled';
                                ?>
                                <span class="<?= $badgeClass ?>"><?= ucfirst($status) ?></span>
                            </td>
                            <td>
                                <a href="/admin/view-booking/<?= $booking['booking_id'] ?? 0 ?>" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Status Chart
    const ctx = document.getElementById('statusChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Confirmed', 'Completed', 'Cancelled'],
            datasets: [{
                data: [
                    <?= $pending_bookings ?? 0 ?>, 
                    <?= $confirmed_bookings ?? 0 ?>, 
                    <?= $completed_bookings ?? 0 ?>, 
                    <?= $cancelled_bookings ?? 0 ?>
                ],
                backgroundColor: ['#fca311', '#00b4d8', '#4caf50', '#e63946'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>