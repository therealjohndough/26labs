<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Admin'; ?> - 26 Labs</title>
    <link rel="stylesheet" href="/css/design_tokens.css">
    <link rel="stylesheet" href="/css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="admin-layout">
    <aside class="admin-sidebar" id="admin-sidebar">
        <div class="sidebar-header">
            <h1><a href="/admin/dashboard">26 Labs Admin</a></h1>
        </div>
        <nav class="sidebar-nav">
            <a href="/admin/dashboard" class="nav-item <?php echo strpos($_SERVER['REQUEST_URI'], '/dashboard') !== false ? 'active' : ''; ?>">
                <span>Dashboard</span>
            </a>
            <a href="/admin/case-studies" class="nav-item <?php echo strpos($_SERVER['REQUEST_URI'], '/case-studies') !== false ? 'active' : ''; ?>">
                <span>Case Studies</span>
            </a>
            <a href="/admin/inquiries" class="nav-item <?php echo strpos($_SERVER['REQUEST_URI'], '/inquiries') !== false ? 'active' : ''; ?>">
                <span>Inquiries</span>
                <?php if ($unreadInquiries ?? 0): ?>
                    <span class="badge"><?php echo $unreadInquiries; ?></span>
                <?php endif; ?>
            </a>
            <a href="/admin/services" class="nav-item <?php echo strpos($_SERVER['REQUEST_URI'], '/admin/services') !== false ? 'active' : ''; ?>">
                <span>Services</span>
            </a>
            <a href="/admin/logout" class="nav-item logout">
                <span>Logout</span>
            </a>
        </nav>
    </aside>

    <main class="admin-content">
        <header class="admin-header">
            <div class="admin-header-title">
                <button type="button" class="admin-mobile-toggle" id="admin-mobile-toggle" aria-expanded="false" aria-controls="admin-sidebar">
                    <span>Menu</span>
                </button>
                <h1><?php echo $title ?? 'Admin'; ?></h1>
            </div>
            <div class="admin-user">
                <span><?php echo htmlspecialchars($user['email'] ?? 'Admin'); ?></span>
            </div>
        </header>

        <div class="admin-body">
            <?php include __DIR__ . '/../' . $__view . '.php'; ?>
        </div>
    </main>

    <script src="/js/admin.js"></script>
</body>
</html>
