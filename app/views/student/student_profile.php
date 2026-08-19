<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title ?? 'Student Profile'); ?></title>
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

        body {
            font-family: var(--sans);
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                radial-gradient(ellipse 60% 40% at 85% 0%, rgba(157,78,221,0.2), transparent 60%),
                radial-gradient(ellipse 50% 40% at 10% 30%, rgba(255,117,24,0.1), transparent 60%);
            pointer-events: none;
            z-index: 0;
        }

        .wrap { position: relative; z-index: 1; max-width: 780px; margin: 0 auto; padding: 0 2rem; }

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
            color: var(--pumpkin);
            text-decoration: none;
            text-shadow: 0 0 14px var(--witch-glow);
        }

        .nav-links { display: flex; gap: 0.5rem; }

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

        .nav-links a:hover { color: var(--text); border-color: var(--border); background: var(--bg3); }
        .nav-links a.active { color: #fff; background: var(--witch); box-shadow: 0 0 18px var(--witch-glow); }

        .page-head { padding: 4rem 2rem 2rem; text-align: center; }

        .page-head .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(123,255,92,0.08);
            border: 1px solid rgba(123,255,92,0.35);
            color: #a6ffa0;
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 0.4rem 1rem;
            border-radius: 999px;
            margin-bottom: 1.5rem;
        }

        .page-head h1 {
            font-family: var(--spook);
            font-weight: 400;
            font-size: clamp(2rem, 6vw, 3.2rem);
            color: var(--witch);
            text-shadow: 0 0 30px var(--witch-glow);
        }

        .profile-card {
            background: var(--bg2);
            border: 1px solid var(--border);
            border-radius: 20px;
            margin: 0 2rem 4rem;
            padding: 2.5rem;
            box-shadow: 0 20px 60px rgba(0,0,0,0.4);
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .profile-top {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            padding-bottom: 1.75rem;
            margin-bottom: 1.75rem;
            border-bottom: 1px dashed var(--border);
        }

        .avatar {
            width: 74px; height: 74px;
            border-radius: 50%;
            background: radial-gradient(circle at 30% 30%, var(--pumpkin), var(--pumpkin-dim));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.1rem;
            flex-shrink: 0;
            box-shadow: 0 0 25px rgba(255,117,24,0.4);
        }

        .profile-top h2 { font-size: 1.4rem; margin-bottom: 0.3rem; }
        .profile-top .role { color: var(--text-muted); font-size: 0.88rem; }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.1rem 1.5rem;
        }

        .info-item {
            background: var(--bg3);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 0.9rem 1.1rem;
        }

        .info-item .label {
            font-size: 0.7rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--slime);
            margin-bottom: 0.3rem;
        }

        .info-item .value { font-size: 0.95rem; color: var(--text); word-break: break-word; }

        .info-item.full { grid-column: 1 / -1; }

        .bio {
            margin-top: 1.75rem;
            padding-top: 1.75rem;
            border-top: 1px dashed var(--border);
            color: var(--text-muted);
            font-size: 0.92rem;
            line-height: 1.75;
        }

        .bio .label {
            font-size: 0.7rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--slime);
            margin-bottom: 0.6rem;
        }

        footer {
            border-top: 1px solid var(--border);
            padding: 1.75rem 2rem;
            text-align: center;
            color: var(--text-muted);
            font-size: 0.82rem;
            position: relative;
            z-index: 1;
        }

        @media (max-width: 600px) {
            .info-grid { grid-template-columns: 1fr; }
            .nav-links a:not(.active) { display: none; }
        }
    </style>
</head>
<body>

<nav>
    <a class="nav-logo" href="<?= site_url('student'); ?>">🎃 Haunted Hallway</a>
    <div class="nav-links">
        <a href="<?= site_url('student'); ?>">Home</a>
        <a href="<?= site_url('student/profile'); ?>" class="active">Student Profile</a>
        <a href="<?= site_url(''); ?>">Back to Portal</a>
    </div>
</nav>

<div class="page-head wrap">
    <div class="badge">🔓 Unlocked by StudentMiddleware</div>
    <h1>Student Profile</h1>
</div>

<div class="profile-card">
    <div class="profile-top">
        <div class="avatar">🧑‍🎓</div>
        <div>
            <h2><?= htmlspecialchars($name); ?></h2>
            <div class="role"><?= htmlspecialchars($course); ?> &middot; <?= htmlspecialchars($year); ?> &middot; Section <?= htmlspecialchars($section); ?></div>
        </div>
    </div>

    <div class="info-grid">
        <div class="info-item">
            <div class="label">🪪 Student ID</div>
            <div class="value"><?= htmlspecialchars($student_id); ?></div>
        </div>
        <div class="info-item">
            <div class="label">📧 Email</div>
            <div class="value"><?= htmlspecialchars($email); ?></div>
        </div>
        <div class="info-item">
            <div class="label">🎓 Course</div>
            <div class="value"><?= htmlspecialchars($course); ?></div>
        </div>
        <div class="info-item">
            <div class="label">📅 Year Level</div>
            <div class="value"><?= htmlspecialchars($year); ?></div>
        </div>
        <div class="info-item">
            <div class="label">🏷️ Section</div>
            <div class="value"><?= htmlspecialchars($section); ?></div>
        </div>
        <div class="info-item">
            <div class="label">☎️ Contact No.</div>
            <div class="value"><?= htmlspecialchars($contact); ?></div>
        </div>
        <div class="info-item full">
            <div class="label">🏚️ Address</div>
            <div class="value"><?= htmlspecialchars($address); ?></div>
        </div>
        <div class="info-item full">
            <div class="label">🕯️ Skills</div>
            <div class="value"><?= htmlspecialchars($skills); ?></div>
        </div>
        <div class="info-item full">
            <div class="label">🦇 Hobbies</div>
            <div class="value"><?= htmlspecialchars($hobbies); ?></div>
        </div>
    </div>

    <div class="bio">
        <div class="label">📜 About</div>
        <p><?= htmlspecialchars($bio); ?></p>
    </div>
</div>

<footer>
    🔒 This page is protected by StudentMiddleware &middot; <?= date('Y'); ?>
</footer>

</body>
</html>
