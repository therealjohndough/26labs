<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? '26 Labs'; ?> - Creative Agency</title>
    <link rel="preconnect" href="https://use.typekit.net" crossorigin>
    <link rel="stylesheet" href="https://use.typekit.net/snz1mha.css">
    <link rel="stylesheet" href="/css/design_tokens.css?v=5">
    <link rel="stylesheet" href="/css/tailwind.css?v=5">
    <link rel="stylesheet" href="/css/style.css?v=5">
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
