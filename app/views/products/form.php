<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); $editing = !empty($product['id']); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?= htmlspecialchars(rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/') . '/', ENT_QUOTES, 'UTF-8') ?>">
    <title><?= $editing ? 'Edit' : 'Add' ?> product | LavaLust</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap');
        :root { --ink: #fdeef0; --muted: #a5717c; --pink: #ff4d74; --red: #ff2e4d; --rose: rgba(255,46,77,.14); --paper: #170709; --bg2: #1a0a0d; --line: rgba(255,77,116,.18); --shadow: rgba(255,46,77,.22); }
        * { box-sizing: border-box; }
        body {
            min-height: 100vh;
            margin: 0;
            padding: 40px 20px;
            color: var(--ink);
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at 90% 10%, rgba(255,46,77,.16), transparent 25%), linear-gradient(135deg, #150608, #0e0405 50%, #170709);
        }
        main { width: min(760px, 100%); margin: 0 auto; }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
        }
        .breadcrumb {
            margin: 0;
            color: var(--muted);
            font-family: 'JetBrains Mono', monospace;
            font-size: .72rem;
            letter-spacing: .1em;
            text-transform: uppercase;
        }
        .breadcrumb strong { color: var(--red); }
        .status-pill {
            padding: 5px 12px;
            border-radius: 999px;
            border: 1px solid var(--line);
            color: var(--pink);
            font-family: 'JetBrains Mono', monospace;
            font-size: .68rem;
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .form-card {
            border: 1px solid var(--line);
            border-radius: 16px;
            background: var(--paper);
            box-shadow: 10px 10px 0 var(--shadow);
            overflow: hidden;
        }
        .form-header {
            padding: 30px 32px 24px;
            border-bottom: 1px solid var(--line);
        }
        h1 {
            margin: 0;
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(1.7rem, 4vw, 2.2rem);
            font-weight: 700;
        }
        .form-body { padding: 28px 32px 32px; }

        .section-label {
            margin: 0 0 16px;
            color: var(--muted);
            font-family: 'JetBrains Mono', monospace;
            font-size: .66rem;
            letter-spacing: .1em;
            text-transform: uppercase;
        }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0 16px; }
        .wide { grid-column: 1 / -1; }
        .field { margin-bottom: 18px; }
        label {
            display: block;
            margin: 0 0 7px;
            color: var(--muted);
            font-family: 'JetBrains Mono', monospace;
            font-size: .68rem;
            font-weight: 500;
            letter-spacing: .06em;
            text-transform: uppercase;
        }
        input, textarea {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid var(--line);
            border-radius: 8px;
            color: var(--ink);
            background: var(--bg2);
            font: 500 .9rem 'Inter', sans-serif;
        }
        input:focus, textarea:focus { outline: none; border-color: var(--pink); box-shadow: 0 0 0 3px rgba(255,77,116,.12); }
        textarea { min-height: 120px; resize: vertical; }

        .price-input { position: relative; }
        .price-input span {
            position: absolute;
            left: 13px;
            top: 39px;
            color: var(--muted);
            font-size: .9rem;
        }
        .price-input input { padding-left: 26px; }

        .error {
            margin: 0 0 20px;
            padding: 12px 14px;
            color: #ffb4b4;
            background: rgba(255,46,77,.12);
            border: 1px solid rgba(255,46,77,.3);
            border-radius: 8px;
            font-family: 'JetBrains Mono', monospace;
            font-size: .82rem;
        }
        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 8px;
            padding-top: 24px;
            border-top: 1px solid var(--line);
        }
        button, a.btn {
            padding: 12px 20px;
            border: 0;
            border-radius: 8px;
            color: #fff;
            background: var(--red);
            font: 600 .8rem 'Inter', sans-serif;
            letter-spacing: .04em;
            text-transform: uppercase;
            text-decoration: none;
            cursor: pointer;
        }
        button:hover { background: var(--pink); }
        a.btn { color: var(--muted); background: transparent; border: 1px solid var(--line); }
        a.btn:hover { color: var(--ink); border-color: var(--pink); }

        @media (max-width: 560px) {
            .form-header, .form-body { padding: 22px; }
            .grid { display: block; }
        }
    </style>
</head>
<body>
    <main>
        <div class="topbar">
            <p class="breadcrumb">LavaLust / Inventory / <strong><?= $editing ? 'Edit' : 'New' ?></strong></p>
            <span class="status-pill"><?= $editing ? 'Editing #' . (int) $product['id'] : 'New entry' ?></span>
        </div>

        <div class="form-card">
            <div class="form-header">
                <h1><?= $editing ? 'Edit product' : 'Add product' ?></h1>
            </div>
            <div class="form-body">
                <?php if (!empty($error)): ?><p class="error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
                <form method="post" action="<?= $editing ? 'products/edit/' . (int) $product['id'] : 'products' ?>">
                    <p class="section-label">Product details</p>
                    <div class="grid">
                        <div class="field wide">
                            <label for="product_name">Product name</label>
                            <input id="product_name" name="product_name" maxlength="100" required value="<?= htmlspecialchars($product['product_name'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                        </div>
                        <div class="field price-input">
                            <label for="price">Price</label>
                            <span>₱</span>
                            <input id="price" name="price" type="number" min="0" step="0.01" required value="<?= htmlspecialchars($product['price'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                        </div>
                        <div class="field">
                            <label for="quantity">Quantity</label>
                            <input id="quantity" name="quantity" type="number" min="0" required value="<?= htmlspecialchars($product['quantity'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                        </div>
                        <div class="field wide">
                            <label for="description">Description</label>
                            <textarea id="description" name="description"><?= htmlspecialchars($product['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
                        </div>
                    </div>
                    <div class="buttons">
                        <button type="submit"><?= $editing ? 'Save changes' : 'Create product' ?></button>
                        <a class="btn" href="products">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
