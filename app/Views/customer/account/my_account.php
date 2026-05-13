<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-user-circle fa-4x" style="color: #2c5f8a;"></i>
                <h5 class="mt-3"><?= session()->get('full_name') ?></h5>
                <p class="text-muted"><?= session()->get('username') ?></p>
                <hr>
                <div class="list-group">
                    <a href="/my-account" class="list-group-item list-group-item-action active" style="background-color: #2c5f8a;">Profile Information</a>
                    <a href="/change-password" class="list-group-item list-group-item-action">Change Password</a>
                    <a href="/my-bookings" class="list-group-item list-group-item-action">My Bookings</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Edit Profile Information</h5>
            </div>
            <div class="card-body">
                <form action="/update-account" method="post">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" value="<?= $user['username'] ?>" disabled>
                        <small class="text-muted">Username cannot be changed</small>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="full_name" class="form-control" value="<?= $user['full_name'] ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" value="<?= $user['phone'] ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <input type="text" class="form-control" value="<?= ucfirst($user['role']) ?>" disabled>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Account
                    </button>
                </form>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0">Account Information</h5>
            </div>
            <div class="card-body">
                <?php 
                $db = \Config\Database::connect();
                $total = $db->query("SELECT COUNT(*) as count FROM bookings WHERE user_id = ?", [session()->get('user_id')])->getRowArray();
                ?>
                <p><strong>Member since:</strong> <?= date('F d, Y', strtotime($user['created_at'])) ?></p>
                <p><strong>Total Bookings:</strong> <?= $total['count'] ?? 0 ?></p>
            </div>
        </div>
    </div>
</div>