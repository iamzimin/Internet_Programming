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
    <script rel = "text/javascript" src = "/lab2_IP/scripts/jquery-3.6.0.js"></script>
    <script rel = "text/javascript" src = "/lab2_IP/scripts/scrypt_lab2.js"></script>
    <script rel = "text/javascript" src = "/lab2_IP/scripts/scrypt_lab5.js"></script>
    <script rel = "text/javascript" src = "/lab2_IP/scripts/ajax.js"></script>
</head>
<body>

<div class="interface">
    <div class="FIO">Zimin Evgeny Sergeevich</div>
    <div class="Group">IVTACbd-11</div>
    <div class="MyWorks"><u><a href="MyWorks.php">My works</a></u></div>
    <div class="Achievements"><a href="Achievements.php">Achievements</a></div>
    <div class="AboutMe"><a href="AboutMe.php">About me</a></div>
    <div class="FAQ"><a href="FAQ.php">FAQ</a></div>
    <div class="MyContacts"><a href="MyContacts.php">Contacts</a></div>

    <?php
    if (isset($_SESSION['auth'])) { ?>
        <div class="Phone"><a href="menu.php"><?echo "User: "?></a></div>
        <div class="Phone"><a href="menu.php"><?echo "".$_SESSION['name'];?></a></div>
        <div class="Number"><a href="exit.php">Exit</a></div>

    <?php } else {?>
        <div class="Phone"><a href="registr.php">Registration</a></div>
        <div class="Number"><a href="login.php">Login</a></div>
    <?php } ?>
    <?php
    if (isset($_SESSION['auth'])) {
        $query = "SELECT * FROM `users` WHERE id=".$_SESSION['id']; ////////////вывод аватарки
        $res = DB::query($query);
        $item = DB::fetch_array($res) ?>
        <td><img src="<?=$item['avatar_name']?>" class="profilePhoto"></td>
    <?php } ?>


</div>

<div class="MyWorksDiv">
    <div class="Gallery">

        <div class="text1MyWorks">I haven't done much programming yet, but I have some interesting projects thanks to laboratory work at the university.</div>
        <div class="text2MyWorks">Here are some of them:</div>
        <div class="text3MyWorks">These projects were written by me during my studies at UlSTU. In the first project I made a maze with a square running through it, which can be controlled using the keyboard. When hitting the yellow square, the player moves to the next level, and when hitting the red square, the player returns to level 1. In another project, I used the processing of a two-dimensional array to automatically delete the row and column that contained the smallest element of this array. In the last project in the first program, I wrote data to a binary file about the amount of text that will be output, its coordinates and color. In another program, I decrypted this binary file and output the text with the specified parameters to the console.</div>

        <div> <img class="left" onclick="leftChangeImage()" src="../images/left.png"></div>

        <div id="MainImage"></div>

        <div> <img class="right" onclick="rightChangeImage()" src="../images/right.png"></div>

    </div>

</div>


<div class = "Game">
    <div class="BlocksGame">
        <?php
        for ($i = 1; $i < 25; $i++) { ?>
        <img id="ImageGame-<?php echo $i ?>" onclick="getClickedElement()" src="../images/game/WhiteSqrtImage.jpg">
        <?php } ?>
    </div>

</div>


<?php
if (isset($_POST['txt']) && isset($_SESSION['auth'])) // Проверка существования переменной авторизованного пользователя
{
    $query = "SELECT * FROM `users` WHERE id=".$_SESSION['id'];
    $res = DB::query($query);
    $item = DB::fetch_array($res);
    $best_score = $item['game_score'];

    $current_score = $_POST['txt'];

     if ($current_score < $best_score || $best_score == 0) {
        $_SESSION['game_score'] = $current_score;

        $query = "UPDATE `users` SET `game_score`= $current_score WHERE id=" . $_SESSION['id'];
        $res = DB::query($query);
    }
} ?>
<p class="out"></p>

<div id = "steps"></div>

<div id = "output"></div>
<div id = "output2"></div>













<div><img class="img0" src="../images/FOR-SCROLLING.jpg"></div>



















</body>
</html>