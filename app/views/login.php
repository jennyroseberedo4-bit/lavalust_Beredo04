<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?= htmlspecialchars(rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/') . '/', ENT_QUOTES, 'UTF-8') ?>">
    <title>Sign in | LavaLust Products</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Manrope:wght@400;600;700;800&family=Syne:wght@700;800&display=swap');
        :root { --ink: #271536; --muted: #725b91; --violet: #805ad5; --magenta: #c044a3; --lavender: #e9ddff; --paper: #fffaff; --line: #d7c5f0; }
        * { box-sizing: border-box; }
        body { min-height: 100vh; margin: 0; display: grid; place-items: center; padding: 24px; color: var(--ink); font-family: 'Manrope', sans-serif; background: radial-gradient(circle at 10% 15%, rgba(192, 68, 163, .2), transparent 28%), linear-gradient(135deg, #e9ddff, #f8efff); }
        .login-card { width: min(430px, 100%); padding: 42px; border: 1px solid var(--line); border-radius: 18px; background: rgba(255, 250, 255, .9); box-shadow: 12px 12px 0 #c7b1f4; }
        .eyebrow { margin: 0 0 28px; color: var(--magenta); font: 500 .72rem 'DM Mono', monospace; letter-spacing: .12em; text-transform: uppercase; }
        h1 { margin: 0 0 10px; font: 800 clamp(2.4rem, 10vw, 4rem)/.92 'Syne', sans-serif; letter-spacing: -.05em; }
        .intro { margin: 0 0 30px; color: var(--muted); line-height: 1.55; }
        label { display: block; margin: 18px 0 8px; color: var(--muted); font-size: .78rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; }
        input { width: 100%; padding: 13px 14px; border: 1px solid var(--line); border-radius: 8px; color: var(--ink); background: #fff; font: 500 .95rem 'Manrope', sans-serif; }
        input:focus { outline: 3px solid rgba(128, 90, 213, .2); border-color: var(--violet); }
        button { width: 100%; margin-top: 28px; padding: 14px; border: 0; border-radius: 8px; color: #fff; background: var(--violet); font: 700 .85rem 'Manrope', sans-serif; cursor: pointer; }
        button:hover { background: var(--magenta); }
        .error { margin: 0 0 18px; padding: 12px; border-radius: 8px; color: #8e245e; background: #f9dff1; font-size: .86rem; }
        .signup-link { display: block; margin-top: 18px; color: var(--violet); font-size: .86rem; text-align: center; text-decoration: none; }
    </style>
</head>
<body>
    <main class="login-card">
        <p class="eyebrow">LavaLust / Admin access</p>
        <h1>Welcome back.</h1>
        <p class="intro">Sign in to manage the product catalog.</p>
        <?php if (!empty($error)): ?><p class="error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
        <form method="post" action="login">
            <label for="username">Username</label>
            <input id="username" name="username" type="text" autocomplete="username" required>
            <label for="password">Password</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required>
            <button type="submit">Sign in</button>
        </form>
        <a class="signup-link" href="signup">No account yet? Sign up</a>
    </main>
</body>
</html>