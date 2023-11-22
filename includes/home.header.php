<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">

        <h1 class="logo"><a href="index.html">OnePage</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="index.php">Home</a></li>

                <li class="dropdown">
                    <a href="#"><span>Exam</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <?php

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
                        // Check if the user has already attempted a specific quiz and add links accordingly
                        $quizSubjects = ['Mathematics', 'English', 'Science'];

                        foreach ($quizSubjects as $subject) {
                            $sql = "SELECT * FROM subject_results WHERE username = ? AND subject = ?";
                            if ($stmt = mysqli_prepare($link, $sql)) {
                                $username = $_SESSION["username"];
                                $subjectName = strtolower($subject);
                                mysqli_stmt_bind_param($stmt, "ss", $username, $subjectName);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_store_result($stmt);

                                if (mysqli_stmt_num_rows($stmt) > 0) {
                                    echo "<li><a href='javascript:void(0)'>$subject (Attempted)</a></li>";
                                } else {
                                    echo "<li><a href='{$subjectName}.php'>$subject</a></li>";
                                }
                            }
                        }
                        ?>
                    </ul>
                </li>

                <li><a class="getstarted scrollto" href="../final.php">Results</a></li>
                <li><a class="nav-link scrollto"> <?php echo htmlspecialchars($_SESSION["username"]); ?></a></li>
                <li><a class="getstarted scrollto" href="logout.php">Logout</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
