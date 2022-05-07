<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT']."/lab2_IP/Lab2/db.class.php";
DB::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userType = $_SESSION['user_type'];


    $login1 = htmlspecialchars($_POST['user_name']);
    $pas11 = htmlspecialchars($_POST['user_pass']);
    $pas22 = htmlspecialchars($_POST['user_pass2']);
    $fio1 = htmlspecialchars($_POST['user_fio']);
    if($userType == 0)
        $game_score =  htmlspecialchars($_POST['user_score']);

    $error1 = "";

    if (empty($login1))
        $error1 = "The login cannot be empty<br>";

    if (empty($pas11))
        $error1 .= "The password cannot be empty<br>";

    if ($pas11 != $pas22)
        $error1 .= "Passwords must match";

    if($_SESSION['_GET_LOGIN'] == $login1) {
        $ef = $login1;
    }


    $chooseUserLogin = $_SESSION['_GET_LOGIN'];
    if (empty($error1)) {
        $query1 = "SELECT * FROM `users` WHERE `login` = '$login1'";
        $res1 = DB::query($query1);

        if (($item1 = DB::fetch_array($res1)) == true) {
            if ($chooseUserLogin != $item1['login'])
                $error1 = "This login already exists";
        }
    }


    if (empty($error1)) {


        $strQueryPass = "";
        if (isset($_POST['user_pass2']) && !empty($_POST['user_pass2']))
            $strQueryPass = ", `pass` = MD5(" . $_POST['user_pass2'] . ")";


        $strQueryAvatar = "";
        if (isset($_FILES['user_avatar'])) {
            $uploadTypeFile = "";
            if ($_FILES['user_avatar']['type'] = 'image/jpeg')
                $uploadTypeFile = ".jpg";

            $uploadNameFile = md5(time() . $_FILES['user_avatar']['name']);
            $uploadNameDirection = $_SERVER['DOCUMENT_ROOT'] . "/upload/avatars/";

            $uploadAvatar = $uploadNameDirection . $uploadNameFile . $uploadTypeFile;
            if (move_uploaded_file($_FILES['user_avatar']['tmp_name'],
                $uploadAvatar
            )) {
                echo "Файл корректен и был успешно загружен.\n";
            } else {
                echo "Возможная атака с помощью файловой загрузки!\n";
            }

            $strQueryAvatar = ", `avatar_name` = '" . "/upload/avatars/" . $uploadNameFile . $uploadTypeFile . "'";
        }

        if ($userType == 0) {
            $query = "UPDATE `users`
          SET `login`= '" . $_POST['user_name'] . "',
              `fio` = '" . $_POST['user_fio'] . "',     
              `game_score` = '" . $_POST['user_score'] . "'"
                . $strQueryPass . $strQueryAvatar . "        
          WHERE id=" . $_POST['id'];
            $res = DB::query($query);
        }
        else if ($userType == 1) {
            $query = "UPDATE `users`
          SET `login`= '" . $_POST['user_name'] . "',
              `fio` = '" . $_POST['user_fio'] . "'"
                . $strQueryPass . $strQueryAvatar . "        
          WHERE id=" . $_POST['id'];
            $res = DB::query($query);
        }

        /*
        $login = $_POST['user_name'];/////////////////////////////////////////////////////////////////////////////
        $pas1 = $_POST['user_pass2'];
        $query1 = "SELECT * FROM `users` WHERE `login` = '$login' and `pass` = MD5('$pas1')";
        $res1 = DB::query($query1);

        unset($_SESSION['auth']);
        unset($_SESSION['name']);
        unset($_SESSION['id']);
        unset($_SESSION['user_type']);
        if( ($item = DB::fetch_array($res1)) != false) {
            $_SESSION['auth'] = true;
            $_SESSION['name'] = $item['fio'];/////////////////////////////////////////////////////////////////////не обновляется
            $_SESSION['id'] = $item['id'];
            $_SESSION['user_type'] = $item['user_type'];
            //header('location: MyWorks.php');
        }

        //$_SESSION['name'] = $_POST['user_fio'];/////////////////////////////////////////////////////////////////////не обновляется
        */
        header("location: listusers.php");
    } else {
        include_once "edituser.php";
    }
}