<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); $editing = !empty($product['id']); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?= htmlspecialchars(rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/') . '/', ENT_QUOTES, 'UTF-8') ?>">
    <title><?= $editing ? 'Edit' : 'Add' ?> product | LavaLust</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Syne:wght@700;800&display=swap');
        :root { --ink: #fdeef0; --muted: #a5717c; --pink: #ff4d74; --red: #ff2e4d; --rose: rgba(255,46,77,.14); --paper: #170709; --bg2: #1a0a0d; --line: rgba(255,77,116,.18); --shadow: rgba(255,46,77,.22); }
        * { box-sizing: border-box; } body { min-height: 100vh; margin: 0; display: grid; place-items: center; padding: 24px; color: var(--ink); font-family: 'Manrope', sans-serif; background: radial-gradient(circle at 90% 10%, rgba(255,46,77,.16), transparent 25%), linear-gradient(135deg, #150608, #0e0405 50%, #170709); }
        .form-card { width: min(680px, 100%); padding: 36px; border: 1px solid var(--line); border-radius: 16px; background: var(--paper); box-shadow: 10px 10px 0 var(--shadow); }
        .eyebrow { margin: 0 0 12px; color: var(--red); font-size: .72rem; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; } h1 { margin: 0 0 28px; color: var(--ink); font: 800 clamp(2.4rem, 6vw, 3.9rem)/.95 'Syne', sans-serif; letter-spacing: 0; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0 18px; } label { display: block; margin: 16px 0 8px; color: var(--muted); font-size: .76rem; font-weight: 700; text-transform: uppercase; } input, textarea { width: 100%; padding: 12px; border: 1px solid var(--line); border-radius: 7px; color: var(--ink); background: var(--bg2); font: .92rem 'Manrope', sans-serif; } input:focus, textarea:focus { outline: 3px solid rgba(255,77,116,.15); border-color: var(--pink); } textarea { min-height: 130px; resize: vertical; } .wide { grid-column: 1 / -1; } .error { padding: 12px; color: #ffb4b4; background: rgba(255,46,77,.12); border: 1px solid rgba(255,46,77,.3); border-radius: 7px; } .buttons { display: flex; gap: 10px; margin-top: 28px; } a, button { padding: 12px 16px; border: 0; border-radius: 7px; color: #fff; background: linear-gradient(135deg, var(--red), var(--pink)); font: 700 .82rem 'Manrope', sans-serif; text-decoration: none; cursor: pointer; } a:hover, button:hover { filter: brightness(1.08); } a { color: var(--red); background: rgba(255,46,77,.12); } @media (max-width: 560px) { .form-card { padding: 24px; } .grid { display: block; } }
    </style>
</head>
<body>
    <main class="form-card">
        <p class="eyebrow">LavaLust / Inventory</p><h1><?= $editing ? 'Edit product' : 'Add product' ?></h1>
        <?php if (!empty($error)): ?><p class="error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
        <form method="post" action="<?= $editing ? 'products/edit/' . (int) $product['id'] : 'products' ?>">
            <div class="grid">
                <div class="wide"><label for="product_name">Product name</label><input id="product_name" name="product_name" maxlength="100" required value="<?= htmlspecialchars($product['product_name'] ?? '', ENT_QUOTES, 'UTF-8') ?>"></div>
                <div><label for="price">Price</label><input id="price" name="price" type="number" min="0" step="0.01" required value="<?= htmlspecialchars($product['price'] ?? '', ENT_QUOTES, 'UTF-8') ?>"></div>
                <div><label for="quantity">Quantity</label><input id="quantity" name="quantity" type="number" min="0" required value="<?= htmlspecialchars($product['quantity'] ?? '', ENT_QUOTES, 'UTF-8') ?>"></div>
                <div class="wide"><label for="description">Description</label><textarea id="description" name="description"><?= htmlspecialchars($product['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea></div>
            </div>
            <div class="buttons"><button type="submit"><?= $editing ? 'Save changes' : 'Create product' ?></button><a href="products">Cancel</a></div>
        </form>
    </main>
</body>
</html>
