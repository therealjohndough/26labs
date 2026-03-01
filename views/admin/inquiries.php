<?php
// Inquiries list view
?>

<?php if ($_GET['success'] ?? false): ?>
<div class="alert alert-success">
    Inquiry deleted successfully
</div>
<?php endif; ?>

<?php if ($inquiries): ?>
<table class="admin-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Company</th>
            <th>Status</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($inquiries as $inquiry): ?>
        <tr class="<?php echo $inquiry['read_at'] == null ? 'unread' : ''; ?>">
            <td><?php echo htmlspecialchars($inquiry['name']); ?></td>
            <td><?php echo htmlspecialchars($inquiry['email']); ?></td>
            <td><?php echo htmlspecialchars($inquiry['company'] ?? '-'); ?></td>
            <td>
                <?php if ($inquiry['read_at'] == null): ?>
                <span class="badge-new">New</span>
                <?php else: ?>
                <span class="badge-read">Read</span>
                <?php endif; ?>
            </td>
            <td><?php echo date('M d, Y H:i', strtotime($inquiry['created_at'])); ?></td>
            <td>
                <a href="/admin/inquiries/<?php echo $inquiry['id']; ?>" class="btn-small">View</a>
                <form method="POST" action="/admin/inquiries/<?php echo $inquiry['id']; ?>/delete" style="display: inline;">
                    <input type="hidden" name="<?php echo htmlspecialchars($csrf_field); ?>" value="<?php echo htmlspecialchars($csrf_token); ?>">
                    <button type="submit" class="btn-small btn-danger" onclick="return confirm('Delete this inquiry?')">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p class="no-data">No inquiries yet</p>
<?php endif; ?>
