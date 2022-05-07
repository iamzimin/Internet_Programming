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
    <div class="AboutMe"><u><a href="AboutMe.php">About me</a></u></div>
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

<div><img class="img6" src="../images/66.png"></div>

<div class="textAboutMe">
    <div class="text1AboutMe">My name is Evgeny Zimin, I am 18 years old. I am studying at the Ulyanovsk State Technical University. I recently graduated from Gymnasium No. 59 and passed the Unified State Exam well, by 218 points.</div>
    <div class="text2AboutMe">Among my hobbies, I have been playing basketball for 6 years, and during this time I have won many times with my team at competitions.</div>
    <div class="text3AboutMe">I entered the direction of Computer Science and Computer Engineering, because I like programming and I want to develop in this field.</div>
    <div class="text4AboutMe">After university, I plan to find an interesting job in the field of game development or DevOps engineering.</div>
</div>




<div><img class="img0" src="../images/FOR-SCROLLING.jpg"></div>
</body>
</html>