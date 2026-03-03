<?php
// Admin Create Service
?>

<a href="/admin/services" class="btn-secondary" style="display: inline-block; margin-bottom: var(--space-6);">← Back to Services</a>

<?php if (isset($_GET['error'])): ?>
<div class="alert alert-error">Failed to create service. Check your input and try again.</div>
<?php endif; ?>

<form method="POST" action="/admin/services" class="admin-form">
    <input type="hidden" name="<?php echo htmlspecialchars($csrf_field); ?>" value="<?php echo htmlspecialchars($csrf_token); ?>">

    <div class="form-group">
        <label for="title">Service Title *</label>
        <input type="text" id="title" name="title" required placeholder="e.g. Brand Strategy">
    </div>

    <div class="form-group">
        <label for="slug">Slug (URL) *</label>
        <input type="text" id="slug" name="slug" required pattern="^[a-z0-9-]+$" placeholder="e.g. brand-strategy">
        <span class="form-hint">Lowercase, hyphens only. Used in /services/{slug}</span>
    </div>

    <div class="form-group">
        <label for="short_description">Short Description</label>
        <textarea id="short_description" name="short_description" rows="2" placeholder="Brief tagline shown in the services list (max 500 chars)"></textarea>
    </div>

    <div class="form-group">
        <label for="description">Full Description</label>
        <textarea id="description" name="description" rows="5" placeholder="Complete description shown on the service detail page"></textarea>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="icon">Icon / Symbol</label>
            <input type="text" id="icon" name="icon" maxlength="4" placeholder="◎">
            <span class="form-hint">Unicode symbol (◎ ◈ ⬡ ▽ ○ ◇)</span>
        </div>
        <div class="form-group">
            <label for="position">Display Order</label>
            <input type="number" id="position" name="position" value="0" min="0" max="99">
            <span class="form-hint">Lower number = shown first</span>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-primary">Create Service</button>
        <a href="/admin/services" class="btn-secondary">Cancel</a>
    </div>
</form>
