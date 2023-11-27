<?php
include_once "./external/connection.php";
session_start();

if (isset($_SESSION["email"])) {
    header("Location: ./applicants.php");
    exit();
}

if (isset($_POST["login_btn"])) {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM `admin` WHERE `email` = '$email' ; ";
    $result = mysqli_query($conn, $sql);

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row["password"])) {
            $_SESSION["email"] = $email;
            header("Location: ./applicants.php");
            exit();
        } else {
            session_destroy();
            header("Location: ./login.php?err_msg=Email or Password Invalid");
            exit();
        }
    } else {
        session_destroy();
        header("Location: ./login.php?err_msg=Email or Password Invalid");
        exit();
    }
}
?>

<!DOCTYPE html>
<html data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login to Admin</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Lato.css">
    <link rel="stylesheet" href="assets/css/Nunito.css">
    <link rel="stylesheet" href="assets/css/swiper-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Call-Now-Button.css">
    <link rel="stylesheet" href="assets/css/Hero-Carousel-images.css">
    <link rel="stylesheet" href="assets/css/pikaday.min.css">
    <link rel="stylesheet" href="assets/css/Simple-Slider-swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/Simple-Slider.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top portfolio-navbar gradient navbar-dark" style="background: rgba(0,0,0,0.32);">
        <div class="container"><a href="./index.php"><img src="assets/img/logo.png" width="63" height="63"></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navbarNav"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="form.php">Form</a></li>
                    <li class="nav-item"><a class="nav-link active" href="login.php">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="page contact-page">
        <section class="portfolio-block contact">
            <div class="container">
                <div class="heading">
                    <h2>Login</h2>
                </div>
                <form class="shadow-lg" data-bs-theme="light" method="post">
                    <?php
                    if (isset($_GET["err_msg"])) {
                        echo "<div class='alert alert-danger' role='alert'>" . $_GET["err_msg"] . "</div>";
                    }
                    ?>
                    <div class="mb-3"><label class="form-label" for="email">Email</label><input class="form-control item" type="email" id="email" name="email"></div>
                    <div class="mb-3"><label class="form-label" for="email">Password</label><input class="form-control" type="password" name="password"></div>
                    <div class="mb-3 mt-4"><button class="btn btn-primary btn-lg d-block w-100" name="login_btn" type="submit">Login</button></div>
                </form>
            </div>
        </section>
    </main>
    <footer class="page-footer py-3 border-top">
        <section class="portfolio-block skills" style="background: #dedede;color: rgb(255,255,255);">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card special-skill-item border-0" style="backdrop-filter: opacity(0);">
                            <div class="card-header bg-transparent border-0"><i class="icon ion-ios-telephone"></i></div>
                            <div class="card-body">
                                <h3 class="card-title">Contact</h3>
                                <p>16107, 09610 990 998 SUNDAY - THURSDAY (9.00 AM - 4.00 PM)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card special-skill-item border-0">
                            <div class="card-header bg-transparent border-0"><i class="icon ion-link"></i></div>
                            <div class="card-body">
                                <h3 class="card-title">Important Links</h3>
                                <p class="card-text" style="text-align: left;"><a href="https://bangabhaban.gov.bd/">President Office</a><br><a href="https://cabinet.gov.bd/">Cabinet Division</a><br><a href="http://www.rthd.gov.bd/">Road Transport &amp; Highway Division</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card special-skill-item border-0">
                            <div class="card-header bg-transparent border-0"><i class="icon ion-android-contact"></i></div>
                            <div class="card-body">
                                <h3 class="card-title">Subscription</h3>
                                <p class="card-text">
                                    <input type="email" id="subscription_email"><input class="btn btn-primary" id="subscription_submit_btn" type="submit" style="margin: 17px;">
                                    <span id="err" style="color: red;"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pikaday.min.js"></script>
    <script src="assets/js/Simple-Slider-swiper-bundle.min.js"></script>
    <script src="assets/js/Simple-Slider.js"></script>
    <script src="assets/js/theme.js"></script>

    <!-- Footer Email add on database -->
    <script>
        var email;
        $("#subscription_submit_btn").click(function() {
            email = $('#subscription_email').val();
            if (email.length < 1) {
                $('#err').empty();
                $('#err').html('<br>This field is required');
            } else {
                var regEx = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                // var validEmail = regEx.test(email);
                if (regEx.test(email)) {
                    $('#err').empty();
                    console.log(111);
                    $.ajax({
                        url: './external/footer_email.php',
                        type: 'POST',
                        data: {
                            email: email
                        },
                        success: function(data) {
                            $('#err').empty();
                            $('#err').html('<br>' + data);
                        }
                        // complete: function () {
                        //     // Schedule the next data fetch after a delay (e.g., every 5 seconds)
                        // setTimeout(fetchUserListData, 5000);
                        // }
                    });
                } else {
                    $('#err').empty();
                    $('#err').html('<br>Enter a valid email');
                }

            }

        });
    </script>
</body>

</html>