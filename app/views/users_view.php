<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management Module</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap');

        :root {
            --pink: #ff4d74;
            --red: #ff2e4d;
            --red-dim: #c81a37;
            --rose: rgba(255, 46, 77, 0.14);
            --rose-soft: rgba(255, 46, 77, 0.08);
            --bg: #120507;
            --bg2: #1a0a0d;
            --paper: #170709;
            --ink: #fdeef0;
            --muted: #a5717c;
            --line: rgba(255, 77, 116, 0.18);
            --shadow: rgba(255, 46, 77, 0.22);
        }

        * { box-sizing: border-box; }

        body {
            min-height: 100vh;
            margin: 0;
            padding: 48px 32px;
            color: var(--ink);
            font-family: 'Inter', 'Segoe UI', sans-serif;
            background:
                radial-gradient(circle at 92% 8%, rgba(255, 46, 77, 0.16), transparent 25%),
                linear-gradient(125deg, rgba(255, 46, 77, 0.06), transparent 44%),
                linear-gradient(135deg, #150608, #0e0405 52%, #170709);
        }

        main { width: min(1180px, 100%); margin: 0 auto; }

        /* TOP BAR */
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            padding-bottom: 22px;
            border-bottom: 1px solid var(--line);
        }
        .brand { display: flex; align-items: center; gap: 12px; }
        .brand-mark {
            width: 38px;
            height: 38px;
            display: grid;
            place-items: center;
            border-radius: 10px;
            background: var(--red);
            color: #fff;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.05rem;
        }
        .brand-text .eyebrow {
            margin: 0;
            color: var(--muted);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.68rem;
            font-weight: 500;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }
        .brand-text h1 {
            margin: 2px 0 0;
            color: var(--ink);
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.01em;
        }

        /* STAT CARDS */
        .stats { display: flex; gap: 14px; margin-bottom: 24px; }
        .stat-card {
            flex: 1;
            padding: 18px 20px;
            border: 1px solid var(--line);
            border-radius: 12px;
            background: var(--paper);
        }
        .stat-card .label {
            margin: 0 0 6px;
            color: var(--muted);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.65rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }
        .stat-card .value {
            margin: 0;
            color: var(--ink);
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
        }
        .stat-card.accent { border-top: 3px solid var(--red); }

        /* TABLE PANEL */
        .table-panel {
            overflow: hidden;
            border: 1px solid var(--line);
            background: var(--paper);
            border-radius: 14px;
        }

        .panel-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            padding: 18px 22px;
            border-bottom: 1px solid var(--line);
        }

        .panel-title {
            margin: 0;
            color: var(--ink);
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1rem;
            font-weight: 600;
        }
        .panel-tools { display: flex; align-items: center; gap: 14px; }
        .search-wrap { position: relative; }
        .search-wrap::before {
            content: '';
            position: absolute;
            left: 12px;
            top: 50%;
            width: 12px;
            height: 12px;
            transform: translateY(-50%);
            border: 2px solid var(--muted);
            border-radius: 50%;
            box-shadow: 5px 5px 0 -3px var(--muted);
        }
        .search {
            width: min(230px, 40vw);
            padding: 9px 12px 9px 32px;
            border: 1px solid var(--line);
            border-radius: 8px;
            outline: 0;
            color: var(--ink);
            background: var(--bg2);
            font: 500 0.82rem 'Inter', sans-serif;
        }
        .search::placeholder { color: var(--muted); }
        .search:focus { border-color: var(--pink); box-shadow: 0 0 0 3px rgba(255, 77, 116, 0.15); }

        .table-scroll { overflow-x: auto; }
        table { width: 100%; min-width: 720px; border-collapse: collapse; }
        th, td { padding: 16px 22px; text-align: left; }
        th {
            color: var(--muted);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.66rem;
            font-weight: 500;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            border-bottom: 1px solid var(--line);
        }
        td { color: var(--ink); font-size: 0.9rem; font-weight: 500; border-bottom: 1px solid var(--line); }
        tbody tr { transition: background-color 0.15s; }
        tbody tr:hover { background: rgba(255, 46, 77, 0.05); }
        tbody tr:last-child td { border-bottom: 0; }

        .id-chip {
            display: inline-block;
            padding: 3px 9px;
            border-radius: 6px;
            background: var(--rose-soft);
            color: var(--red);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.78rem;
        }
        .name-cell { display: flex; align-items: center; gap: 10px; }
        .avatar {
            width: 30px;
            height: 30px;
            flex-shrink: 0;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: var(--rose);
            color: var(--pink);
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.75rem;
            font-weight: 700;
        }
        .username-tag {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 6px;
            border: 1px solid var(--line);
            color: var(--pink);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.78rem;
            font-weight: 500;
        }
        .empty { color: var(--muted); text-align: center; padding: 40px 20px; }

        @media (max-width: 720px) {
            body { padding: 28px 16px; }
            .stats { flex-direction: column; }
            .panel-bar { flex-direction: column; align-items: stretch; }
            .search { width: 100%; }
            th, td { padding: 13px 14px; }
        }
    </style>
</head>
<body>
    <main>
        <div class="topbar">
            <div class="brand">
                <div class="brand-mark">L</div>
                <div class="brand-text">
                    <p class="eyebrow">LavaLust / Directory</p>
                    <h1>Users</h1>
                </div>
            </div>
        </div>

        <div class="stats">
            <div class="stat-card accent">
                <p class="label">Total records</p>
                <p class="value"><?= count($users ?? []) ?></p>
            </div>
            <div class="stat-card">
                <p class="label">Source</p>
                <p class="value" style="font-size: 1.1rem;">Application DB</p>
            </div>
        </div>

        <section class="table-panel">
            <div class="panel-bar">
                <h2 class="panel-title">User registry</h2>
                <div class="panel-tools">
                    <div class="search-wrap">
                        <input class="search" type="search" placeholder="Search users" aria-label="Search users" data-user-search>
                    </div>
                </div>
            </div>
            <div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users)): ?>
                            <?php foreach ($users as $user): ?>
                                <?php $initials = strtoupper(substr($user['firstname'], 0, 1) . substr($user['lastname'], 0, 1)); ?>
                                <tr data-user-row>
                                    <td><span class="id-chip">#<?= htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8') ?></span></td>
                                    <td>
                                        <div class="name-cell">
                                            <span class="avatar"><?= htmlspecialchars($initials, ENT_QUOTES, 'UTF-8') ?></span>
                                            <span><?= htmlspecialchars($user['firstname'] . ' ' . $user['lastname'], ENT_QUOTES, 'UTF-8') ?></span>
                                        </div>
                                    </td>
                                    <td><?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><span class="username-tag">@<?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td class="empty" colspan="4">No users found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    <script>
        const search = document.querySelector('[data-user-search]');
        const rows = [...document.querySelectorAll('[data-user-row]')];

        search?.addEventListener('input', () => {
            const query = search.value.trim().toLowerCase();
            rows.forEach((row) => {
                row.hidden = !row.textContent.toLowerCase().includes(query);
            });
        });
    </script>
</body>
</html>
