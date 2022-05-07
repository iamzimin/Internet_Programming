<?php
session_start();
include "db.class.php";
DB::getInstance();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Моя 2 лаба</title>
    <link rel = "stylesheet" href = "/lab2_IP/styles/fon.css">
    <link rel = "stylesheet" href = "/lab2_IP/styles/text.css">
    <link rel = "stylesheet" href = "/lab2_IP/styles/images.css">
</head>
<body>

<div class="interface">
    <div class="FIO">Zimin Evgeny Sergeevich</div>
    <div class="Group">IVTACbd-11</div>
    <div class="MyWorks"><a href="MyWorks.php">My works</a></div>
    <div class="Achievements"><a href="Achievements.php">Achievements</a></div>
    <div class="AboutMe"><a href="AboutMe.php">About me</a></div>
    <div class="FAQ"><a href="FAQ.php">FAQ</a></div>
    <div class="MyContacts"><u><a href="MyContacts.php">Contacts</a></u></div>

    <?php
    if (isset($_SESSION['auth'])) { ?>
        <div class="Phone"><a href="menu.php"><?echo "User: "?></a></div>
        <div class="Phone"><a href="menu.php"><?echo "".$_SESSION['name'];?></a></div>
        <div class="Number"><a href="exit.php">Exit</a></div>
        <?php
        $query = "SELECT * FROM `users` WHERE id=".$_SESSION['id']; ////////////вывод аватарки
        $res = DB::query($query);
    $item = DB::fetch_array($res) ?>
        <td><img src="<?=$item['avatar_name']?>" class="profilePhoto"></td>
    <?php } else {?>
        <div class="Phone"><a href="registr.php">Registration</a></div>
        <div class="Number"><a href="login.php">Login</a></div>
    <?php } ?>

</div>

<div class="VK">
    <div><a href="https://vk.com/iamzimin/"><img class="imgVK" src="../images/vk.png"></a></div>
    <div class="textVK">Evgeny Zimin</div>
</div>

<div class="INST">
    <div><a href="https://www.instagram.com/iamzimin/"><img class="imgINST" src="../images/inst.png"></a></div>
    <div class="textINST">iamzimin</div>
</div>

<div class="TELEGRAM">
    <div><a href="https://t.me/iamzimin/"><img class="imgTELEGRAM" src="../images/telegram.png"></a></div>
    <div class="textTELEGRAM">Evgeny</div>
</div>

<div class="STEAM">
    <div><a href="https://steamcommunity.com/id/thend1511"><img class="imgSTEAM" src="../images/steam.png"></a></div>
    <div class="textSTEAM">ThEnd</div>
</div>

<div class="GITHUB">
    <div><a href="https://github.com/iamzimin"><img class="imgGITHUB" src="../images/github.png"></a></div>
    <div class="textGITHUB">iamzimin</div>
</div>

<div><img class="img0" src="../images/FOR-SCROLLING.jpg"></div>
</body>
</html>