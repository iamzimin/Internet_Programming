<?php
session_start();
include "db.class.php";
DB::getInstance();
?>

<?php
if(!isset($_SESSION['auth']))
    exit;
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
    <div class="MyContacts"><a href="MyContacts.php">Contacts</a></div>

    <div class="Phone"><u><a href="menu.php"><?echo "User: "?></a></u></div>
    <div class="Phone"><a href="menu.php"><?echo "".$_SESSION['name'];?></a></div>
    <div class="Number"><a href="exit.php">Exit</a></div>

    <?php
    if (isset($_SESSION['auth'])) {
        $query = "SELECT * FROM `users` WHERE id=".$_SESSION['id']; ////////////вывод аватарки
        $res = DB::query($query);
        $item = DB::fetch_array($res) ?>
        <td><img src="<?=$item['avatar_name']?>" class="profilePhoto"></td>
    <?php } ?>

</div>
<div><img class="img0" src="../images/FOR-SCROLLING.jpg"></div>
</body>
</html>



<div class="centerTextHeader">Users list</div>
<table class="edit_form">
    <tr>
        <td>id</td>
        <td>Login</td>
        <td>Full name</td>
        <td>User type</td>
        <td>Avatar</td>
        <td>Score</td>
        <td>File</td>
        <td></td>
    </tr>

    <?php
    $userType = $_SESSION['user_type'];
    if($userType == 0) { ?>
    <?php
    $query = "SELECT * FROM `users`";
    $res = DB::query($query);
    while( ($item = DB::fetch_array($res)) != false) {
        ?>
        <tr>
            <td><?=$item['id']?></td>
            <td><?=$item['login']?></td>
            <td><?=$item['fio']?></td>
            <td><?=$item['user_type']?></td>
            <td><img src="<?=$item['avatar_name']?>" class="avatarimg" alt="Avatar"></td>
            <td><?=$item['game_score']?></td>
            <td><?=$item['avatar_name']?></td>
            <td>
                <a href="edituser.php?id=<?=$item['id']?>">
                    <img class="icons" src="../images/edit.png" title="Edit">
                </a>
                <a href="deleteuser.php?id=<?=$item['id']?>">
                    <img class="icons" src="../images/delete.png" title="Delete">
                </a>
            </td>
        </tr>
        <?php
    }
    }
    else if ($userType == 1) {
        $query = "SELECT * FROM `users` WHERE id=".$_SESSION['id']; ////////////вывод аватарки
        $res = DB::query($query);
        $item = DB::fetch_array($res); ?>

            <tr>
                <td><?=$item['id']?></td>
                <td><?=$item['login']?></td>
                <td><?=$item['fio']?></td>
                <td><?=$item['user_type']?></td>
                <td><img src="<?=$item['avatar_name']?>" class="avatarimg" alt="Avatar"></td>
                <td><?=$item['game_score']?></td>
                <td><?=$item['avatar_name']?></td>
                <td>
                    <a href="edituser.php?id=<?=$item['id']?>">
                        <img class="icons" src="../images/edit.png" title="Edit">
                    </a>
                    <a href="deleteuser.php?id=<?=$item['id']?>">
                        <img class="icons" src="../images/delete.png" title="Delete">
                    </a>
                </td>
            </tr>
            <?php } ?>

</table>

