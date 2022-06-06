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
<pre>
    <?=print_r($arResult["IBLOCKS"][0]["ITEMS"])?>
</pre>
<div class="swiper-wrapper banner-slider-wrapper">
    <?php foreach($arResult["IBLOCKS"][0]["ITEMS"] as $item){?>
        <div class="swiper-slide banner-slider__item">
            <div class="banner-slider__number">001</div>
            <div class="banner-slider__img">
                <img src="<?=CFile::GetPath($item['PROPERTIES']['foto']['VALUE'])?>" alt="">
            </div>
            <div class="banner-slider__text">
                <div class="banner-slider__title title"><?=$item['PROPERTIES']['nazvaniye']['VALUE']?></div>
                <div class="banner-slider__group">
                    <div class="banner-slider__description">
                        <?=$item['PROPERTIES']['opisaniye_l']['VALUE']['TEXT']?>
                    </div>
                    <div class="banner-slider__description">
                        <?=$item['PROPERTIES']['opisaniye_p']['VALUE']['TEXT']?>
                    </div>
                </div>
                <a href="/uslugi/" class="banner-slider__btn btn ">Cделать заказ</a>
            </div>
        </div>
    <?}?>
</div>

