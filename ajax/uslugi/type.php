<?php
require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('iblock');

$service_detail = CIBlockElement::GetList(
    array(),
    array('INCLUDE_SUBSECTIONS' => 'Y', 'IBLOCK_ID' => 12, 'SECTION_ID' => 43, 'ACTIVE' => 'Y'),
    false,
    array(),
    array('ID','PROPERTY_LIST_PRICE'));

    $items = [];
    while ($item = $service_detail->GetNext()) {
        if($item['PROPERTY_LIST_PRICE_VALUE'])
        {
            $items[$item['ID']] = $item['PROPERTY_LIST_PRICE_VALUE'];
        }

    }

    print_r($items);





