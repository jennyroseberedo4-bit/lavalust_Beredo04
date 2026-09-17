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
        :root { --ink: #f5e6e6; --muted: #b98686; --violet: #8a0e1f; --magenta: #ff2d4d; --lavender: #3a1414; --paper: #1a0808; --line: #4a1a1e; }
        * { box-sizing: border-box; }
        body { min-height: 100vh; margin: 0; display: grid; place-items: center; padding: 24px; color: var(--ink); font-family: 'Manrope', sans-serif; background: radial-gradient(circle at 10% 15%, rgba(255, 45, 77, .15), transparent 30%), linear-gradient(135deg, #100404, #1c0808); }
        .login-card { width: min(430px, 100%); padding: 42px; border: 1px solid var(--line); border-radius: 18px; background: rgba(26, 8, 8, .92); box-shadow: 12px 12px 0 #3a0e12; }
        .eyebrow { margin: 0 0 28px; color: var(--magenta); font: 500 .72rem 'DM Mono', monospace; letter-spacing: .12em; text-transform: uppercase; }
        h1 { margin: 0 0 10px; color: #fff; font: 800 clamp(2.4rem, 10vw, 4rem)/.92 'Syne', sans-serif; letter-spacing: -.05em; }
        .intro { margin: 0 0 30px; color: var(--muted); line-height: 1.55; }
        label { display: block; margin: 18px 0 8px; color: var(--muted); font-size: .78rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; }
        input { width: 100%; padding: 13px 14px; border: 1px solid var(--line); border-radius: 8px; color: var(--ink); background: #250b0b; font: 500 .95rem 'Manrope', sans-serif; }
        input::placeholder { color: #6b4444; }
        input:focus { outline: 3px solid rgba(255, 45, 77, .2); border-color: var(--magenta); }
        button { width: 100%; margin-top: 28px; padding: 14px; border: 0; border-radius: 8px; color: #fff; background: var(--violet); font: 700 .85rem 'Manrope', sans-serif; cursor: pointer; transition: background .2s; }
        button:hover { background: var(--magenta); }
        .error { margin: 0 0 18px; padding: 12px; border-radius: 8px; color: #ffb4b4; background: rgba(255, 45, 77, .12); border: 1px solid rgba(255, 45, 77, .3); font-size: .86rem; }
        .signup-link { display: block; margin-top: 18px; color: var(--magenta); font-size: .86rem; text-align: center; text-decoration: none; }
        .signup-link:hover { text-decoration: underline; }
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
