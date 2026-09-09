<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?= htmlspecialchars(rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/') . '/', ENT_QUOTES, 'UTF-8') ?>">
    <title>Sign up | LavaLust Products</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Manrope:wght@400;600;700;800&family=Syne:wght@700;800&display=swap');
        :root { --ink: #271536; --muted: #725b91; --violet: #805ad5; --magenta: #c044a3; --lavender: #e9ddff; --paper: #fffaff; --line: #d7c5f0; }
        * { box-sizing: border-box; }
        body { min-height: 100vh; margin: 0; display: grid; place-items: center; padding: 24px; color: var(--ink); font-family: 'Manrope', sans-serif; background: radial-gradient(circle at 10% 15%, rgba(192,68,163,.2), transparent 28%), linear-gradient(135deg, #e9ddff, #f8efff); }
        .card { width: min(520px, 100%); padding: 38px; border: 1px solid var(--line); border-radius: 18px; background: rgba(255,250,255,.92); box-shadow: 12px 12px 0 #c7b1f4; }
        .eyebrow { margin: 0 0 24px; color: var(--magenta); font: 500 .72rem 'DM Mono', monospace; letter-spacing: .12em; text-transform: uppercase; }
        h1 { margin: 0 0 10px; font: 800 clamp(2.3rem, 9vw, 4rem)/.92 'Syne', sans-serif; letter-spacing: -.05em; }
        .intro { margin: 0 0 24px; color: var(--muted); line-height: 1.5; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0 14px; }
        .wide { grid-column: 1 / -1; }
        label { display: block; margin: 14px 0 7px; color: var(--muted); font-size: .75rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; }
        input { width: 100%; padding: 12px; border: 1px solid var(--line); border-radius: 8px; color: var(--ink); background: #fff; font: .9rem 'Manrope', sans-serif; }
        input:focus { outline: 3px solid rgba(128,90,213,.2); border-color: var(--violet); }
        button { width: 100%; margin-top: 26px; padding: 14px; border: 0; border-radius: 8px; color: #fff; background: var(--violet); font: 700 .85rem 'Manrope', sans-serif; cursor: pointer; }
        button:hover { background: var(--magenta); }
        .error { margin: 0 0 18px; padding: 12px; border-radius: 8px; color: #8e245e; background: #f9dff1; font-size: .86rem; }
        .login-link { display: block; margin-top: 18px; color: var(--violet); font-size: .86rem; text-align: center; text-decoration: none; }
        @media (max-width: 520px) { .card { padding: 26px; } .grid { display: block; } }
    </style>
</head>
<body>
    <main class="card">
        <p class="eyebrow">LavaLust / Create account</p>
        <h1>Join the catalog.</h1>
        <p class="intro">Create an account to access product management.</p>
        <?php if (!empty($error)): ?><p class="error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
        <form method="post" action="signup">
            <div class="grid">
                <div><label for="firstname">First name</label><input id="firstname" name="firstname" required value="<?= htmlspecialchars($form['firstname'] ?? '', ENT_QUOTES, 'UTF-8') ?>"></div>
                <div><label for="lastname">Last name</label><input id="lastname" name="lastname" required value="<?= htmlspecialchars($form['lastname'] ?? '', ENT_QUOTES, 'UTF-8') ?>"></div>
                <div class="wide"><label for="email">Email</label><input id="email" name="email" type="email" required value="<?= htmlspecialchars($form['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>"></div>
                <div class="wide"><label for="username">Username</label><input id="username" name="username" autocomplete="username" required value="<?= htmlspecialchars($form['username'] ?? '', ENT_QUOTES, 'UTF-8') ?>"></div>
                <div><label for="password">Password</label><input id="password" name="password" type="password" minlength="8" autocomplete="new-password" required></div>
                <div><label for="password_confirmation">Confirm password</label><input id="password_confirmation" name="password_confirmation" type="password" minlength="8" autocomplete="new-password" required></div>
            </div>
            <button type="submit">Create account</button>
        </form>
        <a class="login-link" href="login">Already have an account? Sign in</a>
    </main>
</body>
</html>