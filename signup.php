<?php
    require "connect.php";

    $getAllQuery = "SELECT * FROM account";

    $usernameAccount = $_POST["usernameAccount"];
    $passwordAccount = $_POST["passwordAccount"];
    if(strcmp($_POST["adminAccount"], 'true') == 0) {
        $adminAccount = 1;
    } else {
        $adminAccount = 0;
    }
    $insertAccountQuery = "INSERT INTO `account`(`username`, `password`, `admin`) VALUES ('$usernameAccount','$passwordAccount',$adminAccount)";

    if(strcmp($_POST["passwordAccount"], $_POST["confirmPasswordAccount"]) == 0) {
        if (!isExistAccount($_POST["usernameAccount"])) {
            $insertAccountData = mysqli_query($conn, $insertAccountQuery);
            //Nếu là khách cần điền thông tin
            if ($adminAccount == 0) {
                $cookie_name = "id";
                $cookie_value = getIdAccount($_POST["usernameAccount"]);
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
                mysqli_close($conn);
                header( "Location: getinfor.html" );
            } else {
                //Trang chủ
                mysqli_close($conn);
                echo "Home";
            }
        } else {
            mysqli_close($conn);
            echo '<script language="javascript">';
            echo 'alert("Đăng kí thất bại, tên tài khoản đã tồn tại");';
            echo 'window.location = "signup.html"';
            echo '</script>';
        }
    } else {
        mysqli_close($conn);
        echo '<script language="javascript">';
        echo 'alert("Đăng kí thất bại, hãy chắc chắn xác nhận đúng mật khẩu");';
        echo 'window.location = "signup.html"';
        echo '</script>';
    }

    //KT tồn tại tài khoản
    function isExistAccount($username) {
        $getAllData = mysqli_query($GLOBALS['conn'], $GLOBALS['getAllQuery']);
        while ($row = mysqli_fetch_assoc($getAllData)) {
            if(strcmp($row["username"], $username) == 0) {
                return true;
            }
        }
        return false;
    }

    function getIdAccount($username) {
        $getIdQuery = "SELECT id FROM account WHERE account.username = '$username'";
        $getIdData = mysqli_query($GLOBALS['conn'], $getIdQuery);
        while ($row = mysqli_fetch_assoc($getIdData)) {
            return $row["id"];
        }
        return -1;
    }
?>