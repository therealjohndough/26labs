<?php
// Admin login view
?>

<div class="login-container">
    <div class="login-box">
        <h1>26 Labs Admin</h1>
        
        <?php if ($error ?? false): ?>
        <div class="alert alert-error">
            <?php echo htmlspecialchars($error); ?>
        </div>
        <?php endif; ?>

        <form method="POST" action="/admin/login" class="login-form">
            <input type="hidden" name="<?php echo htmlspecialchars($csrf_field); ?>" value="<?php echo htmlspecialchars($csrf_token); ?>">
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="btn-primary btn-wide">Login</button>
        </form>

        <p class="login-footer">
            <a href="/">Back to Website</a>
        </p>
    </div>
</div>

<style>
body {
    background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    font-family: 'Inter', sans-serif;
}

.login-container {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.login-box {
    background: white;
    padding: 40px;
    border-radius: 8px;
    width: 100%;
    max-width: 400px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
}

.login-box h1 {
    margin-bottom: 30px;
    text-align: center;
    color: #1a1a1a;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #333;
}

.form-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

.btn-primary {
    background: #2d5016;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-weight: 600;
}

.btn-wide {
    width: 100%;
    margin-top: 10px;
}

.alert {
    padding: 12px;
    margin-bottom: 20px;
    border-radius: 4px;
}

.alert-error {
    background: #fee;
    color: #c33;
    border: 1px solid #fcc;
}

.login-footer {
    text-align: center;
    margin-top: 20px;
}

.login-footer a {
    color: #2d5016;
    text-decoration: none;
}
</style>
