<?php
session_start();
include_once "db.class.php";
DB::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = htmlspecialchars($_POST['login']);
    $pas1 = htmlspecialchars($_POST['pas']);
    $error = "";
    $userId = 0;

    if (empty($login))
        $error = "The login cannot be empty<br>";

    if (empty($pas1))
        $error .= "The password cannot be empty<br>";

    if (empty($login) && empty($pas1))
        $error = "Authorization error";

    if(empty($error))
    {
        $query = "SELECT * FROM `users` WHERE `login` = '$login' and `pass` = MD5('$pas1')";
        $res = DB::query($query);

        if( ($item = DB::fetch_array($res)) != false) {
            $_SESSION['auth'] = true;
            $_SESSION['name'] = $item['fio'];
            $_SESSION['id'] = $item['id'];
            $_SESSION['user_type'] = $item['user_type'];
            header('location: MyWorks.php');
        }

        if( ($item = DB::fetch_array($res)) == false) {
            $error = "The user does not exist";
        }
    }
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Моя 2 лаба</title>
    <link rel = "stylesheet" href = "/lab2_IP/styles/fon.css">
    <link rel = "stylesheet" href = "/lab2_IP/styles/text.css">
    <script rel = "text/javascript" src = "/lab2_IP/scripts/jquery-3.6.0.js"></script>
    <script rel = "text/javascript" src = "/lab2_IP/scripts/scrypt_lab2.js"></script>
</head>
<body>

<div class="interface">
    <div class="FIO">Zimin Evgeny Sergeevich</div>
    <div class="Group">IVTACbd-11</div>
    <div class="MyWorks"><a href="MyWorks.php">My works</a></div>
    <div class="Achievements"><a href="Achievements.php">Achievements</a></div>
    <div class="AboutMe"><a href="AboutMe.php">About me</a></div>
    <div class="FAQ"><a href="FAQ.php">FAQ</a></div>
    <div class="MyContacts"><a href="MyContacts.php">Contacts</a></div>


        <div class="Phone"><a href="registr.php">Registration</a></div>
        <div class="Number"><u><a href="login.php">Login</a></u></div>


        <div class="centerTextHeader">Login</div>

        <div class="form_reg">
            <div>
                <form action="login.php" method="POST">
                    <table>
                        <tr>
                            <td>
                                Login
                            </td>
                            <td>
                                <input name="login"/>
                            </td>
                        </tr>
                            <td>
                                Password
                            </td>
                            <td>
                                <input type="password" name="pas"/>
                            </td>
                        </tr>
                    </table>
                    <input type="submit" value="Login"/>
                </form>
            </div>
        </div>


    <?php
    if(isset($error) && !empty($error)) { ?>
        <div class="error">
            <div>
                <?=$error?>
            </div>
        </div>
    <?php } ?>


</div>

<div><img class="img0" src="../images/FOR-SCROLLING.jpg"></div>
</body>
</html>




