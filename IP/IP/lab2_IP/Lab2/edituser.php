<?php
session_start();

if (empty($error1)) {
    include "db.class.php";
    DB::getInstance();
}
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
    $query1 = "SELECT * FROM `users` WHERE id=".$_SESSION['id']; ////////////вывод аватарки
    $res1 = DB::query($query1);
    $item1 = DB::fetch_array($res1); ?>
    <td><img src="<?=$item1['avatar_name']?>" class="profilePhoto"></td>
    <?php } ?>

</div>
<div><img class="img0" src="../images/FOR-SCROLLING.jpg"></div>
</body>
</html>

<div class="centerTextHeader">Editing the user</div>

<?php
if(isset($error1) && !empty($error1))
{
    ?>
    <div class="error">
        <div>
            <?=$error1?>
        </div>
    </div>
<?php }
else {
    $_SESSION['_GET_ID'] = $_GET['id'];
    //$_SESSION['_GET_LOGIN'] = $_GET['login'];
    //$_SESSION['_GET_LOGIN'] = $_GET['name'];
    //$_SESSION['_GET_LOGIN'] = $_GET['user'];


}?>

    <?php
    $query = "SELECT * FROM `users` WHERE id=".$_SESSION['_GET_ID'];
    $res = DB::query($query);

    $userType = $_SESSION['user_type'];
    if($userType == 0) {

    if( ($item = DB::fetch_array($res)) != false) {
        $_SESSION['_GET_LOGIN'] = $item['login'];
        ?>
        <div class="form_reg">
            <form action="updateuser.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?=$item['id']?>">
                <table>
                    <tr>
                        <td>Your login</td>
                        <td>
                            <input type="text" name="user_name" value="<?=$item['login']?>" REQUIRED/>
                        </td>
                    </tr>
                    <tr>
                        <td>Your full name</td>
                        <td>
                            <input type="text" name="user_fio" value="<?=$item['fio']?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td>
                            <input type="password" name="user_pass" value="<?=$item['pas1']?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Password again</td>
                        <td>
                            <input type="password" name="user_pass2" value="<?=$item['pas2']?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Game Score</td>
                        <td>
                            <input type="text" name="user_score" value="<?=$item['game_score']?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>User's avatar</td>
                        <td>
                            <input type="file" name="user_avatar" />
                        </td>
                    </tr>
                </table>
                <input type="submit" value="Edit" />
            </form>
        </div>
        <?php } } else if ($userType == 1) {


        if( ($item = DB::fetch_array($res)) != false) {
        $_SESSION['_GET_LOGIN'] = $item['login'];
        ?>
        <div class="form_reg">
            <form action="updateuser.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?=$item['id']?>">
                <table>
                    <tr>
                        <td>Your login</td>
                        <td>
                            <input type="text" name="user_name" value="<?=$item['login']?>" REQUIRED/>
                        </td>
                    </tr>
                    <tr>
                        <td>Your full name</td>
                        <td>
                            <input type="text" name="user_fio" value="<?=$item['fio']?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td>
                            <input type="password" name="user_pass" value="<?=$item['pas1']?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Password again</td>
                        <td>
                            <input type="password" name="user_pass2" value="<?=$item['pas2']?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>User's avatar</td>
                        <td>
                            <input type="file" name="user_avatar" />
                        </td>
                    </tr>
                </table>
                <input type="submit" value="Edit" />
            </form>
        </div>
        <?php    }  }  ?>
