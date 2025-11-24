<!-- careergrowthtips.php -->
<div class="modal-header border-0 text-center flex-column">
  <h2 class="fw-bold" style="color:#00d4a6;">🚀 Career Growth Tips</h2>
  <p class="text-light">Boost your career and unlock your full potential!</p>
</div>

<div class="modal-body px-4 py-3">
  <!-- Carousel Tips -->
  <div id="careerTipsCarousel" class="carousel slide">
    <div class="carousel-inner">

      <!-- Tip 1 -->
      <div class="carousel-item active">
        <div class="d-flex flex-column flex-md-row align-items-start gap-3 position-relative">
          <div class="video-container" style="width: 40%;">
            <video autoplay muted playsinline class="rounded-4 shadow-lg w-100">
              <source src="videos/careertip1.mp4" type="video/mp4">
            </video>
            <button class="mute-toggle btn btn-sm btn-dark rounded-circle position-absolute top-0 end-0 m-2">
              🔇
            </button>
          </div>
          <div style="width: 60%;">
            <h5 class="fw-bold" style="color:#00d4a6;">Set clear short- and long-term goals</h5>
            <p class="text-light">Define what you want to achieve now and in the future. Goals guide your actions and keep your career path focused.</p>
          </div>
        </div>
      </div>

      <!-- Tip 2 -->
      <div class="carousel-item">
        <div class="d-flex flex-column flex-md-row align-items-start gap-3 position-relative">
          <div class="video-container" style="width: 40%;">
            <video autoplay muted playsinline class="rounded-4 shadow-lg w-100">
              <source src="videos/careertip2.mp4" type="video/mp4">
            </video>
            <button class="mute-toggle btn btn-sm btn-dark rounded-circle position-absolute top-0 end-0 m-2">
              🔇
            </button>
          </div>
          <div style="width: 60%;">
            <h5 class="fw-bold" style="color:#00d4a6;">Learn from mentors and feedback</h5>
            <p class="text-light">Seek guidance and constructive criticism to improve. Learning from others accelerates your professional growth.</p>
          </div>
        </div>
      </div>

      <!-- Tip 3 -->
      <div class="carousel-item">
        <div class="d-flex flex-column flex-md-row align-items-start gap-3 position-relative">
          <div class="video-container" style="width: 40%;">
            <video autoplay muted playsinline class="rounded-4 shadow-lg w-100">
              <source src="videos/careertip3.mp4" type="video/mp4">
            </video>
            <button class="mute-toggle btn btn-sm btn-dark rounded-circle position-absolute top-0 end-0 m-2">
              🔇
            </button>
          </div>
          <div style="width: 60%;">
            <h5 class="fw-bold" style="color:#00d4a6;">Keep networking with professionals</h5>
            <p class="text-light">Build and maintain relationships in your industry. Networking opens doors to opportunities and valuable insights.</p>
          </div>
        </div>
      </div>

      <!-- Tip 4 -->
      <div class="carousel-item">
        <div class="d-flex flex-column flex-md-row align-items-start gap-3 position-relative">
          <div class="video-container" style="width: 40%;">
            <video autoplay muted playsinline class="rounded-4 shadow-lg w-100">
              <source src="videos/careertip4.mp4" type="video/mp4">
            </video>
            <button class="mute-toggle btn btn-sm btn-dark rounded-circle position-absolute top-0 end-0 m-2">
              🔇
            </button>
          </div>
          <div style="width: 60%;">
            <h5 class="fw-bold" style="color:#00d4a6;">Stay adaptable to change</h5>
            <p class="text-light">Be flexible when facing new technologies, roles, or processes. Adaptability ensures long-term success in a dynamic work environment.</p>
          </div>
        </div>
      </div>

      <!-- Tip 5 -->
      <div class="carousel-item">
        <div class="d-flex flex-column flex-md-row align-items-start gap-3 position-relative">
          <div class="video-container" style="width: 40%;">
            <video autoplay muted playsinline class="rounded-4 shadow-lg w-100">
              <source src="videos/careertip5.mp4" type="video/mp4">
            </video>
            <button class="mute-toggle btn btn-sm btn-dark rounded-circle position-absolute top-0 end-0 m-2">
              🔇
            </button>
          </div>
          <div style="width: 60%;">
            <h5 class="fw-bold" style="color:#00d4a6;">Keep your motivation strong after challenges</h5>
            <p class="text-light">Overcome setbacks with resilience and determination. Staying motivated helps you achieve your career objectives despite obstacles.</p>
          </div>
        </div>
      </div>

    </div>

    <!-- Carousel Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#careerTipsCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#careerTipsCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
</div>

<div class="modal-footer border-0 justify-content-center">
  <button type="button" class="btn btn-outline-light px-4 rounded-pill" data-bs-dismiss="modal">Close</button>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.querySelector('#careerTipsCarousel');
    const videos = carousel.querySelectorAll('video');
    const muteButtons = carousel.querySelectorAll('.mute-toggle');

    videos.forEach((v, i) => i !== 0 && v.pause());

    carousel.addEventListener('slide.bs.carousel', () => {
      videos.forEach(v => {
        v.pause();
        v.currentTime = 0;
      });
    });

    carousel.addEventListener('slid.bs.carousel', () => {
      const activeVideo = carousel.querySelector('.carousel-item.active video');
      if (activeVideo) activeVideo.play().catch(() => {});
    });

    document.body.addEventListener('click', function enableAudio() {
      videos.forEach(v => v.muted = false);
      muteButtons.forEach(b => b.textContent = '🔊');
      document.body.removeEventListener('click', enableAudio);
    });

    muteButtons.forEach((btn, index) => {
      btn.addEventListener('click', e => {
        e.stopPropagation();
        const vid = videos[index];
        vid.muted = !vid.muted;
        btn.textContent = vid.muted ? '🔇' : '🔊';
      });
    });
  });
</script>
