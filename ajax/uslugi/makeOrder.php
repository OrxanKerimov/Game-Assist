<?php
require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('iblock');

$lbzParent = $_POST['DEV']['LBZ_PARENT_COUNT'];
$lbzChild = $_POST['DEV']['LBZ_COUNT'];
$LBZ = $_POST['LBZ'];
$LBZen = $_POST['LBZ_EN'];
$fullPrice = $_REQUEST['FULL_PRICE'];
$baseName = false;
$scroll = false;
$uslugi = false;

for ( $i = 0; $i < $lbzParent; $i++)
{
    if($LBZ['CHECK_ALL_PRICE_'.$i])
    {
        // items[n] = $('.lbz-all-'+i+'.active').val();
        $lbzAr[$LBZ['CHECK_ALL_NAME_'.$i]] = $LBZ['CHECK_ALL_PRICE_'.$i];
        $lbzArEn[$LBZen['CHECK_ALL_NAME_'.$i]] = $LBZ['CHECK_ALL_PRICE_'.$i];
        continue;
    }
    elseif($LBZ['CHECK_UNGREAT_PRICE_'.$i])
    {
        $lbzAr[$LBZ['CHECK_UNGREAT_NAME_'.$i]] = $LBZ['CHECK_UNGREAT_PRICE_'.$i];
        $lbzArEn[$LBZen['CHECK_UNGREAT_NAME_'.$i]] = $LBZ['CHECK_UNGREAT_PRICE_'.$i];
        continue;
    }
    else
    {
        for ( $j = 0; $j < $lbzChild; $j++ )
        {
            if($LBZ['CHECK_PRICE_'.$i.'_'.$j])   //Поиск активных чекбоксов
            {
                // items[n] = $('.lbz-'+i+'-'+j+'.active').val();
                $lbzAr[$LBZ['CHECK_NAME_'.$i.'_'.$j]] = $LBZ['CHECK_PRICE_'.$i.'_'.$j];
            }
        }
        for ( $j = 0; $j < $lbzChild; $j++ )
        {
            if($LBZ['CHECK_PRICE_'.$i.'_'.$j])   //Поиск активных чекбоксов
            {
                $lbzArEn[$LBZen['CHECK_NAME_'.$i.'_'.$j]] = $LBZ['CHECK_PRICE_'.$i.'_'.$j];
            }
        }
    }

}

foreach ($_POST['USLUGI'] as $key => $val)
{

    if(preg_match('/все задачи/i', $_REQUEST['USLUGI'][$key]['NAME']) || preg_match('/Все задачи/i', $_REQUEST['USLUGI'][$key]['NAME']) || preg_match('/all tasks/i', $_REQUEST['USLUGI'][$key]['NAME']) || preg_match('/All tasks/i', $_REQUEST['USLUGI'][$key]['NAME']))
    {
        $result['ALL'] = $_REQUEST['USLUGI'][$key]['VALUE'];
    }
    if($_REQUEST['USLUGI'][$key]['VALUE'] != '')
    {
        $result[] = 1;
    }
    if($key == 'BASENAME' && $val) $baseName = true;
    if($key == 'SCROLL' && $val)   $scroll   = true;
    if(preg_match('/USLUGA-/', $key) && $val['VALUE']) $uslugi = true;

}

if( ( (!$LBZen && !$LBZen) && $uslugi == true || $baseName == true ) || (count($lbzArEn) > 0 || count($lbzAr) > 0) && $fullPrice > 0 )
{
    $all = [];
    $all['USLUGI'] = $_REQUEST['USLUGI'];
    $all['USLUGI']['CURRENT'] = $_REQUEST['USLUGI']['CURRENT'];
    $all['USLUGI']['BASENAME'] = $_REQUEST['USLUGI']['BASENAME'][$_REQUEST['USLUGI']['BASENAME']['ID']];
    $all['USLUGI']['FULL_PRICE'] = $fullPrice;
    $all['USLUGI']['SCROLL'] = $_REQUEST['USLUGI']['SCROLL'];
    $all['USLUGI']['ALL'] = $result['ALL'];
    $all['LANG_FORM'] = $_REQUEST['LANG_FORM'];
    $all['USLUGA_ID'] = $_REQUEST['USLUGA_ID'];
    $all['LBZ'] = $lbzAr;

    if($_REQUEST['LANG_FORM'] == 'EN')
    {
        $all['USLUGI_EN'] = $_REQUEST['USLUGI_EN'];
        $all['USLUGI_EN']['CURRENT'] = $_REQUEST['USLUGI_EN']['CURRENT'];
        $all['USLUGI_EN']['BASENAME'] = $_REQUEST['USLUGI_EN']['BASENAME'][$_REQUEST['USLUGI']['BASENAME']['ID']];
        $all['USLUGI']['ALL'] = $result['ALL'];
        $all['LBZ_EN'] = $lbzArEn;
        foreach ($_POST['DISCOUNT_EN'] as $key => $val)
        {
            $all['DISCOUNT_EN'][] = ['NAME' => $val['NAME'], 'VALUE' => $_POST['DISCOUNT'][$key]['VALUE']];
        }
    }

    foreach ($_POST['DISCOUNT'] as $val)
    {
        $all['DISCOUNT'][] = ['NAME' => $val['NAME'], 'VALUE' => $val['VALUE']];
    }
    $res = http_build_query($all);

    if ($all['LANG_FORM'] == 'RU') echo "/order/?".$res;
    else echo "/en/order/?".$res;
}
else
{
    echo 'error';
}
