<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Interview Simulator</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

<style>
body { 
  background: linear-gradient(135deg, #0d1b2a, #1b263b, #0f4c5c); 
  font-family: 'Poppins', sans-serif;
  color: #f8f9fa;
}

.navbar {
  box-shadow: 0 4px 12px rgba(0,0,0,0.3);
  background: #0d1b2a !important;
  border-bottom: 2px solid #00d4a6;
}
.navbar-brand { 
  color: #00d4a6 !important; 
  font-weight: 700;
}

.video-section { 
  position: relative; 
  width: 75%; 
  border-radius: 20px;
  overflow: hidden;
  background: #1e2a38;
  box-shadow: 0 8px 20px rgba(0,0,0,0.4);
  border: 2px solid #0f4c5c;
}
#hrdVideo { width: 100%; height: 100%; object-fit: cover; border-radius: 20px; }

#webcamOverlay {
  position: absolute; 
  top: 15px; right: 15px; 
  width: 220px; height: 160px;
  border: 3px solid #00d4a6; 
  border-radius: 12px; 
  overflow: hidden; 
  box-shadow: 0 0 15px rgba(0,212,166,0.6);
  background: rgba(0,0,0,0.7);
}
#webcam { width: 100%; height: 100%; object-fit: cover; }

.sidebar { 
  width: 25%; 
  display: flex; 
  flex-direction: column; 
  gap: 15px; 
  background: #1e2a38;
  border-left: 2px solid #0f4c5c;
  box-shadow: inset 0 0 15px rgba(0,0,0,0.4);
  padding: 20px;
  border-radius: 20px 0 0 20px;
}

.question-box {
  background: linear-gradient(145deg, #1b263b, #0d1b2a);
  border: 2px solid #00d4a6;
  border-radius: 15px;
  padding: 20px;
  box-shadow: 0 6px 18px rgba(0,212,166,0.15);
  transition: 0.3s;
}
.question-box:hover {
  box-shadow: 0 10px 25px rgba(0,212,166,0.3);
}
.question-box h5 { 
  color: #00d4a6; 
  font-weight: 700;
}

.recorder-box {
  background: linear-gradient(145deg, #1b263b, #0d1b2a);
  border: 2px solid #0d6efd;
  border-radius: 15px;
  padding: 20px;
  box-shadow: 0 6px 18px rgba(13,110,253,0.2);
  transition: 0.3s;
}
.recorder-box:hover {
  box-shadow: 0 10px 25px rgba(13,110,253,0.35);
}
.recorder-box h5 { 
  color: #0d6efd; 
  font-weight: 700;
}

#recordBtn, #toggleCameraBtn, #nextBtn {
  margin-top: 12px;
  border-radius: 30px;
  font-weight: 600;
  padding: 10px 14px;
  transition: transform 0.2s, box-shadow 0.2s;
}
#recordBtn:hover, #toggleCameraBtn:hover, #nextBtn:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 15px rgba(0,0,0,0.25);
}

#transcript {
  margin-top: 15px;
  background: #0d1b2a;
  padding: 15px;
  border-radius: 12px;
  border: 1px solid #00d4a6;
  min-height: 120px;
  font-size: 14px;
  color: #f8f9fa;
  box-shadow: inset 0 0 12px rgba(0,212,166,0.15);
}
</style>

</head>
<body>

<div class="container-fluid d-flex flex-row p-0">
  <div class="video-section p-3 position-relative">
    <video id="hrdVideo" autoplay playsinline></video>
    <div id="webcamOverlay"><video id="webcam" autoplay playsinline></video></div>
  </div>

  <div class="sidebar p-3">
    <div class="question-box mb-3" id="questionBox">
      <h5 class="mb-3">Question From HRD</h5>
      <p id="questionText" class="fs-5">Please turn on the camera to start the interview.</p>
    </div>
    <div class="recorder-box d-flex flex-column">
      <h5 class="mb-3">Voice Recording and Transcription</h5>
      <button id="recordBtn" class="btn btn-primary"><i class="bi bi-mic-fill"></i> Start Recording</button>
      <button id="repeatBtn" class="btn btn-warning mt-2" disabled>
        <i class="bi bi-arrow-repeat"></i> Repeat Answer
      </button>
      <button id="continueBtn" class="btn btn-info mt-2" disabled>
        <i class="bi bi-plus-circle"></i> Continue Answer
      </button>
      <button id="toggleCameraBtn" class="btn btn-secondary"><i class="bi bi-camera-video-off"></i> Turn On Camera</button>
      <div id="transcript">The transcription results will appear here...</div>
      <button id="nextBtn" class="btn btn-success mt-3"><i class="bi bi-arrow-right-circle"></i> Next</button>
    </div>
  </div>
</div>

<form id="resultForm" action="result.php" method="post">
  <input type="hidden" name="answers" id="answersInput">
</form>

<script>
const questionTexts = [
  "Could you tell me a little about yourself?",
  "What motivates you to apply to our company?",
  "What are your strengths and weaknesses?",
  "How do you handle pressure or tight deadlines?",
  "Could you share your previous work or internship experience?",
  "How do you usually work within a team?",
  "How do you deal with conflicts in the workplace?",
  "What has been your greatest achievement so far?",
  "Where do you see yourself in the next five years?",
  "Why should we consider hiring you for this position?"
];

const videos = {
  needCamera: "videos/nyalakan_kamera.mp4",
  listen: "videos/hrd_listening.mp4",
  feedback: "Result.mp4",
  questions: [
    "Q1.mp4",
    "Q2.mp4",
    "Q3.mp4",
    "Q4.mp4",
    "Q5.mp4",
    "Q6.mp4",
    "Q7.mp4",
    "Q8.mp4",
    "Q9.mp4",
    "Q10.mp4"
  ]
};

let currentQuestion = -1;
let allAnswers = [];

const hrdVideo = document.getElementById("hrdVideo");
const webcamVideo = document.getElementById("webcam");
const toggleCameraBtn = document.getElementById("toggleCameraBtn");
const recordBtn = document.getElementById("recordBtn");
const repeatBtn = document.getElementById("repeatBtn");
const continueBtn = document.getElementById("continueBtn");
const nextBtn = document.getElementById("nextBtn");
const questionTextEl = document.getElementById("questionText");
const transcriptDiv = document.getElementById("transcript");

function playVideo(src, callback = null){
  hrdVideo.src = src;
  hrdVideo.load();
  hrdVideo.play();
  hrdVideo.onended = () => { if(callback) callback(); };
}

function showQuestion(index){
  if(index < questionTexts.length){
    currentQuestion = index;
    questionTextEl.innerText = questionTexts[index];
    playVideo(videos.questions[index]);
  } else {
    questionTextEl.innerText = "Interview is over, wait a moment...";
    playVideo(videos.feedback);
  }
}

let stream = null, webcamActive = false;
async function toggleCamera(){
  if(!webcamActive){
    try{
      stream = await navigator.mediaDevices.getUserMedia({video:true});
      webcamVideo.srcObject = stream;
      webcamActive = true;
      toggleCameraBtn.innerHTML = '<i class="bi bi-camera-video"></i> Turn Off Camera';
      toggleCameraBtn.classList.replace("btn-secondary","btn-danger");
      showQuestion(0);
    } catch(err){ alert("Cannot access camera: "+err.message); }
  } else {
    stream.getTracks().forEach(track=>track.stop());
    webcamVideo.srcObject = null;
    webcamActive = false;
    toggleCameraBtn.innerHTML = '<i class="bi bi-camera-video-off"></i> Turn On Camera';
    toggleCameraBtn.classList.replace("btn-danger","btn-secondary");
    playVideo(videos.needCamera);
  }
}
toggleCameraBtn.addEventListener("click", toggleCamera);

let recognition, recognizing = false;
let recordTimeout;

window.SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

if(window.SpeechRecognition){
  recognition = new SpeechRecognition();
  recognition.lang = "en-US";
  recognition.continuous = false;
  recognition.interimResults = true;

  recognition.onstart = () => {
    recognizing = true;
    recordBtn.innerHTML = '<i class="bi bi-mic-fill"></i> Recording...';
    recordBtn.classList.replace("btn-primary","btn-danger");

    recordTimeout = setTimeout(()=>{
      if(recognizing) recognition.stop();
    },30000);
  };

  recognition.onresult = (event)=>{
    let finalTranscript="";
    for(let i=event.resultIndex;i<event.results.length;++i){
      if(event.results[i].isFinal) finalTranscript+=event.results[i][0].transcript+" ";
    }
    if(finalTranscript.trim()!==""){
      if(allAnswers[currentQuestion] && continueBtn.disabled === false){
        allAnswers[currentQuestion] += " " + finalTranscript;
        transcriptDiv.innerText = "Answer: " + allAnswers[currentQuestion];
      } else {
        transcriptDiv.innerText = "Answer: " + finalTranscript;
      }
    }
  };

  recognition.onend = ()=>{
    clearTimeout(recordTimeout);
    if(recognizing){
      recognizing=false;
      recordBtn.innerHTML = '<i class="bi bi-mic-fill"></i> Start Recording';
      recordBtn.classList.replace("btn-danger","btn-primary");
      let answer = transcriptDiv.innerText.replace("Answer: ","").trim();
      if(answer!=="") {
        allAnswers[currentQuestion]=answer;
        repeatBtn.disabled = false;
        continueBtn.disabled = false;
      }
    }
  };
} else {
  alert("Browser not supported Speech Recognition.");
}

repeatBtn.addEventListener("click", ()=>{
  transcriptDiv.innerText = "Answer: ";
  allAnswers[currentQuestion] = "";
  repeatBtn.disabled = true;
  continueBtn.disabled = true;
});

continueBtn.addEventListener("click", ()=>{
  if(!recognizing){
    recognition.start();
  }
});

function toggleRecognition(){
  if(recognizing) recognition.stop();
  else recognition.start();
}
recordBtn.addEventListener("click", toggleRecognition);

nextBtn.addEventListener("click", async ()=>{
  if(currentQuestion+1 < questionTexts.length){
    showQuestion(currentQuestion+1);
    transcriptDiv.innerText = "The transcription of your answers will appear here...";
  } else {
    questionTextEl.innerText = "Interview is over, processing your answers...";
    try{
      const res = await fetch("evaluate.php",{
        method:"POST",
        headers:{"Content-Type":"application/json"},
        body:JSON.stringify({answers:allAnswers})
      });
      const data = await res.json();

      document.getElementById("answersInput").value = JSON.stringify(allAnswers);
      document.getElementById("resultForm").submit();
    } catch(err){
      alert("Failed to evaluate: "+err);
    }
  }
});
</script>

</body>
</html>