<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store/New.app</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; color: #1a1a1a; }
        code { background: #f4f4f4; padding: 2px 6px; border-radius: 4px; }
        .box { border: 1px solid #ddd; padding: 16px; border-radius: 8px; max-width: 720px; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 6px 8px; border-bottom: 1px solid #eee; vertical-align: top; }
        pre { background: #f7f7f7; padding: 10px; border-radius: 6px; }
    </style>
</head>
<body>
    <?php
    $expected = $expectedParams ?? [];
    $matched = $matchedParams ?? [];
    $extra = $extraParams ?? [];
    $params = $params ?? [];
    ?>
    <div class="box">
        <h1>Store/New.app</h1>
        <p>Factory Firmware v2 skeleton route is active.</p>
        <p>Route: <code>/Store/New.app</code></p>
    </div>

    <div class="box" style="margin-top: 16px;">
        <h2>Query Parameters</h2>
        <p>Expected keys: <code><?= $expected ? htmlspecialchars(implode(', ', $expected)) : 'None' ?></code></p>

        <h3>Matched</h3>
        <?php if (!$matched): ?>
            <p>None</p>
        <?php else: ?>
            <table>
                <?php foreach ($matched as $key => $value): ?>
                    <tr><td><strong><?= htmlspecialchars($key) ?></strong></td><td><?= htmlspecialchars((string) $value) ?></td></tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <h3>Extra</h3>
        <?php if (!$extra): ?>
            <p>None</p>
        <?php else: ?>
            <table>
                <?php foreach ($extra as $key => $value): ?>
                    <tr><td><strong><?= htmlspecialchars($key) ?></strong></td><td><?= htmlspecialchars((string) $value) ?></td></tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <h3>Raw</h3>
        <pre><?= htmlspecialchars(json_encode($params, JSON_PRETTY_PRINT)) ?></pre>
    </div>
</body>
</html>
