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
    <div class="FAQ"><u><a href="FAQ.php">FAQ</a></u></div>
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


<div class="textFAQ">
    <div class="text1FAQ">— Why did you choose this particular direction?</div>
    <div class="text2FAQ">I chose it because I have long been interested in how applications, games and artificial intelligence work. And after I found out that they teach this in my city, I decided that I would enroll here.</div>

    <div class="text3FAQ">— Why did you decide to play basketball?</div>
    <div class="text4FAQ">&nbsp;When I was in the 6th grade, my physical education teacher invited me to practice, as I was the tallest in the class and I had a great chance to become successful in this kind of sport. After the first training sessions, I enjoyed doing it and that's why I continue to train to this day.</div>

    <div class="text5FAQ">— Who do you see yourself in the future?</div>
    <div class="text6FAQ">I believe that in 4 years, after graduating from University, I will go to study for a master's degree in order to improve my knowledge in the field of artificial intelligence. And after studying to get an interesting job for me to enjoy it.</div>
</div>

<div><img class="img0" src="../images/FOR-SCROLLING.jpg"></div>
</body>
</html>