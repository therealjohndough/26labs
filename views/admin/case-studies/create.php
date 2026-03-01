<?php
// Create case study view
?>

<form method="POST" action="/admin/case-studies" class="admin-form">
    <input type="hidden" name="<?php echo htmlspecialchars($csrf_field); ?>" value="<?php echo htmlspecialchars($csrf_token); ?>">
    
    <div class="form-group">
        <label for="title">Title *</label>
        <input type="text" id="title" name="title" required>
    </div>

    <div class="form-group">
        <label for="client_name">Client Name *</label>
        <input type="text" id="client_name" name="client_name" required>
    </div>

    <div class="form-group">
        <label for="description">Description *</label>
        <textarea id="description" name="description" rows="5" required></textarea>
    </div>

    <div class="form-group">
        <label for="tags">Tags (comma-separated)</label>
        <input type="text" id="tags" name="tags" placeholder="e.g. branding, web, digital">
    </div>

    <div class="form-group">
        <label for="services_provided">Services Provided</label>
        <textarea id="services_provided" name="services_provided" rows="3" placeholder="e.g. Brand Strategy, Visual Identity"></textarea>
    </div>

    <div class="form-group">
        <label for="year">Year</label>
        <input type="number" id="year" name="year" value="<?php echo date('Y'); ?>">
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-primary">Create Case Study</button>
        <a href="/admin/case-studies" class="btn-secondary">Cancel</a>
    </div>
</form>
