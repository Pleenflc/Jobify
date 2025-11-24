<!-- interviewtips.php -->
<div class="modal-header border-0 text-center flex-column">
  <h2 class="fw-bold" style="color:#00d4a6;">💬 Interview Tips</h2>
  <p class="text-light">Master communication skills and ace your next interview!</p>
</div>

<div class="modal-body px-4 py-3">
  <!-- Carousel Tips -->
  <div id="interviewCarousel" class="carousel slide">
    <div class="carousel-inner">

      <!-- Tip 1 -->
      <div class="carousel-item active">
        <div class="d-flex flex-column flex-md-row align-items-start gap-3">
          <video playsinline class="rounded-4 shadow-lg" style="width: 40%; height: auto;">
            <source src="videos/intertip1.mp4" type="video/mp4">
          </video>
          <div style="width: 60%;">
            <h5 class="fw-bold" style="color:#00d4a6;">Research the company before the interview</h5>
            <p class="text-light">Understand its mission, products, and industry position. This shows the interviewer that you are genuinely interested and prepared.</p>
          </div>
        </div>
      </div>

      <!-- Tip 2 -->
      <div class="carousel-item">
        <div class="d-flex flex-column flex-md-row align-items-start gap-3">
          <video playsinline class="rounded-4 shadow-lg" style="width: 40%; height: auto;">
            <source src="videos/intertip2.mp4" type="video/mp4">
          </video>
          <div style="width: 60%;">
            <h5 class="fw-bold" style="color:#00d4a6;">Practice answering common questions</h5>
            <p class="text-light">Rehearse responses to frequently asked questions to gain confidence. Practice helps you communicate clearly and reduce nervousness.</p>
          </div>
        </div>
      </div>

      <!-- Tip 3 -->
      <div class="carousel-item">
        <div class="d-flex flex-column flex-md-row align-items-start gap-3">
          <video playsinline class="rounded-4 shadow-lg" style="width: 40%; height: auto;">
            <source src="videos/intertip3.mp4" type="video/mp4">
          </video>
          <div style="width: 60%;">
            <h5 class="fw-bold" style="color:#00d4a6;">Dress professionally</h5>
            <p class="text-light">Choose attire that is appropriate for the company’s culture. Dressing well makes a strong first impression and shows respect.</p>
          </div>
        </div>
      </div>

      <!-- Tip 4 -->
      <div class="carousel-item">
        <div class="d-flex flex-column flex-md-row align-items-start gap-3">
          <video playsinline class="rounded-4 shadow-lg" style="width: 40%; height: auto;">
            <source src="videos/intertip4.mp4" type="video/mp4">
          </video>
          <div style="width: 60%;">
            <h5 class="fw-bold" style="color:#00d4a6;">Maintain good posture and eye contact</h5>
            <p class="text-light">Sit upright and look at the interviewer to show confidence. These non-verbal cues convey professionalism and engagement.</p>
          </div>
        </div>
      </div>

      <!-- Tip 5 -->
      <div class="carousel-item">
        <div class="d-flex flex-column flex-md-row align-items-start gap-3">
          <video playsinline class="rounded-4 shadow-lg" style="width: 40%; height: auto;">
            <source src="videos/intertip5.mp4" type="video/mp4">
          </video>
          <div style="width: 60%;">
            <h5 class="fw-bold" style="color:#00d4a6;">End with a polite thank you and follow-up</h5>
            <p class="text-light">Express gratitude at the end of the interview. Following up with a message reinforces your interest and professionalism.</p>
          </div>
        </div>
      </div>

    </div>

    <!-- Carousel Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#interviewCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#interviewCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
</div>

<div class="modal-footer border-0 justify-content-center">
  <button type="button" class="btn btn-outline-light px-4 rounded-pill" data-bs-dismiss="modal">Close</button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const carousel = document.querySelector('#interviewCarousel');
  const videos = carousel.querySelectorAll('video');

  videos.forEach(video => {
    video.pause();
    video.currentTime = 0;
  });

  videos[0].play().catch(() => {});

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
    videos.forEach(video => {
      video.muted = false;
    });
    const activeVideo = carousel.querySelector('.carousel-item.active video');
    if (activeVideo) activeVideo.play().catch(() => {});
    document.body.removeEventListener('click', enableAudio);
  });
});
</script>
