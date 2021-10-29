<?php
    require "connect.php";

    $usernameAccount = $_POST["usernameAccount"];
    $passwordAccount = $_POST["passwordAccount"];
    $idAccount = 0;

    $loginQuery = "SELECT * FROM account WHERE account.username = '$usernameAccount' AND account.password = '$passwordAccount'";
    $getWhereData = mysqli_query($conn, $loginQuery);

    if (mysqli_num_rows($getWhereData) != 0) {
        while ($row = mysqli_fetch_assoc($getWhereData)) {
            $idAccount = $row["id"];
            //Nếu không có thông tin và ko là admin cần điền thông tin
            if(!isHaveInfor($idAccount) && !$row["admin"]) {
                $cookie_name = "id";
                $cookie_value = $idAccount;
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
                mysqli_close($conn);
                header( "Location: getinfor.html" );
            } else {
                //Trang chủ
                mysqli_close($conn);
                echo "Home";
            }
        }
    } else {
        mysqli_close($conn);
        echo '<script language="javascript">';
        echo 'alert("Đăng nhập thất bại, hãy kiểm tra lại tài khoản hoặc mật khẩu");';
        echo 'window.location = "login.html"';
        echo '</script>';
    }

    //Hàm kiểm tra xem đã có thông tin chưa
    function isHaveInfor($idAccount) {
        $guestWhereQuery = "SELECT * FROM guest WHERE guest.id = $idAccount";
        $guestWhereData = mysqli_query($GLOBALS["conn"], $guestWhereQuery);
        if (mysqli_num_rows($guestWhereData) != 0) {
            return true;
        }
        return false;
    }
?>