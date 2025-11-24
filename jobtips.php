<!-- jobtips.php -->
<div class="modal-header border-0 text-center flex-column">
  <h2 class="fw-bold" style="color:#00d4a6;">💼 Job Tips</h2>
  <p class="text-light">Learn smart ways to find and apply for jobs effectively!</p>
</div>

<div class="modal-body px-4 py-3">
  <!-- Carousel Tips -->
  <div id="jobCarousel" class="carousel slide">
    <div class="carousel-inner">

      <!-- Tip 1 -->
      <div class="carousel-item active">
        <div class="d-flex flex-column flex-md-row align-items-start gap-3">
          <video autoplay muted playsinline class="rounded-4 shadow-lg" style="width: 40%; height: auto;">
            <source src="videos/jobtip1.mp4" type="video/mp4">
          </video>
          <div style="width: 60%;">
            <h5 class="fw-bold" style="color:#00d4a6;">Understand your company’s culture</h5>
            <p class="text-light">Learn the company’s values, mission, and work environment to fit in smoothly. Understanding culture helps you make decisions that align with organizational goals.</p>
          </div>
        </div>
      </div>

      <!-- Tip 2 -->
      <div class="carousel-item">
        <div class="d-flex flex-column flex-md-row align-items-start gap-3">
          <video autoplay muted playsinline class="rounded-4 shadow-lg" style="width: 40%; height: auto;">
            <source src="videos/jobtip2.mp4" type="video/mp4">
          </video>
          <div style="width: 60%;">
            <h5 class="fw-bold" style="color:#00d4a6;">Communicate effectively with your team</h5>
            <p class="text-light">Share your ideas clearly and listen actively to your colleagues. Good communication prevents misunderstandings and strengthens teamwork.</p>
          </div>
        </div>
      </div>

      <!-- Tip 3 -->
      <div class="carousel-item">
        <div class="d-flex flex-column flex-md-row align-items-start gap-3">
          <video autoplay muted playsinline class="rounded-4 shadow-lg" style="width: 40%; height: auto;">
            <source src="videos/jobtip3.mp4" type="video/mp4">
          </video>
          <div style="width: 60%;">
            <h5 class="fw-bold" style="color:#00d4a6;">Manage your time wisely</h5>
            <p class="text-light">Prioritize tasks and set realistic deadlines to boost productivity. Effective time management reduces stress and helps you achieve goals efficiently.</p>
          </div>
        </div>
      </div>

      <!-- Tip 4 -->
      <div class="carousel-item">
        <div class="d-flex flex-column flex-md-row align-items-start gap-3">
          <video autoplay muted playsinline class="rounded-4 shadow-lg" style="width: 40%; height: auto;">
            <source src="videos/jobtip4.mp4" type="video/mp4">
          </video>
          <div style="width: 60%;">
            <h5 class="fw-bold" style="color:#00d4a6;">Stay positive and professional</h5>
            <p class="text-light">Maintain a respectful attitude even in challenging situations. A positive outlook improves relationships and creates a better work environment.</p>
          </div>
        </div>
      </div>

      <!-- Tip 5 -->
      <div class="carousel-item">
        <div class="d-flex flex-column flex-md-row align-items-start gap-3">
          <video autoplay muted playsinline class="rounded-4 shadow-lg" style="width: 40%; height: auto;">
            <source src="videos/jobtip5.mp4" type="video/mp4">
          </video>
          <div style="width: 60%;">
            <h5 class="fw-bold" style="color:#00d4a6;">Keep learning and improving your skills</h5>
            <p class="text-light">Continuously update your knowledge to stay competitive. Developing new skills opens opportunities for career advancement.</p>
          </div>
        </div>
      </div>

    </div>

    <!-- Carousel Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#jobCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#jobCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
</div>

<div class="modal-footer border-0 justify-content-center">
  <button type="button" class="btn btn-outline-light px-4 rounded-pill" data-bs-dismiss="modal">Close</button>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.querySelector('#jobCarousel');
    const videos = carousel.querySelectorAll('video');

    videos.forEach((video, index) => {
      if (index !== 0) video.pause();
    });

    carousel.addEventListener('slide.bs.carousel', function() {
      videos.forEach(video => {
        video.pause();
        video.currentTime = 0;
      });
    });

    carousel.addEventListener('slid.bs.carousel', function() {
      const activeVideo = carousel.querySelector('.carousel-item.active video');
      if (activeVideo) {
        activeVideo.play().catch(() => {});
      }
    });

    document.body.addEventListener('click', function enableAudio() {
      videos.forEach(video => video.muted = false);
      document.body.removeEventListener('click', enableAudio);
    });
  });
</script>
