<?php
require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('iblock');
$pageURL = explode('/', $_POST['URL']);

if($pageURL[1] !== 'en')
{
    $langAr = [
        'NAME' => ['max' => 'Длина имени должна быть не более 255 символов.', 'forgot' => 'Вы забыли указать своё имя.'],
        'THEME' => 'Длина темы должна быть не более 255 и не менее 3 символов.',
        'COMMENT' => 'Комментарий должен быть не более 500 символов.',
        'USLUGA' => 'Вы забыли выбрать услугу.',
        'RATE' => 'Вы забыли поставить оценку.',
        'THANKS' => 'Спасибо за ваш отзыв!'
    ];
}
elseif($pageURL[1] == 'en')
{
    $langAr = [
        'NAME' => ['max' => 'The length of the name must be no more than 255 characters.', 'forgot' => 'You forgot to enter your name.'],
        'THEME' => 'The length of the topic should be no more than 255 and no less than 3 characters.',
        'COMMENT' => 'The comment must be no more than 500 characters.',
        'USLUGA' => 'You forgot to choose a service.',
        'RATE' => 'You forgot to put a rating.',
        'THANKS' => 'Thanks for your review!'
    ];
}
$data = [
    'NAME'    => filter_var(trim(htmlspecialchars(strip_tags($_POST['NAME']))), FILTER_SANITIZE_STRING),
    'THEME'   => filter_var(trim(htmlspecialchars(strip_tags($_POST['THEME']))), FILTER_SANITIZE_STRING),
    'COMMENT' => filter_var(trim(htmlspecialchars(strip_tags($_POST['COMMENT']))), FILTER_SANITIZE_STRING),
    'USLUGA'  => filter_var(trim(htmlspecialchars(strip_tags($_POST['USLUGA']))), FILTER_SANITIZE_STRING),
    'RATE'    => filter_var(trim(htmlspecialchars(strip_tags($_POST['RATE']))), FILTER_SANITIZE_STRING),
];

foreach ($data as $key => $val)
{
        if ($key == 'NAME')
        {
            if(strlen($val) >= 2 && strlen($val) < 255) $result[$key] = $val;
            elseif(strlen($val) > 255)
            {
                echo $langAr[$key]['max']; die;
            }
            else
            {
                echo $langAr[$key]['forgot']; die;
            }
        }
        elseif ($key == 'THEME' )
        {
           if($val)
           {
               if(strlen($val) >= 3 && strlen($val) < 255) $result[$key] = $val;
               else
               {
                   echo $langAr[$key]; die;
               }
           }
        }
        elseif ($key == 'COMMENT')
        {
           if($val)
           {
               if(strlen($val) <= 500) $result[$key] = $val;
               else
               {
                   echo $langAr[$key];
                   die;
               }
           }
        }
        elseif ($key == 'USLUGA')
        {
            if($val) $result[$key] = $val;
            else {
                echo $langAr[$key];
                die;
            }
        }
        elseif ($key == 'RATE')
        {
            if($val) $result[$key] = $val;
            else {
                echo $langAr[$key];
                die;
            }
        }
}
$services = CIBlockElement::GetList(array(), array('IBLOCK_ID' => 9, 'ACTIVE' => 'Y'), false, array(),
    array('PROPERTY_NAME_EN','PROPERTY_NAME'));
while ($service = $services->GetNext()):
    if ($service['PROPERTY_NAME_EN_VALUE'] == $result['USLUGA']){
        $usluga = $service['PROPERTY_NAME_VALUE'];
        $usluga_en = $result['USLUGA'];
     }elseif($service['PROPERTY_NAME_VALUE'] == $result['USLUGA']){
        $usluga_en = $service['PROPERTY_NAME_EN_VALUE'];
        $usluga = $result['USLUGA'];
    }
endwhile;


$feedback = CIBlockElement::GetList(array(), array('IBLOCK_ID' => 10), false, array());
$count = $feedback->SelectedRowsCount()+1;


        $el = new CIBlockElement;
        $PROPS = [
            47 => $result['NAME'],
            48 => $usluga,
            49 => $result['COMMENT'],
            50 => $result['RATE'],
            52 => $result['THEME'],
            56 => $usluga_en,

        ];

        $arLoadProductArray = Array(
            "IBLOCK_ID" => 10,
            "NAME" => "Отзыв".$count,
            "CODE" => "otziv".$count,
            "PROPERTY_VALUES"=> $PROPS,
            "ACTIVE" => "N",
        );

        $PRODUCT_ID = $el->Add($arLoadProductArray);
    print_r(1);

