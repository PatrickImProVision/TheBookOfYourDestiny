<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factory Firmware v2 - Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 32px; color: #1a1a1a; }
        h1 { margin-bottom: 8px; }
        .subtitle { color: #555; margin-top: 0; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px; margin-top: 24px; }
        .card { border: 1px solid #ddd; border-radius: 10px; padding: 16px; }
        .card h2 { font-size: 1.1em; margin: 0 0 10px; }
        ul { list-style: none; padding: 0; margin: 0; }
        li { margin: 6px 0; }
        a { text-decoration: none; color: #1a73e8; }
        a:hover { text-decoration: underline; }
        code { background: #f4f4f4; padding: 2px 6px; border-radius: 4px; }
    </style>
</head>
<body>
    <h1>Factory Firmware v2</h1>
    <p class="subtitle">Landing page with links to all .app routes.</p>

    <div class="grid">
        <div class="card">
            <h2>Root</h2>
            <ul>
                <li><a href="<?= rtrim(base_url(), '/') ?>/Index.app">/Index.app</a></li>
                <li><a href="<?= rtrim(base_url(), '/') ?>/New.app">/New.app</a></li>
            </ul>
        </div>

        <div class="card">
            <h2>User</h2>
            <ul>
                <li><a href="<?= rtrim(base_url(), '/') ?>/User/Register.app?ConfirmLink=abc&User=123">/User/Register.app</a></li>
                <li><a href="<?= rtrim(base_url(), '/') ?>/User/Login.app?E-Mail=test@example.com&ReMemberMe=1">/User/Login.app</a></li>
                <li><a href="<?= rtrim(base_url(), '/') ?>/User/ProFile.app?View=123">/User/ProFile.app</a></li>
            </ul>
        </div>

        <div class="card">
            <h2>Store</h2>
            <ul>
                <li><a href="<?= rtrim(base_url(), '/') ?>/Store/Index.app?CaseID=AA0">/Store/Index.app</a></li>
                <li><a href="<?= rtrim(base_url(), '/') ?>/Store/New.app?CaseID=AA0">/Store/New.app</a></li>
                <li><a href="<?= rtrim(base_url(), '/') ?>/Store/Edit.app?CaseID=AA0&BookID=1&FlagStoneID=A&PageID=3">/Store/Edit.app</a></li>
                <li><a href="<?= rtrim(base_url(), '/') ?>/Store/View.app?CaseID=AA0&BookID=1&FlagStoneID=A&PageID=3">/Store/View.app</a></li>
            </ul>
        </div>
    </div>

    <p style="margin-top: 24px;">
        Base URL: <code><?= htmlspecialchars(base_url()) ?></code>
    </p>
</body>
</html>
