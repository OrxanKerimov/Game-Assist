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

<div class="quick-contact__text">
    <h1 class="quick-contact__title"><?=$arResult['PROPERTIES']['nazvaniye_b']['VALUE']?></h1>
    <div class="quick-contact__group">
        <?php for ($i = 0; $i < 4; $i++) {?>
        <div class="quick-contact__item">
            <div class="quick-contact__item-number">0<?=$i+1?></div>
            <div class="quick-contact__item-text">
                <div class="quick-contact__item-label"><?=$arResult['PROPERTIES']['svyaz']['VALUE'][$i]?></div>
                <a href="tel:79654255682" class="quick-contact__item-value"><?=$arResult['PROPERTIES']['akkaunt']['VALUE'][$i]?></a>
            </div>
        </div>
        <?}?>
    </div>
</div>