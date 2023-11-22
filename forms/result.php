<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once " http://localhost/config.php";
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

$answer1 = $_POST['question-1-answers'];
$answer2 = $_POST['question-2-answers'];
$answer3 = $_POST['question-3-answers'];
$answer4 = $_POST['question-4-answers'];
$answer5 = $_POST['question-5-answers'];

$totalCorrect = 0;

if ($answer1 == "C") { $totalCorrect++; }
if ($answer2 == "D") { $totalCorrect++; }
if ($answer3 == "A") { $totalCorrect++; }
if ($answer4 == "B") { $totalCorrect++; }
if ($answer5 == "D") { $totalCorrect++; }

// Insert quiz results into the database
$sql = "INSERT INTO quiz_results (user_id, score, total_questions, date_completed) VALUES (?, ?, ?, NOW())";

if ($stmt = $conn->prepare($sql)) {
    $user_id = $_SESSION["user_id"]; // You may need to adjust this to match your user identifier
    $totalQuestions = 5; // Adjust this if the number of questions can vary

    $stmt->bind_param("iii", $user_id, $totalCorrect, $totalQuestions);

    if ($stmt->execute()) {
        echo "<div id='results'>$totalCorrect / $totalQuestions correct</div>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
