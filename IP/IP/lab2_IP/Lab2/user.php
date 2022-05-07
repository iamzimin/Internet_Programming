<?php
session_start();
include "db.class.php";
DB::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = htmlspecialchars($_POST['user_name']);
    $pas1 = htmlspecialchars($_POST['user_pass']);
    $pas2 = htmlspecialchars($_POST['user_pass2']);
    $fio = htmlspecialchars($_POST['user_fio']);
    $error = "";
    $flag = true;



    if (empty($login))
        $error = "The login cannot be empty<br>";

    if (empty($pas1))
        $error .= "The password cannot be empty<br>";

    if ($pas1 != $pas2)
        $error .= "Passwords must match<br>";

    if(empty($error))
    {
        $query = "SELECT * FROM `users` WHERE `login` = '$login'";
        $res = DB::query($query);

        if( ($item = DB::fetch_array($res)) != false) {
            $error .= "This login already exists<br>";
            $flag = false;
        }
    }



    //$idUser = "SELECT * FROM `users` WHERE `id` = '$id'";
    //$res = DB::query($idUser);
    //$id = DB::fetch_array($res);

    ////////////////////////////////////////////////////////////


    if(empty($error) && $flag)
    {
        $query = "INSERT INTO `users` ( `login`, `fio`, `pass`) VALUES ('$login', '$fio', MD5('".$pas1."'))";
        DB::query($query);

        $_SESSION['auth'] = true;
        $_SESSION['name'] = $fio;
        //$_SESSION['id'] = $id;                        ///////////////////////////////////////////////////////////


        $query5 = "SELECT * FROM `users` WHERE `login` = '$login'"; //////////////// айдишник при регистрации
        $res5 = DB::query($query5);

        if (($item5 = DB::fetch_array($res5)) != false) {
            $_SESSION['id'] = $item5['id'];
            $_SESSION['user_type'] = $item5['user_type'];
        }

        header('location: MyWorks.php');
    }




    include_once "registr.php";
}