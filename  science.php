<?php


session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>OnePage Bootstrap Template - Index</title>
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

<?php include("includes/home.header.php"); ?>

<div id="page-wrap">
    <h1>Science Quiz</h1>
    <form action="forms/insert.php?subject=science" method="post" id="quiz">
        <ol>
            <li>
                <h3>What is the chemical symbol for water?</h3>
                <div>
                    <input type="radio" name="question-1-answers" id="question-1-answers-A" value="A" />
                    <label for="question-1-answers-A">A) H2O</label>
                </div>
                <div>
                    <input type="radio" name="question-1-answers" id="question-1-answers-B" value="B" />
                    <label for="question-1-answers-B">B) CO2</label>
                </div>
                <div>
                    <input type="radio" name="question-1-answers" id="question-1-answers-C" value="C" />
                    <label for="question-1-answers-C">C) O2</label>
                </div>
                <div>
                    <input type="radio" name="question-1-answers" id="question-1-answers-D" value="D" />
                    <label for="question-1-answers-D">D) N2</label>
                </div>
            </li>

            <li>
                <h3>Which gas do plants absorb from the atmosphere during photosynthesis?</h3>
                <div>
                    <input type="radio" name="question-2-answers" id="question-2-answers-A" value="A" />
                    <label for="question-2-answers-A">A) Oxygen</label>
                </div>
                <div>
                    <input type="radio" name="question-2-answers" id="question-2-answers-B" value="B" />
                    <label for="question-2-answers-B">B) Nitrogen</label>
                </div>
                <div>
                    <input type="radio" name="question-2-answers" id="question-2-answers-C" value="C" />
                    <label for="question-2-answers-C">C) Carbon Dioxide</label>
                </div>
                <div>
                    <input type="radio" name="question-2-answers" id="question-2-answers-D" value="D" />
                    <label for="question-2-answers-D">D) Hydrogen</label>
                </div>
            </li>

            <li>
                <h3>Which planet is known as the Red Planet?</h3>
                <div>
                    <input type="radio" name="question-3-answers" id="question-3-answers-A" value="A" />
                    <label for="question-3-answers-A">A) Earth</label>
                </div>
                <div>
                    <input type="radio" name="question-3-answers" id="question-3-answers-B" value="B" />
                    <label for="question-3-answers-B">B) Venus</label>
                </div>
                <div>
                    <input type="radio" name="question-3-answers" id="question-3-answers-C" value="C" />
                    <label for="question-3-answers-C">C) Mars</label>
                </div>
                <div>
                    <input type="radio" name="question-3-answers" id="question-3-answers-D" value="D" />
                    <label for="question-3-answers-D">D) Jupiter</label>
                </div>
            </li>
        </ol>
        <input type="submit" value="Submit" class="submitbtn" />
    </form>
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
