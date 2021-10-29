<?php
    require "connect.php";

    $id = $_COOKIE['id'];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    $insertGuestQuery = "INSERT INTO `guest`(`id`, `firstname`, `lastname`, `email`, `phone`, `address`) VALUES ($id,'$firstname','$lastname','$email','$phone','$address')";
    mysqli_query($conn, $insertGuestQuery);
    mysqli_close($conn);
    echo "Home";
?>