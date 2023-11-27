<?php
    // $conn = mysqli_connect("localhost", "root", "", "brta_lab_assignment");
    try {
        //code...
        $conn = new mysqli("localhost", "root", "", "brta_lab_assignment");
    } catch (\Throwable $th) {
        //throw $th;
        ?>
        <script>
            window.location.href = "./mysql_error.html";
        </script>
        <?php

        
    }
?>