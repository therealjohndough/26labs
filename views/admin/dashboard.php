<?php
// Admin dashboard view
?>

<div class="dashboard-grid">
    <div class="dashboard-card">
        <h3>Recent Inquiries</h3>
        <p class="card-number"><?php echo count($inquiries) ?? 0; ?></p>
        <p class="card-text">Unread: <?php echo $unreadInquiries ?? 0; ?></p>
        <a href="/admin/inquiries" class="card-link">View All →</a>
    </div>

    <div class="dashboard-card">
        <h3>Case Studies</h3>
        <p class="card-number"><?php echo count($caseStudies) ?? 0; ?></p>
        <a href="/admin/case-studies" class="card-link">Manage →</a>
    </div>

    <div class="dashboard-card">
        <h3>Blog Posts</h3>
        <p class="card-number"><?php echo count($posts) ?? 0; ?></p>
    </div>
</div>

<section class="dashboard-section">
    <h3>Latest Inquiries</h3>
    <?php if ($inquiries): ?>
    <table class="dashboard-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($inquiries as $inquiry): ?>
            <tr>
                <td><?php echo htmlspecialchars($inquiry['name']); ?></td>
                <td><?php echo htmlspecialchars($inquiry['email']); ?></td>
                <td><?php echo date('M d, Y', strtotime($inquiry['created_at'])); ?></td>
                <td>
                    <a href="/admin/inquiries/<?php echo $inquiry['id']; ?>" class="btn-small">View</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p class="no-data">No inquiries yet</p>
    <?php endif; ?>
</section>
