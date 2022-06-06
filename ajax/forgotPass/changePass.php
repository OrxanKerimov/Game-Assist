<?php
require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");
global $APPLICATION;

use Bitrix\Main\UserTable;

$lang = $_POST['LANG'];

$data = [
    'LOGIN'    => filter_var(trim(htmlspecialchars(strip_tags($_POST['LOGIN']))), FILTER_SANITIZE_STRING),
    'CODE'         => filter_var(trim(htmlspecialchars(strip_tags($_POST['CODE']))), FILTER_SANITIZE_STRING),
    'PASSWORD'         => filter_var(trim(htmlspecialchars(strip_tags($_POST['PASSWORD']))), FILTER_SANITIZE_STRING),
    'PASSWORD_CONFIRM' => filter_var(trim(htmlspecialchars(strip_tags($_POST['PASSWORD_CONFIRM']))), FILTER_SANITIZE_STRING),
];




if($lang == 'en')
{
    $langAr = [
        'recovery' => 'Invalid recover code.',
        'login' => 'Invalid login.',
        'password' => [
           'length' => 'The password must be at least 6 characters.',
           'match' => 'Passwords don\'t match',
           'oldForgot' => 'You didn\'t fill the old password.',
           'oldErr' => 'Invalid old password.',
           'newForgot' => 'You forgot to fill a new password.'
        ],
        'subject' => 'Password restored',
        'message' => "Informational message of the site GAME.ASSIST
------------------------------------------
".$data['LOGIN'].", You have successfully changed your password!

http://".$_SERVER['SERVER_NAME']."/en

The message is generated automatically." ];
}
elseif($lang == 'ru')
{
    $langAr = [
        'recovery' => 'Неверный код восстановления.',
        'login' => 'Неверный логин.',
        'password' => [
            'length' => 'Пароль должен быть не менее 6 символов.',
            'match' => 'Пароли не совпадают.',
            'oldForgot' => 'Вы не указали старый пароль.',
            'oldErr' => 'Неверный старый пароль.',
            'newForgot' => 'Вы забыли ввести новый пароль.'
        ],
        'subject' => 'Пароль восстановлен',
        'message' => "Информационное сообщение сайта GAME.ASSIST
------------------------------------------
".$data['LOGIN'].", Вы успешно восстановили свой пароль!

http://".$_SERVER['SERVER_NAME']."

Сообщение сгенерировано автоматически." ];
}

$user = UserTable::getList([
    'select' => ['ID', 'EMAIL'],
    'filter' => ['LOGIN' => $data['LOGIN']]
])->fetch();

$userData = CUser::GetByID($user['ID']);
$userAr = $userData->Fetch();
$uniqKey = $userAr['UF_RECOVERY_CODE'];

if(!$user) die($langAr['login']);
if($data['CODE'] !== $uniqKey) die($langAr['recovery']);


    if($data['PASSWORD'] !== '' && $data['PAST_PASSWORD'] !== ''){
        if($data['PASSWORD'] == $data['PASSWORD_CONFIRM'])
        {
            if (strlen($data['PASSWORD']) >= 6 && strlen($data['PASSWORD']) < 256)
            {
                $result = ['PASSWORD' => $data['PASSWORD'], 'PASSWORD_CONFIRM' => $data['PASSWORD_CONFIRM']];
            } else die($langAr['length']);
        }
        else die($langAr['password']['match']);
    }
    else die($langAr['password']['newForgot']);


$header = "From: info@game.assist.net";
mail($user['EMAIL'], $langAr['subject'], $langAr['message'], $header);



    $result['UF_RECOVERY_CODE'] = '';

    $USER->Update($user['ID'], $result);
    print_r(1);








