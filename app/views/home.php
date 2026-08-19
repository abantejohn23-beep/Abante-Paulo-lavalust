<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information Portal — Halloween Edition</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Creepster&family=Nunito+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --pumpkin: #ff7518;
            --pumpkin-dim: #d95f0e;
            --witch: #9d4edd;
            --witch-glow: rgba(157,78,221,0.2);
            --slime: #7bff5c;
            --bg: #0a0510;
            --bg2: #140b1f;
            --bg3: #1d1129;
            --border: rgba(157,78,221,0.22);
            --text: #f3ecff;
            --text-muted: #b8a9d9;
            --spook: 'Creepster', cursive;
            --sans: 'Nunito Sans', sans-serif;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: var(--sans);
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                radial-gradient(ellipse 60% 40% at 15% 0%, rgba(157,78,221,0.16), transparent 60%),
                radial-gradient(ellipse 50% 40% at 90% 15%, rgba(255,117,24,0.1), transparent 60%);
            pointer-events: none;
            z-index: 0;
        }

        nav {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(10,5,16,0.8);
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
            font-family: var(--spook);
            font-weight: 400;
            font-size: 1.3rem;
            color: var(--pumpkin);
            display: flex;
            align-items: center;
            gap: 8px;
            text-shadow: 0 0 14px var(--witch-glow);
        }

        .nav-links { display: flex; gap: 28px; list-style: none; position: relative; z-index: 1; }

        .nav-links a {
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.95rem;
            transition: color 0.2s;
        }

        .nav-links a:hover { color: var(--pumpkin); }

        .nav-actions { display: flex; gap: 12px; position: relative; z-index: 1; }

        .btn {
            padding: 9px 20px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
        }

        .btn-ghost { color: var(--pumpkin); background: transparent; border: 1px solid var(--border); }
        .btn-ghost:hover { background: var(--bg3); }

        .btn-solid { background: var(--pumpkin); color: #1a0a00; }
        .btn-solid:hover { background: var(--pumpkin-dim); box-shadow: 0 0 22px rgba(255,117,24,0.4); }

        .hero {
            max-width: 1100px;
            margin: 0 auto;
            padding: 100px 24px 70px;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .hero-badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 99px;
            background: rgba(157,78,221,0.12);
            border: 1px solid var(--border);
            color: var(--witch);
            font-size: 0.8rem;
            font-weight: 700;
            margin-bottom: 24px;
        }

        .hero h1 {
            font-family: var(--spook);
            font-weight: 400;
            font-size: clamp(2.4rem, 6vw, 3.6rem);
            line-height: 1.25;
            margin-bottom: 18px;
            color: var(--pumpkin);
            text-shadow: 0 0 26px rgba(255,117,24,0.3);
        }

        .hero h1 span { color: var(--witch); text-shadow: 0 0 26px var(--witch-glow); }

        .hero p {
            max-width: 560px;
            margin: 0 auto 32px;
            color: var(--text-muted);
            font-size: 1.05rem;
            line-height: 1.7;
        }

        .hero-actions { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; }
        .hero-actions .btn { padding: 13px 28px; font-size: 0.95rem; }

        .features {
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 24px 90px;
            position: relative;
            z-index: 1;
        }

        .section-title {
            text-align: center;
            font-family: var(--spook);
            font-weight: 400;
            font-size: 1.9rem;
            color: var(--witch);
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
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 34px rgba(0,0,0,0.4);
            border-color: var(--witch);
        }

        .feature-icon {
            width: 46px;
            height: 46px;
            border-radius: 10px;
            background: rgba(255,117,24,0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            margin-bottom: 16px;
        }

        .feature-card h3 { font-size: 1.05rem; margin-bottom: 8px; }
        .feature-card p { color: var(--text-muted); font-size: 0.9rem; line-height: 1.55; }

        .about {
            background: var(--bg2);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            position: relative;
            z-index: 1;
        }

        .about-inner {
            max-width: 800px;
            margin: 0 auto;
            padding: 70px 24px;
            text-align: center;
        }

        .about h2 { font-family: var(--spook); font-weight: 400; font-size: 1.7rem; color: var(--pumpkin); margin-bottom: 16px; }
        .about p { color: var(--text-muted); line-height: 1.7; }

        footer {
            padding: 30px 24px;
            text-align: center;
            color: var(--text-muted);
            font-size: 0.85rem;
            position: relative;
            z-index: 1;
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
            <div class="logo">🎃 Information Portal</div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#about">About</a></li>
            </ul>
            <div class="nav-actions">
                <a href="<?= site_url('student'); ?>" class="btn btn-ghost">Student Info</a>
            </div>
        </div>
    </nav>

    <section class="hero" id="home">
        <span class="hero-badge">👻 Welcome, if you dare</span>
        <h1>Your one-stop <span>Information Portal</span></h1>
        <p>Access announcements, services, and resources in one place — this Halloween edition also hides a haunted Student Information corner guarded by its own middleware spirit.</p>
        <div class="hero-actions">
            <a href="<?= site_url('student'); ?>" class="btn btn-solid">🎃 Enter Student Info</a>
            <a href="#features" class="btn btn-ghost">Learn More</a>
        </div>
    </section>

    <section class="features" id="features">
        <h2 class="section-title">What you can do here</h2>
        <p class="section-sub">Everything you need, organized and easy to reach.</p>
        <div class="feature-grid">
            <a href="<?= site_url('student'); ?>" class="feature-card">
                <div class="feature-icon">🎓</div>
                <h3>Student Info</h3>
                <p>Visit the Haunted Hallway to view the student home page and unlock the protected profile.</p>
            </a>
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
        </div>
    </section>

    <section class="about" id="about">
        <div class="about-inner">
            <h2>About this Portal</h2>
            <p>This Information Portal is the LavaLust Laboratory Activity landing page — replacing the default LavaLust welcome screen — dressed up for Halloween. Explore the Student Info section to see routing, controllers, views, and middleware working together.</p>
        </div>
    </section>

    <footer>
        🎃 &copy; <?php echo date('Y'); ?> Information Portal. All rights reserved.
    </footer>

</body>
</html>
