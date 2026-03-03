<?php
// Admin dashboard view
?>

<div class="dashboard-grid">
    <div class="dashboard-card">
        <div class="dashboard-kicker">Inbox</div>
        <h3>Recent Inquiries</h3>
        <p class="card-number"><?php echo count($inquiries) ?? 0; ?></p>
        <p class="card-text">Unread messages waiting for review.</p>
        <div class="dashboard-meta">
            <span>Unread</span>
            <strong><?php echo $unreadInquiries ?? 0; ?></strong>
        </div>
        <a href="/admin/inquiries" class="card-link">View All →</a>
    </div>

    <div class="dashboard-card">
        <div class="dashboard-kicker">Portfolio</div>
        <h3>Case Studies</h3>
        <p class="card-number"><?php echo count($caseStudies) ?? 0; ?></p>
        <p class="card-text">Published work available in the site portfolio.</p>
        <div class="dashboard-meta">
            <span>Status</span>
            <strong>Active</strong>
        </div>
        <a href="/admin/case-studies" class="card-link">Manage →</a>
    </div>

    <div class="dashboard-card">
        <div class="dashboard-kicker">Content</div>
        <h3>Blog Posts</h3>
        <p class="card-number"><?php echo count($posts) ?? 0; ?></p>
        <p class="card-text">Editorial entries currently available.</p>
        <div class="dashboard-meta">
            <span>Next move</span>
            <strong>Create</strong>
        </div>
        <a href="/admin/case-studies/create" class="card-link">Add New →</a>
    </div>

    <div class="dashboard-card">
        <div class="dashboard-kicker">Priority</div>
        <h3>Response Queue</h3>
        <p class="card-number"><?php echo ($unreadInquiries ?? 0) > 0 ? 'Hot' : 'Clear'; ?></p>
        <p class="card-text">
            <?php if (($unreadInquiries ?? 0) > 0): ?>
                New leads are waiting for follow-up.
            <?php else: ?>
                No unread inquiries right now.
            <?php endif; ?>
        </p>
        <div class="dashboard-meta">
            <span>Focus</span>
            <strong><?php echo ($unreadInquiries ?? 0) > 0 ? 'Inbox' : 'Pipeline'; ?></strong>
        </div>
        <a href="/admin/inquiries" class="card-link">Open Queue →</a>
    </div>
</div>

<div class="dashboard-actions">
    <a href="/admin/inquiries" class="btn-primary">Review Inquiries</a>
    <a href="/admin/case-studies/create" class="btn-secondary">New Case Study</a>
</div>

<section class="dashboard-section">
    <h3>Latest Inquiries</h3>
    <?php if ($inquiries): ?>
    <div class="table-scroll">
        <table class="dashboard-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inquiries as $inquiry): ?>
                <tr>
                    <td><?php echo htmlspecialchars($inquiry['name']); ?></td>
                    <td><?php echo htmlspecialchars($inquiry['email']); ?></td>
                    <td>
                        <?php if ($inquiry['read_at'] == null): ?>
                        <span class="badge-new">New</span>
                        <?php else: ?>
                        <span class="badge-read">Read</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo date('M d, Y', strtotime($inquiry['created_at'])); ?></td>
                    <td>
                        <a href="/admin/inquiries/<?php echo $inquiry['id']; ?>" class="btn-small">View</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <p class="no-data">No inquiries yet</p>
    <?php endif; ?>
</section>
