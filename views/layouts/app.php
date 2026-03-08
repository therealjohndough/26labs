<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        $pageTitle = $title ?? '26 Labs - Creative Agency';
        $metaDescriptionContent = $meta_description ?? '';
        $canonicalUrl = $canonical_url ?? '';
        $robots = $meta_robots ?? 'index,follow';
        $ogType = $og_type ?? 'website';
        $twitterCard = $twitter_card ?? (($ogType === 'article') ? 'summary_large_image' : 'summary');
    ?>
    <title><?php echo htmlspecialchars($pageTitle); ?></title>

    <?php if ($metaDescriptionContent !== ''): ?>
    <meta name="description" content="<?php echo htmlspecialchars($metaDescriptionContent); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($metaDescriptionContent); ?>">
    <?php endif; ?>

    <?php if ($canonicalUrl !== ''): ?>
    <link rel="canonical" href="<?php echo htmlspecialchars($canonicalUrl); ?>">
    <meta property="og:url" content="<?php echo htmlspecialchars($canonicalUrl); ?>">
    <?php endif; ?>

    <meta name="robots" content="<?php echo htmlspecialchars($robots); ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
    <meta property="og:type" content="<?php echo htmlspecialchars($ogType); ?>">
    <meta property="og:site_name" content="Case Study Labs">
    <meta name="twitter:card" content="<?php echo htmlspecialchars($twitterCard); ?>">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
    <?php if ($metaDescriptionContent !== ''): ?>
    <meta name="twitter:description" content="<?php echo htmlspecialchars($metaDescriptionContent); ?>">
    <?php endif; ?>

    <?php if ($og_image ?? ''): ?>
    <meta property="og:image" content="<?php echo htmlspecialchars($og_image); ?>">
    <meta name="twitter:image" content="<?php echo htmlspecialchars($og_image); ?>">
    <?php endif; ?>

    <?php if (!empty($json_ld)): ?>
        <?php
            $schemas = is_array($json_ld) ? $json_ld : [$json_ld];
            foreach ($schemas as $schema):
                if (!is_string($schema) || trim($schema) === '') {
                    continue;
                }
        ?>
    <script type="application/ld+json"><?php echo $schema; ?></script>
        <?php endforeach; ?>
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
