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
        :root { --ink: #3a0f1d; --muted: #7f3d4a; --pink: #ff4d74; --red: #d91d3d; --rose: #ffe2e8; --paper: #fff7f8; --line: #f5bfd0; }
        * { box-sizing: border-box; }
        body { min-height: 100vh; margin: 0; display: grid; place-items: center; padding: 24px; color: var(--ink); font-family: 'Manrope', sans-serif; background: radial-gradient(circle at 15% 15%, rgba(217, 29, 61, .2), transparent 28%), linear-gradient(135deg, #ffe7ec, #fff6f8 52%, #ffdfe7); }
        .login-card { width: min(430px, 100%); padding: 42px; border: 1px solid var(--line); border-radius: 18px; background: rgba(255, 248, 250, .95); box-shadow: 12px 12px 0 rgba(217, 29, 61, .25); }
        .eyebrow { margin: 0 0 28px; color: var(--red); font: 500 .72rem 'DM Mono', monospace; letter-spacing: .12em; text-transform: uppercase; }
        h1 { margin: 0 0 10px; font: 800 clamp(2.4rem, 10vw, 4rem)/.92 'Syne', sans-serif; letter-spacing: -.05em; }
        .intro { margin: 0 0 30px; color: var(--muted); line-height: 1.55; }
        label { display: block; margin: 18px 0 8px; color: var(--muted); font-size: .78rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; }
        input { width: 100%; padding: 13px 14px; border: 1px solid var(--line); border-radius: 8px; color: var(--ink); background: #fff; font: 500 .95rem 'Manrope', sans-serif; }
        input:focus { outline: 3px solid rgba(255, 77, 116, .18); border-color: var(--pink); }
        button { width: 100%; margin-top: 28px; padding: 14px; border: 0; border-radius: 8px; color: #fff; background: linear-gradient(135deg, var(--red), var(--pink)); font: 700 .85rem 'Manrope', sans-serif; cursor: pointer; }
        button:hover { filter: brightness(.96); }
        .error { margin: 0 0 18px; padding: 12px; border-radius: 8px; color: #9d1635; background: #ffe7ee; font-size: .86rem; }
        .signup-link { display: block; margin-top: 18px; color: var(--red); font-size: .86rem; text-align: center; text-decoration: none; }
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