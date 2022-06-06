<?php
require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");
global $APPLICATION;
CModule::IncludeModule('main');
use Bitrix\Main\UserTable;

$USER = new CUser;

$lang = $_POST['LANG'];


    $email = filter_var(trim(htmlspecialchars(strip_tags($_POST['EMAIL']))), FILTER_SANITIZE_STRING);
    $pass = filter_var(trim(htmlspecialchars(strip_tags($_POST['PASSWORD']))), FILTER_SANITIZE_STRING);
    $passConf = filter_var(trim(htmlspecialchars(strip_tags($_POST['PASSWORD_CONFIRM']))), FILTER_SANITIZE_STRING);

if($lang == 'en')
{
    $langAr = [
        'email' => ['forgot' => 'You forgot to fill your E-mail.', 'exists' => 'An account with such an email already exists.', 'length' => 'Check the length of the "E-mail" field, it must be no more than 255 characters.'],
        'password' => ['forgot' => 'You forgot to fill your password.' ,'match' => 'Passwords don\'t match.', 'length' => 'The password must be at least 6 characters long.'],
        'subject' => 'Welcome to GAME.ASSIST',
        'message' => "Informational message of the GAME.ASSIST website
------------------------------------------

Hello! You have registered on our website.

Your E-Mail: ".$email."
http://".$_SERVER['SERVER_NAME']."/en'

The letter is generated automatically."];

}
elseif($lang == 'ru')
{
    $langAr = [
        'email' => ['forgot' => 'Вы забыли указать E-mail.', 'exists' => 'Аккаунт с такой почтой уже существует.', 'length' => 'Проверьте длину поля "E-mail", оно должно быть не больше 255 символов.'],
        'password' => ['forgot' => 'Вы забыли указать пароль.' ,'match' => 'Пароли не совпадают.', 'length' => 'Длина пароля должна быть не менее 6 символов.'],
        'subject' => 'Добро пожаловать на GAME.ASSIST',
        'message' => "Информационное сообщение сайта GAME.ASSIST
------------------------------------------

Здравствуйте! Вы зарегестрировались на нашем сайте.
http://".$_SERVER['SERVER_NAME']."

Ваш E-Mail: ".$email."

Письмо сгенерировано автоматически."];
}

    if($email)
    {
        $check = UserTable::getList([
            'select' => ['ID'],
            'filter' => ['EMAIL' => $email]
        ])->fetch();

        if($check) die($langAr['email']['exists']);
        else
        {
            if(strlen($email) < 256)
            {
                $result['EMAIL'] = $email;
            }
            else die($langAr['email']['length']);
        }


    }
    else die($langAr['email']['forgot']);

    if($pass && $passConf)
    {
        if( (strlen($pass) >= 6 && strlen($pass) < 256) || (strlen($passConf) >= 6 && strlen($passConf) < 256))
        {
            if($passConf == $pass)
            {
                $result['PASSWORD'] = $result['PASSWORD_CONFIRM'] = $pass;
            }
            else die($langAr['password']['match']);
        }
        else die($langAr['password']['length']);
    }
    else die($langAr['password']['forgot']);


    $arFields = Array(
        "EMAIL"             => $email,
        "LOGIN"             => $email,
        "LID"               => "ru",
        "ACTIVE"            => "Y",
        "GROUP_ID"          => array(3),
        "PASSWORD"          => $pass,
        "CONFIRM_PASSWORD"  => $pass,
    );

    $ID = $USER->Add($arFields);
    if (intval($ID) > 0)
    {
        $arAuthResult = $USER->Login($email, $pass, "Y");
        $APPLICATION->arAuthResult = $arAuthResult;
        $result = "success";

        $header = "From: info@game.assist.net";
        mail($email, $langAr['subject'], $langAr['message'], $header);

    }
    else
    {
        $result = $USER->LAST_ERROR;
    }





print_r($result);
