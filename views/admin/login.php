<?php
// Admin login view
?>

<div class="login-wrapper">
    <div class="login-card">
        <h1>26 Labs Admin</h1>

        <?php if ($error ?? false): ?>
        <div class="alert alert-error">
            <?php echo htmlspecialchars($error); ?>
        </div>
        <?php endif; ?>

        <form method="POST" action="/admin/login">
            <input type="hidden" name="<?php echo htmlspecialchars($csrf_field); ?>" value="<?php echo htmlspecialchars($csrf_token); ?>">

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-actions" style="border:none;padding-top:0;margin-top:0;">
                <button type="submit" class="btn" style="width:100%;">Login</button>
            </div>
        </form>

        <p style="text-align:center;margin-top:var(--space-5);font-size:var(--text-xs);color:var(--color-text-muted);">
            <a href="/" style="color:var(--color-text-muted);">← Back to site</a>
        </p>
    </div>
</div>
