<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="banner-bottom">
    <?php
    for ( $i=0 ; $i<5 ; $i++ ) {
    ?>
    <div class="banner-bottom__item">
        <div class="banner-bottom__item-number"><?=$arResult['PROPERTIES']['cifra']['VALUE'][$i]?></div>
        <div class="banner-bottom__item-text"><?=str_replace('/n','<br>',$arResult['PROPERTIES']['preimushestvo']['VALUE'][$i])?></div>
    </div>
    <?}?>

</div>