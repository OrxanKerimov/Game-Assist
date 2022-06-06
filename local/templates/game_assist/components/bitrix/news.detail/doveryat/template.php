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
<div class="container">
    <div class="advantages-heading">
        <h1 class="advantages-title title">
            <?=$arResult['PROPERTIES']['nazvaniye_b']['VALUE']?>
        </h1>
        <div class="advantages-subtitle">
            <?=$arResult['PROPERTIES']['opisaniye_b']['VALUE']?>
        </div>
    </div>
    <div class="advantages-content">
        <?php for ($i = 0; $i < 6; $i++) {?>
        <div class="advantages-item">
            <div class="advantages-item__img">
                <img src="<?=SITE_TEMPLATE_PATH?>/img/advantages-<?=$i+1?>.png" alt="">
            </div>
            <div class="advantages-item__text">
                <div class="advantages-item__title">
                    <?=$arResult['PROPERTIES']['nazvaniye_k']['VALUE'][$i]?>
                </div>
                <div class="advantages-item__description">
                    <?=$arResult['PROPERTIES']['opisaniye_k']['VALUE'][$i]['TEXT']?>
                </div>
            </div>
        </div>
        <?}?>
    </div>
</div>