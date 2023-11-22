<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'eastboy');
define('DB_PASSWORD', 'time');
define('DB_NAME', 'school');

// Attempt to connect to the MySQL database
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check the database connection
if ($link === false) {
    die("ERROR: Could not connect to the database. " . mysqli_connect_error());
}

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Fetch data for the specific user from the subject_results table
$userId = $_SESSION["username"]; // Change this to match the user's ID

// Initialize arrays to store subject names, grades, and comments
$subjectNames = [];
$grades = [];
$comments = [];

// Fetch data from the subject_results table
$sql = "SELECT subject, score FROM subject_results WHERE username = ?";

if ($stmt = mysqli_prepare($link, $sql)) {
    mysqli_stmt_bind_param($stmt, "s", $userId);
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        
        $failedSubjects = 0; // Counter for failed subjects

        while ($row = mysqli_fetch_assoc($result)) {
            $subjectNames[] = $row["subject"];
            $score = $row["score"];

            if ($score == 3) {
                $grades[] = 'A';
                $comments[] = 'Excellent performance';
            } elseif ($score == 2) {
                $grades[] = 'B';
                $comments[] = 'Good progress';
            } elseif ($score == 1) {
                $grades[] = 'C';
                $comments[] = 'Satisfactory';
                $failedSubjects++;
            } else {
                $grades[] = 'D';
                $comments[] = 'Needs improvement';
                $failedSubjects++;
            }
        }

        // Update the comments based on the number of failed subjects
        if ($failedSubjects == 0) {
            $comments[] = 'Clear pass';
        } elseif ($failedSubjects == 1) {
            $comments[] = 'Process but repeat year';
        } else {
            $comments[] = 'Repeat year';
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
}

// Close the database connection
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title> Index </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link rel="stylesheet" type="text/css" href="style.css" />
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: OnePage
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/onepage-multipurpose-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<style>

body {
  font-family: Georgia, serif;
  font-size: 16px;
  line-height: 1.6;
  color: #333;
  background-color: #f8f8f8;
  margin: 0;
  padding: 0;
}

#page-wrap {
  width: 80%;
  max-width: 500px;
  margin: 100px auto;
  background-color: #fff;
  padding: 20px;

  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

h1 {
  font-size: 36px;
  font-family: Georgia, Serif;
  text-transform: uppercase;
  letter-spacing: 3px;
  margin: 20px 0;
  text-align: center;
}

#quiz {
  margin: 20px 0;
}

#quiz ol {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

#quiz li {
  margin: 20px 0;
}

#quiz h3 {
  font-size: 18px;
  margin: 0;
  color: #333;
}

#quiz label {
  display: block;
  cursor: pointer;
  margin-top: 5px;
}

#quiz input[type="radio"] {
  margin-right: 5px;
  vertical-align: middle;
}

.submitbtn {
  display: block;
  margin: 20px auto;
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
}

.submitbtn:hover {
  background-color: #0056b3;
}

/* Add more styles as needed */

    </style>

<body>

<?php include("includes/final.header.php"); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <h2 class="text-center"></h2>
        </div>
    </div>
</div>
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <h2 class="text-center">Report Card</h2>
            <table class="table table-bordered">
                <tr>
                    <td>ID</td>
                    <td><?php echo $userId; ?></td>
                </tr>
                <tr>
                    <td>English</td>
                    <td><?php echo (isset($grades[0]) ? $grades[0] : 'N/A'); ?></td>
                </tr>
                <tr>
                    <td>Mathematics</td>
                    <td><?php echo (isset($grades[1]) ? $grades[1] : 'N/A'); ?></td>
                </tr>
                <tr>
                    <td>Science</td>
                    <td><?php echo (isset($grades[2]) ? $grades[2] : 'N/A'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

  </main><!-- End #main -->


  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
