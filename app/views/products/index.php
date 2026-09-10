<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?= htmlspecialchars(rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/') . '/', ENT_QUOTES, 'UTF-8') ?>">
    <title>Products | LavaLust</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Manrope:wght@400;600;700;800&family=Syne:wght@700;800&display=swap');
        :root { --ink: #3a0f1d; --muted: #7f3d4a; --pink: #ff4d74; --red: #d91d3d; --rose: #ffe2e8; --paper: #fff7f8; --line: #f5bfd0; }
        * { box-sizing: border-box; }
        body { min-height: 100vh; margin: 0; padding: 42px 24px; color: var(--ink); font-family: 'Manrope', sans-serif; background: linear-gradient(rgba(255,255,255,.38) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.38) 1px, transparent 1px), radial-gradient(circle at 90% 8%, rgba(217,29,61,.18), transparent 25%), linear-gradient(135deg, #ffe7ec, #fff4f7 40%, #ffdfe7); background-size: 32px 32px, 32px 32px, auto, auto; }
        main { width: min(1160px, 100%); margin: auto; }
        .topbar, .actions, .product-card { border: 1px solid var(--line); background: rgba(255,248,250,.94); }
        .topbar { display: flex; align-items: end; justify-content: space-between; gap: 20px; padding: 28px 30px; border-radius: 16px 16px 0 0; }
        .eyebrow { margin: 0 0 12px; color: var(--red); font: 500 .72rem 'DM Mono', monospace; letter-spacing: .12em; text-transform: uppercase; }
        h1 { margin: 0; font: 800 clamp(2.5rem, 6vw, 4.2rem)/.95 'Syne', sans-serif; letter-spacing: 0; }
        .topbar p { max-width: 280px; margin: 0; color: var(--muted); font-size: .9rem; line-height: 1.5; text-align: right; }
        .actions { display: flex; justify-content: space-between; gap: 16px; padding: 16px 30px; border-top: 0; }
        .actions span { color: var(--muted); font: 500 .76rem 'DM Mono', monospace; }
        a, button { border: 0; border-radius: 7px; padding: 10px 14px; color: #fff; background: linear-gradient(135deg, var(--red), var(--pink)); font: 700 .8rem 'Manrope', sans-serif; text-decoration: none; cursor: pointer; }
        a:hover, button:hover { filter: brightness(.96); }
        .logout { color: var(--red); background: transparent; border: 1px solid var(--line); }
        .product-card { overflow-x: auto; border-top: 0; border-radius: 0 0 16px 16px; box-shadow: 10px 10px 0 rgba(217,29,61,.18); }
        table { width: 100%; min-width: 820px; border-collapse: collapse; }
        th, td { padding: 17px 20px; border-bottom: 1px solid var(--line); text-align: left; }
        th { color: var(--muted); background: #fff0f3; font: 500 .68rem 'DM Mono', monospace; letter-spacing: .1em; text-transform: uppercase; }
        td { font-size: .9rem; vertical-align: top; }
        td:first-child { color: var(--red); font-family: 'DM Mono', monospace; }
        td:nth-child(3) { color: var(--red); font-weight: 700; }
        .description { max-width: 280px; color: var(--muted); }
        .row-actions { display: flex; gap: 8px; }
        .edit { color: var(--red); background: #ffe9ee; }
        .delete { color: #9d1635; background: #ffe2e8; }
        .empty { padding: 36px; color: var(--muted); text-align: center; }
        @media (max-width: 640px) { body { padding: 20px 14px; } .topbar { align-items: start; flex-direction: column; padding: 24px 20px; } .topbar p { text-align: left; } .actions { align-items: start; flex-direction: column; padding: 14px 20px; } }
    </style>
</head>
<body>
    <main>
        <header class="topbar">
            <div><p class="eyebrow">LavaLust / Inventory</p><h1>Products</h1></div>
            <p>Keep your catalog current, clear, and ready for the next order.</p>
        </header>
        <div class="actions"><span><?= count($products) ?> products in catalog</span><div><a href="products/create">Add product</a> <a class="logout" href="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a></div></div>
        <form id="logout-form" method="post" action="logout" hidden></form>
        <section class="product-card">
            <table>
                <thead><tr><th>ID</th><th>Product</th><th>Price</th><th>Quantity</th><th>Description</th><th>Actions</th></tr></thead>
                <tbody>
                <?php if ($products): foreach ($products as $product): ?>
                    <tr>
                        <td><?= (int) $product['id'] ?></td>
                        <td><?= htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td>₱<?= number_format((float) $product['price'], 2) ?></td>
                        <td><?= (int) $product['quantity'] ?></td>
                        <td class="description"><?= htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><div class="row-actions"><a class="edit" href="products/edit/<?= (int) $product['id'] ?>">Edit</a><form method="post" action="products/delete/<?= (int) $product['id'] ?>" onsubmit="return confirm('Delete this product?');"><button class="delete" type="submit">Delete</button></form></div></td>
                    </tr>
                <?php endforeach; else: ?><tr><td class="empty" colspan="6">No products yet. Add your first product to begin.</td></tr><?php endif; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>