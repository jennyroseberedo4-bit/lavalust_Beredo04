<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management Module</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Manrope:wght@400;500;600;700;800&family=Syne:wght@600;700;800&display=swap');

        :root {
            --lavender: #e9ddff;
            --lavender-deep: #c7b1f4;
            --plum: #2a1745;
            --plum-soft: #725b91;
            --ink: #38264d;
            --line: #d7c5f0;
            --paper: #fffaff;
            --violet: #805ad5;
            --magenta: #c044a3;
        }

        * { box-sizing: border-box; }

        body {
            min-height: 100vh;
            margin: 0;
            padding: 56px 24px;
            color: var(--ink);
            font-family: 'Manrope', 'Segoe UI', sans-serif;
            background:
                linear-gradient(rgba(255, 255, 255, 0.38) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.38) 1px, transparent 1px),
                radial-gradient(circle at 92% 8%, rgba(192, 68, 163, 0.2), transparent 25%),
                linear-gradient(125deg, rgba(128, 90, 213, 0.12), transparent 42%),
                var(--lavender);
            background-size: 32px 32px, 32px 32px, auto, auto, auto;
        }

        main { width: min(1100px, 100%); margin: 0 auto; }

        .eyebrow {
            margin: 0 0 12px;
            color: var(--magenta);
            font-family: 'DM Mono', monospace;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .heading {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 34px;
        }

        h1 {
            margin: 0;
            color: var(--plum);
            font-family: 'Syne', 'Trebuchet MS', sans-serif;
            font-size: clamp(2.8rem, 7vw, 5.5rem);
            font-weight: 800;
            line-height: 0.9;
            letter-spacing: -0.06em;
        }

        .heading p {
            max-width: 260px;
            margin: 0;
            color: var(--plum-soft);
            font-size: 0.9rem;
            font-weight: 500;
            line-height: 1.5;
            text-align: right;
        }

        .table-panel {
            overflow: hidden;
            border: 1px solid var(--line);
            border-top: 4px solid var(--violet);
            background: var(--paper);
            box-shadow: 10px 10px 0 var(--lavender-deep);
            border-radius: 14px;
        }

        .panel-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 20px;
            border-bottom: 1px solid var(--line);
            background: rgba(255, 250, 255, 0.86);
        }

        .panel-title { margin: 0; color: var(--plum); font-size: 0.78rem; letter-spacing: 0.12em; text-transform: uppercase; }
        .count { color: var(--violet); font-family: 'DM Mono', monospace; font-size: 0.75rem; font-weight: 500; }
        .table-scroll { overflow-x: auto; }
        table { width: 100%; min-width: 720px; border-collapse: collapse; }
        th, td { padding: 18px 20px; border-bottom: 1px solid var(--line); text-align: left; }
        th { color: var(--plum-soft); background: #f4edff; font-family: 'DM Mono', monospace; font-size: 0.68rem; letter-spacing: 0.12em; text-transform: uppercase; }
        td { color: var(--ink); font-size: 0.92rem; }
        tbody tr { transition: background-color 0.2s; }
        tbody tr:hover { background: #f8f1ff; }
        tbody tr:last-child td { border-bottom: 0; }
        td:first-child { color: var(--magenta); font-family: 'DM Mono', monospace; font-weight: 500; }
        td:nth-child(4) { color: var(--violet); }
        .empty { color: var(--plum-soft); text-align: center; }

        @media (max-width: 640px) {
            body { padding: 32px 14px; }
            .heading { align-items: start; flex-direction: column; gap: 14px; margin-bottom: 22px; }
            .heading p { text-align: left; }
            .panel-bar { padding: 14px; }
            th, td { padding: 15px 14px; }
        }
    </style>
</head>
<body>
    <main>
        <p class="eyebrow">LavaLust / Directory</p>
        <div class="heading">
            <h1>Users</h1>
            <p>Active records from the application database.</p>
        </div>
        <section class="table-panel">
            <div class="panel-bar">
                <h2 class="panel-title">User registry</h2>
                <span class="count"><?= count($users ?? []) ?> records</span>
            </div>
            <div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Username</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users)): ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($user['firstname'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($user['lastname'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td class="empty" colspan="5">No users found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>