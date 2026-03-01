<?php
/**
 * Admin Create Service View
 */
$pageTitle = $title ?? 'Create Service';
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
            <h1 class="mt-4 text-3xl font-bold">Create Service</h1>
            <p class="mt-2 text-text-secondary">Add a new service to the Case Study Labs offering</p>
        </div>

        <?php if (isset($_GET['error'])): ?>
            <div class="mb-6 rounded bg-red-900/30 border border-red-700 px-4 py-3 text-red-200">
                Failed to create service. Please check your input and try again.
            </div>
        <?php endif; ?>

        <form method="POST" action="/admin/services" class="space-y-6">
            <input type="hidden" name="<?php echo htmlspecialchars($csrf_field); ?>" value="<?php echo htmlspecialchars($csrf_token); ?>">

            <div>
                <label for="title" class="block text-sm font-medium mb-2">Service Title</label>
                <input type="text" id="title" name="title" required class="w-full rounded border border-border bg-black/50 px-4 py-2 text-white placeholder-text-muted focus:border-accent focus:outline-none">
                <p class="mt-1 text-xs text-text-muted">e.g., "Brand Strategy", "Web Design"</p>
            </div>

            <div>
                <label for="slug" class="block text-sm font-medium mb-2">Slug (URL)</label>
                <input type="text" id="slug" name="slug" required pattern="^[a-z0-9-]+$" class="w-full rounded border border-border bg-black/50 px-4 py-2 text-white placeholder-text-muted focus:border-accent focus:outline-none">
                <p class="mt-1 text-xs text-text-muted">e.g., "brand-strategy", "web-design" (lowercase, hyphens only)</p>
            </div>

            <div>
                <label for="short_description" class="block text-sm font-medium mb-2">Short Description</label>
                <textarea id="short_description" name="short_description" rows="2" class="w-full rounded border border-border bg-black/50 px-4 py-2 text-white placeholder-text-muted focus:border-accent focus:outline-none"></textarea>
                <p class="mt-1 text-xs text-text-muted">Brief description for service listing (max 500 chars)</p>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium mb-2">Full Description</label>
                <textarea id="description" name="description" rows="6" class="w-full rounded border border-border bg-black/50 px-4 py-2 text-white placeholder-text-muted focus:border-accent focus:outline-none"></textarea>
                <p class="mt-1 text-xs text-text-muted">Complete description for service detail page</p>
            </div>

            <div>
                <label for="icon" class="block text-sm font-medium mb-2">Icon/Symbol</label>
                <input type="text" id="icon" name="icon" maxlength="2" class="w-full rounded border border-border bg-black/50 px-4 py-2 text-white placeholder-text-muted focus:border-accent focus:outline-none">
                <p class="mt-1 text-xs text-text-muted">Unicode symbol (e.g., "◎", "◈", "⬡")</p>
            </div>

            <div>
                <label for="position" class="block text-sm font-medium mb-2">Position</label>
                <input type="number" id="position" name="position" value="0" class="w-full rounded border border-border bg-black/50 px-4 py-2 text-white placeholder-text-muted focus:border-accent focus:outline-none">
                <p class="mt-1 text-xs text-text-muted">Display order (0-6)</p>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="rounded bg-accent px-6 py-2 font-semibold text-black transition hover:bg-opacity-90">
                    Create Service
                </button>
                <a href="/admin/services" class="rounded border border-border px-6 py-2 font-semibold text-white transition hover:bg-black/50">
                    Cancel
                </a>
            </div>
        </form>
    </main>
</body>
</html>
