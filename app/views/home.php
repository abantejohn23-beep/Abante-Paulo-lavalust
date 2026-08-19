<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information Portal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary: #2563eb;
            --primary-dim: #1d4ed8;
            --primary-glow: rgba(37,99,235,0.15);
            --bg: #f8fafc;
            --bg2: #ffffff;
            --border: #e2e8f0;
            --text: #0f172a;
            --text-muted: #64748b;
            --sans: 'Poppins', sans-serif;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: var(--sans);
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        /* ── NAVBAR ── */
        nav {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
        }

        .nav-inner {
            max-width: 1100px;
            margin: 0 auto;
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            font-weight: 700;
            font-size: 1.15rem;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-links {
            display: flex;
            gap: 28px;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.2s;
        }

        .nav-links a:hover { color: var(--primary); }

        .nav-actions { display: flex; gap: 12px; }

        .btn {
            padding: 9px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
        }

        .btn-ghost {
            color: var(--primary);
            background: transparent;
        }

        .btn-ghost:hover { background: var(--primary-glow); }

        .btn-solid {
            background: var(--primary);
            color: #fff;
        }

        .btn-solid:hover { background: var(--primary-dim); }

        /* ── HERO ── */
        .hero {
            max-width: 1100px;
            margin: 0 auto;
            padding: 90px 24px 70px;
            text-align: center;
        }

        .hero-badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 99px;
            background: var(--primary-glow);
            color: var(--primary);
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 24px;
        }

        .hero h1 {
            font-size: 2.6rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 18px;
        }

        .hero h1 span { color: var(--primary); }

        .hero p {
            max-width: 560px;
            margin: 0 auto 32px;
            color: var(--text-muted);
            font-size: 1.05rem;
            line-height: 1.6;
        }

        .hero-actions {
            display: flex;
            gap: 14px;
            justify-content: center;
        }

        .hero-actions .btn { padding: 13px 28px; font-size: 0.95rem; }

        /* ── FEATURES ── */
        .features {
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 24px 90px;
        }

        .section-title {
            text-align: center;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .section-sub {
            text-align: center;
            color: var(--text-muted);
            margin-bottom: 48px;
            max-width: 480px;
            margin-left: auto;
            margin-right: auto;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .feature-card {
            background: var(--bg2);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 28px 24px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 30px rgba(15,23,42,0.06);
        }

        .feature-icon {
            width: 46px;
            height: 46px;
            border-radius: 10px;
            background: var(--primary-glow);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            margin-bottom: 16px;
        }

        .feature-card h3 { font-size: 1.05rem; margin-bottom: 8px; }
        .feature-card p { color: var(--text-muted); font-size: 0.9rem; line-height: 1.55; }

        /* ── ABOUT ── */
        .about {
            background: var(--bg2);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }

        .about-inner {
            max-width: 800px;
            margin: 0 auto;
            padding: 70px 24px;
            text-align: center;
        }

        .about h2 { font-size: 1.7rem; margin-bottom: 16px; }
        .about p { color: var(--text-muted); line-height: 1.7; }

        /* ── FOOTER ── */
        footer {
            padding: 30px 24px;
            text-align: center;
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        @media (max-width: 720px) {
            .nav-links { display: none; }
            .hero h1 { font-size: 1.9rem; }
            .feature-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <nav>
        <div class="nav-inner">
            <div class="logo">📋 Information Portal</div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <div class="nav-actions">
                <a href="#" class="btn btn-ghost">Login</a>
                <a href="#" class="btn btn-solid">Register</a>
            </div>
        </div>
    </nav>

    <section class="hero" id="home">
        <span class="hero-badge">Welcome</span>
        <h1>Your one-stop <span>Information Portal</span></h1>
        <p>Access announcements, services, and resources in one place — built to keep everyone informed, connected, and updated in real time.</p>
        <div class="hero-actions">
            <a href="#" class="btn btn-solid">Get Started</a>
            <a href="#features" class="btn btn-ghost">Learn More</a>
        </div>
    </section>

    <section class="features" id="features">
        <h2 class="section-title">What you can do here</h2>
        <p class="section-sub">Everything you need, organized and easy to reach.</p>
        <div class="feature-grid">
            <div class="feature-card">
                <div class="feature-icon">📢</div>
                <h3>Announcements</h3>
                <p>Stay updated with the latest news, notices, and important updates.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🗂️</div>
                <h3>Services</h3>
                <p>Browse and request available services directly through the portal.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <h3>Reports & Records</h3>
                <p>View records, track requests, and download reports when needed.</p>
            </div>
        </div>
    </section>

    <section class="about" id="about">
        <div class="about-inner">
            <h2>About this Portal</h2>
            <p>This Information Portal was built to make information more accessible, organized, and easy to manage for everyone who relies on it. Replace this section with your project's actual description.</p>
        </div>
    </section>

    <footer id="contact">
        &copy; <?php echo date('Y'); ?> Information Portal. All rights reserved.
    </footer>

</body>
</html>
