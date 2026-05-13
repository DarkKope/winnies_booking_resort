<div class="row">
    <div class="col-md-3 mb-4">
        <div class="stat-card">
            <i class="fas fa-calendar-check"></i>
            <h3><?= isset($stats['total_bookings']) ? $stats['total_bookings'] : 0 ?></h3>
            <p>Total Bookings</p>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="stat-card">
            <i class="fas fa-clock"></i>
            <h3><?= isset($stats['pending']) ? $stats['pending'] : 0 ?></h3>
            <p>Pending</p>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="stat-card">
            <i class="fas fa-check-circle"></i>
            <h3><?= isset($stats['confirmed']) ? $stats['confirmed'] : 0 ?></h3>
            <p>Confirmed</p>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="stat-card">
            <i class="fas fa-check-double"></i>
            <h3><?= isset($stats['completed']) ? $stats['completed'] : 0 ?></h3>
            <p>Completed</p>
        </div>
    </div>
</div>

<!-- Clickable Gallery Section -->
<div class="card mb-5">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-images me-2"></i> Resort Gallery</h5>
        <p class="text-muted small mb-0">Click on any image to book this cottage</p>
    </div>
    <div class="card-body">
        <div class="row gallery">
            <div class="col-md-4 mb-3">
                <a href="/book/1" class="gallery-link">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=400&h=300&fit=crop" alt="Beach Front Kubo">
                        <div class="gallery-overlay">
                            <span>🏖️ Beach Front Kubo</span>
                            <small>Starting at ₱3,000/night</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="/book/2" class="gallery-link">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=400&h=300&fit=crop" alt="Family Villa">
                        <div class="gallery-overlay">
                            <span>👨‍👩‍👧‍👦 Family Villa</span>
                            <small>Starting at ₱8,000/night</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="/book/3" class="gallery-link">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=400&h=300&fit=crop" alt="Couple's Paradise">
                        <div class="gallery-overlay">
                            <span>💑 Couple's Paradise</span>
                            <small>Starting at ₱5,000/night</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="/book/4" class="gallery-link">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=400&h=300&fit=crop" alt="Function Hall">
                        <div class="gallery-overlay">
                            <span>🎉 Function Hall</span>
                            <small>Starting at ₱15,000/night</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="/book/5" class="gallery-link">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1540541338287-41700207dee6?w=400&h=300&fit=crop" alt="Deluxe Suite">
                        <div class="gallery-overlay">
                            <span>⭐ Deluxe Suite</span>
                            <small>Starting at ₱7,000/night</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="/book/6" class="gallery-link">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=400&h=300&fit=crop" alt="Premium Beach House">
                        <div class="gallery-overlay">
                            <span>🏆 Premium Beach House</span>
                            <small>Starting at ₱12,000/night</small>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6 mb-4">
        <div class="card text-center">
            <div class="card-body py-5">
                <i class="fas fa-search fa-3x mb-3" style="color: #1e88e5;"></i>
                <h4>Browse All Cottages</h4>
                <p class="text-muted">Explore our luxurious cottages and find your perfect getaway</p>
                <a href="/cottages" class="btn btn-primary mt-2">
                    Browse Now <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card text-center">
            <div class="card-body py-5">
                <i class="fas fa-calendar-alt fa-3x mb-3" style="color: #8b5a2b;"></i>
                <h4>My Bookings</h4>
                <p class="text-muted">View and manage all your existing reservations</p>
                <a href="/my-bookings" class="btn btn-outline-brown mt-2">
                    View Bookings <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</div>