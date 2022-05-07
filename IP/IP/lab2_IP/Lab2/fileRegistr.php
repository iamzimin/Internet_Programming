<div class="centerTextHeader">Registration</div>

    <div class="form_reg">
        <div>
            <form action="user.php" method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>Your login</td>
                        <td>
                            <input type="text" name="user_name" value="<?=$login?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Your full name</td>
                        <td>
                            <input type="text" name="user_fio" value="<?=$fio?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td>
                            <input type="password" name="user_pass"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Password again</td>
                        <td>
                            <input type="password" name="user_pass2"/>
                        </td>
                    </tr>
                    <tr>
                        <td>User's avatar</td>
                        <td>
                            <input type="file" name="user_avatar" value="<?=$user_avatar?>"/>
                        </td>
                    </tr>
                </table>
                <input type="submit" value="Register" />
            </form>
        </div>
    </div>

<?php
if(isset($_FILES['user_avatar']) && empty($error)) {
    include_once $_SERVER['DOCUMENT_ROOT'] . "/lab2_IP/Lab2/db.class.php";
    DB::getInstance();

    $uploadTypeFile = "";
    if ($_FILES['user_avatar']['type'] = 'image/jpeg')
        $uploadTypeFile = ".jpg";

    $uploadNameFile = md5(time().$_FILES['user_avatar']['name']);
    $uploadNameDirection = $_SERVER['DOCUMENT_ROOT']."/upload/avatars/";

    $uploadAvatar = $uploadNameDirection.$uploadNameFile.$uploadTypeFile;
    if (move_uploaded_file($_FILES['user_avatar']['tmp_name'],
        $uploadAvatar
    )) {
    } else {
    }
    $strQueryAvatar = "`avatar_name` = '"."/upload/avatars/".$uploadNameFile.$uploadTypeFile . "'";

    $query = "UPDATE `users` SET ".$strQueryAvatar." WHERE id=".$_SESSION['id'];           //////////////// не добавляет фотку
    $res = DB::query($query);
}
?>