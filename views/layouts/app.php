<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? '26 Labs'; ?> - Creative Agency</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/tailwind.css?v=4">
    <link rel="stylesheet" href="/css/style.css?v=4">
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
