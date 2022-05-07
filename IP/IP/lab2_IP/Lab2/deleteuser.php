<?php
session_start();
include "db.class.php";
DB::getInstance();

$query = "SELECT * FROM `users` WHERE id=".$_GET['id'];
$res = DB::query($query);
if( ($item = DB::fetch_array($res)) != false) {
    $id_user_for_del = $item['id'];
}
$userType = $_SESSION['user_type'];

if (!empty($id_user_for_del)) {
    $query = "DELETE FROM `users` WHERE id=".$id_user_for_del;
    $res = DB::query($query);
    if ($userType == 1) {
        unset($_SESSION['auth']);
        unset($_SESSION['name']);
        unset($_SESSION['id']);
        unset($_SESSION['user_type']);
        unset($_SESSION['_GET_ID']);
        unset($_SESSION['_GET_LOGIN']);
        unset($_SESSION['game_score']);
        header('location: MyWorks.php');
    }
    else if ($userType == 0) {
        header('location: menu.php');
    }
}

?>
