<!-- cvresumetips.php -->
<div class="modal-header border-0 text-center flex-column">
  <h2 class="fw-bold" style="color:#00d4a6;">📝 CV & Resume Tips</h2>
  <p class="text-light">Create a standout CV and impress recruiters!</p>
</div>

<div class="modal-body px-4 py-3">
  <!-- Carousel Tips -->
  <div id="cvCarousel" class="carousel slide">
    <div class="carousel-inner">

      <!-- Tip 1 -->
      <div class="carousel-item active">
        <div class="d-flex flex-column flex-md-row align-items-start gap-3">
          <video autoplay playsinline class="rounded-4 shadow-lg" style="width: 40%; height: auto;">
            <source src="videos/cvtip1.mp4" type="video/mp4">
          </video>
          <div style="width: 60%;">
            <h5 class="fw-bold" style="color:#00d4a6;">Keep your CV simple and clear</h5>
            <p class="text-light">Use an organized layout that is easy to read. Simplicity helps recruiters quickly find your key qualifications.</p>
          </div>
        </div>
      </div>

      <!-- Tip 2 -->
      <div class="carousel-item">
        <div class="d-flex flex-column flex-md-row align-items-start gap-3">
          <video autoplay playsinline class="rounded-4 shadow-lg" style="width: 40%; height: auto;">
            <source src="videos/cvtip2.mp4" type="video/mp4">
          </video>
          <div style="width: 60%;">
            <h5 class="fw-bold" style="color:#00d4a6;">Highlight your most relevant experience</h5>
            <p class="text-light">Focus on achievements that match the job requirements. Relevant experience demonstrates that you are the right fit for the role.</p>
          </div>
        </div>
      </div>

      <!-- Tip 3 -->
      <div class="carousel-item">
        <div class="d-flex flex-column flex-md-row align-items-start gap-3">
          <video autoplay playsinline class="rounded-4 shadow-lg" style="width: 40%; height: auto;">
            <source src="videos/cvtip3.mp4" type="video/mp4">
          </video>
          <div style="width: 60%;">
            <h5 class="fw-bold" style="color:#00d4a6;">Use action verbs and measurable results</h5>
            <p class="text-light">Begin bullet points with strong verbs and include quantifiable outcomes. This makes your accomplishments concrete and impressive.</p>
          </div>
        </div>
      </div>

      <!-- Tip 4 -->
      <div class="carousel-item">
        <div class="d-flex flex-column flex-md-row align-items-start gap-3">
          <video autoplay playsinline class="rounded-4 shadow-lg" style="width: 40%; height: auto;">
            <source src="videos/cvtip4.mp4" type="video/mp4">
          </video>
          <div style="width: 60%;">
            <h5 class="fw-bold" style="color:#00d4a6;">Avoid spelling and grammar mistakes</h5>
            <p class="text-light">Proofread your CV carefully before sending it. Errors can create a negative impression and reduce your chances of selection.</p>
          </div>
        </div>
      </div>

      <!-- Tip 5 -->
      <div class="carousel-item">
        <div class="d-flex flex-column flex-md-row align-items-start gap-3">
          <video autoplay playsinline class="rounded-4 shadow-lg" style="width: 40%; height: auto;">
            <source src="videos/cvtip5.mp4" type="video/mp4">
          </video>
          <div style="width: 60%;">
            <h5 class="fw-bold" style="color:#00d4a6;">Customize your CV for each job application</h5>
            <p class="text-light">Tailor your resume to match the job description. Personalization shows effort and increases the likelihood of being noticed.</p>
          </div>
        </div>
      </div>

    </div>

    <!-- Carousel Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#cvCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#cvCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
</div>

<div class="modal-footer border-0 justify-content-center">
  <button type="button" class="btn btn-outline-light px-4 rounded-pill" data-bs-dismiss="modal">Close</button>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.querySelector('#cvCarousel');
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
  });
</script>
