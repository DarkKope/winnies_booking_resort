<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-calendar-check"></i> Manage Bookings</h5>
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
                        <th>Days</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($bookings as $booking): ?>
                    <tr>
                        <td><strong><?= $booking['booking_reference'] ?></strong></td>
                        <td>
                            <?= $booking['full_name'] ?><br>
                            <small class="text-muted"><?= $booking['customer_phone'] ?></small>
                        </td>
                        <td><?= $booking['cottage_name'] ?></td>
                        <td><?= date('M d, Y', strtotime($booking['booking_date'])) ?></td>
                        <td><?= $booking['total_days'] ?> day(s)</td>
                        <td>₱<?= number_format($booking['total_amount'], 2) ?></td>
                        <td>
                            <form action="/admin/update-booking-status" method="post" style="display:inline">
                                <input type="hidden" name="booking_id" value="<?= $booking['booking_id'] ?>">
                                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()" style="width: auto;">
                                    <option value="pending" <?= $booking['status'] == 'pending' ? 'selected' : ?>>Pending</option>
                                    <option value="confirmed" <?= $booking['status'] == 'confirmed' ? 'selected' : ?>>Confirmed</option>
                                    <option value="completed" <?= $booking['status'] == 'completed' ? 'selected' : ?>>Completed</option>
                                    <option value="cancelled" <?= $booking['status'] == 'cancelled' ? 'selected' : ?>>Cancelled</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <a href="/admin/view-booking/<?= $booking['booking_id'] ?>" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>