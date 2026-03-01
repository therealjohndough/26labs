<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? '26 Labs'; ?> - Creative Agency</title>
    <link rel="stylesheet" href="/css/tailwind.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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
