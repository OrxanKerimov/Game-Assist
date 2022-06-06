<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("GAME-ASSIST услуга");
$APPLICATION->SetPageProperty("description", "Как по мне, это лучший сервис по прокачке WOT цены и наличие бонусных предложений лучше чем у кого либо");

CModule::IncludeModule('iblock');

$url = $APPLICATION->GetCurPage();
$remove_http = str_replace('http://', '', $url);
$split_url = explode('?', $remove_http);
$pageURL = explode('/', $split_url[0]);
if($pageURL[1] == 'en') $LANG = 'EN';
else $LANG = 'RU';

$currentCode = array_reverse($pageURL)[0];
$basePrice = 0;

$services = CIBlockElement::GetList( //Получаем ID текущей услуги
    array('NAME' => "ASC"),
    array('INCLUDE_SUBSECTIONS' => 'Y', 'IBLOCK_ID' => 9, 'CODE' => $currentCode, 'ACTIVE' => 'Y'),
    false,
    array(),
    array('ID', 'PROPERTY_NAME', 'PROPERTY_PROCENT', 'PROPERTY_CENA', 'PROPERTY_FOTO'));
$service = $services->GetNext();
$currentID = $service['ID'];

$services = CIBlockSection::GetList( //Получаем ID раздела для правого вывода
    array('NAME' => "ASC"),
    array('INCLUDE_SUBSECTIONS' => 'Y', 'IBLOCK_ID' => 12, 'CODE' => $currentCode, 'ACTIVE' => 'Y'),
    false,
    array('ID', 'CODE'),
    false);
$service = $services->GetNext();
$sectionCode = $service['ID'];

$services = CIBlockSection::GetList( //Получаем ID подраздера для правого вывода
    array('NAME' => "ASC"),
    array('INCLUDE_SUBSECTIONS' => 'Y', 'IBLOCK_ID' => 12, 'CODE' => 'RIGHT_OUT', 'SECTION_ID' => $sectionCode, 'ACTIVE' => 'Y'),
    false,
    array('ID'),
    false);
$service = $services->GetNext();
$currentIDRightOutput = $service['ID'];


$basePrice = 0;
$services = CIBlockElement::GetList( // Получаем заголовки
    array('NAME' => "ASC"),
    array('INCLUDE_SUBSECTIONS' => 'Y', 'IBLOCK_ID' => 9, 'CODE' => $currentCode, 'ACTIVE' => 'Y'),
    false,
    array(),
    array('ID', 'PROPERTY_NAME_EN', 'PROPERTY_NAME', 'PROPERTY_PROCENT', 'PROPERTY_CENA', 'PROPERTY_FOTO'));
while ($service = $services->GetNext() ):
    $title = $service['PROPERTY_NAME_VALUE'];
    $titleEN = $service['PROPERTY_NAME_EN_VALUE'];
?>



<main>
    <section class="banner-template banner-service">
        <div class="container">
            <div class="path">
                <ul>
                    <li><a href="/en/">Home</a></li>
                    <li><a href="/en/uslugi/">Services</a></li>
                    <li><a href="#"><?=$service['PROPERTY_NAME_EN_VALUE']?></a></li>
                </ul>
            </div>
        </div>
    </section>

    <section class="services-filters">
    </section>

    <section class="details">
        <div class="container">
            <div class="details-content">
                <div class="details-block border border-b">
                    <div class="details-block__logo border">
                        <img src="<?= CFile::GetPath($service['PROPERTY_FOTO_VALUE']) ?>" alt="">
                    </div>
                    <? $service_detail = CIBlockElement::GetList(
                        array(),
                        array('INCLUDE_SUBSECTIONS' => 'Y', 'IBLOCK_ID' => 12, 'SECTION_CODE' => $currentCode, 'CODE' => 'OPLATA', 'ACTIVE' => 'Y'),
                        false,
                        array(),
                        array('ID','CODE', 'NAME', 'PROPERTY_DISCOUNT_NAME', 'PROPERTY_SERVICE_INCLUDES', 'PROPERTY_DISCOUNT_NAME_EN','PROPERTY_DISCOUNT_PRICE', 'PROPERTY_SCROLL_IN_ONE','PROPERTY_SERVICE_INCLUDES_EN', 'PROPERTY_SCROLL_NAME', 'PROPERTY_SCROLL_NAME_EN','PROPERTY_SCROLL_MAX', 'PROPERTY_LIST_NAME','PROPERTY_SCROLL_MIN','PROPERTY_LIST_NAME_EN','PROPERTY_LIST_PRICE','PROPERTY_CHECK_NAME_EN', 'PROPERTY_CHECK_NAME','PROPERTY_CHECK_PRICE','PROPERTY_TANK_LIST_EN','PROPERTY_NAME1_TANK_EN','PROPERTY_PRICE1_TANK','PROPERTY_PRICE3_TANK','PROPERTY_PRICE4_TANK','PROPERTY_PRICE5_TANK','PROPERTY_PRICE2_TANK','PROPERTY_NAME2_TANK_EN','PROPERTY_NAME3_TANK_EN','PROPERTY_NAME4_TANK_EN','PROPERTY_NAME5_TANK_EN', 'PROPERTY_MIN_MATERIAL_COUNT', 'PROPERTY_MIN_BASEPRICE_COUNT'));
                    ?>

                    <form action="#" class="details-form form detail-usluga-ajax" data-params="<?=$currentID?>">
                        <input type="hidden" class="lang-ajax" name="LANG_FORM" value="<?=$LANG?>">
                        <div class="alert alert-warning" style=" display: none; color: red; text-align: center;background: #191F29; border: red 1px solid; border-radius: 2rem; margin-bottom: 20px; font-size: 16px; padding-bottom: 10px; padding-top: 10px">
                            <p><font class="errortext"></font></p></div>
                        <div class="form-content" >
                            <?  $items = [];
                            while ($item = $service_detail->GetNext()) {
                                $items[] = $item;
                            }
                            $service_additional = $items[0];
                            if(count($service_additional['PROPERTY_CHECK_NAME_EN_VALUE']) || count($service_additional['PROPERTY_NAME1_TANK_EN_VALUE'])): ?>
                                <style>
                                    .label-checkbox
                                    {
                                        max-height: ;
                                    }
                                    .details-form__group label.label-checkbox .ckeckbox-title {
                                        font-size: 1.5rem;
                                    }
                                    .details-form__group label.label-checkbox .ckeckbox-description
                                    {
                                        font-size: 1.5rem;
                                    }
                                    .form label.label-checkbox > span {
                                        width: 2.5rem;
                                        height: 2.5rem;
                                    }
                                    .details-form__group:not(:last-child) {
                                        margin-bottom: 0.95rem;
                                    }
                                    .form label.label-checkbox > span::after {
                                        width: 2.5rem;
                                        height: 2.5rem;
                                    }
                                </style>
                            <?php endif;?>
                            <input type="hidden" name="USLUGI[CURRENT]" value="<?=$title?>">
                            <input type="hidden" name="USLUGI_EN[CURRENT]" value="<?=$titleEN?>">
                            <input type="hidden" name="USLUGA_ID" value="<?=$currentID?>">
                            <?php
                            $service_detailCNT = CIBlockElement::GetList(
                                array(),
                                array('INCLUDE_SUBSECTIONS' => 'Y', 'IBLOCK_ID' => 12, 'SECTION_CODE' => $currentCode, 'CODE' => 'OPLATA', 'ACTIVE' => 'Y'),
                                false,
                                array(),
                                array('PROPERTY_TANK_LIST'));
                            $itemzZ = [];
                            while ($itemZ = $service_detailCNT->GetNext()) {
                                $itemzZ[] = $itemZ;
                            }
                            $service_additionalCNT = $items[0];
                            $lbzCount = count($service_additionalCNT['PROPERTY_TANK_LIST_EN_VALUE']);

                            ?>
                            <? if (empty($service_additional['PROPERTY_TANK_LIST_EN_VALUE'])){?>
                                <div class="details-form__block details-form__block-type details-form__block-range">
                                    <div class="details-form__block-title"><?=$service_additional['PROPERTY_SERVICE_INCLUDES_EN_VALUE']?></div>
                                    <? if (!empty($service_additional['PROPERTY_LIST_NAME_EN_VALUE'])):
                                    if ( $service_additional['ID'] == '443' || $service_additional['ID'] == '448'):?>
                                    <div>
                                        <?else:?>
                                        <div class="details-form__block-filter">
                                            <?endif;
                                            if ($service_additional['ID'] == '448'):?>
                                                <div class="details-form__block-title"><?=$service_additional['PROPERTY_LIST_NAME_EN_VALUE'][0]?></div>
                                                <?php
                                                $basePrice = $items[0]['PROPERTY_LIST_PRICE_VALUE'][0];
                                                ?>
                                                <input class="base-id-input" type="hidden" name="USLUGI[BASENAME][ID]" value="0">
                                                <? for($i = 0; $i < count($service_additional['PROPERTY_LIST_NAME_EN_VALUE_VALUE']);$i++): ?>
                                                    <input class="base-name-input-<?=$i?>"  type="hidden" name="USLUGI_EN[BASENAME][]" value="<?=$service_additional['PROPERTY_LIST_NAME_EN_VALUE'][$i]?>">
                                                    <input class="base-name-input-<?=$i?>"  type="hidden" name="USLUGI[BASENAME][]" value="<?=$service_additional['PROPERTY_LIST_NAME_VALUE'][$i]?>">
                                                    <input type="hidden" name="type" class="quick-filter__select-id-<?=$items[$i]['ID']?>" value="<?=$items[$i]['ID']?>">
                                                    <input type="hidden" name="type" class="quick-filter__select-price-<?=$items[$i]['ID']?>" value="<?=$items[0]['PROPERTY_LIST_PRICE_VALUE'][$i]?>">
                                                <?endfor;?>
                                    <?else:?>
                                            <div class="quick-filter border">
                                                <div class="select">
                                                    <div class="select_checked quick-select_checked">
                                                        <span class="select-text"><?=$service_additional['PROPERTY_LIST_NAME_EN_VALUE'][0]?></span>
                                                        <input type="hidden" >
                                                    </div>
                                                    <?php
                                                    $basePrice = $items[0]['PROPERTY_LIST_PRICE_VALUE'][0];
                                                    ?>
                                                    <ul class="select-dropdown">
                                                        <input class="base-id-input" type="hidden" name="USLUGI[BASENAME][ID]" value="0">
                                                        <? for($i = 0; $i < count($service_additional['PROPERTY_LIST_NAME_EN_VALUE']);$i++): ?>
                                                            <li selector-id="<?=$i?>" data-id="<?=$items[$i]['ID']?>" class="select-dropdown__option quick-filter__option" data-filter="<?=$service_additional['PROPERTY_LIST_NAME_EN_VALUE'][$i]?>" >
                                                                <input class="base-name-input-<?=$i?>"  type="hidden" name="USLUGI[BASENAME][]" value="<?=$service_additional['PROPERTY_LIST_NAME_VALUE'][$i]?>">
                                                                <input class="base-name-input-<?=$i?>"  type="hidden" name="USLUGI_EN[BASENAME][]" value="<?=$service_additional['PROPERTY_LIST_NAME_EN_VALUE'][$i]?>">
                                                                <input type="hidden" name="type" class="quick-filter__select-id-<?=$items[$i]['ID']?>" value="<?=$items[$i]['ID']?>">
                                                                <input type="hidden" name="type" class="quick-filter__select-price-<?=$items[$i]['ID']?>" value="<?=$items[0]['PROPERTY_LIST_PRICE_VALUE'][$i]?>">
                                                                <?=$service_additional['PROPERTY_LIST_NAME_EN_VALUE'][$i]?>
                                                            </li>
                                                        <?endfor;?>
                                                    </ul>
                                                </div>
                                            </div>
                                    <?endif;?>
                                        </div>

                                    <?endif;?>
                                    <? if (!empty($service_additional['PROPERTY_SCROLL_NAME_EN_VALUE'])):?>

                                        <div class="details-form__block-title"><?=$service_additional['PROPERTY_SCROLL_NAME_EN_VALUE']?></div>
                                        <div class="details-form__block-inner">
                                            <div class="details-form__range">
                                                <label class="details-form__range-value">
                                                    <input class="input-scroll" type="hidden" data-type="" maxlength="2"
                                                           value="<?=number_format($service_additional['PROPERTY_SCROLL_IN_ONE_VALUE'], 0, '', ' ') ?>">
                                                    <input class="input-scroll-blank"  name="USLUGI[SCROLL][VALUE]" type="text" data-type="" maxlength="2"
                                                           value="<?=$service_additional['PROPERTY_SCROLL_IN_ONE_VALUE']?>">                                               </label>
                                            </div>
                                            <input class="multiple-scroll" name="USLUGI[TYPE]" type="hidden" value="<?=$service_additional['PROPERTY_SCROLL_IN_ONE_VALUE']?>">
                                            <input name="USLUGI_EN[SCROLL][NAME]" type="hidden" value="<?=$service_additional['PROPERTY_SCROLL_NAME_EN_VALUE']?>">
                                            <input name="USLUGI[SCROLL][NAME]" type="hidden" value="<?=$service_additional['PROPERTY_SCROLL_NAME_VALUE']?>">
                                            <input type="range" min="0" value="0" max="99" class="details-form__range-input" oninput="inputRangeChange()">
                                            <script>
                                                function inputRangeChange() {
                                                    var multiplie = $('.multiple-scroll').val()
                                                    if(!multiplie || multiplie <= 0) multiplie = 1;

                                                    let value = $('.details-form__range-input').val();
                                                    let inputText = $('.details-form__range-value input');
                                                    let final = value * Number(multiplie)
                                                    inputText.val(final.toLocaleString());
                                                    $('.details-form__range-input').css({
                                                        'background': '-webkit-linear-gradient(left, #55FA83 0%, #55FA83 ' + value + '%, #393E45 ' + value + '%, #393E45 100%)'
                                                    });
                                                }
                                            </script>
                                        </div>
                                    <?endif;?>
                                </div>
                                <? if (!empty($service_additional['PROPERTY_CHECK_NAME_EN_VALUE'])):?>

                                    <? for($i = 0; $i < count($service_additional['PROPERTY_CHECK_NAME_EN_VALUE']);$i++):?>
                                        <div class="details-form__group">
                                            <label class="label-checkbox">
                                                <input name="USLUGI[USLUGA-<?=$i?>][VALUE]" value="<?=$service_additional['PROPERTY_CHECK_PRICE_VALUE'][$i]?>" type="checkbox" data-id="<?=$i?>" class="visually-hidden usluga-params-ajax usluga-<?=$i?>">
                                                <input name="USLUGI[USLUGA-<?=$i?>][NAME]" value="<?=$service_additional['PROPERTY_CHECK_NAME_VALUE'][$i]?>" type="hidden" data-id="<?=$i?>">
                                                <input name="USLUGI_EN[USLUGA-<?=$i?>][NAME]" value="<?=$service_additional['PROPERTY_CHECK_NAME_EN_VALUE'][$i]?>" type="hidden" data-id="<?=$i?>">

                                                <span></span>
                                                <div class="checkbox-text">
                                                    <div class="ckeckbox-title filterSize checkbx-<?=$i?>"><?=$service_additional['PROPERTY_CHECK_NAME_EN_VALUE'][$i]?></div>
                                                    <?if ($service_additional['PROPERTY_CHECK_PRICE_VALUE'][$i]!= '-'):?>
                                                        <div class="ckeckbox-description filterSize"><span><?=$service_additional['PROPERTY_CHECK_PRICE_VALUE'][$i]?></span> ₽</div>
                                                    <?endif;?>
                                                </div>
                                            </label>
                                        </div>
                                    <?endfor;
                                endif;
                                if (!empty($service_additional['PROPERTY_DISCOUNT_NAME_EN_VALUE'])):?>
                                    <div >
                                        <div class="details-form__block-title">Discount:</div>
                                    </div>
                                    <? for($i = 0; $i < count($service_additional['PROPERTY_DISCOUNT_NAME_EN_VALUE']);$i++):?>
                                        <div class="details-form__group">

                                            <label class="label-checkbox">
                                                <input type="checkbox" disabled class="visually-hidden discount-check-<?=$i?>">
                                                <span></span>
                                                <div class="checkbox-text">
                                                    <input type="hidden" name="DISCOUNT_EN[DISCOUNT-<?=$i?>][NAME]" class="discount-name-<?=$i?>" value="<?=$service_additional['PROPERTY_DISCOUNT_NAME_EN_VALUE'][$i]?>">
                                                    <input type="hidden" name="DISCOUNT[DISCOUNT-<?=$i?>][NAME]" class="discount-name-<?=$i?>" value="<?=$service_additional['PROPERTY_DISCOUNT_NAME_VALUE'][$i]?>">
                                                    <input type="hidden" name="DISCOUNT[DISCOUNT-<?=$i?>][VALUE]" class="discount-val-<?=$i?>" value="">
                                                    <div class="ckeckbox-title"><?=$service_additional['PROPERTY_DISCOUNT_NAME_EN_VALUE'][$i]?></div>
                                                    <div min-material="<?=$service_additional['PROPERTY_MIN_MATERIAL_COUNT_VALUE'][$i]?>" min-base="<?=$service_additional['PROPERTY_MIN_BASEPRICE_COUNT_VALUE'][$i]?>" class="ckeckbox-description discount-<?=$i?>"><span><?=$service_additional['PROPERTY_DISCOUNT_PRICE_VALUE'][$i]?></span> ₽</div>
                                                </div>
                                            </label>
                                        </div>
                                    <? endfor;?>

                                <? endif;
                                    if ($service_additional['ID'] == '445' ):?>
                                <div class="details-form__price details-form__total">
                                    Total:
                                    <div class="details-form__price-value details-form__total-value"><span  data-base="<?=$basePrice?>" data-current="0" data-discount="<?=count($service_additional['PROPERTY_DISCOUNT_NAME_EN_VALUE'])?>"
                                     <?php if(count($service_additional['PROPERTY_CHECK_NAME_EN_VALUE']) > count($service_additional['PROPERTY_NAME1_TANK_EN_VALUE'])):?>
                                         data-count="<?=count($service_additional['PROPERTY_CHECK_NAME_EN_VALUE'])?>"
                                     <?php else:?>
                                         data-count="<?=count($service_additional['PROPERTY_NAME1_TANK_EN_VALUE'])?>"
                                     <?php endif;?>
                                     class="">No price</span></div>
                                </div>
                                    <?else:?>
                                        <div class="details-form__price details-form__total">
                                            Total:
                                            <div class="details-form__price-value details-form__total-value"><span  data-base="<?=$basePrice?>" data-current="0" data-discount="<?=count($service_additional['PROPERTY_DISCOUNT_NAME_EN_VALUE'])?>"
                                     <?php if(count($service_additional['PROPERTY_CHECK_NAME_EN_VALUE']) > count($service_additional['PROPERTY_NAME1_TANK_EN_VALUE'])):?>
                                         data-count="<?=count($service_additional['PROPERTY_CHECK_NAME_EN_VALUE'])?>"
                                     <?php else:?>
                                         data-count="<?=count($service_additional['PROPERTY_NAME1_TANK_EN_VALUE'])?>"
                                     <?php endif;?>
                                     class="do-ajax"><?=$basePrice?></span> ₽</div>
                                        </div>
                                    <?endif;?>
                                </div>
                            <?}
                            else{ ?>

                                <div class="form-content">
                                    <div class="details-form__tasks">
                                        <div class="details-form__tasks-title">We will help you complete personal combat missions (LBZ) for a tank <?=$service['PROPERTY_NAME_EN_VALUE'];?></div>
                                        <a href="#" class="details-form__tasks-btn btn tasks-modal-up">Select task</a>
                                    </div>
                                </div>
                                <div class="details-form__price details-form__total">
                                    Total:

                                    <div class="details-form__price-value details-form__total-value"><span  data-base="<?=$basePrice?>" data-current="0"
                                             <?php if(count($service_additional['PROPERTY_CHECK_NAME_EN_VALUE']) > count($service_additional['PROPERTY_NAME1_TANK_EN_VALUE'])):?>
                                                 data-count="<?=count($service_additional['PROPERTY_CHECK_NAME_EN_VALUE'])?>"
                                                 count-parent="<?=$lbzCount?>"
                                                 count-lbz="<?=count($service_additional['PROPERTY_CHECK_NAME_EN_VALUE'])?>"
                                             <?php else:?>
                                                 data-count="<?=count($service_additional['PROPERTY_NAME1_TANK_EN_VALUE'])?>"
                                                 count-parent="<?=$lbzCount?>"
                                                 count-lbz="<?=count($service_additional['PROPERTY_NAME1_TANK_EN_VALUE'])?>"
                                             <?php endif;?>
                                    class="do-ajax"><?=$basePrice?></span> ₽</div>
                                </div>

                                </div>
                            <?}?>

                        <div class="details-form__btns">
                            <input class="full-price-ajax" type="hidden" name="FULL_PRICE" value="<?=$basePrice?>">
                            <button  class="details-form__btn btn">Make order</button>
                        </div>
                            <?php if(count($service_additional['PROPERTY_CHECK_NAME_EN_VALUE']) > count($service_additional['PROPERTY_NAME1_TANK_EN_VALUE'])):?>
                                <input type="hidden" name="DEV[LBZ_COUNT]" value="<?=count($service_additional['PROPERTY_CHECK_NAME_EN_VALUE'])?>">
                            <?php else:?>
                                <input type="hidden" class="lbz-count" name="DEV[LBZ_COUNT]" value="<?=count($service_additional['PROPERTY_NAME1_TANK_EN_VALUE'])?>">
                            <?php endif;?>
                            <input class="lbz-parent-count" type="hidden" name="DEV[LBZ_PARENT_COUNT]" value="<?=$lbzCount?>">
                </div>

                </form>

                    <div class="details-text">
                        <div class="details-title title"><?=$service['PROPERTY_NAME_EN_VALUE']?></div>

                        <div class="details-links">
                            <a href="/en/otzyvy/" class="details-link link">Reviews</a>
                            <button  id="question" class="details-link link">FAQ</button>
                        </div>

                        <?php
                        $currentSection = CIBlockSection::GetList(array(), Array('IBLOCK_ID' => 12, 'ACTIVE' => 'Y', 'DEPTH_LEVEL' => 3, 'SECTION_ID' => $currentIDRightOutput), false,
                            array('ID', 'UF_ENGLISH_NAME'),
                            false);

                        while($section = $currentSection->GetNext()):?>
                            <div class="details-subtitle"><?=$section['UF_ENGLISH_NAME']?></div>
                            <?
                            $service_detail = CIBlockElement::GetList(
                                array(),
                                array('INCLUDE_SUBSECTIONS' => 'Y', 'IBLOCK_ID' => 12, 'IBLOCK_SECTION_ID' => $section['ID'],  'ACTIVE' => 'Y'),
                                false,
                                array(),
                                array('CODE','ID', 'PROPERTY_SERVICE_INCLUDES_EN', 'PROPERTY_DESCRIPTION_EN', 'PROPERTY_PRICE'));

                            $items1 = [];
                            while ($item1 = $service_detail->GetNext()) {
                                $items1[] = $item1;
                            }

                            foreach ($items1 AS $service_additional):
                                if ($service_additional['CODE'] == 'OPLATA'):
                                    continue;
                                endif;
                                ?>

                                <div class="details-text__group">
                                    <div class="details-text__group-title">
                                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/details-icon-2.svg" alt="">
                                        <?=$service_additional['PROPERTY_SERVICE_INCLUDES_EN_VALUE']?>
                                    </div>
                                    <ul class="details-text__list">
                                        <? foreach ( $service_additional['PROPERTY_DESCRIPTION_EN_VALUE'] AS $service_d):?>
                                            <li><?=$service_d['TEXT']?></li>
                                        <?endforeach;?>
                                    </ul>
                                </div>
                            <?endforeach;?>

                        <?php endwhile;?>
                    </div>
            </div>


        </div>





        </div>
    </section>

    <section class="services other-services">
        <div class="container">
            <div class="services-heading">
                <div class="services-title title">Buy with it</div>
                <a href="/en/uslugi/" class="services-link link">See all services</a>
            </div>
            <?
            $services = CIBlockElement::GetList(
                array('NAME' => "ASC"),
                array('IBLOCK_ID' => 9, 'SECTION_ID'=> 42,  'ACTIVE' => 'Y'),
                false,
                array('nTopCount'=>4),
                array('ID', 'CODE', 'PROPERTY_NAME_EN', 'PROPERTY_PROCENT', 'PROPERTY_CENA', 'PROPERTY_FOTO'));
            ?>
            <div class="services-content">
                <div class="swiper services-slider" id="services-slider">
                    <div class="swiper-wrapper services-slider-wrapper">
                        <?while ($service1 = $services->GetNext()):?>
                            <div    class="swiper-slide services-slider__item">
                                <a href="/en/uslugi/<?=$service1['CODE']?>" class="services-item border-b">
                                    <div class="services-item__img border">
                                        <img src="<?= CFile::GetPath($service1['PROPERTY_FOTO_VALUE']) ?>" alt="">
                                    </div>
                                    <div class="services-item__text">
                                        <div class="services-item__title"><?=$service1['PROPERTY_NAME_EN_VALUE']?></div>
                                        <div class="services-item__description">
                                            Winning percentage: from <span><?=$service1['PROPERTY_PROCENT_VALUE']?><sub>%</sub></span>
                                        </div>
                                        <div class="services-item__info">
                                            from <span><?=$service1['PROPERTY_CENA_VALUE']?><sup>₽</sup></span> / per fight
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?endwhile;?>

                        <div class="services-slider__kit slider-kit">
                            <div class="swiper-button-prev services-button-prev slider-button-prev"></div>
                            <div class="swiper-button-next services-button-next slider-button-next"></div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <?
    $res = CIBlockElement::GetList(
        array('NAME' => "ASC"),
        array('IBLOCK_ID' => 10, 'IBLOCK_SECTION_ID'=> 35, 'ACTIVE' => 'Y'),
        false,
        false,
        array('ID', 'PROPERTY_igra','PROPERTY_igra_en', 'PROPERTY_name', 'PROPERTY_zvezdi', 'PROPERTY_otziv', 'PROPERTY_foto', 'PROPERTY_tema'));
    ?>
    <section class="reviews">
        <div class="container">
            <div class="reviews-heading">
                <div class="reviews-title title">Reviews about our company</div>
                <div class="reviews-count">Total Reviews: <span><?=$res->DB->db_Conn->affected_rows?></span></div>
                <a href="/en/otzyvy/page-review.php" class="reviews-text__link link mobile">Leave a comment</a>
            </div>


            <div class="reviews-content">
                <div class="swiper reviews-slider" id="reviews-slider">
                    <?
                    $items = [];
                    while ($item = $res->GetNext()){
                        $items[] = $item;
                    }

                    ?>
                    <div class="swiper-wrapper reviews-slider-wrapper">
                        <?
                        $b = 1;
                        foreach ($items as $review):
                            if ($b == 1):
                                $active = "active";
                            else:
                                $active = " ";
                            endif; ?>

                            <div class="box swiper-slide reviews-slider__item <?= $active ?>"
                                 data-reviews="<?= $b++ ?>">
                                <div class="reviews-slider__group mobile">
                                    <div class="reviews-text__rating">
                                        <?
                                        for ($i = 1; $i <= $review['PROPERTY_ZVEZDI_VALUE']; $i++) {
                                            ?>
                                            <div class="reviews-text__rating-item"></div>
                                        <? } ?>
                                    </div>
                                    <div class="reviews-text__subtitle">World of Tanks</div>
                                    <div class="reviews-text__title"><?= $review['PROPERTY_TEMA_VALUE'] ?></div>
                                    <div class="reviews-text__description">
                                        <?= $review['PROPERTY_OTZIV_VALUE']['TEXT'] ?>
                                    </div>
                                    <div class="reviews-text__date"><?= $review['TIMESTAMP_X'] ?></div>
                                </div>
                                <div class="reviews-slider__item-wrap">
                                    <?php

                                    if (empty($review['PROPERTY_FOTO_VALUE'])) {
                                        ?>
                                        <div class="reviews-slider__author empty">
                                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/reviews-author.png" alt="">
                                        </div>
                                    <? } else {
                                        ?>
                                        <div class="reviews-slider__author ">
                                            <img src="<?= CFile::GetPath($review['PROPERTY_FOTO_VALUE']) ?>"
                                                 alt="">
                                        </div>
                                    <? } ?>
                                    <div class="reviews-slider__text">
                                        <div class="reviews-slider__name"><?= $review['PROPERTY_NAME_VALUE'] ?></div>
                                        <div class="reviews-slider__service"><?= $review['PROPERTY_IGRA_EN_VALUE'] ?></div>
                                    </div>
                                </div>
                            </div>
                        <? endforeach; ?>
                    </div>
                    <button id="button" class="reviews-slider__more btn">Load more</button>
                    <div class="reviews-slider__kit">
                        <div class="swiper-button-prev reviews-button-prev slider-button-prev"></div>
                        <button id="button1" class="swiper-button-next reviews-button-next slider-button-next"></button>
                    </div>
                    <div class="swiper-scrollbar reviews-scrollbar"></div>
                </div>

                <div class="reviews-text">
                    <?
                    $c = 0;
                    foreach ($items as $review):
                        $c++;
                        if ($c == 1):
                            $active = "active";
                        else:
                            $active = "";
                        endif; ?>
                        <div class="reviews-text__item <?= $active ?>" data-reviews="<?= $c ?>">
                            <div class="reviews-text__rating">
                                <?
                                for ($i = 1; $i <= $review['PROPERTY_ZVEZDI_VALUE']; $i++) {
                                    ?>
                                    <div class="reviews-text__rating-item"></div>
                                <? } ?>
                            </div>
                            <div class="reviews-text__title"><?= $review['PROPERTY_TEMA_VALUE'] ?></div>
                            <div class="reviews-text__description">
                                <?= $review['PROPERTY_OTZIV_VALUE']['TEXT']?>
                            </div>
                            <div  class="reviews-text__date"><?= $review['TIMESTAMP_X'] ?></div>
                            <a href="/otzyvy/page-review.php" class="reviews-text__link link">Leave a comment</a>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
        <div class="question1"></div>
    </section>
    <?
    $service_detail = CIBlockElement::GetList(
        array(),
        array('INCLUDE_SUBSECTIONS' => 'Y', 'IBLOCK_ID' => 12, 'SECTION_CODE' => $currentCode, 'ACTIVE' => 'Y'),
        false,
        array(),
        array('ID','CODE', 'NAME', 'PROPERTY_DISCOUNT_NAME', 'PROPERTY_TANK_LIST', 'PROPERTY_NAME1_TANK','PROPERTY_NAME2_TANK', 'PROPERTY_NAME3_TANK','PROPERTY_NAME4_TANK', 'PROPERTY_NAME5_TANK', 'PROPERTY_DISCOUNT_NAME_EN','PROPERTY_DISCOUNT_PRICE', 'PROPERTY_SCROLL_IN_ONE','PROPERTY_SERVICE_INCLUDES_EN', 'PROPERTY_SCROLL_NAME', 'PROPERTY_SCROLL_NAME_EN','PROPERTY_SCROLL_MAX','PROPERTY_SCROLL_MIN','PROPERTY_LIST_NAME_EN','PROPERTY_LIST_PRICE','PROPERTY_CHECK_NAME_EN','PROPERTY_CHECK_PRICE','PROPERTY_TANK_LIST_EN','PROPERTY_NAME1_TANK_EN','PROPERTY_PRICE1_TANK','PROPERTY_PRICE3_TANK','PROPERTY_PRICE4_TANK','PROPERTY_PRICE5_TANK','PROPERTY_PRICE2_TANK','PROPERTY_NAME2_TANK_EN','PROPERTY_NAME3_TANK_EN','PROPERTY_NAME4_TANK_EN','PROPERTY_NAME5_TANK_EN', 'PROPERTY_MIN_MATERIAL_COUNT', 'PROPERTY_MIN_BASEPRICE_COUNT'));
    $items = [];
    while ($item = $service_detail->GetNext()) {
        $items[] = $item;
    }
    $service_additional = $items[0];

    $tank_nameRU = array($service_additional['PROPERTY_NAME1_TANK_VALUE'],$service_additional['PROPERTY_NAME2_TANK_VALUE'],$service_additional['PROPERTY_NAME3_TANK_VALUE'],$service_additional['PROPERTY_NAME4_TANK_VALUE'],$service_additional['PROPERTY_NAME5_TANK_VALUE']);
    $tank_name = array($service_additional['PROPERTY_NAME1_TANK_EN_VALUE'],$service_additional['PROPERTY_NAME2_TANK_EN_VALUE'],$service_additional['PROPERTY_NAME3_TANK_EN_VALUE'],$service_additional['PROPERTY_NAME4_TANK_EN_VALUE'],$service_additional['PROPERTY_NAME5_TANK_EN_VALUE']);
    $tank_price = array($service_additional['PROPERTY_PRICE1_TANK_VALUE'],$service_additional['PROPERTY_PRICE2_TANK_VALUE'],$service_additional['PROPERTY_PRICE3_TANK_VALUE'],$service_additional['PROPERTY_PRICE4_TANK_VALUE'],$service_additional['PROPERTY_PRICE5_TANK_VALUE']);
    ?>
    <div class="popup popup-tasks" id="popup-tasks">
        <div class="popup-wrap">
            <div class="popup-content">
                <div class="popup-close">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/delete.svg" alt="">
                </div>
                <div class="details-block__logo border">
                    <img src="<?= CFile::GetPath($service['PROPERTY_FOTO_VALUE']) ?>" alt="">
                </div>
                <form action="#" class="popup-tasks__form form border border-b detail-usluga-ajax">

                    <div class="popup-tasks__title">Select the required tasks:</div>
                    <div class="popup-tasks__content">
                        <?php

                        for($i = 0; $i < count($service_additional['PROPERTY_TANK_LIST_EN_VALUE']);$i++):
                        $tankListName1 = str_replace('Задачи', '', $service_additional['PROPERTY_TANK_LIST_VALUE'][$i]);
                        $tankListName = str_replace($title, '', $tankListName1); ?>

                            <div class="popup-tasks__group">
                                <div class="popup-tasks__group-title"><?=$service_additional['PROPERTY_TANK_LIST_EN_VALUE'][$i]?></div>
                                <input class="popup-title-ajax-<?=$i?>" type="hidden" value="<?=trim($tankListName)?>">

                                <ul class="popup-tasks__group-list">
                                    <?php
                                    $currentSum = 0;
                                    for($b = 0; $b < count($tank_name[0]);$b++)
                                    {
                                        if(!strpos($tank_name[$i][$b], 'отл')) $currentSum += $tank_price[$i][$b];
                                    }
                                    ?>
                                    <?for($b = 0; $b < count($tank_name[0]);$b++):

                                        if( (preg_match( '/without great/i', $tank_name[$i][$b]) || preg_match('/Without great/i', $tank_name[$i][$b]) )):?>
                                            <li>
                                                <label class="label-checkbox">
                                                    <input type="checkbox" current-name="<?=$i?>" class="visually-hidden lbz-ungreat-<?=$i?> lbz check-ungreat-price" name="LBZ[CHECK_UNGREAT_PRICE_<?=$i?>]" value="<?=$tank_price[$i][$b]?>">
                                                    <input type="hidden"   class="visually-hidden lbz-ungreat-<?=$i?> lbz check-ungreat-name" name="LBZ[CHECK_UNGREAT_NAME_<?=$i?>]" value="<?=$tank_nameRU[$i][$b]?>">
                                                    <span></span>
                                                    <div class="checkbox-text">
                                                        <div class="ckeckbox-title usluga-parent-<?=$i?> lbz-name-<?=$b?>"><?=$tank_name[$i][$b]?></div>
                                                        <div class="ckeckbox-description"><span><?=$tank_price[$i][$b]?></span> ₽</div>
                                                    </div>
                                                </label>
                                            </li>
                                        <?elseif( (preg_match('/great/i', $tank_name[$i][$b]) || preg_match('/Great/i', $tank_name[$i][$b])) ):?>

                                            <li>
                                                <label class="label-checkbox">
                                                    <input type="checkbox" class="visually-hidden lbz-great-<?=$i?> lbz check-great-price" name="LBZ[CHECK_GREAT_PRICE_<?=$i?>]" value="<?=$tank_price[$i][$b]?>">
                                                    <input type="hidden"   class="visually-hidden lbz-great-<?=$i?> lbz check-great-name" name="LBZ[CHECK_GREAT_NAME_<?=$i?>]" value="<?=$tank_nameRU[$i][$b]?>">
                                                    <input type="hidden"   class="visually-hidden lbz-great-<?=$i?> lbz check-great-name" name="LBZ_EN[CHECK_GREAT_NAME_<?=$i?>]" value="<?=$tank_name[$i][$b]?>">
                                                    <span></span>
                                                    <div class="checkbox-text">
                                                        <div class="ckeckbox-title usluga-parent-<?=$i?> lbz-name-<?=$b?>"><?=$tank_name[$i][$b]?></div>
                                                        <div class="ckeckbox-description"><span><?=$tank_price[$i][$b]?></span> ₽</div>
                                                    </div>
                                                </label>
                                            </li>
                                        <?php else:?>
                                            <li>
                                                <label class="label-checkbox">
                                                    <input type="checkbox" class="visually-hidden lbz-<?=$i?>-<?=$b?> lbz-price lbz-price-<?=$i?>-<?=$b?> lbz check-price" first-id="<?=$i?>" name="LBZ[CHECK_PRICE_<?=$i?>_<?=$b?>]" value="<?=$tank_price[$i][$b]?>">
                                                    <input type="hidden"   class="visually-hidden lbz-<?=$i?>-<?=$b?> lbz check-name" name="LBZ[CHECK_NAME_<?=$i?>_<?=$b?>]" value="<?=$tank_nameRU[$i][$b]?>">
                                                    <input type="hidden"   class="visually-hidden lbz-<?=$i?>-<?=$b?> lbz check-name" name="LBZ_EN[CHECK_NAME_<?=$i?>_<?=$b?>]" value="<?=$tank_name[$i][$b]?>">
                                                    <span></span>
                                                    <div class="checkbox-text">
                                                        <div class="ckeckbox-title usluga-parent-<?=$i?> lbz-name-<?=$b?>"><?=$tank_name[$i][$b]?></div>
                                                        <div class="ckeckbox-description"><span><?=$tank_price[$i][$b]?></span> ₽</div>
                                                    </div>
                                                </label>
                                            </li>
                                        <?php endif;?>
                                        <?php if($b == count($tank_name[0])-1):?>
                                        <li>
                                            <label class="label-checkbox">
                                                <input type="checkbox"  current-name="<?=$i?>" first-id="<?=$i?>" second-id="<?=$b?>"  class="visually-hidden lbz-all-<?=$i?> lbz check-all-price all-tasks-js all-tasks-input-<?=$i?>" name="LBZ[CHECK_ALL_PRICE_<?=$i?>]" value="<?=$tank_price[$i][$b]?>">
                                                <input type="hidden"   class="visually-hidden lbz-all-<?=$i?> lbz check-all-name" name="LBZ[CHECK_ALL_NAME_<?=$i?>]" value="<?=$tank_nameRU[$i][$b]?>">
                                                <input type="hidden"   class="visually-hidden lbz-all-<?=$i?> lbz check-all-name" name="LBZ_EN[CHECK_ALL_NAME_<?=$i?>]" value="<?=$tank_name[$i][$b]?>">
                                                <span></span>
                                                <div class="checkbox-text all-tasks-js" first-id="<?=$i?>" second-id="<?=$b?>">
                                                    <div class="ckeckbox-title usluga-parent-<?=$i?> lbz-name-<?=$b?>">All tasks <?=trim($tankListName)?></div>
                                                    <div class="ckeckbox-description"><span>+<?=$currentSum?></span> ₽</div>
                                                </div>
                                            </label>
                                        </li>
                                    <?php endif;?>
                                    <? endfor;?>

                                <?php if($service_additional['PROPERTY_DISCOUNT_PRICE_VALUE'][$i]):?>
                                    <label class="label-checkbox">
                                        <input type="checkbox" disabled class="visually-hidden discount-check-<?=$i?>">
                                        <input type="checkbox" disabled class="visually-hidden discount-check-<?=$i?>">
                                        <span></span>
                                        <div class="checkbox-text">
                                            <input type="hidden" name="DISCOUNT_EN[DISCOUNT-<?=$i?>][NAME]" class="discount-name-<?=$i?>" value="<?=$service_additional['PROPERTY_DISCOUNT_NAME_EN_VALUE'][$i]?>">
                                            <input type="hidden" name="DISCOUNT[DISCOUNT-<?=$i?>][NAME]" class="discount-name-<?=$i?>" value="<?=$service_additional['PROPERTY_DISCOUNT_NAME_VALUE'][$i]?>">
                                            <input type="hidden" name="DISCOUNT[DISCOUNT-<?=$i?>][VALUE]" class="discount-val-<?=$i?>" value="">
                                            <div class="ckeckbox-title"><?=$service_additional['PROPERTY_DISCOUNT_NAME_EN_VALUE'][$i]?></div>
                                            <div
                                                <?php if(!$service_additional['PROPERTY_MIN_MATERIAL_COUNT_VALUE'][$i] == 0 && $service_additional['PROPERTY_MIN_MATERIAL_COUNT_VALUE'][$i] == 0):?>
                                                    min-material="0"
                                                <?php else:?>
                                                    min-material="<?=$service_additional['PROPERTY_MIN_MATERIAL_COUNT_VALUE'][$i]?>"
                                                <?php endif;?>

                                                <?php if(!$service_additional['PROPERTY_MIN_BASEPRICE_COUNT_VALUE'][$i] == 0 && $service_additional['PROPERTY_MIN_BASEPRICE_COUNT_VALUE'][$i] == 0):?>
                                                    min-base="0"
                                                <?php else:?>
                                                    min-base="<?=$service_additional['PROPERTY_MIN_BASEPRICE_COUNT_VALUE'][$i]?>"
                                                <?php endif;?>

                                                    class="ckeckbox-description discount-<?=$i?>"><span><?=$service_additional['PROPERTY_DISCOUNT_PRICE_VALUE'][$i]?></span> ₽</div>
                                        </div>
                                    </label>
                                <?php endif;?>
                                    
                                </ul>
                            </div>
                        <? endfor;?>
                    </div>




            <div class="popup-tasks__btns">
                <a href="#" class="popup-tasks__btn btn">Save changes</a>
            </div>
            </form>
        </div>
    </div>
    </div>
    <?
    $questions = CIBlockElement::GetList(
        array('NAME' => "ASC"),
        array('IBLOCK_ID' => 13, 'ACTIVE' => 'Y'),
        false,
        false,
        array('ID', 'PROPERTY_QUESTION_EN', 'PROPERTY_ANSWERS_EN'));
    ?>

    <section  class="faq ">
        <div  class="container">
            <div  class="faq-title title">FAQ</div>
            <div class="faq-content">
                <div class="faq-items">
                    <?while ($question = $questions->GetNext()):?>
                        <div class="faq-item border">
                            <div class="faq-item__heading">
                                <div class="faq-item__title"><?=$question['PROPERTY_QUESTION_EN_VALUE']?></div>
                                <div class="faq-item__img">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/faq-arrow.svg" alt="">
                                </div>
                            </div>
                            <ul class="faq-item__dropdown">
                                <?foreach ($question['PROPERTY_ANSWERS_EN_VALUE'] AS $item):?>
                                    <li><?=$item['TEXT']?></li>
                                <?endforeach;?>

                            </ul>
                        </div>
                    <?endwhile;?>
                </div>

                <div class="faq-img">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/faq-img.png" alt="">
                </div>
            </div>
        </div>
    </section>
</main>
<?endwhile;?>
<script>

    var hiddenElement = document.querySelector('.question1');
    $('#question').click(function() {
        hiddenElement.scrollIntoView();
    })

</script>
<script>


    if (( /Android|webOS|iPhone|iPod|iPad|BlackBerry/i.test(navigator.userAgent))){
        window.onload = function () {
            let box = document.getElementsByClassName('box');
            let btn = document.getElementById('button');

            for (let i=4;i<box.length;i++) {
                box[i].style.display = "none";
            }
            if (box.length<=4){
                btn.style.display = "none"
            }
            var countD = 4;
            btn.addEventListener("click", function() {
                var box=document.getElementsByClassName('box');
                countD += 4;
                if (countD < box.length){
                    for(let i=0;i<countD;i++){
                        box[i].style.display = "block";
                    }
                }else{
                    for(let i=0;i<box.length;i++){
                        box[i].style.display = "block";
                        btn.style.display= "none";
                    }
                }

            })
        }
    }

</script>
<script>
    $('.quick-filter__tank').click(function () {
        var id = $(this).attr('data-id');
        var params = $('.detail-usluga-ajax').attr('data-params');
        // alert(document.getElementById('tank_id_'+id).value);
        $.ajax({
            type: 'POST',
            url: '/ajax/detail/detail_en.php?id='+params,
            data: {"number": id},
            dataType: 'html',

            success: function (response) {
                $('.form_list_ajax').html('');
                $('.form_list_ajax').append(response)
            },
            error: function (jqXHR, textStatus, errorThrown) { // Ошибка

            }
        });
    });
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
