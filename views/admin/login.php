<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In — 26 Labs Admin</title>
    <link rel="preconnect" href="https://use.typekit.net" crossorigin>
    <link rel="stylesheet" href="https://use.typekit.net/snz1mha.css">
    <link rel="stylesheet" href="/css/design_tokens.css">
    <link rel="stylesheet" href="/css/admin.css">
</head>
<body class="admin-login">

<div class="login-wrapper">
    <div class="login-card">

        <h1>26 Labs Admin</h1>

        <?php if ($error ?? false): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" action="/admin/login" novalidate>
            <input type="hidden" name="<?php echo htmlspecialchars($csrf_field); ?>" value="<?php echo htmlspecialchars($csrf_token); ?>">

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required autofocus autocomplete="email"
                    value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required autocomplete="current-password">
            </div>

            <div class="form-actions" style="border:none; padding-top:0; margin-top:0;">
                <button type="submit" class="btn-primary" style="width:100%;">Sign In</button>
            </div>
        </form>

        <p style="text-align:center; margin-top:var(--space-5); font-size:var(--text-xs); color:var(--color-text-muted);">
            <a href="/" style="color:var(--color-text-muted);">&#8592; Back to site</a>
        </p>

    </div>
</div>

</body>
</html>
