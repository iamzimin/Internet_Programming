<?php
include_once $_SERVER['DOCUMENT_ROOT']."/lab2_IP/Lab2/db.class.php";
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

    <?php
    if (isset($_SESSION['auth'])) { ?>
        <div class="Phone"><a href="registr.php"><?echo "User: "?></a></div>
        <div class="Phone"><a href="registr.php"><?echo "".$_SESSION['name'];?></a></div>
        <div class="Number"><a href="exit.php">Exit</a></div>
        <?php
        $query = "SELECT * FROM `users` WHERE id=".$_SESSION['id']; ////////////вывод аватарки
        $res = DB::query($query);
        $item = DB::fetch_array($res) ?>
        <td><img src="<?=$item['avatar_name']?>" class="profilePhoto"></td>
    <?php } else {?>
        <div class="Phone"><u><a href="registr.php">Registration</a></u></div>
        <div class="Number"><a href="login.php">Login</a></div>
    <?php } ?>

</div>

<div><img class="img0" src="../images/FOR-SCROLLING.jpg"></div>
</body>
</html>


<?php
if(isset($error) && !empty($error))
{
    ?>
    <div class="error">
        <div>
            <?=$error?>
        </div>
    </div>
<?php } ?>


<?php include_once "fileRegistr.php"; ?>


<?php
if (isset($_SESSION['auth'])) { ?>
    <?php header('location: MyWorks.php'); ?>
<?php }
