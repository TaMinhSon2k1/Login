<?php
    $conn = mysqli_connect("localhost", "root", "", "utlap.db");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_query($conn, "SET NAMES 'utf8'");
?>