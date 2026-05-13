<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-user-circle fa-4x" style="color: #2c5f8a;"></i>
                <h5 class="mt-3"><?= session()->get('full_name') ?></h5>
                <p class="text-muted"><?= session()->get('username') ?></p>
                <hr>
                <div class="list-group">
                    <a href="/my-account" class="list-group-item list-group-item-action">Profile Information</a>
                    <a href="/change-password" class="list-group-item list-group-item-action active" style="background-color: #2c5f8a;">Change Password</a>
                    <a href="/my-bookings" class="list-group-item list-group-item-action">My Bookings</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Change Password</h5>
            </div>
            <div class="card-body">
                <form action="/update-password" method="post">
                    <div class="mb-3">
                        <label class="form-label">Current Password</label>
                        <input type="password" name="current_password" class="form-control" required>
                        <small class="text-muted">Enter your current password</small>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" name="new_password" class="form-control" required>
                        <small class="text-muted">Minimum 6 characters</small>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                        <small class="text-muted">Re-enter your new password</small>
                    </div>
                    
                    <div class="alert alert-info">
                        <strong>Password Requirements:</strong>
                        <ul class="mb-0 mt-2">
                            <li>Minimum 6 characters long</li>
                            <li>Use a mix of letters and numbers</li>
                        </ul>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Change Password
                    </button>
                    <a href="/my-account" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>