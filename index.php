<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Jobify | Career Readiness Dashboard</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      color: #f8f9fa;
      background: url('bg.png') no-repeat center center fixed;
      background-size: cover;
      overflow-x: hidden;
    }

    html {
      scroll-behavior: smooth;
    }

    /* Biar pas klik navbar scroll ke judul section, bukan ke card */
    section[id] {
      scroll-margin-top: 100px; /* tinggi navbar kira-kira 80-100px */
    }

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

    /* Hero Section */
    .hero {
      text-align: center;
      padding: 50px 20px 60px;
      background: rgba(13, 27, 42, 0.7);
      backdrop-filter: blur(6px);
    }
    .hero h1 {
      font-weight: 800;
      font-size: 2.8rem;
      color: #fff;
      margin-top: 5px;
    }
    .hero p {
      color: #ddd;
      font-size: 1.1rem;
      max-width: 600px;
      margin: 10px auto 0;
    }
    .hero h2 {
      color: #fff;
      font-weight: 700;
      margin-top: 50px;
      font-size: 1.8rem;
    }

    /* Section Title */
    .section-title {
      text-align: center;
      margin-top: 80px;
      margin-bottom: 40px;
    }
    .section-title h2 {
      font-weight: 700;
      color: #fff;
    }

    /* Feature Cards */
    .feature-card {
      background: #0d1b2a;
      border-radius: 20px;
      padding: 30px;
      box-shadow: 6px 6px 15px rgba(0,0,0,0.4);
      transition: all 0.4s ease;
      text-align: center;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      min-height: 230px;
    }
    .feature-card:hover {
      transform: translateY(-10px) scale(1.03);
      box-shadow: 10px 10px 25px rgba(0,0,0,0.6);
    }
    .feature-card h5 {
      color: #00d4a6;
      font-weight: 700;
      margin-bottom: 15px;
    }
    .feature-card p {
      color: #ccc;
      margin-bottom: 25px;
      font-size: 0.95rem;
      flex-grow: 1;
    }

    /* Outline Buttons */
    .btn-outline-jobify {
      color: #00d4a6;
      border: 2px solid #00d4a6;
      border-radius: 30px;
      padding: 8px 22px;
      font-weight: 600;
      background: transparent;
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-block;
    }
    .btn-outline-jobify:hover {
      background-color: #00d4a6;
      color: #fff;
      transform: translateY(-3px);
      box-shadow: 0 0 15px rgba(0,212,166,0.4);
    }

    /* About Jobify Section */
    .about-section {
      margin-top: 50px;
      margin-bottom: 50px;
      padding-top: 80px;
      padding-bottom: 50px;
    }

    .about-section h2 {
      color: #ffffff;
      font-weight: 700;
      margin-bottom: 1rem;
    }

    .about-section p {
      color: #d9d9d9;
      line-height: 1.6;
      font-size: 1rem;
      max-width: 800px;
      margin: 0 auto;
    }

    footer {
      background: #0d1b2a;
      color: #aaa;
      text-align: center;
      padding: 15px 0;
      margin-top: 60px;
      font-size: 0.9rem;
    }

    /* Smooth fade in/out for scroll animations */
    [data-aos][data-aos][data-aos-duration="1000"] {
      transition-property: transform, opacity;
      transition-duration: 1s;
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
          <li class="nav-item"><a class="nav-link active" href="#hero">Home</a></li>
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
          <li class="nav-item"><a class="nav-link" href="#tips">Tips & Learning</a></li>
          <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
        </ul>
      </div>
    </div>
  </nav>

  
  <!-- 🏠 Hero Section -->
  <section id="hero" class="hero" data-aos="fade-down">
    <h1>Welcome to <span style="color:#00d4a6;">Jobify!</span></h1>
    <p>Your all-in-one platform to boost your career readiness.</p>
    <h2>Let’s get started.</h2>
  </section>

  <section class="container mt-5" data-aos="fade-up">
  <div class="row align-items-center justify-content-center">
    <div class="col-md-8" data-aos="fade-right">
      <div class="video-wrapper ratio ratio-16x9 rounded-4 shadow-lg overflow-hidden"
           style="border:3px solid rgba(0,212,166,0.5);">
        <video id="motivationVideo" width="100%" controls poster="thumb.png" style="background-color: #0d1b2a;">
          <source src="Beautiful Prison.mp4" type="video/mp4">
          Browser Anda tidak mendukung video HTML5.
        </video>
      </div>
    </div>

    <div class="col-md-4 text-light" data-aos="fade-left">
      <h3 class="fw-bold text-info mb-3">Leave your comfort zone and go get a job!</h3>
      <p style="font-size:1rem; line-height:1.6;">
        Sometimes, the comfort we build around ourselves becomes the walls that quietly hold us back.
True growth begins the moment we step beyond those walls, when we dare to face uncertainty and chase something greater.
Remember, progress doesn’t come from staying safe; it comes from moving forward, even when it feels uncomfortable.
      </p>
    </div>
  </div>
</section>

  <!-- 🧰 Tools & Practice -->
  <section id="tools" class="container">
    <div class="section-title" data-aos="fade-up">
      <h2>Tools & Practice</h2>
    </div>
    <div class="row g-4 justify-content-center">
      <div class="col-md-4" data-aos="flip-up" data-aos-delay="100">
        <div class="feature-card">
          <h5><i class="bi bi-person-video3 me-2"></i> Interview Simulator</h5>
          <p>Interactive interview practice with virtual HR for real-world readiness.</p>
          <a href="rules.php" class="btn-outline-jobify">Try Now</a>
        </div>
      </div>
      <div class="col-md-4" data-aos="flip-up" data-aos-delay="200">
        <div class="feature-card">
          <h5><i class="bi bi-lightbulb-fill me-2"></i> Job Matching</h5>
          <p>Find jobs that match your skills with smart features.</p>
          <a href="jobmatch.php" class="btn-outline-jobify">Search Jobs</a>
        </div>
      </div>
      <div class="col-md-4" data-aos="flip-up" data-aos-delay="300">
        <div class="feature-card">
          <h5><i class="bi bi-journal-text me-2"></i> CV Analyzer</h5>
          <p>Upload your CV or portfolio to be reviewed by AI.</p>
          <a href="jobprep.php" class="btn-outline-jobify">Upload CV</a>
        </div>
      </div>
    </div>
  </section>

  <!-- 📚 Tips & Learning -->
  <section id="tips" class="container">
    <div class="section-title" data-aos="fade-up">
      <h2>Tips & Learning</h2>
    </div>
    <div class="row g-4 justify-content-center">
      <div class="col-md-3" data-aos="flip-up" data-aos-delay="100">
        <div class="feature-card">
          <h5><i class="bi bi-briefcase-fill me-2"></i> Job Tips</h5>
          <p>Learn smart ways to find and apply for jobs effectively.</p>
          <a href="#" class="btn-outline-jobify" data-bs-toggle="modal" data-bs-target="#jobTipsModal">Read More</a>
        </div>
      </div>
      <div class="col-md-3" data-aos="flip-up" data-aos-delay="200">
        <div class="feature-card">
          <h5><i class="bi bi-chat-dots-fill me-2"></i> Interview Tips</h5>
          <p>Master communication skills during interviews.</p>
          <a href="#" class="btn-outline-jobify" data-bs-toggle="modal" data-bs-target="#interviewTipsModal">Read More</a>
        </div>
      </div>
      <div class="col-md-3" data-aos="flip-up" data-aos-delay="300">
        <div class="feature-card">
          <h5><i class="bi bi-file-earmark-person-fill me-2"></i> CV & Resume Tips</h5>
          <p>Learn to create a professional CV.</p>
          <a href="#" class="btn-outline-jobify" data-bs-toggle="modal" data-bs-target="#CVTipsModal">Read More</a>
        </div>
      </div>
      <div class="col-md-3" data-aos="flip-up" data-aos-delay="400">
        <div class="feature-card">
          <h5><i class="bi bi-bar-chart-fill me-2"></i> Career Growth Tips</h5>
          <p>Discover ways to grow up your career path.</p>
          <a href="#" class="btn-outline-jobify" data-bs-toggle="modal" data-bs-target="#careerTipsModal">Read More</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ℹ️ About -->
  <section class="about-section container text-center" data-aos="fade-up" id="about">
    <h2>About Jobify</h2>
    <p>
Jobify is an AI-powered career platform that helps you prepare for your dream job through three main tools: an Interview Simulator for realistic practice and feedback, a Job Matching feature that recommends jobs based on your skills, and a CV Analyzer that improves your resume with AI suggestions. It also offers a Tips & Learning section with practical career guidance to help you grow and succeed.
    </p>
  </section>

  <!-- 🦶 Footer -->
  <footer>
    <p class="mb-0">&copy; 2025 Jobify | All Rights Reserved</p>
  </footer>

  <!-- Job Tips Modal -->
<div class="modal fade" id="jobTipsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content bg-dark text-light rounded-4 shadow-lg">
      <?php include 'jobtips.php'; ?>
    </div>
  </div>
</div>

  <!-- Interview Tips Modal -->
<div class="modal fade" id="interviewTipsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content bg-dark text-light rounded-4 shadow-lg">
      <?php include 'interviewtips.php'; ?>
    </div>
  </div>
</div>

  <!-- CV & Resume Tips Modal -->
<div class="modal fade" id="CVTipsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content bg-dark text-light rounded-4 shadow-lg">
      <?php include 'cvtips.php'; ?>
    </div>
  </div>
</div>

  <!-- Career Growth Tips Modal -->
<div class="modal fade" id="careerTipsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content bg-dark text-light rounded-4 shadow-lg">
      <?php include 'careertips.php'; ?>
    </div>
  </div>
</div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
  AOS.init({
    duration: 800,
    once: true,
  });
  </script>
</body>
</html>
