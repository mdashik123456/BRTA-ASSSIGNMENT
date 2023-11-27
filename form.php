<?php
session_start();
include_once "external/connection.php";

if (isset($_POST["submit_btn"])) {
    $name = htmlspecialchars($_POST["name"]);
    $nid = htmlspecialchars($_POST["nid"]);
    $email = htmlspecialchars($_POST["email"]);
    $vehicleNo = htmlspecialchars($_POST["vehicleNo"]);
    $chassisNo = htmlspecialchars($_POST["chassisNo"]);
    $presentAddress = htmlspecialchars($_POST["presentAddress"]);
    $permanentAddress = htmlspecialchars($_POST["permanentAddress"]);

    $profile_pic = $_FILES["profile_pic"];
    $nidSoftCopy = $_FILES["nidSoftCopy"];

    $sql = "SELECT `email` FROM `applicants` WHERE `email` = '$email';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        ?>
        <script>
            window.location.href = "form.php?msg=This email is already exists"
        </script>
        <?php 
        exit();
    }

    if ($_FILES["profile_pic"]["error"] == UPLOAD_ERR_OK && $_FILES["nidSoftCopy"]["error"] == UPLOAD_ERR_OK) {
        // Specify the target directory to save the uploaded files
        $targetDir = "./uploads/";

        // Create the target directory if it doesn't exist
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Get the file name with path
        $target_file = $_FILES["profile_pic"]["name"];
        $image_tmp_name = $_FILES["profile_pic"]["tmp_name"];
        $imageFileExt = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $profile_pic = "./uploads/" . $email . "." . $imageFileExt;

        // Get the file name with path
        $target_file = $_FILES["nidSoftCopy"]["name"];
        $file_tmp_name = $_FILES["nidSoftCopy"]["tmp_name"];
        $FileExt = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $nidSoftCopy = "./uploads/" . $email . "." . $FileExt;


        if ($imageFileExt != "jpg" && $imageFileExt != "png" && $imageFileExt != "jpeg" && $imageFileExt != "gif" ) {
            header("Location: form.php?msg=Sorry, only JPG, JPEG, PNG and GIF files are allowed");
            exit();
        } else if($FileExt != "pdf"){
            header("Location: form.php?msg=Sorry, only PDF allowed");
            exit();
        } else{
            move_uploaded_file($image_tmp_name, $profile_pic) && move_uploaded_file($file_tmp_name, $nidSoftCopy);

            $sql = "INSERT INTO `applicants` (`name`, `nid_no`, `vehicle_no`, `vehicle_chassis_no`, `present_addr`, `permanent_addr`, `profile_pic`, `nid_softcopy`, `id`, `email`) VALUES ('$name', '$nid', '$vehicleNo', '$chassisNo', '$presentAddress', '$permanentAddress', '$profile_pic', '$nidSoftCopy', NULL, '$email')";
            if(mysqli_query($conn, $sql)){
                header("Location: form.php?success_msg=Submition Success");
                exit();
            } else{
                header("Location: form.php?msg=Submition Failed");
                exit();
            }
        }

        // Move the uploaded files to the target directory
    }
}
?>


<!DOCTYPE html>
<html data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>BRTA Application Form</title>
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
                    <li class="nav-item"><a class="nav-link active" href="form.php">Form</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php"><?php if (!isset($_SESSION["email"])){
                        echo "Login";
                    }else{
                        echo "Dashboard";
                    }
                    ?></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="page contact-page">
        <section class="portfolio-block contact">
            <div class="container">

                <form class="shadow-lg" data-bs-theme="light" method="post" , enctype="multipart/form-data">
                    <?php
                        if(isset($_GET["msg"])){
                            echo "<div class='alert alert-danger' role='alert'>".$_GET["msg"]."</div>";
                        }else if(isset($_GET["success_msg"])){
                            echo "<div class='alert alert-success' role='alert'>".$_GET["success_msg"]."</div>";
                        }
                    ?>
                    <div class="mb-3"><label class="form-label" for="name">Your Name</label><input class="form-control item" type="text" id="name" name="name" required></div>
                    <div class="mb-3"><label class="form-label" for="subject">NID No</label><input class="form-control item" type="text" id="nid" name="nid" required></div>
                    <div class="mb-3"><label class="form-label" for="email">Email</label><input class="form-control item" type="email" id="email" name="email" required></div>
                    <div class="mb-3"><label class="form-label" for="name">Vehicle No</label><input class="form-control item" type="text" id="vehicleNo" name="vehicleNo" required></div>
                    <div class="mb-3"><label class="form-label" for="name">Vehicle Chassis No</label><input class="form-control item" type="text" id="chassisNo" name="chassisNo" required></div>
                    <div class="mb-3"><label class="form-label" for="name">Present Address</label><input class="form-control item" type="text" id="presentAddress" name="presentAddress" required></div>
                    <div class="mb-3"><label class="form-label" for="name">Permanent Address</label><input class="form-control item" type="text" id="permanentAddress" name="permanentAddress" required></div>
                    <div class="mb-3"><label class="form-label" for="name">Your Photo</label><input class="form-control" type="file" accept="image/*" id="profile_pic" name="profile_pic" required></div>
                    <div class="mb-3"><label class="form-label" for="name">NID Soft Copy (PDF)</label><input class="form-control" accept="application/pdf" id="nidSoftCopy" name="nidSoftCopy" type="file" required></div>
                    <div class="mb-3 mt-4"><button onclick="validateFormPHP()" class="btn btn-primary btn-lg d-block w-100" name="submit_btn" type="submit">Submit Form</button></div>
                    <div id="form_submit" name="error_success_status" style="text-align: center;"></div>
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
    <script src="assets/js/formPHP_validation.js"></script>

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