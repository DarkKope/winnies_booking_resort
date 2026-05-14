<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-hotel"></i> Manage Cottages</h5>
        <a href="/admin/add-cottage" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add New Cottage
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table data-table mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cottage Name</th>
                        <th>Description</th>
                        <th>Price/Day</th>
                        <th>Capacity</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($cottages as $cottage): ?>
                    <tr>
                        <td><?= $cottage['cottage_id'] ?></td>
                        <td><strong><?= $cottage['cottage_name'] ?></strong></td>
                        <td><?= substr($cottage['description'], 0, 50) ?>...</td>
                        <td>₱<?= number_format($cottage['price_per_day'], 2) ?></td>
                        <td><i class="fas fa-users"></i> <?= $cottage['capacity'] ?></td>
                        <td>
                            <span class="badge bg-<?= $cottage['status'] == 'available' ? 'success' : 'danger' ?>">
                                <?= ucfirst($cottage['status']) ?>
                            </span>
                        </td>
                        <td>
                            <a href="/admin/edit-cottage/<?= $cottage['cottage_id'] ?>" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="/admin/delete-cottage/<?= $cottage['cottage_id'] ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Delete this cottage?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>