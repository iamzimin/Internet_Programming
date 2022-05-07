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
    <div class="Achievements"><u><a href="Achievements.php">Achievements</a></u></div>
    <div class="AboutMe"><a href="AboutMe.php">About me</a></div>
    <div class="FAQ"><a href="FAQ.php">FAQ</a></div>
    <div class="MyContacts"><a href="MyContacts.php">Contacts</a></div>

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

<div><img class="img5" src="../images/55.png"></div>

<div class="textAchievements">
    <div class="text1Achievements">My academic achievements will appear on this page soon, but they are not there yet, since I am only in the 1st year.</div>
    <div class="text2Achievements">But I have achievements in school. For example, last summer I passed the Unified State Exam for 218 points and entered the university of my dreams!</div>
    <div class="text3Achievements">But also, besides studying, I have achievements in other fields. For example, in basketball. I have been doing it for 6 years and during this time I have managed to participate in many school and city competitions. Of course, during this time he took prizes with his team. So, last year we took 1st place in the district and 3rd place in the city.</div>
</div>


<div><img class="img0" src="../images/FOR-SCROLLING.jpg"></div>
</body>
</html>