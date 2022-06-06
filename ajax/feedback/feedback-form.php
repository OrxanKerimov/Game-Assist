<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
global $APPLICATION;
CModule::IncludeModule('iblock');

$mails = CIBlockElement::GetList(
    array(),
    array('INCLUDE_SUBSECTIONS' => 'Y','IBLOCK_ID' => 15, 'ACTIVE' => 'Y'),
    false,
    array(),
    array('ID', 'PROPERTY_MAIL'));
$mail = $mails->GetNext();

$lang = $_POST['LANG'];

if($lang == 'en')
{
    $langAr = ['success' => 'The message has been sent!', 'error' => 'Fill in all the fields.',
        'subject' => 'Requisites',
        'message' => "We will contact you soon."
    ];
}
elseif($lang !== 'en')
{
    $langAr = ['success' => 'Сообщение отправлено!', 'error' => 'Заполните все поля.',
        'subject' => 'Реквизиты',
        'message' => "Мы скоро с вами свяжемся." ];
}


if($_REQUEST) {

    $message = 'Заявка' . "\r\n"
        . 'Имя: '. $_REQUEST['NAME']. "\r\n"
        . 'Почта: '. $_REQUEST['EMAIL']. "\r\n"
        . 'Телефон: '. $_REQUEST['PHONE_NUMBER']. "\r\n";
    $to1 = $mail['PROPERTY_MAIL_VALUE'];

    $subject = 'Заявка';

    $header = "From: info@game-assist.net";
    mail($to1, $subject, $message, $header);

    mail($_REQUEST['EMAIL'], $langAr['subject'], $langAr['message'], $header);

    echo 1;
}
else {


    echo $langAr['error'];

}

die();

?>
