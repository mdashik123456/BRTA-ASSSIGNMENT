<?php
include "./connection.php";

$email = htmlspecialchars($_POST['email']);
$flag = 0;

$sql = "SELECT * FROM `subscription`";
$result  = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)){
    if($row["email"] === $email){
        $flag = 1;
    }
}

if($flag == 1){
    echo "You Already Subscribed";
} else{
    $sql = "INSERT INTO `subscription` (`email`) VALUES ('$email')";
    mysqli_query($conn, $sql);
    echo "Thank You For Subscribe";
}
?>