<?php
// Case studies list view
?>

<div class="admin-controls">
    <a href="/admin/case-studies/create" class="btn-primary">+ New Case Study</a>
</div>

<?php if ($_GET['success'] ?? false): ?>
<div class="alert alert-success">
    Case study saved successfully
</div>
<?php endif; ?>

<?php if ($caseStudies): ?>
<table class="admin-table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Client</th>
            <th>Year</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($caseStudies as $case): ?>
        <tr>
            <td><?php echo htmlspecialchars($case['title']); ?></td>
            <td><?php echo htmlspecialchars($case['client_name']); ?></td>
            <td><?php echo htmlspecialchars($case['year']); ?></td>
            <td>
                <a href="/admin/case-studies/<?php echo $case['id']; ?>/edit" class="btn-small">Edit</a>
                <form method="POST" action="/admin/case-studies/<?php echo $case['id']; ?>/delete" style="display: inline;">
                    <input type="hidden" name="<?php echo htmlspecialchars($csrf_field); ?>" value="<?php echo htmlspecialchars($csrf_token); ?>">
                    <button type="submit" class="btn-small btn-danger" onclick="return confirm('Delete this case study?')">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p class="no-data">No case studies yet</p>
<?php endif; ?>
