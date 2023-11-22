<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'eastboy');
define('DB_PASSWORD', 'time');
define('DB_NAME', 'school');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Get the subject from the URL parameter or form field
$subject = isset($_GET['subject']) ? $_GET['subject'] : '';

// Check if the database connection was successful
if ($link) {
    $answer1 = $_POST['question-1-answers'];
    $answer2 = $_POST['question-2-answers'];
    $answer3 = $_POST['question-3-answers'];

    $totalCorrect = 0;

    // Add logic to determine the correct answers for the specified subject
    switch ($subject) {
        case 'mathematics':
            if ($answer1 == "A") { $totalCorrect++; }
            if ($answer2 == "A") { $totalCorrect++; }
            if ($answer3 == "A") { $totalCorrect++; }
            break;

        case 'english':
            if ($answer1 == "A") { $totalCorrect++; } 
            if ($answer2 == "C") { $totalCorrect++; } 
            if ($answer3 == "A") { $totalCorrect++; } 
            break;
            

        case 'science':
            
            if ($answer1 == "A") { $totalCorrect++; } // Correct answer for question 1
                if ($answer2 == "C") { $totalCorrect++; } // Correct answer for question 2
            if ($answer3 == "C") { $totalCorrect++; } // Correct answer for question 3
            break;

        default:
            echo "Invalid subject specified.";
            exit;
    }

    // Insert quiz results into the "subject_results" table with the subject specified
    $sql = "INSERT INTO subject_results (username, subject, score, total_questions, date_completed) VALUES (?, ?, ?, ?, NOW())";

    if ($stmt = mysqli_prepare($link, $sql)) {
        $username = $_SESSION["username"]; // Adjust this to match the username from the session
        $totalQuestions = 3; // The quiz has 3 questions

        mysqli_stmt_bind_param($stmt, "ssii", $username, $subject, $totalCorrect, $totalQuestions);

        if (mysqli_stmt_execute($stmt)) {
            echo "<div id='results' style='color: " . ($totalCorrect == $totalQuestions ? 'green' : 'red') . "; background-color: black; text-align: center; padding: 10px;'>$totalCorrect / $totalQuestions correct</div>";

            header("refresh:5;url=../welcome.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }

} else {
    echo "Database connection failed.";
}

// Close the database connection
mysqli_close($link);
?>
