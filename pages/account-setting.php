<?php
session_start();
require('../node/vars.php');
$setting = $_POST['form'];
$userLogin = $_SESSION['login'];
$_SESSION['error'] = '';
$_SESSION['message'] = '';

$mysql = new mysqli($hostnameSQL, $usernameSQL, $passwordSQL, $databaseSQL);
switch ($setting) {
    case 'nickname':
        $newNickname = $_POST['newnickname'];
        if ($newNickname != '' && $newNickname != ' ' && isset($newNickname)) {
            $mysql->query("UPDATE `users` SET `nickname` = '$newNickname' WHERE `login` = '$userLogin';");
            $_SESSION['message'] = 'Успешно изменено имя!';
            $_SESSION['nickname'] = $newNickname;
        } else {
            $_SESSION['error'] = 'Неподходящие данные';
        }
        break;
    case 'pwd':
        $oldPwd = md5($_POST['old-password']);
        $newPwd = md5($_POST['new-password']);
        $retPwd = md5($_POST['ret-password']);
        if ($oldPwd != '' && $oldPwd != ' ' && isset($oldPwd) && $newPwd != '' && $newPwd != ' ' && isset($newPwd) && $retPwd != '' && $retPwd != ' ' && isset($retPwd)) {
            if (strlen($oldPwd) >= 8 && strlen($newPwd) >= 8 && strlen($retPwd) >= 8) {
                $res = $mysql->query("SELECT `password` FROM `users` WHERE `login` = '$userLogin' AND `password` = '$oldPwd';");
                $res = $res->fetch_assoc();
                if ($res != '') {
                    if ($newPwd == $retPwd) {
                        if ($newPwd != $oldPwd) {
                            $mysql->query("UPDATE `users` SET `password` = '$newPwd' WHERE `login` = '$userLogin';");
                            $_SESSION['message'] = 'Успешно изменён пароль!';
                        } else {
                            $_SESSION['error'] = 'Старый и новый пароль совпадают';
                        }
                    } else {
                        $_SESSION['error'] = 'Новый пароль не совпадает';
                    }
                } else {
                    $_SESSION['error'] = 'Неверный пароль';
                }
            } else {
                $_SESSION['error'] = 'Неподходящие данные хитрый жук!';
            }
        } else {
            $_SESSION['error'] = 'Неподходящие данные';
        }
        break;
    case 'icon':
        $allowedExtensions = ['jpg', 'png', 'jpeg'];
        $fileName = $_FILES['file']['name'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        if (in_array($fileExtension, $allowedExtensions)) {
            if ($_FILES["file"]["size"] < $_POST['MAX_FILE_SIZE']) {
                $_FILES["file"]["name"] = "$userLogin." . $fileExtension;
                $fileName = basename($_FILES["file"]["name"]);
                $targetFile = $targetDirIcon . $fileName;
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
                    $search = $targetDirIcon . $userLogin . '.*';
                    $otherIcon = glob($search);
                    print_r($otherIcon);
                    foreach ($otherIcon as $thisIcon) {
                        if ($thisIcon != $targetFile) {
                            unlink($thisIcon);
                        }
                    }
                    echo "Файл " . htmlspecialchars($fileName) . " успешно загружен.";
                    $mysql->query("UPDATE `users` SET `icon` = '$fileName' WHERE `login` = '$userLogin';");
                    $_SESSION['message'] = 'Успешно обновлена аватарка!';
                    $_SESSION['icon'] = $fileName;
                } else {
                    $_SESSION['error'] = "Извините, произошла ошибка при загрузке вашего файла.";
                }
            } else {
                $_SESSION['error'] = 'Максимальный размер файла 5MB';
            }
        } else {
            $_SESSION['error'] = 'Неверное расширение. Доступны png и jpg.';
        }
        echo '<pre>';

        echo 'Дополнительная отладочная информация:';
        print_r($_FILES);
        print "</pre>";
        break;
}
$mysql->close();
header("Location:/pages/account.php");
echo '<br>';
print_r($_SESSION);
echo '<br>';
print_r($_POST);


?>