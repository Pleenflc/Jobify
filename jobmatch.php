<?php
// jobmatch.php
// Job Match Page with consistent navbar (with LOGO.png)

// Handle JSON POST from frontend
if ($_SERVER['REQUEST_METHOD'] === 'POST' && strpos($_SERVER['CONTENT_TYPE'] ?? '', 'application/json') !== false) {
    header('Content-Type: application/json');
    $input = json_decode(file_get_contents('php://input'), true);
    $profile = $input['profile'] ?? [];

    if (empty($profile)) {
        echo json_encode(['error' => 'No profile data provided.']);
        exit;
    }

    $results = fallback_recommendations($profile);
    echo json_encode(['result' => $results]);
    exit;
}

// --- Fallback recommender ---
function fallback_recommendations($profile) {
    $skills = array_map('strtolower', $profile['skills'] ?? []);
    $candidates = [];

    $map = [
        'microsoft office' => ['Office Administrator', 'Data Entry Specialist'],
        'data analysis' => ['Data Analyst', 'Business Intelligence Analyst'],
        'accounting' => ['Junior Accountant', 'Finance Assistant'],
        'digital marketing' => ['Digital Marketing Specialist', 'SEO Specialist'],
        'graphic design' => ['Graphic Designer', 'Visual Designer'],
        'video editing' => ['Video Editor', 'Content Creator'],
        'programming' => ['Software Engineer', 'Backend Developer'],
        'web development' => ['Frontend Developer', 'Full-Stack Developer'],
        'database' => ['Database Administrator', 'Data Engineer'],
        'cloud computing' => ['Cloud Engineer', 'DevOps Engineer'],
        'cybersecurity' => ['Security Analyst', 'IT Security Specialist'],
        'ui/ux' => ['UI/UX Designer', 'Product Designer'],
        'sap' => ['SAP Consultant', 'ERP Analyst'],
        'project management' => ['Project Coordinator', 'Project Manager'],
        'foreign language' => ['Customer Support (multi-lingual)', 'Localization Specialist'],
        'communication' => ['Customer Success', 'Account Manager'],
        'leadership' => ['Team Lead', 'Operations Supervisor'],
        'teamwork' => ['Associate / Team Member', 'Junior Specialist'],
        'problem solving' => ['Support Engineer', 'Operations Analyst'],
        'sales' => ['Sales Representative', 'Business Development'],
        'customer service' => ['Customer Service Representative', 'Support Agent'],
    ];

    foreach ($map as $k => $titles) {
        foreach ($skills as $s) {
            if (strpos($s, $k) !== false || strpos($s, explode(' ', $k)[0]) !== false) {
                foreach ($titles as $t) $candidates[$t] = ($candidates[$t] ?? 0) + 1;
            }
        }
    }

    if (empty($candidates)) {
        $candidates = [
            'Intern / Trainee' => 1,
            'Customer Service Representative' => 1,
            'Administrative Assistant' => 1,
        ];
    }

    arsort($candidates);
    $results = [];
    foreach (array_slice($candidates, 0, 6) as $title => $score) {
        $results[] = [
            'title' => $title,
            'level' => 'Entry - Mid',
            'skills' => array_slice($profile['skills'] ?? [], 0, 6),
            'justification' => 'Matched from your listed skills: ' . implode(', ', array_slice($profile['skills'] ?? [], 0, 6)),
            'query' => $title . ' ' . ($profile['preferred_location'] ?? ''),
        ];
    }
    return $results;
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Jobify | Job Match</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700;800&display=swap');
:root {
  --accent: #00d4a6;
  --navy-1: #0d1b2a;
  --navy-2: #1b263b;
  --muted: #f8f9fa;
}

body {
      font-family: 'Poppins', sans-serif;
      color: #f8f9fa;
      background: url('bg.png') no-repeat center center fixed;
      background-size: cover;
      overflow-x: hidden;
    }

main { flex: 1; padding: 40px 0; }

/* Navbar */
    .navbar {
      background-color: #0d1b2a !important;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      transition: all 0.4s ease;
    }
    .navbar.scrolled {
      background-color: rgba(13, 27, 42, 0.95) !important;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
      backdrop-filter: blur(8px);
    }
    .navbar-brand {
      font-weight: 700;
      color: #00d4a6 !important;
      font-size: 1.5rem;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .navbar-brand img {
      height: 35px;
      width: auto;
    }
    .navbar-nav .nav-link {
      color: #f8f9fa !important;
      margin-right: 20px;
      transition: 0.3s;
    }
    .navbar-nav .nav-link:hover {
      color: #00d4a6 !important;
    }

.btn-accent {
  border-radius: 30px;
  font-weight: 700;
  border: 1px solid rgba(0,0,0,0.15);
  transition: transform .2s ease, box-shadow .2s ease;
}
.btn-accent:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 20px rgba(0,0,0,0.5);
}
.card-panel {
  border-radius: 18px;
  padding: 22px;
  background: linear-gradient(145deg, #1e2a38, #0d1b2a);
  box-shadow: 6px 6px 18px rgba(0,0,0,0.45), -6px -6px 18px rgba(255,255,255,0.03);
  color: var(--muted);
}
.card-panel.secondary {
  background: linear-gradient(145deg, #0f4c5c, #1b263b);
}
.skill-pill {
  display:inline-block;
  background: rgba(0,212,166,0.12);
  color: var(--accent);
  padding: 6px 12px;
  border-radius: 999px;
  margin: 4px;
  font-weight: 600;
  font-size: .9rem;
}
footer {
  background: var(--navy-1);
  text-align: center;
  color: #9aa6b2;
  padding: 12px 0;
  border-top: 1px solid rgba(255,255,255,0.04);
  margin-top: 32px;
}
.layout-shell { display: flex; gap: 2%; align-items: flex-start; }
.left-col { flex-basis: 60%; }
.right-col { flex-basis: 36%; }
@media (max-width: 992px) {
  .layout-shell { flex-direction: column; }
  .left-col, .right-col { flex-basis: 100%; }
}
</style>
</head>
<body>
<!-- 🌐 Navbar -->
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="LOGO.png" alt="Jobify Logo">
        Jobify
      </a>
      <button class="navbar-toggler text-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <i class="bi bi-list"></i>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="toolsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Tools
            </a>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="toolsDropdown">
              <li><a class="dropdown-item" href="rules.php">Interview Simulator</a></li>
              <li><a class="dropdown-item" href="jobmatch.php">Job Matching</a></li>
              <li><a class="dropdown-item" href="jobprep.php">CV Analyzer</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link" href="index.php#tips">Tips & Learning</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php#about">About</a></li>
        </ul>
      </div>
    </div>
  </nav>

<main class="container">
  <div class="page-title text-center mb-4" data-aos="fade-up">
    <h1 class="fw-bold text-accent"><i class="bi bi-briefcase-fill me-2"></i>JobMatch — Find Jobs that Fit Your Skills</h1>
    <p class="text-white">Fill out your profile and select skills. Click "Get Recommendations" to receive job suggestions.</p>
  </div>

  <div class="layout-shell">
    <!-- LEFT -->
    <div class="left-col">
      <div class="card-panel" data-aos="fade-right">
        <form id="profileForm">
          <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control" placeholder="Your full name">
          </div>

          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" placeholder="you@example.com">
            </div>
            <div class="col-md-6">
              <label class="form-label">Highest Education</label>
              <input type="text" name="education" class="form-control" placeholder="e.g. BSc Information Systems">
            </div>
          </div>

          <div class="row g-3 mt-3">
            <div class="col-md-6">
              <label class="form-label">Desired Role / Interest</label>
              <input type="text" name="desired_role" class="form-control" placeholder="e.g. Data Analyst, Marketing">
            </div>
            <div class="col-md-6">
              <label class="form-label">Preferred Location</label>
              <input type="text" name="preferred_location" class="form-control" placeholder="e.g. Jakarta">
            </div>
          </div>

          <hr class="my-4">
          <h5 class="text-info mb-3">Select Skills</h5>
          <div class="row">
            <?php
              $skills = [
                "Microsoft Office (Excel, Word, PowerPoint)","Data Analysis","Accounting & Finance","Digital Marketing (SEO/Ads)",
                "Graphic Design (Photoshop/Illustrator)","Video Editing","Programming (Python/Java/PHP/C#)","Web Development (HTML/CSS/JS)",
                "Database Management (MySQL/SQL Server)","Cloud Computing (AWS/GCP/Azure)","Cybersecurity","UI/UX Design",
                "ERP / SAP Systems","Project Management (Jira/Trello)","Foreign Languages (English/Mandarin/etc.)",
                "Communication","Leadership","Teamwork","Problem Solving","Critical Thinking","Creativity","Negotiation","Public Speaking","Time Management","Adaptability"
              ];
              foreach ($skills as $s) {
                $val = htmlspecialchars($s, ENT_QUOTES);
                echo "<div class='col-md-6 mb-2'><div class='form-check'><input class='form-check-input' type='checkbox' name='skills[]' value=\"{$val}\" id=\"sk_".md5($val)."\"><label class='form-check-label' for='sk_".md5($val)."'>".$val."</label></div></div>";
              }
            ?>
          </div>

          <div class="mt-4 d-flex gap-2">
            <button type="button" id="getRecBtn" class="btn btn-success btn-accent"><i class="bi bi-rocket-takeoff me-2"></i>Get Recommendations</button>
            <button type="button" id="clearBtn" class="btn btn-outline-light"><i class="bi bi-x-circle me-2"></i>Clear</button>
          </div>
        </form>
      </div>
    </div>

    <!-- RIGHT -->
    <div class="right-col">
      <div class="card-panel secondary" data-aos="fade-left">
        <h5 class="text-warning"><i class="bi bi-list-task me-2"></i>Summary</h5>
        <div id="summaryBox" class="mt-2 small text-white">
          <strong>Name:</strong> <span id="sum_name">-</span><br>
          <strong>Education:</strong> <span id="sum_education">-</span><br>
          <strong>Skills:</strong> <div id="sum_skills" class="mt-2"></div>
          <strong>Role:</strong> <span id="sum_desired">-</span><br>
          <strong>Location:</strong> <span id="sum_location">-</span>
        </div>

        <hr class="my-3" />
        <h6 class="text-info"><i class="bi bi-lightbulb me-2"></i>Recommendations</h6>
        <div id="resultsArea" class="mt-2">
          <p class="text-white small">No recommendations yet.</p>
        </div>
      </div>
    </div>
  </div>
</main>

<footer>
  <div class="container"><small>&copy; 2025 Jobify | All Rights Reserved</small></div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
AOS.init({ duration: 900, once: true });

function collectProfile() {
  const fd = new FormData(document.getElementById('profileForm'));
  return {
    name: fd.get('name')||'', email: fd.get('email')||'',
    education: fd.get('education')||'', desired_role: fd.get('desired_role')||'',
    preferred_location: fd.get('preferred_location')||'', skills: fd.getAll('skills[]')||[]
  };
}
function renderSummary(p) {
  document.getElementById('sum_name').textContent=p.name||'-';
  document.getElementById('sum_education').textContent=p.education||'-';
  document.getElementById('sum_desired').textContent=p.desired_role||'-';
  document.getElementById('sum_location').textContent=p.preferred_location||'-';
  document.getElementById('sum_skills').innerHTML=p.skills.length?p.skills.map(s=>`<span class="skill-pill">${s}</span>`).join(' '):'-';
}

document.getElementById('getRecBtn').addEventListener('click', async()=>{
  const p=collectProfile(); renderSummary(p);
  const area=document.getElementById('resultsArea');
  area.innerHTML=`<p class='text-muted small'>Searching recommendations for ${p.name||'user'}...</p>`;
  try{
    const res=await fetch(location.href,{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({profile:p})});
    const j=await res.json(); if(j.error){area.innerHTML=`<div class='text-danger small'>${j.error}</div>`;return;}
    const list=j.result||[]; if(!list.length){area.innerHTML='<p class="text-muted small">No matches found.</p>';return;}
    const ul=document.createElement('div'); ul.className='small';
    list.forEach(it=>{
      const q=encodeURIComponent(it.query||it.title||''); const loc=encodeURIComponent(p.preferred_location||'');
      ul.innerHTML+=`<div class='mb-3'><strong>${it.title}</strong> <small class='text-muted'>${it.level}</small><br>
      <small>${it.justification}</small><br>
      <small>Skills: ${(it.skills||[]).join(', ')}</small><br>
      <a class='text-success' href='https://www.linkedin.com/jobs/search/?keywords=${q}%20${loc}' target='_blank'>LinkedIn</a> • 
      <a class='text-success' href='https://www.indeed.com/jobs?q=${q}&l=${loc}' target='_blank'>Indeed</a> • 
      <a class='text-success' href='https://www.google.com/search?q=${q}+jobs+${loc}' target='_blank'>Google</a></div>`;
    });
    area.innerHTML=''; area.appendChild(ul);
  }catch(e){area.innerHTML=`<div class='text-danger small'>Error: ${e.message}</div>`;}
});
document.getElementById('clearBtn').addEventListener('click',()=>{
  document.getElementById('profileForm').reset();
  renderSummary({name:'',education:'',desired_role:'',preferred_location:'',skills:[]});
  document.getElementById('resultsArea').innerHTML='<p class="text-muted small">No recommendations yet.</p>';
});
</script>
</body>
</html>
