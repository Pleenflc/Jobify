<?php
// rules.php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Jobify | Interview Simulator Rules</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      color: #f8f9fa;
      background: url('bg.png') no-repeat center center fixed;
      background-size: cover;
      margin: 0;
      overflow-x: hidden;
      overflow-y: auto; /* biar bisa scroll dan dropdown muncul */
      height: 100vh;
      display: flex;
      flex-direction: column;
    }


    /* Navbar */
    .navbar {
      background-color: #0d1b2a !important;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      z-index: 1000;
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

    /* Konten utama */
    .main-content {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
      z-index: 2;
    }

    .card {
      border-radius: 20px;
      background-color: #0d1b2a !important;
      box-shadow: 0 8px 20px rgba(0,0,0,0.5);
      max-width: 700px;
      width: 90%;
      padding: 40px;
    }

    .card h2 {
      font-weight: bold;
      text-align: center;
      margin-bottom: 25px;
    }

    .btn-start {
      background-color: #00adb5;
      border: none;
      font-size: 18px;
      font-weight: bold;
      border-radius: 12px;
      transition: 0.3s;
    }
    .btn-start:hover {
      background-color: #008b8f;
    }

    ul {
      list-style: disc;
      padding-left: 20px;
      margin-bottom: 25px;
    }
    ul li {
      margin-bottom: 8px;
    }

    /* Panel kanan animasi */
    .right-panel {
      position: absolute;
      top: 0;
      right: 0;
      width: 40%;
      height: 100%;
      background: linear-gradient(270deg, rgba(0,173,181,0.2), rgba(31,64,104,0.1));
      animation: slideGradient 6s ease-in-out infinite alternate;
      z-index: 1;
    }
    @keyframes slideGradient {
      0% { transform: translateX(0); opacity: 0.6; }
      100% { transform: translateX(-30px); opacity: 0.9; }
    }

    /* Bubble blur dekoratif */
    .bubble {
      position: absolute;
      border-radius: 50%;
      background: rgba(0,173,181,0.25);
      filter: blur(50px);
      animation: float 12s infinite ease-in-out alternate;
      z-index: 0;
    }
    .bubble1 {
      width: 200px;
      height: 200px;
      bottom: 10%;
      right: 10%;
    }
    .bubble2 {
      width: 150px;
      height: 150px;
      top: 20%;
      right: 5%;
      animation-delay: 3s;
    }
    @keyframes float {
      0% { transform: translateY(0) translateX(0); }
      100% { transform: translateY(-40px) translateX(-20px); }
    }

    footer {
      background: #0d1b2a;
      color: #aaa;
      text-align: center;
      padding: 12px 0;
      font-size: 0.9rem;
      z-index: 5;
    }
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

  <!-- Panel kanan dan bubble -->
  <div class="right-panel"></div>
  <div class="bubble bubble1"></div>
  <div class="bubble bubble2"></div>

  <!-- 🎯 Card Rules -->
  <div class="main-content">
    <div class="card text-light">
      <h2>Simulation Interview Rules ⚠️</h2>
      <ul>
        <li>This interview is a simulation with a virtual HR representative.</li>
        <li>Each question will appear one at a time.</li>
        <li>Turn on your camera so the HR can provide the questions.</li>
        <li>Turn on your microphone to answer with your voice.</li>
        <li>Follow the interview until the end and answer seriously.</li>
        <li>After finishing, you will receive feedback & a score from the AI HR.</li>
        <li>It is recommended to use earphones or other audio devices so that the sound can be heard clearly.</li>
      </ul>
      <div class="text-center">
        <a href="interview.php" class="btn btn-start px-4 py-2">Let’s Start</a>
      </div>
    </div>
  </div>

  <!-- 🦶 Footer -->
  <footer>
    <p class="mb-0">&copy; 2025 Jobify | All Rights Reserved</p>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
