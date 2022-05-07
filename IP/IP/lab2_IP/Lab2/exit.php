<?php
session_start();
unset($_SESSION['auth']);
unset($_SESSION['name']);
unset($_SESSION['id']);
unset($_SESSION['user_type']);
unset($_SESSION['_GET_ID']);
unset($_SESSION['_GET_LOGIN']);
unset($_SESSION['game_score']);
//unset($_SESSION['id_user_for_delete']);
header('location: MyWorks.php');