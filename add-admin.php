<?php
include_once "external/connection.php";
session_start();

if (!isset($_SESSION["email"])) {
?>
    <script>
        window.location.href = "external/logout.php";
    </script>
    <?php
}

if (isset($_POST["submit_btn"])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);

    $sql = "SELECT `email` FROM `admin` WHERE `email` = '$email';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        ?>
        <script>
            window.location.href = "add-admin.php?failed_msg=This email is already exists"
        </script>
        <?php 
        exit();
    }

    $sql = "INSERT INTO `admin` (`name`, `email`, `password`) VALUES ('$name', '$email', '$password');";
    if ($conn->query($sql)) {
    ?>
        <script>
            window.location.href = "add-admin.php?success_msg=Admin added successfully"
        </script>
    <?php
        exit();
    } else {
    ?>
        <script>
            window.location.href = "add-admin.php?failed_msg=Admin added failed"
        </script>
<?php
        exit();
    }
    if(mysqli_error($conn)){
        ?>
        <script>
            window.location.href = "add-admin.php?failed_msg=Admin added failed for Unknown error"
        </script>
<?php
        exit();
    }
}

?>

<!DOCTYPE html>
<html data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Add Admin</title>
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
    <main class="page contact-page">
        <section class="portfolio-block contact">
            <div class="container">
                <div class="heading">
                    <h2>Add Admin</h2>
                </div>
                <form class="shadow-lg" data-bs-theme="light" method="post">
                    <?php
                    if (isset($_GET["failed_msg"])) {
                        echo "<div class='alert alert-danger' role='alert'>" . $_GET["failed_msg"] . "</div>";
                    } else if (isset($_GET["success_msg"])) {
                        echo "<div class='alert alert-success' role='alert'>" . $_GET["success_msg"] . "</div>";
                    }
                    ?>
                    <div class="mb-3"><label class="form-label" for="name">Admin Name</label><input class="form-control item" type="text" id="name" name="name"></div>
                    <div class="mb-3"><label class="form-label" for="email">Email</label><input class="form-control item" type="email" id="email" name="email"></div>
                    <div class="mb-3"><label class="form-label" for="email">Password</label><input class="form-control" type="password" name="password"></div>
                    <div class="mb-3 mt-4"><button class="btn btn-primary btn-lg d-block w-100" type="submit" name="submit_btn">Submit</button></div>
                </form>
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