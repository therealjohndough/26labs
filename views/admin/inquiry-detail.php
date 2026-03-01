<?php
// Inquiry detail view
?>

<div class="inquiry-detail">
    <div class="inquiry-header">
        <h2><?php echo htmlspecialchars($inquiry['name']); ?></h2>
        <a href="/admin/inquiries" class="btn-secondary">← Back to Inquiries</a>
    </div>

    <div class="inquiry-body">
        <div class="inquiry-info">
            <p><strong>Email:</strong> <a href="mailto:<?php echo htmlspecialchars($inquiry['email']); ?>"><?php echo htmlspecialchars($inquiry['email']); ?></a></p>
            <p><strong>Company:</strong> <?php echo htmlspecialchars($inquiry['company'] ?? 'N/A'); ?></p>
            <p><strong>Date:</strong> <?php echo date('F d, Y \a\t g:i A', strtotime($inquiry['created_at'])); ?></p>
            <?php if ($inquiry['budget']): ?>
            <p><strong>Budget Range:</strong> <?php echo htmlspecialchars($inquiry['budget']); ?></p>
            <?php endif; ?>
            <?php if ($inquiry['services']): ?>
            <p><strong>Services Interested:</strong> <?php echo htmlspecialchars($inquiry['services']); ?></p>
            <?php endif; ?>
        </div>

        <div class="inquiry-message">
            <h3>Message</h3>
            <p><?php echo nl2br(htmlspecialchars($inquiry['message'])); ?></p>
        </div>

        <div class="inquiry-actions">
            <form method="POST" action="/admin/inquiries/<?php echo $inquiry['id']; ?>/delete" style="display: inline;">
                <input type="hidden" name="<?php echo htmlspecialchars($csrf_field); ?>" value="<?php echo htmlspecialchars($csrf_token); ?>">
                <button type="submit" class="btn-danger" onclick="return confirm('Delete this inquiry?')">Delete Inquiry</button>
            </form>
        </div>
    </div>
</div>

<style>
.inquiry-detail {
    max-width: 800px;
}

.inquiry-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.inquiry-info {
    background: #f9f9f9;
    padding: 20px;
    border-radius: 4px;
    margin-bottom: 30px;
}

.inquiry-info p {
    margin-bottom: 10px;
}

.inquiry-info a {
    color: #2d5016;
}

.inquiry-message {
    margin-bottom: 30px;
}

.inquiry-message h3 {
    margin-bottom: 15px;
}

.inquiry-message p {
    line-height: 1.6;
    color: #555;
}

.inquiry-actions {
    padding-top: 20px;
    border-top: 1px solid #eee;
}
</style>
