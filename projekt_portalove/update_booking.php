<?php
include_once "db_connect.php";
$db = $GLOBALS['db'];

if(isset($_POST['submit'])) {
    $update = $db->updateBooking($_POST['id'],
        $_POST['name'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['date'],
        $_POST['message']);

    if($update) {
        header("Location: admin.php");
    } else {
        echo "FATAL ERROR!!!!";
    }
} else {
    header("Location: admin.php");
}