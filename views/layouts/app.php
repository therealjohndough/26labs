<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title ?? '26 Labs - Creative Agency'); ?></title>
    <?php if ($meta_description ?? ''): ?>
    <meta name="description" content="<?php echo htmlspecialchars($meta_description); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($meta_description); ?>">
    <?php endif; ?>
    <?php if ($og_image ?? ''): ?>
    <meta property="og:image" content="<?php echo htmlspecialchars($og_image); ?>">
    <?php endif; ?>
    <meta property="og:title" content="<?php echo htmlspecialchars($title ?? '26 Labs'); ?>">
    <meta property="og:type" content="website">
    <?php if ($json_ld ?? ''): ?>
    <script type="application/ld+json"><?php echo $json_ld; ?></script>
    <?php endif; ?>
    <link rel="preconnect" href="https://use.typekit.net" crossorigin>
    <link rel="stylesheet" href="https://use.typekit.net/snz1mha.css">
    <link rel="stylesheet" href="/css/design_tokens.css?v=8">
    <link rel="stylesheet" href="/css/tailwind.css?v=8">
    <link rel="stylesheet" href="/css/style.css?v=8">
    <link rel="stylesheet" href="https://unpkg.com/@hackernoon/pixel-icon-library@latest/fonts/iconfont.css">
</head>
<body>
    <div id="app">
        <?php include __DIR__ . '/navbar.php'; ?>
        
        <main>
            <?php include __DIR__ . '/../' . $__view . '.php'; ?>
        </main>

        <?php include __DIR__ . '/footer.php'; ?>
    </div>

    <script src="/js/main.js"></script>
</body>
</html>
