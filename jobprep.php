<?php
// jobprep.php — CV Analyzer Offline (PHP only)
$analysisResult = "";

// Fungsi sederhana untuk extract teks dari PDF (butuh pdftotext di server atau fallback)
function extractPdfText($filePath) {
    // Cek kalau pdftotext tersedia di server
    $output = "";
    $cmd = "pdftotext " . escapeshellarg($filePath) . " -"; // output ke stdout
    exec($cmd, $outputArr, $status);
    if ($status === 0) {
        $output = implode("\n", $outputArr);
    } else {
        $output = "Unable to extract text from PDF.";
    }
    return $output;
}

// Fungsi feedback sederhana berbasis teks
function analyzeCVText($text) {
    $feedback = [];
    $score = 0;

    // Panjang CV
    $length = strlen($text);
    if ($length < 500) {
        $feedback[] = "Your CV is quite short. Consider adding more details about your experience.";
        $score += 20;
    } elseif ($length < 1500) {
        $feedback[] = "CV length is reasonable.";
        $score += 60;
    } else {
        $feedback[] = "CV is detailed, good job!";
        $score += 80;
    }

    // Summary check
    if (stripos($text, "summary") !== false || stripos($text, "objective") !== false) {
        $feedback[] = "You have a summary/objective section. This is good!";
        $score += 10;
    } else {
        $feedback[] = "Consider adding a professional summary or objective at the top.";
    }

    // Skills check
    $skills = ["PHP", "JavaScript", "Python", "SQL", "HTML", "CSS"];
    $foundSkills = [];
    foreach ($skills as $skill) {
        if (stripos($text, $skill) !== false) {
            $foundSkills[] = $skill;
        }
    }
    if (!empty($foundSkills)) {
        $feedback[] = "Skills detected: " . implode(", ", $foundSkills);
        $score += 10;
    } else {
        $feedback[] = "Try listing your relevant skills clearly.";
    }

    // Experience check
    if (stripos($text, "experience") !== false || stripos($text, "internship") !== false) {
        $feedback[] = "Experience section is included. Great!";
        $score += 10;
    } else {
        $feedback[] = "Add your work or internship experience if possible.";
    }

    $score = min($score, 100);
    return implode("\n- ", ["Feedback:"] + $feedback) . "\n\nScore: $score/100";
}

// Proses upload
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["cvFile"])) {
    $fileTmpPath = $_FILES["cvFile"]["tmp_name"];
    $fileType = $_FILES["cvFile"]["type"];

    if ($fileType === "application/pdf") {
        $cvText = extractPdfText($fileTmpPath);
        $analysisResult = analyzeCVText($cvText);
    } else {
        $analysisResult = "Please upload a valid PDF file.";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Jobify | CV Analyzer</title>

  <!-- Bootstrap & Icons & AOS -->
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
      background: url('bg.png') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Poppins', sans-serif;
      color: var(--muted);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* Navbar */
    .navbar {
      background-color: #0d1b2a !important;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      z-index: 10;
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

    main { flex: 1; padding: 40px 0; }

    .page-title { text-align: center; margin-bottom: 32px; }
    .page-title h1 {
      color: white;
      font-size: 2rem;
      font-weight: 800;
      text-shadow: 2px 2px 8px rgba(0,0,0,0.6);
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

    footer {
      background: #0d1b2a;
      color: #aaa;
      text-align: center;
      padding: 12px 0;
      font-size: 0.9rem;
      z-index: 5;
    }
    .layout-shell { 
  display: flex; 
  gap: 2%; 
  align-items: flex-start; 
}

.left-col { 
  flex-basis: 30%; 
}

.right-col { 
  flex-basis: 70%; 
}

@media (max-width: 992px) {
  .layout-shell { 
    flex-direction: column; 
  }
  .left-col, .right-col { 
    flex-basis: 100%; 
  }
}
.analysis-output p { margin-bottom: 0.8rem; }
    .analysis-output ul { margin-left: 1.2rem; margin-bottom: 1rem; }
    .analysis-output strong { color: #ffd166; }
  </style>
</head>
<body>
  <!-- 🌐 Navbar -->
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="LOGO.png" alt="Jobify Logo">
        <strong>Jobify</strong>
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
  <div class="page-title" data-aos="fade-up">
    <h1><i class="bi bi-file-earmark-person-fill me-2"></i>CV Analyzer — Improve Your Resume</h1>
    <p class="text-white">Upload your CV (PDF) and get instant feedback from Gemini AI to make it stronger.</p>
  </div>

  <div class="layout-shell">
    <!-- LEFT -->
    <div class="left-col">
      <div class="card-panel" data-aos="fade-right">
        <form method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label fw-bold">Upload CV (PDF only)</label>
            <input type="file" name="cvFile" accept="application/pdf" class="form-control mb-3" required>
            <button type="submit" class="btn btn-success btn-accent w-100"><i class="bi bi-upload me-2"></i>Analyze CV</button>
          </div>
        </form>
      </div>
    </div>

    <!-- RIGHT -->
    <div class="right-col">
      <div class="card-panel secondary" data-aos="fade-left">
        <h5 class="text-warning"><i class="bi bi-lightbulb me-2"></i>Analysis Result</h5>
        <div class="mt-3 small" style="white-space: pre-wrap;">
          <?php echo $analysisResult ? htmlspecialchars($analysisResult) : "Upload your CV to get analysis from Gemini."; ?>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- 🦶 Footer -->
  <footer>
    <p class="mb-0">&copy; 2025 Jobify | All Rights Reserved</p>
  </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script> AOS.init({ duration: 900, once: true }); </script>
</body>
</html>