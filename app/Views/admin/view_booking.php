<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Booking Details' ?> - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }
        .card-header {
            background: white;
            border-bottom: 1px solid #e0e0e0;
            border-radius: 15px 15px 0 0 !important;
            padding: 15px 20px;
        }
        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .status-pending { background: #ffc107; color: #000; }
        .status-confirmed { background: #28a745; color: #fff; }
        .status-completed { background: #17a2b8; color: #fff; }
        .status-cancelled { background: #dc3545; color: #fff; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0">
                <div class="sidebar" style="background: #2c3e50; min-height: 100vh; color: white;">
                    <div class="brand p-3 text-center">
                        <i class="fas fa-umbrella-beach fa-2x"></i>
                        <h4>Winnie's Resort</h4>
                        <small>Admin Panel</small>
                    </div>
                    <nav class="nav flex-column mt-3">
                        <a class="nav-link text-white" href="/admin/dashboard">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                        <a class="nav-link text-white" href="/admin/cottages">
                            <i class="fas fa-hotel"></i> Cottages
                        </a>
                        <a class="nav-link text-white" href="/admin/bookings">
                            <i class="fas fa-calendar-check"></i> Bookings
                        </a>
                        <a class="nav-link text-danger" href="/logout">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </nav>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10">
                <div class="p-4">
                    <h1 class="mb-4"><i class="fas fa-receipt"></i> Booking Details</h1>
                    
                    <?php if(session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if(session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Booking Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Reference Number:</strong><br> <?= $booking['booking_reference'] ?? 'N/A' ?></p>
                                            <p><strong>Status:</strong><br> 
                                                <span class="status-badge status-<?= $booking['status'] ?? 'pending' ?>">
                                                    <?= ucfirst($booking['status'] ?? 'Pending') ?>
                                                </span>
                                            </p>
                                            <p><strong>Booking Date:</strong><br> <?= isset($booking['created_at']) ? date('F d, Y h:i A', strtotime($booking['created_at'])) : 'N/A' ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Check-in Date:</strong><br> <?= isset($booking['booking_date']) ? date('F d, Y', strtotime($booking['booking_date'])) : 'N/A' ?></p>
                                            <p><strong>Check-out Date:</strong><br> <?= isset($booking['booking_date']) && isset($booking['total_days']) ? date('F d, Y', strtotime($booking['booking_date'] . ' + ' . $booking['total_days'] . ' days')) : 'N/A' ?></p>
                                            <p><strong>Total Days:</strong><br> <?= $booking['total_days'] ?? 0 ?> day(s)</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Cottage Details</h6>
                                            <p><strong>Cottage:</strong> <?= $booking['cottage_name'] ?? 'N/A' ?><br>
                                               <strong>Price per day:</strong> ₱<?= isset($booking['price_per_day']) ? number_format($booking['price_per_day'], 2) : '0.00' ?><br>
                                               <strong>Capacity:</strong> <?= $booking['capacity'] ?? 0 ?> persons</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Payment Details</h6>
                                            <p><strong>Total Amount:</strong> ₱<?= isset($booking['total_amount']) ? number_format($booking['total_amount'], 2) : '0.00' ?><br>
                                               <strong>Payment Method:</strong> <?= ucfirst($booking['payment_method'] ?? 'Not set') ?><br>
                                               <strong>Payment Reference:</strong> <?= $booking['payment_reference'] ?? 'N/A' ?></p>
                                        </div>
                                    </div>
                                    
                                    <?php if(!empty($booking['special_requests'])): ?>
                                    <div class="alert alert-info mt-3">
                                        <strong>Special Requests:</strong><br>
                                        <?= nl2br(htmlspecialchars($booking['special_requests'])) ?>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <?php if(!empty($booking['admin_notes'])): ?>
                                    <div class="alert alert-secondary mt-3">
                                        <strong>Admin Notes:</strong><br>
                                        <?= nl2br(htmlspecialchars($booking['admin_notes'])) ?>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <?php if(!empty($booking['approved_by_name'])): ?>
                                    <div class="alert alert-success mt-3">
                                        <strong>Approved By:</strong> <?= $booking['approved_by_name'] ?><br>
                                        <strong>Approved At:</strong> <?= isset($booking['approved_at']) ? date('F d, Y h:i A', strtotime($booking['approved_at'])) : 'N/A' ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Customer Information</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Name:</strong><br> <?= $booking['full_name'] ?? 'N/A' ?></p>
                                    <p><strong>Email:</strong><br> <?= $booking['email'] ?? 'N/A' ?></p>
                                    <p><strong>Phone:</strong><br> <?= $booking['phone'] ?? 'N/A' ?></p>
                                    <p><strong>Username:</strong><br> <?= $booking['username'] ?? 'N/A' ?></p>
                                </div>
                            </div>
                            
                            <?php if(isset($booking['status']) && $booking['status'] == 'pending'): ?>
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h5 class="mb-0">Confirm Booking</h5>
                                </div>
                                <div class="card-body">
                                    <form action="/admin/confirm-booking" method="post">
                                        <input type="hidden" name="booking_id" value="<?= $booking['booking_id'] ?? '' ?>">
                                        
                                        <div class="mb-3">
                                            <label>Payment Method</label>
                                            <select name="payment_method" class="form-control" required>
                                                <option value="cash">Cash</option>
                                                <option value="gcash">GCash</option>
                                                <option value="bank_transfer">Bank Transfer</option>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label>Payment Reference (if any)</label>
                                            <input type="text" name="payment_reference" class="form-control" placeholder="GCash reference or transaction ID">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label>Admin Notes</label>
                                            <textarea name="admin_notes" class="form-control" rows="3" placeholder="Any notes for the customer..."></textarea>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-success w-100 mb-2">
                                            <i class="fas fa-check-circle"></i> Confirm Booking
                                        </button>
                                    </form>
                                    
                                    <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#cancelModal">
                                        <i class="fas fa-times-circle"></i> Cancel Booking
                                    </button>
                                </div>
                            </div>
                            <?php elseif(isset($booking['status']) && $booking['status'] == 'confirmed'): ?>
                            <div class="card mt-3">
                                <div class="card-body">
                                    <a href="/admin/complete-booking/<?= $booking['booking_id'] ?? '' ?>" 
                                       class="btn btn-info w-100 mb-2"
                                       onclick="return confirm('Mark this booking as completed?')">
                                        <i class="fas fa-check-double"></i> Mark as Completed
                                    </a>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <div class="card mt-3">
                                <div class="card-body">
                                    <a href="/admin/bookings" class="btn btn-secondary w-100">
                                        <i class="fas fa-arrow-left"></i> Back to Bookings
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Cancel Modal -->
    <div class="modal fade" id="cancelModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/admin/cancel-booking/<?= $booking['booking_id'] ?? '' ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Cancel Booking</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to cancel this booking?</p>
                        <div class="mb-3">
                            <label>Cancellation Reason</label>
                            <textarea name="cancel_reason" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Confirm Cancellation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>