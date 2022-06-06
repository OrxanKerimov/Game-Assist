<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$url = $_SERVER["REQUEST_URI"];
$APPLICATION->SetPageProperty("title", "World of Tanks - прокачать аккаунт в Ворлд оф Танк");
$APPLICATION->SetPageProperty("description", "Как по мне, это лучший сервис по прокачке WOT цены и наличие бонусных предложений лучше чем у кого либо");
$remove_http = str_replace('http://', '', $url);
$split_url = explode('?', $remove_http);
$pageURL = explode('/', $split_url[0]);
CModule::IncludeModule('iblock');
if ($pageURL[1] == 'en') {
    $preim = "364";
    $slad = 37;
    $sdelat_z = "Make an order";
    $cont = 369;
} else {
    $preim = "320";
    $slad = 38;
    $sdelat_z = "Cделать заказ";
    $cont = 322;
}
?>

    <main>

        <section class="banner">
            <div class="container">
                <div class="banner-content">
                    <?
                    $slider = CIBlockElement::GetList(
                        array('NAME' => "ASC"),
                        array('IBLOCK_ID' => 4, 'IBLOCK_SECTION_ID'=> $slad, 'ACTIVE' => 'Y'),
                        false,
                        false,
                        array('ID', 'PROPERTY_nazvaniye', 'PROPERTY_opisaniye_l', 'PROPERTY_opisaniye_p', 'PROPERTY_foto',));

                    ?>
                    <div class="swiper banner-slider" id="banner-slider">
                        <div class="swiper-wrapper banner-slider-wrapper">

                        <?
                        $i = 1;
                        while ($item = $slider->GetNext()){?>
                            <div class="swiper-slide banner-slider__item">
                                <div class="banner-slider__number">00<?$i++?>></div>
                                <div class="banner-slider__img">
                                    <img src="<?= CFile::GetPath($item['PROPERTY_FOTO_VALUE']) ?>" alt="">
                                </div>
                                <div class="banner-slider__text">
                                    <div class="banner-slider__title title"><?=$item['PROPERTY_NAZVANIYE_VALUE']?></div>
                                    <div class="banner-slider__group">
                                        <div class="banner-slider__description">
                                            <?=$item['PROPERTY_OPISANIYE_P_VALUE']['TEXT']?>
                                        </div>
                                        <div class="banner-slider__description">
                                            <?=$item['PROPERTY_OPISANIYE_L_VALUE']['TEXT']?>
                                        </div>
                                    </div>
                                    <a href="/en/uslugi/" class="banner-slider__btn btn"><?=$sdelat_z?></a>
                                </div>
                            </div>
                        <?}?>
                        </div>
                        <div class="banner-slider__kit slider-kit">
                            <div class="swiper-button-prev banner-button-prev slider-button-prev"></div>
                            <div class="swiper-button-next banner-button-next slider-button-next"></div>
                        </div>
                        <div class="swiper-pagination banner-pagination slider-pagination"></div>

                    </div>

                    <? if ($pageURL[1] == 'en'){
                        $preim = "364";
                    }else{$preim = "320";}

                    $APPLICATION->IncludeComponent(
                        "bitrix:news.detail",
                        "preimushestvo",
                        array(
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "ADD_ELEMENT_CHAIN" => "N",
                            "ADD_SECTIONS_CHAIN" => "Y",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "BROWSER_TITLE" => "-",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "CHECK_DATES" => "Y",
                            "DETAIL_URL" => "",
                            "DISPLAY_BOTTOM_PAGER" => "Y",
                            "DISPLAY_DATE" => "N",
                            "DISPLAY_NAME" => "N",
                            "DISPLAY_PICTURE" => "N",
                            "DISPLAY_PREVIEW_TEXT" => "N",
                            "DISPLAY_TOP_PAGER" => "N",
                            "ELEMENT_CODE" => "",
                            "ELEMENT_ID" => $preim,
                            "FIELD_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "IBLOCK_ID" => "5",
                            "IBLOCK_TYPE" => "Glavnaya",
                            "IBLOCK_URL" => "",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                            "MESSAGE_404" => "",
                            "META_DESCRIPTION" => "-",
                            "META_KEYWORDS" => "-",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "Страница",
                            "PROPERTY_CODE" => array(
                                0 => "cifra",
                                1 => "preimushestvo",
                                2 => "",
                            ),
                            "SET_BROWSER_TITLE" => "Y",
                            "SET_CANONICAL_URL" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_STATUS_404" => "Y",
                            "SET_TITLE" => "N",
                            "SHOW_404" => "N",
                            "STRICT_SECTION_CHECK" => "N",
                            "USE_PERMISSIONS" => "N",
                            "USE_SHARE" => "N",
                            "COMPONENT_TEMPLATE" => "preimushestvo"
                        ),
                        false
                    ); ?>

                </div>
            </div>
        </section>
        <section class="services">
            <?

            $services = CIBlockElement::GetList(
                array('NAME' => "DESC"),
                array('INCLUDE_SUBSECTIONS' => 'Y','IBLOCK_ID' => 9, 'SECTION_ID'=> 42,  'ACTIVE' => 'Y'),
                false,
                array('nTopCount'=>4),
                array('ID', 'CODE', 'PROPERTY_NAME_EN', 'PROPERTY_PROCENT', 'PROPERTY_CENA', 'PROPERTY_FOTO'));
            ?>

            <div class="container">
                <div class="services-heading">
                    <div class="services-title title">Our services</div>
                    <a href="/en/uslugi/" class="services-link link">See all services </a>
                </div>
                <div class="services-content">
                        <?while ($item = $services->GetNext()){?>
                    <a href="/en/uslugi/<?=$item['CODE']?>" class="services-item border-b">
                        <div class="services-item__img border">
                            <img src="<?= CFile::GetPath($item['PROPERTY_FOTO_VALUE']) ?>" alt="">
                        </div>
                        <div class="services-item__text">
                            <div class="services-item__title"><?=$item['PROPERTY_NAME_EN_VALUE']?></div>
                            <div class="services-item__description">
                                Winning percentage: from <span><?=$item['PROPERTY_PROCENT_VALUE']?><sub>%</sub></span>
                            </div>
                            <div class="services-item__info">
                                from <span><?=$item['PROPERTY_CENA_VALUE']?><sup>₽</sup></span> / per fight
                            </div>
                        </div>
                    </a>
                        <?}?>
                </div>
            </div>
        </section>

        <section class="advantages">
            <? $APPLICATION->IncludeComponent(
                "bitrix:news.detail",
                "doveryat",
                array(
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "ADD_ELEMENT_CHAIN" => "N",
                    "ADD_SECTIONS_CHAIN" => "Y",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "BROWSER_TITLE" => "-",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "DISPLAY_DATE" => "N",
                    "DISPLAY_NAME" => "N",
                    "DISPLAY_PICTURE" => "N",
                    "DISPLAY_PREVIEW_TEXT" => "N",
                    "DISPLAY_TOP_PAGER" => "N",
                    "ELEMENT_CODE" => "",
                    "ELEMENT_ID" => "368",
                    "FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "IBLOCK_ID" => "6",
                    "IBLOCK_TYPE" => "Glavnaya",
                    "IBLOCK_URL" => "",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                    "MESSAGE_404" => "",
                    "META_DESCRIPTION" => "-",
                    "META_KEYWORDS" => "-",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "PAGER_TITLE" => "Страница",
                    "PROPERTY_CODE" => array(
                        0 => "nazvaniye_b",
                        1 => "opisaniye_b",
                        2 => "nazvaniye_k",
                        3 => "opisaniye_k",
                    ),
                    "SET_BROWSER_TITLE" => "Y",
                    "SET_CANONICAL_URL" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_STATUS_404" => "Y",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "N",
                    "STRICT_SECTION_CHECK" => "N",
                    "USE_PERMISSIONS" => "N",
                    "USE_SHARE" => "N",
                    "COMPONENT_TEMPLATE" => "doveryat"
                ),
                false
            ); ?>

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
                                <div class="reviews-text__date"><?= $review['TIMESTAMP_X'] ?></div>
                                <a href="/en/otzyvy/page-review.php" class="reviews-text__link link">Leave a comment</a>
                            </div>
                        <? endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="quick">
            <div class="container">
                <div class="quick-title title">Make a quick order</div>

                <div class="quick-content">



                    <form class="quick-form form quick-form-ajax">
                        <div class="alert alert-warning" style="color: red; text-align: center;background: #191F29; border: red 1px solid; border-radius: 2rem; margin-bottom: 20px; font-size: 16px; padding-bottom: 10px; padding-top: 10px">
                            <p><font class="errortext">This form is not working now</font></p></div>

                        <div class="alert alert-warning" style=" display: none; color: red; text-align: center;background: #191F29; border: red 1px solid; border-radius: 2rem; margin-bottom: 20px; font-size: 16px; padding-bottom: 10px; padding-top: 10px">
                            <p><font class="errortext"></font></p></div>

                        <div class="alert alert-success" style="display: none ;color: green; max-width: 45.5em;  text-align: center;background: #191F29; border: green 1px solid; border-radius: 2rem; margin-bottom: 20px; font-size: 16px; padding-bottom: 10px; padding-top: 10px">
                            <p><font class="successtext"></font></p></div>

                        <input type="hidden" name="LANG" value="en">
                        <div class="form-content">
                            <label>
                                <span>Your name</span>
                                <input required name="NAME" type="text" disabled>
                            </label>

                            <label>
                                <span>E-mail</span>
                                <input required name="EMAIL" type="email" disabled>
                            </label>

                            <label>
                                <span>Telephone</span>
                                <input required name="PHONE_NUMBER" type="text" disabled>
                            </label>
<!--                            <label>-->
<!--                               <span>Услуга</span>-->
<!--                               <input type="text" value="Поднятие рейтинга WN8 2500+">-->
<!--                           </label>-->
                            <div class="quick-filter__wrap">
                                <div class="quick-filter border">
                                    <input type="hidden" name="type" class="quick-filter__select" value="Поднятие рейтинга WN8 2500+">
                                    <div class="select">
                                        <div class="select_checked quick-select_checked">
                                            <div class="select-name">Service</div>
                                                <span class="select-text">Upgrading WN8 2500+</span>
                                        </div>
<!--                                        <ul class="select-dropdown">-->
<!--                                            <li class="select-dropdown__option quick-filter__option" data-filter="Поднятие рейтинга WN8 2500+">-->
<!--                                                Поднятие рейтинга WN8 2500+-->
<!--                                            </li>-->
<!--                                            <li class="select-dropdown__option quick-filter__option" data-filter="Поднятие рейтинга WN8 2000+">-->
<!--                                                Поднятие рейтинга WN8 2000+-->
<!--                                            </li>-->
<!--                                            <li class="select-dropdown__option quick-filter__option" data-filter="Поднятие рейтинга WN8 1000+">-->
<!--                                                Поднятие рейтинга WN8 1000+-->
<!--                                            </li>-->
<!--                                        </ul>-->
                                    </div>
                                </div>
                            </div>
<!--                            <div class="form-group">-->
<!--                                <label class="label-checkbox">-->
<!--                                    <input name="OUT_QUEUE" type="checkbox" class="visually-hidden">-->
<!--                                    <span></span>-->
<!--                                    <div class="checkbox-text">-->
<!--                                        <div class="ckeckbox-title">Fulfill an order out of turn</div>-->
<!--                                        <div class="ckeckbox-description">+ 25% to the cost of the order</div>-->
<!--                                    </div>-->
<!--                                </label>-->
<!---->
<!--                                <label class="label-checkbox">-->
<!--                                    <input name="ONLY_NIGHT" type="checkbox" class="visually-hidden">-->
<!--                                    <span></span>-->
<!--                                    <div class="checkbox-text">-->
<!--                                        <div class="ckeckbox-title">Account free only at night</div>-->
<!--                                        <div class="ckeckbox-description">+ 40% to the cost of the order</div>-->
<!--                                    </div>-->
<!--                                </label>-->
<!--                            </div>-->

                            <button class="quick-form__btn btn">Make an order</button>
                        </div>
                    </form>
                    <?
                    $contacts = CIBlockElement::GetList(
                        array('NAME' => "ASC"),
                        array('IBLOCK_ID' => 8,'ID' => $cont, 'ACTIVE' => 'Y'),
                        false,
                        false,
                        array('ID',  'PROPERTY_nazvaniye_b',
                            'PROPERTY_SVYAZ','PROPERTY_akkaunt'));
                    ?>

                    <div class="quick-contact border-b">
                        <div class="quick-contact__img border">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/phone.png" alt="">
                        </div>

                        <?while ($contact = $contacts->GetNext()):
                            ?>
                        <div class="quick-contact__text">
                            <div class="quick-contact__title"><?=$contact['PROPERTY_NAZVANIYE_B_VALUE'] ?></div>
                            <div class="quick-contact__group">
                                <? for($i=0;$i<=count($contact['PROPERTY_SVYAZ_VALUE'])-1;$i++):?>
                                <div class="quick-contact__item">
                                    <div class="quick-contact__item-number">0<?=$i+1?></div>
                                    <div class="quick-contact__item-text">
                                        <div class="quick-contact__item-label"><?=$contact['PROPERTY_SVYAZ_VALUE'][$i]?></div>
                                        <a href="tel:79654255682" class="quick-contact__item-value"><?=$contact['PROPERTY_AKKAUNT_VALUE'][$i]?></a>
                                    </div>
                                </div>
                                <?endfor;?>
                            </div>
                        </div>
                        <?endwhile;?>
                        </div>

                    <a href="/en/kontakty/" class="quick-link link">Our details</a>

                </div>
            </div>
        </section>
    </main>

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
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>


