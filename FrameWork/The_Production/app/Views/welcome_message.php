<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to CodeIgniter 4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .welcome-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            padding: 50px;
            max-width: 800px;
            text-align: center;
        }
        .welcome-container h1 {
            color: #333;
            margin-bottom: 20px;
            font-weight: 700;
            font-size: 3em;
        }
        .welcome-container .subtitle {
            color: #666;
            font-size: 1.2em;
            margin-bottom: 40px;
        }
        .version-badge {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 8px 16px;
            border-radius: 50px;
            margin-bottom: 20px;
            font-size: 0.9em;
            font-weight: 600;
        }
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin: 40px 0;
            text-align: left;
        }
        .feature-card {
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            border-left: 4px solid #667eea;
        }
        .feature-card h3 {
            color: #667eea;
            margin-bottom: 10px;
            font-size: 1.1em;
        }
        .feature-card p {
            color: #666;
            margin: 0;
            font-size: 0.95em;
        }
        .cta-buttons {
            margin-top: 40px;
        }
        .cta-buttons a {
            margin: 0 10px;
            padding: 12px 30px;
            font-size: 1em;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-primary-custom {
            background: #667eea;
            color: white;
        }
        .btn-primary-custom:hover {
            background: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .btn-secondary-custom {
            background: #e9ecef;
            color: #333;
        }
        .btn-secondary-custom:hover {
            background: #dee2e6;
            transform: translateY(-2px);
        }
        .status {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-top: 30px;
        }
        .status strong {
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <div class="version-badge">CodeIgniter 4 - Portable Edition</div>
        <h1>🚀 Welcome!</h1>
        <p class="subtitle">Your CodeIgniter 4 application is ready to develop</p>

        <div class="features">
            <div class="feature-card">
                <h3>⚡ Fast & Light</h3>
                <p>Portable framework that runs immediately without dependencies</p>
            </div>
            <div class="feature-card">
                <h3>📁 Organized</h3>
                <p>Clean MVC structure for controllers, models, and views</p>
            </div>
            <div class="feature-card">
                <h3>🔧 Customizable</h3>
                <p>Easy to configure and extend for your specific needs</p>
            </div>
            <div class="feature-card">
                <h3>📚 Well Documented</h3>
                <p>Comprehensive guides and ready-to-use examples</p>
            </div>
        </div>

        <div class="cta-buttons">
            <a href="https://codeigniter.com/user_guide/" target="_blank" class="btn-secondary-custom">📖 Read Documentation</a>
            <a href="#" onclick="location.href='/CodeIgniter/admin'; return false;" class="btn-primary-custom">Create Your First Page</a>
        </div>

        <div class="status">
            <strong>✅ Status:</strong> Your application is running successfully. Start building!
        </div>

        <hr style="margin-top: 40px; margin-bottom: 20px;">
        <p style="color: #999; font-size: 0.9em;">
            <strong>Next Steps:</strong> Edit your controllers in <code>app/Controllers/</code>, create views in <code>app/Views/</code>, and define routes in <code>app/Config/Routes.php</code>
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
