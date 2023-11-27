<?php
include_once "external/connection.php";
session_start();

if(!isset($_SESSION["email"])){
    ?>
    <script>
        window.location.href = "external/logout.php";
    </script>
    <?php
}

if(isset($_GET["applicants_email"])){
    $sql="SELECT * FROM `applicants` WHERE `email` ='".$_GET["applicants_email"]."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Applicants Details</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Lato.css">
    <link rel="stylesheet" href="assets/css/Nunito.css">
    <link rel="stylesheet" href="assets/css/swiper-icons.css">
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
    <main class="page project-page">
        <section class="portfolio-block project">
            <div class="container">
                <!-- Start: portfolio heading -->
                <div class="heading">
                    <h2><?php echo $row["name"]; ?></h2>
                </div><!-- End: portfolio heading -->
                <div style="text-align: center;margin: 50px;"><img width="152" height="133" src="<?php echo $row["profile_pic"]; ?>" style="border-radius: 50%;"></div>
                <div class="row">
                    <div class="col-12 col-md-6 offset-md-1 info">
                        <h3>Details</h3>
                        <p>NID No: <?php echo $row["nid_no"]; ?>&nbsp;</p>
                        <p>Email: <?php echo $row["email"]; ?>&nbsp;</p>
                        <p>Vehicle No: <?php echo $row["vehicle_no"]; ?>&nbsp;</p>
                        <p>Vehicle Chassis No: <?php echo $row["vehicle_chassis_no"]; ?>&nbsp;</p>
                        <p>Present Address: <?php echo $row["present_addr"]; ?>&nbsp;</p>
                        <p>Permanent Address: <?php echo $row["permanent_addr"]; ?></p>
                    </div>
                    <div class="col-12 col-md-3 offset-md-1 meta">
                        <div class="tags"><span class="meta-heading">Tags</span><a href="<?php echo $row["nid_softcopy"]; ?>">Download NID Soft Copy</a></div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="page-footer py-3 border-top"></footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pikaday.min.js"></script>
    <script src="assets/js/Simple-Slider-swiper-bundle.min.js"></script>
    <script src="assets/js/Simple-Slider.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>