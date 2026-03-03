<?php
// Admin Services List
?>

<div class="dashboard-actions">
    <a href="/admin/services/create" class="btn-primary">+ New Service</a>
</div>

<?php if (isset($_GET['success'])): ?>
<div class="alert alert-success">Service saved successfully.</div>
<?php endif; ?>

<div class="table-scroll">
    <table class="admin-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Short Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($services): ?>
            <?php foreach ($services as $i => $service): ?>
            <tr>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo htmlspecialchars($service['title']); ?></td>
                <td><?php echo htmlspecialchars($service['slug']); ?></td>
                <td><?php echo htmlspecialchars(substr($service['short_description'] ?? '', 0, 60)); ?>...</td>
                <td>
                    <a href="/admin/services/<?php echo $service['id']; ?>/edit" class="btn-small">Edit</a>
                    <form method="POST" action="/admin/services/<?php echo $service['id']; ?>/delete" style="display: inline;">
                        <input type="hidden" name="<?php echo htmlspecialchars($csrf_field); ?>" value="<?php echo htmlspecialchars($csrf_token); ?>">
                        <button type="submit" class="btn-small btn-danger" onclick="return confirm('Delete this service?')">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr><td colspan="5" class="no-data">No services yet.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
