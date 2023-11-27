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

$sql = "SELECT * FROM `applicants`";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Applicants</title>
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
    <main class="page projets-page">
        <section>
            <div style="margin-top: 33px;text-align: center;"><button class="btn btn-primary" type="button" onclick="addAdmin()" style="border-radius: 4px;text-align: left;padding-left: 30px;padding-right: 30px;margin-right: 10px;">Add Admin</button><button class="btn btn-primary" type="button" onclick="logout()" style="border-radius: 4px;text-align: left;padding-left: 40px;padding-right: 40px;margin-left: 10px;">Logout</button></div>
        </section>
        <section class="portfolio-block project-no-images">
            <div class="container">
                <!-- Start: portfolio heading -->
                <div class="heading">
                    <h2><span style="font-weight: normal !important; color: rgb(82, 96, 105);">applicants&nbsp;</span></h2>
                </div><!-- End: portfolio heading -->
                <div class="row">
                    <?php 
                    while($row = $result->fetch_assoc()){
                    ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="project-card-no-image"><img style="border-radius: 11px;margin: 0px;margin-bottom: 12px;" width="100" height="80" src="<?php echo $row["profile_pic"]; ?>" >
                            <h3><?php echo $row["name"]; ?></h3><a class="btn btn-outline-primary btn-sm" role="button" href="./applicants_details.php?applicants_email=<?php echo $row["email"]; ?>">Details</a>
                        </div>
                    </div>
                    <?php 
                    }
                    ?>
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

    <script>
        function logout(){
            window.location.href = "external/logout.php";
        }

        function addAdmin(){
            window.location.href = "add-admin.php";
        }
    </script>
</body>

</html>