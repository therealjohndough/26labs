<?php
// Admin Edit Service
?>

<a href="/admin/services" class="btn-secondary" style="display: inline-block; margin-bottom: var(--space-6);">← Back to Services</a>

<?php if (isset($_GET['error'])): ?>
<div class="alert alert-error">Failed to update service. Check your input and try again.</div>
<?php endif; ?>

<form method="POST" action="/admin/services/<?php echo $service['id']; ?>/update" class="admin-form">
    <input type="hidden" name="<?php echo htmlspecialchars($csrf_field); ?>" value="<?php echo htmlspecialchars($csrf_token); ?>">

    <div class="form-group">
        <label for="title">Service Title *</label>
        <input type="text" id="title" name="title" required value="<?php echo htmlspecialchars($service['title']); ?>">
    </div>

    <div class="form-group">
        <label for="slug">Slug (URL) *</label>
        <input type="text" id="slug" name="slug" required pattern="^[a-z0-9-]+$" value="<?php echo htmlspecialchars($service['slug']); ?>">
        <span class="form-hint">Lowercase, hyphens only. Changing this breaks existing URLs.</span>
    </div>

    <div class="form-group">
        <label for="short_description">Short Description</label>
        <textarea id="short_description" name="short_description" rows="2"><?php echo htmlspecialchars($service['short_description'] ?? ''); ?></textarea>
        <span class="form-hint">Shown in the services list (max 500 chars)</span>
    </div>

    <div class="form-group">
        <label for="description">Full Description</label>
        <textarea id="description" name="description" rows="5"><?php echo htmlspecialchars($service['description'] ?? ''); ?></textarea>
        <span class="form-hint">Shown on the service detail page hero</span>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="icon">Icon / Symbol</label>
            <input type="text" id="icon" name="icon" maxlength="4" value="<?php echo htmlspecialchars($service['icon'] ?? ''); ?>" placeholder="◎">
        </div>
        <div class="form-group">
            <label for="position">Display Order</label>
            <input type="number" id="position" name="position" value="<?php echo intval($service['position'] ?? $service['order_index'] ?? 0); ?>" min="0" max="99">
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-primary">Update Service</button>
        <a href="/admin/services" class="btn-secondary">Cancel</a>
    </div>
</form>

<div class="danger-zone">
    <h3>Danger Zone</h3>
    <p>Permanently delete this service. This cannot be undone.</p>
    <form method="POST" action="/admin/services/<?php echo $service['id']; ?>/delete">
        <input type="hidden" name="<?php echo htmlspecialchars($csrf_field); ?>" value="<?php echo htmlspecialchars($csrf_token); ?>">
        <button type="submit" class="btn-danger" onclick="return confirm('Delete <?php echo htmlspecialchars($service['title']); ?>? This cannot be undone.')">Delete Service</button>
    </form>
</div>
