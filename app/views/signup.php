<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?= htmlspecialchars(rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/') . '/', ENT_QUOTES, 'UTF-8') ?>">
    <title>Sign up | LavaLust Products</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap');
        :root { --ink: #3a0f1d; --muted: #7f3d4a; --red: #d91d3d; --pink: #ff4d74; --rose: #ffe2e8; --paper: #fff7f8; --line: #f5bfd0; }
        * { box-sizing: border-box; }
        html, body { height: 100%; }
        body {
            margin: 0;
            color: var(--ink);
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at 10% 15%, rgba(217,29,61,.1), transparent 30%), linear-gradient(135deg, #ffe7ec, #fff6f8);
        }
        .shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 0.85fr 1fr;
        }
        @media (max-width: 860px) {
            .shell { grid-template-columns: 1fr; }
            .panel-side { display: none; }
        }

        /* LEFT SIDE PANEL */
        .panel-side {
            position: relative;
            overflow: hidden;
            padding: 48px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: linear-gradient(160deg, var(--red), #8f0f27 75%);
            color: #fff;
        }
        .panel-side .brand { display: flex; align-items: center; gap: 12px; }
        .brand-mark {
            width: 40px; height: 40px;
            display: grid; place-items: center;
            border-radius: 10px;
            background: rgba(255,255,255,.16);
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
        }
        .panel-side .brand span {
            font-family: 'JetBrains Mono', monospace;
            font-size: .7rem;
            letter-spacing: .14em;
            text-transform: uppercase;
            opacity: .85;
        }
        .panel-copy h2 {
            margin: 0 0 14px;
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(1.8rem, 3.6vw, 2.4rem);
            font-weight: 700;
            line-height: 1.15;
        }
        .panel-copy p { margin: 0; max-width: 30ch; opacity: .85; line-height: 1.6; font-size: .92rem; }
        .steps { display: flex; flex-direction: column; gap: 14px; }
        .step { display: flex; align-items: center; gap: 12px; font-size: .85rem; opacity: .9; }
        .step .dot { width: 22px; height: 22px; flex-shrink: 0; border-radius: 50%; background: rgba(255,255,255,.18); display: grid; place-items: center; font-family: 'JetBrains Mono', monospace; font-size: .7rem; }

        /* RIGHT FORM PANEL */
        .panel-form { display: flex; align-items: center; justify-content: center; padding: 40px 24px; }
        .card { width: min(460px, 100%); }
        .eyebrow {
            margin: 0 0 10px;
            color: var(--red);
            font-family: 'JetBrains Mono', monospace;
            font-size: .68rem;
            font-weight: 500;
            letter-spacing: .14em;
            text-transform: uppercase;
        }
        h1 {
            margin: 0 0 8px;
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(1.9rem, 5vw, 2.4rem);
            font-weight: 700;
            letter-spacing: -.01em;
        }
        .intro { margin: 0 0 28px; color: var(--muted); line-height: 1.55; font-size: .92rem; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0 14px; }
        .wide { grid-column: 1 / -1; }
        .field { margin-bottom: 16px; }
        label {
            display: block;
            margin: 0 0 6px;
            color: var(--muted);
            font-family: 'JetBrains Mono', monospace;
            font-size: .68rem;
            font-weight: 500;
            letter-spacing: .08em;
            text-transform: uppercase;
        }
        input {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid var(--line);
            border-radius: 8px;
            color: var(--ink);
            background: #fff;
            font: 500 .9rem 'Inter', sans-serif;
        }
        input:focus { outline: none; border-color: var(--red); box-shadow: 0 0 0 3px rgba(217,29,61,.12); }
        button {
            width: 100%;
            margin-top: 22px;
            padding: 14px;
            border: 0;
            border-radius: 8px;
            color: #fff;
            background: var(--red);
            font: 600 .82rem 'Inter', sans-serif;
            letter-spacing: .04em;
            text-transform: uppercase;
            cursor: pointer;
        }
        button:hover { background: var(--pink); }
        .error {
            margin: 0 0 18px;
            padding: 12px 14px;
            border-radius: 8px;
            color: #8e1030;
            background: var(--rose);
            font-family: 'JetBrains Mono', monospace;
            font-size: .82rem;
        }
        .login-link { display: block; margin-top: 20px; text-align: center; color: var(--muted); font-size: .85rem; text-decoration: none; }
        .login-link strong { color: var(--red); }
        .login-link:hover strong { text-decoration: underline; }

        @media (max-width: 520px) { .grid { display: block; } }
    </style>
</head>
<body>
    <div class="shell">
        <div class="panel-side">
            <div class="brand">
                <div class="brand-mark">L</div>
                <span>LavaLust / Create account</span>
            </div>
            <div class="panel-copy">
                <h2>Everything your catalog needs, in one place.</h2>
                <p>Manage products, track inventory, and keep your storefront up to date.</p>
            </div>
            <div class="steps">
                <div class="step"><span class="dot">1</span> Create your account</div>
                <div class="step"><span class="dot">2</span> Sign in to the dashboard</div>
                <div class="step"><span class="dot">3</span> Start managing products</div>
            </div>
        </div>

        <div class="panel-form">
            <div class="card">
                <p class="eyebrow">Step 1 of 2</p>
                <h1>Join the catalog.</h1>
                <p class="intro">Create an account to access product management.</p>
                <?php if (!empty($error)): ?><p class="error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
                <form method="post" action="signup">
                    <div class="grid">
                        <div class="field"><label for="firstname">First name</label><input id="firstname" name="firstname" required value="<?= htmlspecialchars($form['firstname'] ?? '', ENT_QUOTES, 'UTF-8') ?>"></div>
                        <div class="field"><label for="lastname">Last name</label><input id="lastname" name="lastname" required value="<?= htmlspecialchars($form['lastname'] ?? '', ENT_QUOTES, 'UTF-8') ?>"></div>
                        <div class="field wide"><label for="email">Email</label><input id="email" name="email" type="email" required value="<?= htmlspecialchars($form['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>"></div>
                        <div class="field wide"><label for="username">Username</label><input id="username" name="username" autocomplete="username" required value="<?= htmlspecialchars($form['username'] ?? '', ENT_QUOTES, 'UTF-8') ?>"></div>
                        <div class="field"><label for="password">Password</label><input id="password" name="password" type="password" minlength="8" autocomplete="new-password" required></div>
                        <div class="field"><label for="password_confirmation">Confirm password</label><input id="password_confirmation" name="password_confirmation" type="password" minlength="8" autocomplete="new-password" required></div>
                    </div>
                    <button type="submit">Create account</button>
                </form>
                <a class="login-link" href="login">Already have an account? <strong>Sign in</strong></a>
            </div>
        </div>
    </div>
</body>
</html>
