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
        html, body { height: 100%; }
        body {
            margin: 0;
            font-family: 'Manrope', sans-serif;
            color: var(--ink);
            background: var(--paper);
        }
        .shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }
        @media (max-width: 860px) {
            .shell { grid-template-columns: 1fr; }
            .panel-visual { display: none; }
        }

        /* LEFT DECORATIVE PANEL */
        .panel-visual {
            position: relative;
            overflow: hidden;
            padding: 56px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            background: radial-gradient(circle at 15% 10%, rgba(255, 45, 77, .25), transparent 40%), linear-gradient(160deg, var(--violet), #430912 70%);
        }
        .dots {
            position: absolute;
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 14px;
        }
        .dots span { width: 4px; height: 4px; border-radius: 50%; background: rgba(255,255,255,.35); display: block; }
        .dots.top-left { top: 70px; left: 56px; }
        .dots.bottom-left { bottom: 90px; left: 56px; grid-template-columns: repeat(4, 1fr); }
        .ring {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,.4);
        }
        .ring.r1 { width: 90px; height: 90px; top: -30px; left: 30px; background: rgba(255,255,255,.08); }
        .ring.r2 { width: 220px; height: 220px; bottom: -90px; right: -60px; background: rgba(0,0,0,.15); }
        .ring.r3 { width: 40px; height: 40px; top: 190px; right: 70px; }
        .dot-solid {
            position: absolute;
            border-radius: 50%;
            background: var(--magenta);
        }
        .dot-solid.d1 { width: 22px; height: 22px; bottom: 220px; left: 60px; }
        .dot-solid.d2 { width: 14px; height: 14px; top: 200px; right: 55px; }
        .panel-eyebrow {
            position: relative;
            z-index: 1;
            margin: 0 0 18px;
            color: rgba(255,255,255,.75);
            font: 500 .68rem 'DM Mono', monospace;
            letter-spacing: .22em;
            text-transform: uppercase;
        }
        .panel-visual h2 {
            position: relative;
            z-index: 1;
            margin: 0 0 18px;
            color: #fff;
            font: 800 clamp(1.9rem, 4vw, 2.6rem)/1.1 'Syne', sans-serif;
            letter-spacing: -.03em;
            text-transform: uppercase;
        }
        .panel-visual p {
            position: relative;
            z-index: 1;
            margin: 0;
            max-width: 30ch;
            color: rgba(255,255,255,.8);
            line-height: 1.6;
        }

        /* RIGHT FORM PANEL */
        .panel-form {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 24px;
            background: var(--paper);
        }
        .login-card { width: min(420px, 100%); }
        .brand-mark {
            width: 56px;
            height: 56px;
            margin: 0 auto 20px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            background: var(--lavender);
            border: 1px solid var(--line);
            color: var(--magenta);
            font: 800 1.6rem 'Syne', sans-serif;
        }
        h1 {
            margin: 0 0 34px;
            text-align: center;
            color: #fff;
            font: 800 1.9rem 'Syne', sans-serif;
            letter-spacing: -.03em;
        }
        label {
            display: block;
            margin: 0 0 8px;
            color: var(--muted);
            font: 700 .68rem 'DM Mono', monospace;
            letter-spacing: .14em;
            text-transform: uppercase;
        }
        .field { margin-bottom: 20px; position: relative; }
        .field .icon {
            position: absolute;
            left: 16px;
            top: 42px;
            color: var(--magenta);
            font-size: 1rem;
            pointer-events: none;
        }
        input {
            width: 100%;
            padding: 15px 16px 15px 42px;
            border: 1px solid var(--line);
            border-radius: 10px;
            color: var(--ink);
            background: #250b0b;
            font: 500 1rem 'Manrope', sans-serif;
        }
        input::placeholder { color: #6b4444; }
        input:focus {
            outline: none;
            border-color: var(--magenta);
            box-shadow: 0 0 0 4px rgba(255, 45, 77, .15);
        }
        .row-between {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 4px 0 28px;
            font-size: .85rem;
        }
        .remember { display: flex; align-items: center; gap: 8px; color: var(--muted); }
        .remember input { width: 16px; height: 16px; padding: 0; }
        .row-between a { color: var(--magenta); text-decoration: none; }
        .row-between a:hover { text-decoration: underline; }
        button {
            width: 100%;
            padding: 16px;
            border: 0;
            border-radius: 10px;
            color: #fff;
            background: var(--violet);
            font: 700 .85rem 'Manrope', sans-serif;
            letter-spacing: .06em;
            text-transform: uppercase;
            cursor: pointer;
        }
        button:hover { background: var(--magenta); }
        .signup-line { margin-top: 26px; text-align: center; color: var(--muted); font-size: .85rem; }
        .signup-line a { color: var(--magenta); text-decoration: none; font-weight: 700; }
        .signup-line a:hover { text-decoration: underline; }
        .error {
            margin: 0 0 20px;
            padding: 13px 16px;
            border-radius: 10px;
            color: #ffb4b4;
            background: rgba(255, 45, 77, .12);
            border: 1px solid rgba(255, 45, 77, .3);
            font: 500 .85rem 'DM Mono', monospace;
        }
    </style>
</head>
<body>
    <div class="shell">
        <div class="panel-visual">
            <div class="dots top-left">
                <?php for ($i = 0; $i < 21; $i++): ?><span></span><?php endfor; ?>
            </div>
            <div class="dots bottom-left">
                <?php for ($i = 0; $i < 8; $i++): ?><span></span><?php endfor; ?>
            </div>
            <div class="ring r1"></div>
            <div class="ring r2"></div>
            <div class="ring r3"></div>
            <div class="dot-solid d1"></div>
            <div class="dot-solid d2"></div>
            <p class="panel-eyebrow">LavaLust / Admin access</p>
            <h2>Manage Your Product Catalog</h2>
            <p>Sign in to update listings and keep your storefront running.</p>
        </div>

        <div class="panel-form">
            <div class="login-card">
                <div class="brand-mark">L</div>
                <h1>Welcome back!</h1>
                <?php if (!empty($error)): ?><p class="error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
                <form method="post" action="login">
                    <div class="field">
                        <label for="username">Username</label>
                        <span class="icon">&#9993;</span>
                        <input id="username" name="username" type="text" autocomplete="username" placeholder="Enter your username" required>
                    </div>
                    <div class="field">
                        <label for="password">Password</label>
                        <span class="icon">&#128274;</span>
                        <input id="password" name="password" type="password" autocomplete="current-password" placeholder="Enter your password" required>
                    </div>
                    <div class="row-between">
                        <label class="remember"><input type="checkbox" name="remember"> Remember me</label>
                        <a href="#">Reset password?</a>
                    </div>
                    <button type="submit">Login</button>
                </form>
                <p class="signup-line">Don't have an account? <a href="signup">Create Account</a></p>
            </div>
        </div>
    </div>
</body>
</html>
