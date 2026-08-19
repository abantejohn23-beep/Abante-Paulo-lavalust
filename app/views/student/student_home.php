<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title ?? 'Student Home'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Creepster&family=Nunito+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --pumpkin: #ff7518;
            --pumpkin-dim: #d95f0e;
            --witch: #9d4edd;
            --witch-glow: rgba(157,78,221,0.25);
            --slime: #7bff5c;
            --bg: #0a0510;
            --bg2: #140b1f;
            --bg3: #1d1129;
            --border: rgba(157,78,221,0.25);
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
            overflow-x: hidden;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                radial-gradient(ellipse 60% 40% at 15% 10%, rgba(157,78,221,0.18), transparent 60%),
                radial-gradient(ellipse 50% 40% at 85% 20%, rgba(255,117,24,0.12), transparent 60%),
                radial-gradient(ellipse 60% 50% at 50% 100%, rgba(123,255,92,0.06), transparent 60%);
            pointer-events: none;
            z-index: 0;
        }

        .bats { position: fixed; inset: 0; pointer-events: none; z-index: 0; font-size: 1.4rem; opacity: 0.5; }
        .bats span { position: absolute; animation: flap 6s ease-in-out infinite; }
        .bats span:nth-child(1) { top: 8%; left: 6%; animation-delay: 0s; }
        .bats span:nth-child(2) { top: 18%; right: 10%; animation-delay: 1.5s; }
        .bats span:nth-child(3) { top: 40%; left: 85%; animation-delay: 3s; }
        .bats span:nth-child(4) { top: 65%; left: 4%; animation-delay: 2s; }

        @keyframes flap {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-18px) rotate(-8deg); }
        }

        .wrap { position: relative; z-index: 1; max-width: 900px; margin: 0 auto; padding: 0 2rem; }

        nav {
            position: sticky;
            top: 0;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.1rem 2rem;
            border-bottom: 1px solid var(--border);
            backdrop-filter: blur(10px);
            background: rgba(10,5,16,0.75);
        }

        .nav-logo {
            font-family: var(--spook);
            font-size: 1.4rem;
            letter-spacing: 0.03em;
            color: var(--pumpkin);
            text-decoration: none;
            text-shadow: 0 0 14px var(--witch-glow);
        }

        .nav-links { display: flex; gap: 0.5rem; align-items: center; }

        .nav-links a {
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 700;
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.2s;
            border: 1px solid transparent;
        }

        .nav-links a:hover {
            color: var(--text);
            border-color: var(--border);
            background: var(--bg3);
        }

        .nav-links a.active {
            color: #fff;
            background: var(--witch);
            box-shadow: 0 0 18px var(--witch-glow);
        }

        .hero {
            padding: 6rem 2rem 3rem;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(157,78,221,0.12);
            border: 1px solid var(--border);
            color: var(--witch);
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.4rem 1rem;
            border-radius: 999px;
            margin-bottom: 2rem;
        }

        .hero h1 {
            font-family: var(--spook);
            font-weight: 400;
            font-size: clamp(2.4rem, 7vw, 4.2rem);
            line-height: 1.15;
            color: var(--pumpkin);
            text-shadow: 0 0 30px rgba(255,117,24,0.35);
            margin-bottom: 1.25rem;
        }

        .hero h1 .glow { color: var(--witch); text-shadow: 0 0 30px var(--witch-glow); }

        .hero p {
            max-width: 520px;
            margin: 0 auto 2.5rem;
            color: var(--text-muted);
            font-size: 1.05rem;
            line-height: 1.7;
        }

        .pass-note {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            background: rgba(123,255,92,0.08);
            border: 1px solid rgba(123,255,92,0.35);
            color: #a6ffa0;
            padding: 0.8rem 1.2rem;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 2.5rem;
        }

        .actions { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.9rem 1.8rem;
            border-radius: 10px;
            font-weight: 800;
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--pumpkin);
            color: #1a0a00;
        }

        .btn-primary:hover {
            background: var(--pumpkin-dim);
            box-shadow: 0 0 30px rgba(255,117,24,0.4);
            transform: translateY(-2px);
        }

        .btn-ghost {
            background: transparent;
            color: var(--text-muted);
            border: 1px solid var(--border);
        }

        .btn-ghost:hover { color: var(--text); border-color: var(--witch); background: var(--bg3); }

        .card-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            padding: 1rem 2rem 6rem;
            max-width: 900px;
            margin: 0 auto;
        }

        .info-card {
            background: var(--bg2);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1.5rem;
            text-align: center;
        }

        .info-card .icon { font-size: 1.8rem; margin-bottom: 0.6rem; }
        .info-card h3 { font-size: 0.95rem; margin-bottom: 0.4rem; color: var(--text); }
        .info-card p { font-size: 0.82rem; color: var(--text-muted); line-height: 1.5; }

        footer {
            border-top: 1px solid var(--border);
            padding: 1.75rem 2rem;
            text-align: center;
            color: var(--text-muted);
            font-size: 0.82rem;
            position: relative;
            z-index: 1;
        }

        @media (max-width: 700px) {
            .card-row { grid-template-columns: 1fr; }
            .nav-links a:not(.active) { display: none; }
        }
    </style>
</head>
<body>

<div class="bats">
    <span>🦇</span><span>🦇</span><span>🦇</span><span>🦇</span>
</div>

<nav>
    <a class="nav-logo" href="<?= site_url('student'); ?>">🎃 Haunted Hallway</a>
    <div class="nav-links">
        <a href="<?= site_url('student'); ?>" class="active">Home</a>
        <a href="<?= site_url('student/profile'); ?>">Student Profile</a>
        <a href="<?= site_url(''); ?>">Back to Portal</a>
    </div>
</nav>

<div class="hero wrap">
    <div class="badge">👻 Web Systems & Technologies — Laboratory Activity</div>
    <h1>Welcome to the <span class="glow">Haunted Hallway</span></h1>
    <p>
        This is the student home page, built with LavaLust's routing,
        controllers, and views. Step through the gate to unlock the
        protected student profile guarded by a middleware spirit.
    </p>
    <div class="pass-note">
        🕯️ A haunted pass has been stamped into your session. You may
        now enter the Student Profile.
    </div>
    <div class="actions">
        <a href="<?= site_url('student/profile'); ?>" class="btn btn-primary">Enter the Crypt →</a>
        <a href="<?= site_url(''); ?>" class="btn btn-ghost">Return to Portal</a>
    </div>
</div>

<div class="card-row">
    <div class="info-card">
        <div class="icon">🕸️</div>
        <h3>Route</h3>
        <p>/student and /student/profile connect the browser to StudentController.</p>
    </div>
    <div class="info-card">
        <div class="icon">🧙</div>
        <h3>Controller</h3>
        <p>StudentController::index() and ::profile() render the two views.</p>
    </div>
    <div class="info-card">
        <div class="icon">🔒</div>
        <h3>Middleware</h3>
        <p>StudentMiddleware guards the profile route with a session check.</p>
    </div>
</div>

<footer>
    🎃 Student Information Page &middot; LavaLust Laboratory Activity &middot; <?= date('Y'); ?>
</footer>

</body>
</html>
