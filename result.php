<?php
session_start();

// Ambil hasil evaluasi dari session
$results = $_SESSION['interview_result'] ?? [];

// Decode JSON jika masih string
if (is_string($results)) {
  $decoded = json_decode($results, true);
  if ($decoded) $results = $decoded;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Jobify | Interview Result</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      color: #f8f9fa;
      background: url('bg.png') no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* ===== Navbar ===== */
    .navbar {
      background-color: #0d1b2a !important;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      transition: all 0.4s ease;
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

    /* ===== Main Content ===== */
    main {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding: 60px 20px 40px;
    }

    .container-box {
      background: rgba(30, 42, 56, 0.9);
      border-radius: 20px;
      padding: 40px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.4);
      width: 100%;
      max-width: 950px;
      border: 2px solid #0f4c5c;
      backdrop-filter: blur(6px);
    }

    h2 {
      font-weight: 700;
      color: #00d4a6;
      text-align: center;
      margin-bottom: 35px;
      text-shadow: 0 0 8px rgba(0,212,166,0.6);
    }

    .card {
      background: linear-gradient(145deg, #1b263b, #0d1b2a);
      border-radius: 16px;
      border: 2px solid #00d4a6;
      box-shadow: 0 6px 18px rgba(0,212,166,0.2);
      transition: 0.3s;
      color: #f8f9fa;
    }

    .card:hover {
      box-shadow: 0 10px 28px rgba(0,212,166,0.35);
      transform: translateY(-3px);
    }

    .card-title {
      color: #00d4a6;
      font-weight: 600;
      font-size: 1.1rem;
    }

    .text-success { color: #00d4a6 !important; }
    .text-primary { color: #0d6efd !important; }

    .btn-custom {
      border-radius: 30px;
      font-weight: 600;
      padding: 10px 22px;
      margin: 15px 10px 0;
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .btn-custom:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 15px rgba(0,0,0,0.25);
    }

    .btn-green { background-color: #00d4a6; color: #0d1b2a; border: none; }
    .btn-blue { background-color: #0d6efd; color: #fff; border: none; }

    /* ===== Footer ===== */
    footer {
      background: #0d1b2a;
      color: #aaa;
      text-align: center;
      padding: 15px 0;
      font-size: 0.9rem;
      margin-top: auto;
      box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.3);
    }

    /* ===== Responsive ===== */
    @media (max-width: 768px) {
      .container-box {
        padding: 25px;
      }
      .card-title {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>
  <!-- 🌐 Navbar -->
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">
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

  <!-- 🧩 Main Content -->
  <main>
    <div class="container-box">
      <h2>📋 Interview Assessment Results</h2>

      <?php if (empty($results)): ?>
        <div class="alert alert-warning text-center mb-4">
          No evaluation results yet. Please complete the interview first.
        </div>
      <?php else: ?>
        <?php foreach ($results as $item): ?>
          <div class="card mb-3">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($item['question'] ?? '') ?></h5>
              <p><b>Your Answer:</b> <?= htmlspecialchars($item['answer'] ?? '') ?></p>
              <p class="text-success"><b>AI HR Feedback:</b> <?= htmlspecialchars($item['feedback'] ?? '') ?></p>
              <p class="text-primary"><b>Score:</b> <?= htmlspecialchars($item['score'] ?? 0) ?>/100</p>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>

      <div class="text-center mt-4">
        <a href="interview.php" class="btn btn-custom btn-green">
          <i class="bi bi-arrow-repeat"></i> Repeat Interview
        </a>
        <a href="index.php" class="btn btn-custom btn-blue">
          <i class="bi bi-house-door-fill"></i> Back to Dashboard
        </a>
      </div>
    </div>
  </main>

  <!-- 🦶 Footer -->
  <footer>
    <p class="mb-0">&copy; 2025 Jobify | All Rights Reserved</p>
  </footer>
</body>
</html>
