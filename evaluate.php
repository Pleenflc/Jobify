<?php
session_start();
header("Content-Type: application/json");

// Ambil jawaban dari request JSON
$input = json_decode(file_get_contents("php://input"), true);
$answers = $input["answers"] ?? [];

// Daftar pertanyaan
$questions = [
    "Could you tell me a little about yourself?",
    "What motivates you to apply to our company?",
    "What are your strengths and weaknesses?",
    "How do you handle pressure or tight deadlines?",
    "Could you share your previous work or internship experience?",
    "How do you usually work within a team?",
    "What has been your greatest achievement so far?",
    "How do you deal with conflicts in the workplace?",
    "Where do you see yourself in the next five years?",
    "Why should we consider hiring you for this position?"
];

// Fungsi sederhana buat generate feedback & score
function evaluateAnswer($answer) {
    $answer = trim($answer);
    $len = strlen($answer);

    // Feedback & score sederhana berdasarkan panjang jawaban
    if ($len === 0) {
        return ["feedback" => "You didn't answer this question. Try to provide some details.", "score" => 0];
    } elseif ($len < 30) {
        return ["feedback" => "Your answer is a bit short. Try to elaborate more.", "score" => rand(40, 60)];
    } elseif ($len < 80) {
        return ["feedback" => "Good answer, but you can add more examples.", "score" => rand(60, 75)];
    } else {
        return ["feedback" => "Excellent answer! Clear and well-structured.", "score" => rand(76, 95)];
    }
}

// Generate hasil evaluasi
$result = [];
foreach ($questions as $i => $q) {
    $a = $answers[$i] ?? "";
    $eval = evaluateAnswer($a);
    $result[] = [
        "question" => $q,
        "answer" => $a ?: "(no answer)",
        "feedback" => $eval["feedback"],
        "score" => $eval["score"]
    ];
}

// Simpan di session & kirim JSON
$_SESSION['interview_result'] = $result;
echo json_encode($result, JSON_PRETTY_PRINT);
exit;
?>
