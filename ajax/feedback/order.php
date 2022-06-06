<?php
require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');
CModule::IncludeModule('main');
$lang = $_REQUEST['LANG_FORM'];
$mails = CIBlockElement::GetList(
    array(),
    array('INCLUDE_SUBSECTIONS' => 'Y','IBLOCK_ID' => 15, 'ACTIVE' => 'Y'),
    false,
    array(),
    array('ID', 'PROPERTY_MAIL'));
$mail = $mails->GetNext();
if($lang == 'EN')
{
    $langAr = ['error' => 'Fill in all the fields.',
        'subject' => 'Requisites',
        'message' => "Thanks for your request! \r\n
Our requisites:\r
QIWI: 01234879\r
WebMoney: R398123781787843257\r"
    ];

}
elseif($lang == 'RU')
{
    $langAr = ['error' => 'Заполните все поля.',
        'subject' => 'Реквизиты',
        'message' => "Спасибо за ваш запрос \r\n
Наши реквизиты:\r
QIWI: 01234879\r
WebMoney: R398123781787843257\r" ];
}

$admin = CUser::GetByID(1);




if($_REQUEST) {

   $finalPrice = $_REQUEST['USLUGI']['FULL_PRICE'];


    $message = 'Заявка' . "\r\n"
        . 'Имя: '             . $_REQUEST['NAME']. "\r\n"
        . 'Почта: '           . $_REQUEST['EMAIL']. "\r\n"
        . 'Язык: '            . $_REQUEST['LANG_FORM']. "\r\n"
        . 'Телефон: '         . $_REQUEST['PHONE_NUMBER']. "\r\n"
        . 'Услуга: '          . $_REQUEST['USLUGI']['CURRENT']. "\r\n";
        if($_REQUEST['USLUGI']['BASENAME']) $message .= 'Базовое название: '. $_REQUEST['USLUGI']['BASENAME']. "\r\n";
        if($_REQUEST['USLUGI']['SCROLL']) $message .=  'Скролл: '. $_REQUEST['USLUGI']['SCROLL']['VALUE']." | ".number_format($_REQUEST['USLUGI']['TYPE'], 0, '', ' ')." за единицу". "\r\n";

   foreach ($_REQUEST['USLUGI'] as $key => $val)
   {
       if(!empty($_REQUEST['USLUGI'][$key]['VALUE']) && $key != 'SCROLL')
       {
           $message .= $val['NAME'].': '. $val['VALUE']. "\r\n";
       }

   }
    if($_REQUEST['LBZ'])
    {
        foreach ($_REQUEST['LBZ'] as $key => $val)
        {
            if(!empty($val))
            {
                $message .= $key.': '. $val. "\r\n";
            }
        }
    }
    if($_REQUEST['DISCOUNT'])
    {
        foreach ($_REQUEST['DISCOUNT'] as $key => $val)
        {
            if(!empty($val['VALUE']))
            {
                $message .= $val['NAME'].': '. $val['VALUE']. "\r\n";
            }
        }
    }
//    if($_REQUEST['USLUGI']['ALL']) $message .= 'Все услуги или с отличием: '.$_REQUEST['USLUGI']['ALL'];
//    if($_REQUEST['USLUGI']['UNGREAT']) $message .= 'Без отличия: '.$_REQUEST['USLUGI']['UNGREAT'];
    else $message .= 'Полная цена: '.$finalPrice;
    $to1 = $mail['PROPERTY_MAIL_VALUE'];

    $subject = 'Заявка';

    $header = "From: info@game.assist.net";
    mail($to1, $subject, $message, $header);

    mail($_REQUEST['EMAIL'], $langAr['subject'], $langAr['message'], $header);




    if(CUser::IsAuthorized())
    {
        if($lang == 'EN')
        {
            $message = '';
            $message = 'Service: '. $_REQUEST['USLUGI_EN']['CURRENT']. "; \r\n";
            if($_REQUEST['USLUGI_EN']['BASENAME']) $message .= 'Service type: '. $_REQUEST['USLUGI_EN']['BASENAME']. "; \r\n";
//            if($_REQUEST['USLUGI']['SCROLL']) $message .=  $_REQUEST['USLUGI_EN']['SCROLL']['NAME'].': '.$_REQUEST['USLUGI']['SCROLL']['VALUE']. "; \r\n";

            foreach ($_REQUEST['USLUGI_EN'] as $key => $val)
            {
                if(!empty($_REQUEST['USLUGI'][$key]['VALUE']))
                {
                    $message .= $val['NAME'].': '. $_REQUEST['USLUGI'][$key]['VALUE']. "; \r\n";
                }
            }
            if($_REQUEST['LBZ_EN'])
            {
                foreach ($_REQUEST['LBZ_EN'] as $key => $val)
                {
                    if(!empty($val))
                    {
                        $message .= $key.': '. $val. "; \r\n";
                    }
                }
            }
            if($_REQUEST['DISCOUNT_EN'])
            {
                foreach ($_REQUEST['DISCOUNT_EN'] as $key => $val)
                {
                    if(!empty($_REQUEST['DISCOUNT'][$key]['VALUE']))
                    {
                        $message .= $val['NAME'].': '. $_REQUEST['DISCOUNT'][$key]['VALUE']. "; \r\n";
                    }
                }
            }
            if($_REQUEST['USLUGI_EN']['ALL']) $message .= 'All services: '.$_REQUEST['USLUGI']['ALL'].';';
            else $message .= 'Full price: '.$finalPrice.';';

            $messageAr = $message;
        }
        elseif($lang == 'RU')
        {

            $message = '';
            $message = 'Услуга: '. $_REQUEST['USLUGI']['CURRENT']. "; \r\n";
            if($_REQUEST['USLUGI']['BASENAME']) $message .= 'Тип услуги: '. $_REQUEST['USLUGI']['BASENAME']. "; \r\n";
            if($_REQUEST['USLUGI']['scroll']) $message .=  'Скролл: '. $_REQUEST['USLUGI']['scroll']. "; \r\n";

            foreach ($_REQUEST['USLUGI'] as $key => $val)
            {
                if(!empty($_REQUEST['USLUGI'][$key]['VALUE']))
                {
                    $message .= $val['NAME'].': '. $val['VALUE']. "; \r\n";
                }
            }
            if($_REQUEST['LBZ'])
            {
                foreach ($_REQUEST['LBZ'] as $key => $val)
                {
                    if(!empty($val))
                    {
                        $message .= $key.': '. $val. "; \r\n";
                    }
                }
            }

            if($_REQUEST['DISCOUNT'])
            {
                foreach ($_REQUEST['DISCOUNT'] as $key => $val)
                {
                    if(!empty($val['VALUE']))
                    {
                        $message .= $val['NAME'].': '. $val['VALUE']. "; \r\n";
                    }
                }
            }
            if($_REQUEST['USLUGI']['ALL']) $message .= 'Все услуги: '.$_REQUEST['USLUGI']['ALL'].';';
            else $message .= 'Полная цена: '.$finalPrice.';';

            $messageAr = $message;
        }

        $countOrders = CIBlockElement::GetList(array(),
            array('IBLOCK_ID' => 14),
            false,
            array(),
            array('ID'));
        $count = $countOrders->SelectedRowsCount();
        $name = $count+1;
        $el = new CIBlockElement;
        $result = [
            'USLUGA' => $_REQUEST['USLUGA_ID'],
            'STATUS' => 23,
            'SELECTED_FIELDS' => $messageAr,
            'CLIENT' => CUser::GetID()
            ];

        $arLoadProductArray = Array(
            "MODIFIED_BY"       => $admin,
            "IBLOCK_SECTION_ID" => false,
            "IBLOCK_ID"         => 14,
            "PROPERTY_VALUES"   => $result,
            "NAME"              => $name,
            "ACTIVE"            => "Y",

        );

        if($PRODUCT_ID = $el->Add($arLoadProductArray))
        {
            echo 1;
        }
        else
        {
            echo 1;
        }
    }
    else
    {
        echo 1;
    }

}


else
{
    echo $langAr['error'];
}

die();

?>