<?php
require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");
global $APPLICATION;

use Bitrix\Main\UserTable;

$email = filter_var(trim(htmlspecialchars(strip_tags($_POST['EMAIL']))), FILTER_SANITIZE_STRING);
$lang = $_POST['LANG'];
$key = md5(rand());

$user = UserTable::getList([
    'select' => ['ID', 'LOGIN'],
    'filter' => ['EMAIL' => $_POST['EMAIL']]
])->fetch();

if(!$user) {print_r(2); die;}




if($lang == 'en')
{
    $langAr = ['subject' => 'Восстановление пароля',
        'message' => "Informational message of the site GAME.ASSIST
------------------------------------------
".$user['LOGIN'].",

To change your password, click on the following link:

http://".$_SERVER['SERVER_NAME']."/en/change_pass_proccesing/index.php?change_password=yes&lang=ru&USER_CHECKWORD=".$key."&USER_LOGIN=".$user['LOGIN']."


Your registration information:

Login: ".$user['LOGIN']."
Recovery code: ".$key."

The message is generated automatically." ];
}
elseif($lang == 'ru')
{
    $langAr = ['subject' => 'Восстановление пароля',
        'message' => "Информационное сообщение сайта GAME.ASSIST
------------------------------------------
".$user['LOGIN'].",

Для смены пароля перейдите по следующей ссылке:
http://".$_SERVER['SERVER_NAME']."/change_pass_proccesing/index.php?change_password=yes&lang=ru&USER_CHECKWORD=".$key."&USER_LOGIN=".$user['LOGIN']."

Ваша регистрационная информация:

Login: ".$user['LOGIN']."
Код восстановления: ".$key."

Сообщение сгенерировано автоматически." ];
}



$header = "From: info@game.assist.net";
mail($email, $langAr['subject'], $langAr['message'], $header);

$USER->Update($user['ID'], array('UF_RECOVERY_CODE' => $key));
print_r(3);








