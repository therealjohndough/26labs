<?php
/**
 * Admin Edit Service View
 */
$pageTitle = $title ?? 'Edit Service';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?> - Case Study Labs Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white">
    <?php require_once __DIR__ . '/../admin-nav.php'; ?>

    <main class="mx-auto max-w-2xl px-6 py-12">
        <div class="mb-8">
            <a href="/admin/services" class="text-accent hover:underline">&larr; Back to Services</a>
            <h1 class="mt-4 text-3xl font-bold">Edit Service</h1>
            <p class="mt-2 text-text-secondary">Update the service: <?php echo htmlspecialchars($service['title']); ?></p>
        </div>

        <?php if (isset($_GET['error'])): ?>
            <div class="mb-6 rounded bg-red-900/30 border border-red-700 px-4 py-3 text-red-200">
                Failed to update service. Please check your input and try again.
            </div>
        <?php endif; ?>

        <form method="POST" action="/admin/services/<?php echo $service['id']; ?>/update" class="space-y-6">
            <input type="hidden" name="<?php echo htmlspecialchars($csrf_field); ?>" value="<?php echo htmlspecialchars($csrf_token); ?>">

            <div>
                <label for="title" class="block text-sm font-medium mb-2">Service Title</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($service['title']); ?>" required class="w-full rounded border border-border bg-black/50 px-4 py-2 text-white placeholder-text-muted focus:border-accent focus:outline-none">
            </div>

            <div>
                <label for="slug" class="block text-sm font-medium mb-2">Slug (URL)</label>
                <input type="text" id="slug" name="slug" value="<?php echo htmlspecialchars($service['slug']); ?>" required pattern="^[a-z0-9-]+$" class="w-full rounded border border-border bg-black/50 px-4 py-2 text-white placeholder-text-muted focus:border-accent focus:outline-none">
                <p class="mt-1 text-xs text-text-muted">Lowercase, hyphens only. Used in URLs like /services/{slug}</p>
            </div>

            <div>
                <label for="short_description" class="block text-sm font-medium mb-2">Short Description</label>
                <textarea id="short_description" name="short_description" rows="2" class="w-full rounded border border-border bg-black/50 px-4 py-2 text-white placeholder-text-muted focus:border-accent focus:outline-none"><?php echo htmlspecialchars($service['short_description'] ?? ''); ?></textarea>
                <p class="mt-1 text-xs text-text-muted">Brief description for service listing</p>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium mb-2">Full Description</label>
                <textarea id="description" name="description" rows="6" class="w-full rounded border border-border bg-black/50 px-4 py-2 text-white placeholder-text-muted focus:border-accent focus:outline-none"><?php echo htmlspecialchars($service['description'] ?? ''); ?></textarea>
                <p class="mt-1 text-xs text-text-muted">Complete description for service detail page</p>
            </div>

            <div>
                <label for="icon" class="block text-sm font-medium mb-2">Icon/Symbol</label>
                <input type="text" id="icon" name="icon" maxlength="2" value="<?php echo htmlspecialchars($service['icon'] ?? ''); ?>" class="w-full rounded border border-border bg-black/50 px-4 py-2 text-white placeholder-text-muted focus:border-accent focus:outline-none">
                <p class="mt-1 text-xs text-text-muted">Unicode symbol for visual representation</p>
            </div>

            <div>
                <label for="position" class="block text-sm font-medium mb-2">Position</label>
                <input type="number" id="position" name="position" value="<?php echo intval($service['position']); ?>" class="w-full rounded border border-border bg-black/50 px-4 py-2 text-white placeholder-text-muted focus:border-accent focus:outline-none">
                <p class="mt-1 text-xs text-text-muted">Display order on services page</p>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="rounded bg-accent px-6 py-2 font-semibold text-black transition hover:bg-opacity-90">
                    Update Service
                </button>
                <a href="/admin/services" class="rounded border border-border px-6 py-2 font-semibold text-white transition hover:bg-black/50">
                    Cancel
                </a>
            </div>
        </form>

        <!-- Delete Section -->
        <div class="mt-12 border-t border-border/50 pt-8">
            <h2 class="text-xl font-bold mb-4 text-red-400">Danger Zone</h2>
            <p class="text-text-secondary mb-4">Delete this service permanently.</p>
            <form method="POST" action="/admin/services/<?php echo $service['id']; ?>/delete" onsubmit="return confirm('Are you absolutely sure? This cannot be undone.');">
                <input type="hidden" name="<?php echo htmlspecialchars($csrf_field); ?>" value="<?php echo htmlspecialchars($csrf_token); ?>">
                <button type="submit" class="rounded bg-red-900/50 border border-red-700 px-6 py-2 font-semibold text-red-300 transition hover:bg-red-900">
                    Delete Service
                </button>
            </form>
        </div>
    </main>
</body>
</html>
