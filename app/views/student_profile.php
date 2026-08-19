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
    --card:#16161a;
    --card2:#1c1c21;
    --border:rgba(255,255,255,.08);
    --text:#f4f4f5;
    --muted:#8b8b93;
    --ok:#3ddc84;
    --sans:'Space Grotesk',sans-serif;
    --mono:'JetBrains Mono',monospace;
  }
  body{
    font-family:var(--sans);
    background:
      radial-gradient(circle at 15% 10%, var(--glow), transparent 40%),
      radial-gradient(circle at 85% 90%, rgba(61,220,132,.08), transparent 45%),
      var(--bg);
    color:var(--text);min-height:100vh;display:flex;flex-direction:column;
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
  .navlinks a{color:var(--muted);text-decoration:none;font-weight:500;}
  .navlinks a:hover{color:var(--text);}
  .navlinks a.active{color:var(--lava);}

  main{flex:1;display:flex;align-items:center;justify-content:center;padding:60px 6vw;}

  .id-card{
    width:100%;max-width:820px;background:var(--card);border:1px solid var(--border);
    border-radius:22px;overflow:hidden;box-shadow:0 30px 60px rgba(0,0,0,.45);
    display:grid;grid-template-columns:260px 1fr;
  }
  @media (max-width:640px){ .id-card{grid-template-columns:1fr;} }

  .id-left{
    background:linear-gradient(160deg,var(--lava),var(--lava-dim));
    padding:34px 26px;display:flex;flex-direction:column;align-items:center;
    text-align:center;position:relative;
  }
  .id-left::after{
    content:"";position:absolute;inset:0;
    background:radial-gradient(circle at 30% 0%, rgba(255,255,255,.18), transparent 55%);
  }
  .photo-wrap{
    width:140px;height:140px;border-radius:18px;overflow:hidden;border:3px solid rgba(255,255,255,.85);
    box-shadow:0 14px 30px rgba(0,0,0,.35);margin-bottom:18px;position:relative;z-index:1;
  }
  .photo-wrap img{width:100%;height:100%;object-fit:cover;display:block;}
  .id-left h2{position:relative;z-index:1;font-size:19px;color:#fff;margin-bottom:4px;}
  .id-left .role{position:relative;z-index:1;font-family:var(--mono);font-size:11px;
    color:rgba(255,255,255,.85);letter-spacing:.6px;text-transform:uppercase;
    background:rgba(0,0,0,.18);padding:5px 11px;border-radius:999px;}

  .id-right{padding:32px 34px;}
  .id-right .eyebrow{
    font-family:var(--mono);font-size:12px;color:var(--lava);letter-spacing:.5px;
    display:flex;align-items:center;gap:8px;margin-bottom:10px;
  }
  .id-right .eyebrow .dot{width:8px;height:8px;border-radius:50%;background:var(--ok);
    box-shadow:0 0 8px var(--ok);}
  .id-right h1{font-size:22px;margin-bottom:22px;}

  .fields{display:grid;grid-template-columns:1fr 1fr;gap:16px 22px;}
  .field{background:var(--card2);border:1px solid var(--border);border-radius:12px;padding:12px 14px;}
  .field.full{grid-column:1/-1;}
  .field .k{font-family:var(--mono);font-size:10px;color:var(--muted);letter-spacing:.5px;
    text-transform:uppercase;margin-bottom:5px;}
  .field .v{font-size:14px;font-weight:600;}

  .actions{margin-top:26px;display:flex;gap:12px;flex-wrap:wrap;}
  .btn{display:inline-flex;align-items:center;gap:8px;padding:12px 20px;border-radius:10px;
    font-weight:600;font-size:13px;text-decoration:none;border:1px solid var(--border);color:var(--text);
    transition:border-color .2s,color .2s;}
  .btn:hover{border-color:var(--lava);color:var(--lava);}

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
    <a href="<?= site_url('student') ?>">Home</a>
    <a href="<?= site_url('student/profile') ?>" class="active">Student Profile</a>
  </div>
</nav>

<main>
  <div class="id-card">
    <div class="id-left">
      <div class="photo-wrap">
        <img src="<?= htmlspecialchars($student['photo']) ?>" alt="Photo of <?= htmlspecialchars($student['name']) ?>">
      </div>
      <h2><?= htmlspecialchars($student['name']) ?></h2>
      <span class="role">Verified Student</span>
    </div>

    <div class="id-right">
      <div class="eyebrow"><span class="dot"></span> ACCESS GRANTED · StudentMiddleware</div>
      <h1>Student Digital ID</h1>

      <div class="fields">
        <div class="field"><div class="k">Student ID</div><div class="v"><?= htmlspecialchars($student['student_id']) ?></div></div>
        <div class="field"><div class="k">Section</div><div class="v"><?= htmlspecialchars($student['section']) ?></div></div>
        <div class="field full"><div class="k">Course</div><div class="v"><?= htmlspecialchars($student['course']) ?></div></div>
        <div class="field"><div class="k">Year Level</div><div class="v"><?= htmlspecialchars($student['year_level']) ?></div></div>
        <div class="field"><div class="k">Contact No.</div><div class="v"><?= htmlspecialchars($student['contact']) ?></div></div>
        <div class="field full"><div class="k">Email</div><div class="v"><?= htmlspecialchars($student['email']) ?></div></div>
        <div class="field full"><div class="k">Address</div><div class="v"><?= htmlspecialchars($student['address']) ?></div></div>
        <div class="field full"><div class="k">Hobbies / Interests</div><div class="v"><?= htmlspecialchars($student['hobbies']) ?></div></div>
      </div>

      <div class="actions">
        <a class="btn" href="<?= site_url('student') ?>">← Back to Home</a>
      </div>
    </div>
  </div>
</main>

<footer>Laboratory Activity No. 3 · LavaLust Routing · Controllers · Views · Middleware</footer>

</body>
</html>
