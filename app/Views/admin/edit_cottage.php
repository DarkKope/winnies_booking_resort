<!-- add_cottage.php -->
<h1 class="mb-4"><i class="fas fa-plus"></i> Add New Cottage</h1>

<div class="card">
    <div class="card-body">
        <form action="/admin/save-cottage" method="post">
            <div class="mb-3">
                <label>Cottage Name</label>
                <input type="text" name="cottage_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="3" required></textarea>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Price per Hour (₱)</label>
                    <input type="number" step="0.01" name="price_per_hour" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Capacity (persons)</label>
                    <input type="number" name="capacity" class="form-control" required>
                </div>
            </div>
            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="available">Available</option>
                    <option value="maintenance">Maintenance</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save Cottage</button>
            <a href="/admin/cottages" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>