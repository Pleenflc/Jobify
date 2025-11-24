<?php
session_start();

// Pastikan jawaban sudah ada
if (!isset($_POST['answers'])) {
    die("No answers submitted.");
}

$answers = $_POST['answers'];

// API Key Gemini
$apiKey = "AIzaSyDcehlcjl1c9NRcLK3x-N9teWvLZ65tByk"; // ganti dengan API key kamu
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . $apiKey;

// Format prompt
$questions = [
    "Tell me about yourself.",
    "Why do you want to work here?",
    "What motivates you to apply to our company?",
    "What are your strengths and weaknesses?"
];

$evaluationResults = [];

foreach ($answers as $i => $answer) {
    $question = $questions[$i];
    $prompt = "Interview Question: $question\nCandidate's Answer: $answer\n\nAs an AI HR recruiter, please provide:\n1. Constructive feedback on the answer.\n2. A score between 0 and 100.";

    $data = [
        "contents" => [
            [
                "parts" => [
                    ["text" => $prompt]
                ]
            ]
        ]
    ];

    $options = [
        "http" => [
            "header"  => "Content-Type: application/json",
            "method"  => "POST",
            "content" => json_encode($data)
        ]
    ];

    $context  = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    // Debug: cek respon asli dari Gemini
    echo "<pre>DEBUG Gemini Response for Q".($i+1).":\n";
    var_dump($response);
    echo "</pre><hr>";

    if ($response !== FALSE) {
        $resultData = json_decode($response, true);

        $feedback = $resultData['candidates'][0]['content']['parts'][0]['text'] ?? "No feedback received.";
        $score = rand(10, 100); // sementara random, nanti kita bisa parsing dari feedback

        $evaluationResults[] = [
            "question" => $question,
            "answer" => $answer,
            "feedback" => $feedback,
            "score" => $score
        ];
    }
}

// Simpan ke session
$_SESSION['evaluation_results'] = $evaluationResults;

// Debug: cek isi session
echo "<pre>DEBUG SESSION:\n";
print_r($_SESSION);
echo "</pre>";

// Redirect (kalau mau langsung ke result.php)
// header("Location: result.php");
// exit;
