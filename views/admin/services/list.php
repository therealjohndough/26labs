<?php
/**
 * Admin Services List View
 */
$pageTitle = $title ?? 'Services';
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

    <main class="mx-auto max-w-6xl px-6 py-12">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">Services</h1>
                <p class="mt-2 text-text-secondary">Manage the 6 core service offerings</p>
            </div>
            <a href="/admin/services/create" class="rounded bg-accent px-6 py-2 font-semibold text-black transition hover:bg-opacity-90">
                + New Service
            </a>
        </div>

        <?php if (isset($_GET['success'])): ?>
            <div class="mb-6 rounded bg-green-900/30 border border-green-700 px-4 py-3 text-green-200">
                Service updated successfully.
            </div>
        <?php endif; ?>

        <div class="overflow-x-auto rounded border border-border">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-border bg-black/50">
                        <th class="px-6 py-4 font-semibold">#</th>
                        <th class="px-6 py-4 font-semibold">Service Name</th>
                        <th class="px-6 py-4 font-semibold">Slug</th>
                        <th class="px-6 py-4 font-semibold">Position</th>
                        <th class="px-6 py-4 font-semibold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($services as $index => $service): ?>
                        <tr class="border-b border-border/50 hover:bg-black/30 transition">
                            <td class="px-6 py-4 text-text-muted"><?php echo $index + 1; ?></td>
                            <td class="px-6 py-4 font-medium"><?php echo htmlspecialchars($service['title']); ?></td>
                            <td class="px-6 py-4 text-text-secondary"><?php echo htmlspecialchars($service['slug']); ?></td>
                            <td class="px-6 py-4 text-sm text-text-muted"><?php echo $service['position']; ?></td>
                            <td class="px-6 py-4 text-right">
                                <a href="/admin/services/<?php echo $service['id']; ?>/edit" class="inline-block text-accent hover:underline mr-4">
                                    Edit
                                </a>
                                <form method="POST" action="/admin/services/<?php echo $service['id']; ?>/delete" class="inline-block" onsubmit="return confirm('Delete this service?');">
                                    <input type="hidden" name="<?php echo htmlspecialchars($csrf_field); ?>" value="<?php echo htmlspecialchars($csrf_token); ?>">
                                    <button type="submit" class="text-red-400 hover:text-red-300 hover:underline">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if (empty($services)): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-text-muted">
                                No services found. <a href="/admin/services/create" class="text-accent hover:underline">Create one</a>.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
