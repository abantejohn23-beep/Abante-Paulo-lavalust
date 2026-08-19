<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($page_title) ?></title>
<link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
  :root{
    --lava:#dd4814;
    --lava-dim:#b83a10;
    --glow:rgba(221,72,20,.18);
    --bg:#0a0a0c;
    --bg2:#111114;
    --card:#16161a;
    --border:rgba(255,255,255,.08);
    --text:#f4f4f5;
    --muted:#8b8b93;
    --ok:#3ddc84;
    --err:#ff5c5c;
    --sans:'Space Grotesk',sans-serif;
    --mono:'JetBrains Mono',monospace;
  }
  body{
    font-family:var(--sans);
    background:
      radial-gradient(circle at 15% 10%, var(--glow), transparent 40%),
      radial-gradient(circle at 85% 90%, rgba(61,220,132,.08), transparent 45%),
      var(--bg);
    color:var(--text);
    min-height:100vh;
    display:flex;
    flex-direction:column;
  }
  nav{
    display:flex;align-items:center;justify-content:space-between;
    padding:22px 6vw;border-bottom:1px solid var(--border);
    background:rgba(10,10,12,.6);backdrop-filter:blur(10px);
    position:sticky;top:0;z-index:10;
  }
  .brand{display:flex;align-items:center;gap:10px;font-weight:700;letter-spacing:.3px;}
  .brand-mark{width:34px;height:34px;border-radius:9px;background:linear-gradient(135deg,var(--lava),var(--lava-dim));
    display:flex;align-items:center;justify-content:center;font-size:16px;box-shadow:0 0 22px var(--glow);}
  .navlinks{display:flex;gap:26px;font-size:14px;}
  .navlinks a{color:var(--muted);text-decoration:none;font-weight:500;transition:color .2s;}
  .navlinks a:hover{color:var(--text);}
  .navlinks a.active{color:var(--lava);}

  main{flex:1;display:flex;align-items:center;justify-content:center;padding:60px 6vw;}
  .gate{
    width:100%;max-width:620px;background:var(--card);border:1px solid var(--border);
    border-radius:20px;padding:44px;position:relative;overflow:hidden;
    box-shadow:0 30px 60px rgba(0,0,0,.4);
  }
  .gate::before{
    content:"";position:absolute;inset:0 0 auto 0;height:4px;
    background:linear-gradient(90deg,var(--lava),transparent 70%);
  }
  .tag{
    display:inline-flex;align-items:center;gap:8px;font-family:var(--mono);
    font-size:12px;color:var(--lava);background:var(--glow);
    border:1px solid rgba(221,72,20,.3);padding:6px 12px;border-radius:999px;margin-bottom:22px;
  }
  h1{font-size:clamp(28px,4vw,36px);line-height:1.15;margin-bottom:14px;}
  p.lead{color:var(--muted);font-size:15px;line-height:1.7;margin-bottom:28px;max-width:48ch;}

  .status{
    display:flex;align-items:center;gap:12px;padding:16px 18px;border-radius:12px;
    font-family:var(--mono);font-size:13px;margin-bottom:26px;border:1px solid;
  }
  .status.ok{background:rgba(61,220,132,.08);border-color:rgba(61,220,132,.3);color:var(--ok);}
  .status.err{background:rgba(255,92,92,.08);border-color:rgba(255,92,92,.3);color:var(--err);}
  .dot{width:9px;height:9px;border-radius:50%;background:currentColor;flex-shrink:0;
    box-shadow:0 0 10px currentColor;}

  .flow{display:flex;align-items:center;gap:10px;font-family:var(--mono);font-size:12px;
    color:var(--muted);margin-bottom:30px;flex-wrap:wrap;}
  .flow span{padding:5px 10px;border:1px solid var(--border);border-radius:7px;}
  .flow .cur{color:var(--lava);border-color:rgba(221,72,20,.4);}
  .flow .arrow{color:var(--border);}

  .actions{display:flex;gap:14px;flex-wrap:wrap;}
  .btn{
    display:inline-flex;align-items:center;gap:8px;padding:14px 24px;border-radius:11px;
    font-weight:600;font-size:14px;text-decoration:none;transition:transform .15s,box-shadow .15s;
    border:1px solid transparent;
  }
  .btn-primary{background:linear-gradient(135deg,var(--lava),var(--lava-dim));color:#fff;
    box-shadow:0 10px 26px var(--glow);}
  .btn-primary:hover{transform:translateY(-2px);}
  .btn-ghost{background:transparent;border-color:var(--border);color:var(--text);}
  .btn-ghost:hover{border-color:var(--lava);color:var(--lava);}

  footer{text-align:center;padding:18px;color:var(--muted);font-size:12px;font-family:var(--mono);}
</style>
</head>
<body>

<nav>
  <div class="brand">
    <div class="brand-mark">🎓</div>
    Student Portal
  </div>
  <div class="navlinks">
    <a href="<?= site_url('student') ?>" class="active">Home</a>
    <a href="<?= site_url('student/profile') ?>">Student Profile</a>
  </div>
</nav>

<main>
  <div class="gate">
    <span class="tag">● CHECKPOINT / student</span>
    <h1>Welcome to the Student Portal.</h1>
    <p class="lead">
      This is the check-in gate. Visiting this page stamps your session so
      the middleware-protected Digital&nbsp;ID page will let you through.
    </p>

    <?php if (!empty($denied)): ?>
      <div class="status err">
        <span class="dot"></span> <?= htmlspecialchars($denied) ?>
      </div>
    <?php else: ?>
      <div class="status ok">
        <span class="dot"></span> Checked in — StudentMiddleware will now allow /student/profile.
      </div>
    <?php endif; ?>

    <div class="flow">
      <span class="cur">Browser</span><span class="arrow">→</span>
      <span>Route</span><span class="arrow">→</span>
      <span>StudentMiddleware</span><span class="arrow">→</span>
      <span>StudentController</span><span class="arrow">→</span>
      <span>View</span>
    </div>

    <div class="actions">
      <a class="btn btn-primary" href="<?= site_url('student/profile') ?>">View Digital ID →</a>
      <a class="btn btn-ghost" href="<?= site_url('student/logout') ?>">Check (test blocked access)</a>
    </div>
  </div>
</main>

<footer>Laboratory Activity No. 3 · LavaLust Routing · Controllers · Views · Middleware</footer>

</body>
</html>
