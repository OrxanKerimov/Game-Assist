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
$url = $_SERVER["REQUEST_URI"];
$remove_http = str_replace('http://', '', $url);
$split_url = explode('?', $remove_http);
$pageURL = explode('/', $split_url[0]);
if ($pageURL[1] == 'en') {
     $lang = ['Home','Contacts','Contact the operator','Work schedule','Communication methods','Operators available','Requisites','/en/'];
     $ssilka = '/en/feedback/index.php';
} else {
     $lang = ['Главная','Контакты','Связаться с оператором','График работы','Способы связи','Операторы доступны','Реквизиты','/'];
    $ssilka = '/feedback/index.php';
}
?>


<div class="container">
    <div class="banner-template__content">
        <div class="banner-template__text">
            <div class="path">
                <ul>
                    <li><a href="<?=$lang[7]?>"><?=$lang[0]?></a></li>
                    <li><a href="#"><?=$lang[1]?></a></li>
                </ul>
            </div>
            <h1 class="banner-template__title title"> <?=$arResult['PROPERTIES']['nazvaniye']['VALUE']?></h1>
            <div class="banner-template__subtitle"><?=$arResult['PROPERTIES']['opisaniye']['VALUE']?></div>
            <a href="<?=$ssilka?>" class="banner-template__btn btn"><?=$lang[2]?></a>
        </div>

        <div class="banner-template__img">
            <img src="<?=SITE_TEMPLATE_PATH?>/img/banner-contacts.png" alt="">
        </div>
    </div>
    <div class="banner-contacts__bottom">
        <div class="banner-contacts__blocks">
            <div class="banner-contacts__block">
                <div class="banner-contacts__block-title">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/details-icon-1.svg" alt="">
                    <?=$lang[3]?>:  <span><?=$arResult['PROPERTIES']['grafik_raboti']['VALUE']?></span>
                </div>
            </div>

            <div class="banner-contacts__block">
                <div class="banner-contacts__block-title">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/details-icon-3.svg" alt="">
                    <?=$lang[4]?>:
                </div>
                <ul class="banner-contacts__block-list">
                    <?php foreach($arResult['PROPERTIES']['sposobi_svyazi']['VALUE'] as $item){?>
                    <li><?=$item?></li>
                    <?}?>
                </ul>
            </div>
        </div>
        <div class="banner-contacts__blocks">
            <div class="banner-contacts__block">
                <div class="banner-contacts__block-title">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/details-icon-5.svg" alt="">
                    <?=$lang[5]?>:
                </div>
                <ul class="banner-contacts__block-list">
                    <?php foreach($arResult['PROPERTIES']['operotori_dostupni']['VALUE'] as $item){?>
                    <li><?=$item?></li>
                    <?}?>
                </ul>
            </div>
            <?if(isset($arResult['PROPERTIES']['rekviziti']['VALUE'][0])):?>
            <div class="banner-contacts__block">
                <div class="banner-contacts__block-title">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/details-icon-2.svg" alt="">
                    <?=$lang[6]?>:
                </div>
                <ul class="banner-contacts__block-list">
                    <?php foreach($arResult['PROPERTIES']['rekviziti']['VALUE'] as $item){?>
                        <li><?=$item?></li>
                    <?}?>
                </ul>
            </div>
            <?endif;?>
        </div>



    </div>
</div>
