<?php
// Edit case study view
?>

<form method="POST" action="/admin/case-studies/<?php echo $caseStudy['id']; ?>/update" class="admin-form">
    <input type="hidden" name="<?php echo htmlspecialchars($csrf_field); ?>" value="<?php echo htmlspecialchars($csrf_token); ?>">
    
    <div class="form-group">
        <label for="title">Title *</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($caseStudy['title']); ?>" required>
    </div>

    <div class="form-group">
        <label for="slug">Slug (URL) *</label>
        <input type="text" id="slug" name="slug" required pattern="^[a-z0-9-]+$" value="<?php echo htmlspecialchars($caseStudy['slug'] ?? ''); ?>">
        <span class="form-hint">Lowercase, hyphens only. Used in /work/{slug}</span>
    </div>

    <div class="form-group">
        <label for="client_name">Client Name *</label>
        <input type="text" id="client_name" name="client_name" value="<?php echo htmlspecialchars($caseStudy['client_name']); ?>" required>
    </div>

    <div class="form-group">
        <label for="description">Description *</label>
        <textarea id="description" name="description" rows="5" required><?php echo htmlspecialchars($caseStudy['description']); ?></textarea>
    </div>

    <div class="form-group">
        <label for="tags">Tags (comma-separated)</label>
        <input type="text" id="tags" name="tags" value="<?php echo htmlspecialchars($caseStudy['tags'] ?? ''); ?>">
    </div>

    <div class="form-group">
        <label for="services_provided">Services Provided</label>
        <textarea id="services_provided" name="services_provided" rows="3"><?php echo htmlspecialchars($caseStudy['services_provided'] ?? ''); ?></textarea>
    </div>

    <div class="form-group">
        <label for="hero_image">Hero Image URL</label>
        <input type="text" id="hero_image" name="hero_image" value="<?php echo htmlspecialchars($caseStudy['hero_image'] ?? ''); ?>" placeholder="/uploads/case-studies/farm-fresh-branding/hero.png">
        <span class="form-hint">Use a site path or full URL for the hero image shown at the top of the case study.</span>
    </div>

    <div class="form-group">
        <label for="gallery_images">Gallery Images (JSON array)</label>
        <textarea id="gallery_images" name="gallery_images" rows="4"><?php echo htmlspecialchars($caseStudy['gallery_images'] ?? ''); ?></textarea>
        <span class="form-hint">Paste a JSON array of image paths for the detail page gallery.</span>
    </div>

    <div class="form-group">
        <label for="year">Year</label>
        <input type="number" id="year" name="year" value="<?php echo htmlspecialchars($caseStudy['year']); ?>">
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-primary">Update Case Study</button>
        <a href="/admin/case-studies" class="btn-secondary">Cancel</a>
    </div>
</form>
