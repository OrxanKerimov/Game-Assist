<? 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("GAME-ASSIST услуга");
$APPLICATION->SetPageProperty("description", "Как по мне, это лучший сервис по прокачке WOT цены и наличие бонусных предложений лучше чем у кого либо");

$currentCode = array_reverse($pageURLAr)[0];
if     ($currentCode == 'lbz_1') $currentCode = 22;
elseif ($currentCode == 'lbz_2') $currentCode = 84;
else   $currentCode = 97;

CModule::IncludeModule('iblock');
?><main> <section class="banner-template banner-services">
        <div class="container">
            <div class="banner-template__content">
                <div class="banner-template__text">
                    <div class="path">
                        <ul>
                            <li><a href="/en/">Home</a></li>
                            <li><a href="#">Tanks</a></li>
                        </ul>
                    </div>
                    <h1 class="banner-template__title title">
                        Upgrade your account in World of Tanks
                    </h1>
                    <a href="/en/order/" class="banner-template__btn btn">Make order</a>
                </div>
                <div class="banner-template__img">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/banner-services.png" alt="">
                </div>
            </div>
        </div>
    </section>
        <section class="services-filters">
            <div class="container">
                <div class="services-filters__content border">
                    <div class="services-filters__title">
                        Section menu <img src="<?= SITE_TEMPLATE_PATH ?>/img/arrow-dropdown.svg" alt="">
                    </div>
                    <ul class="services-filters__list">
                        <li class="services-filters__item"> <a href="/en/uslugi/podnyatie-statistiki">Raising statistics</a> </li>
                        <li class="services-filters__item"> <a href="#" class="services-filters__sublist">
                                LBZ(1.0) <img src="<?= SITE_TEMPLATE_PATH ?>/img/arrow-dropdown.svg" alt=""> </a>
                            <div class="services-filters__dropdown">
                                <ul class="services-filters__dropdown-list border">
                                    <li><a href="/en/uslugi/lbz_1/stug-iv">StuG-IV</a></li>
                                    <li><a href="/en/uslugi/lbz_1/t28concept">T28-Concept</a></li>
                                    <li><a href="/en/uslugi/lbz_1/t55a">T-55A</a></li>
                                    <li><a href="/en/uslugi/lbz_1/obekt-260">Object260</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="services-filters__item"> <a href="#" class="services-filters__sublist">
                                ЛБЗ(2.0) <img src="<?= SITE_TEMPLATE_PATH ?>/img/arrow-dropdown.svg" alt=""> </a>
                            <div class="services-filters__dropdown">
                                <ul class="services-filters__dropdown-list border">
                                    <li><a href="/en/uslugi/lbz_2/excalibur">Excalibur</a></li>
                                    <li><a href="/en/uslugi/lbz_2/chimera">Chimera</a></li>
                                    <li><a href="/en/uslugi/lbz_2/object-279-p">Объект279(р)</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="services-filters__item"> <a href="/en/uslugi/farm-serebra">Farm silver</a> </li>
                        <li class="services-filters__item"> <a href="/en/uslugi/prokachka-tekhniki">Technical development</a> </li>
                        <li class="services-filters__item"><a href="/en/uslugi/snyatie-zvezd">Taking off the stars</a></li>
                        <li class="services-filters__item"> <a href="/en/uslugi/boi-na-top-uron">Top damage</a></li>
                    </ul>
                </div>
            </div>
        </section>

    <section class="all-services">
        <div class="container">
            <?
            $services = CIBlockElement::GetList(
                array('PROPERTY_NUMBER' => "ASC"),
                array('INCLUDE_SUBSECTIONS' => 'Y','IBLOCK_ID' => 9, 'SECTION_ID' => $currentCode,  'ACTIVE' => 'Y'),
                false,
                array(),
                array('ID', 'CODE', 'PROPERTY_NAME_EN', 'PROPERTY_PROCENT', 'PROPERTY_CENA', 'PROPERTY_FOTO'));
            ?>

            <div class="all-services__content">
                <?while ($item = $services->GetNext()){
                    if ($item['PROPERTY_NAME_EN_VALUE'] !="LBZ(1.0)" && $item['PROPERTY_NAME_EN_VALUE'] !="LBZ(2.0)"):?>

                        <?php if(strpos($APPLICATION->GetCurPage(), 'lbz_1')):?>
                            <a href="/en/uslugi/lbz_1/<?=$item['CODE']?>"  class="box_services services-item border-b">
                        <?php elseif(strpos($APPLICATION->GetCurPage(), 'lbz_2')):?>
                            <a href="/en/uslugi/lbz_2/<?=$item['CODE']?>"  class="box_services services-item border-b">
                        <?php else:?>
                            <a href="/en/uslugi/<?=$item['CODE']?>"  class="box_services services-item border-b">
                        <?php endif;?>

                        <div class="services-item__img border">
                            <img src="<?= CFile::GetPath($item['PROPERTY_FOTO_VALUE']) ?>" alt="">
                        </div>
                        <div class="services-item__text">
                            <div class="services-item__title"><?=$item['PROPERTY_NAME_EN_VALUE']?></div>
                            <div class="services-item__description">
                                Winning percentage: from <span><?=$item['PROPERTY_PROCENT_VALUE']?><sub>%</sub></span>
                            </div>
                            <div class="services-item__info">
                                from <span><?=$item['PROPERTY_CENA_VALUE']?><sup>₽</sup></span>
                            </div>
                        </div>
                    </a>
                    <?elseif ($item['PROPERTY_NAME_EN_VALUE'] =="LBZ(1.0)"):?>
                        <a  href="/en/uslugi/lbz_1" class="box_services services-item border-b">
                            <div class="services-item__img border">
                                <img src="<?= CFile::GetPath($item['PROPERTY_FOTO_VALUE']) ?>" alt="">
                            </div>
                            <div class="services-item__text">
                                <div class="services-item__title"><?=$item['PROPERTY_NAME_EN_VALUE']?></div>
                                <div class="services-item__description">
                                    Winning percentage: from <span><?=$item['PROPERTY_PROCENT_VALUE']?><sub>%</sub></span>
                                </div>
                                <div class="services-item__info">
                                    from <span><?=$item['PROPERTY_CENA_VALUE']?><sup>₽</sup></span>
                                </div>
                            </div>
                        </a>
                    <?elseif ($item['PROPERTY_NAME_EN_VALUE'] =="LBZ(2.0)"):?>
                        <a  href="/en/uslugi/lbz_2" class="box_services services-item border-b">
                            <div class="services-item__img border">
                                <img src="<?= CFile::GetPath($item['PROPERTY_FOTO_VALUE']) ?>" alt="">
                            </div>
                            <div class="services-item__text">
                                <div class="services-item__title"><?=$item['PROPERTY_NAME_EN_VALUE']?></div>
                                <div class="services-item__description">
                                    Winning percentage: from <span><?=$item['PROPERTY_PROCENT_VALUE']?><sub>%</sub></span>
                                </div>
                                <div class="services-item__info">
                                    from <span><?=$item['PROPERTY_CENA_VALUE']?><sup>₽</sup></span>
                                </div>
                            </div>
                        </a>
                <?endif;}?>


            </div>
        </div>
        <button id="button_services" class="all-services__more btn">Load more</button>
    </section>
    <section class="reviews">
        <?
        $res = CIBlockElement::GetList(
            array('NAME' => "ASC"),
            array('IBLOCK_ID' => 10, 'IBLOCK_SECTION_ID'=> 35, 'ACTIVE' => 'Y'),
            false,
            false,
            array('ID', 'PROPERTY_igra','PROPERTY_igra_en', 'PROPERTY_name', 'PROPERTY_zvezdi', 'PROPERTY_otziv', 'PROPERTY_foto', 'PROPERTY_tema'));

        ?>
        <div class="container">
            <div class="reviews-heading">
                <div class="reviews-title title">
                    Reviews about our company
                </div>
                <div class="reviews-count">
                    Total Reviews: <?=$res->DB->db_Conn->affected_rows?>
                </div>
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

                            <div class="box_review swiper-slide reviews-slider__item <?= $active ?>"
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
                    <button id="button_review" class="reviews-slider__more btn">Load more</button>

                    <div class="reviews-slider__kit">
                        <div class="swiper-button-prev reviews-button-prev slider-button-prev">
                        </div>
                        <button id="button1" class="swiper-button-next reviews-button-next slider-button-next"></button>

                    </div>
                    <div class="swiper-scrollbar reviews-scrollbar">
                    </div>
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

    <? $descriptions = CIBlockElement::GetList(
        array('NAME' => "ASC"),
        array('IBLOCK_ID' => 11, 'IBLOCK_SECTION_ID'=> 40, 'ACTIVE' => 'Y'),
        false,
        false,
        array('ID', 'PROPERTY_GAME','PROPERTY_DESCRIPTION_NAME', 'PROPERTY_DESCRIPTION', 'PROPERTY_ADVANTAGES', 'PROPERTY_PHOTO',));

    ?>
    <section class="info">
        <div class="container">
            <div class="info-title title">
                Tanks
            </div>
            <div class="info-content">
                <?while ($description = $descriptions->GetNext()):?>
                    <div class="info-item">
                        <div class="info-item__text">
                            <div class="info-item__title">
                                <?=$description['PROPERTY_DESCRIPTION_NAME_VALUE']?>
                            </div>
                            <div class="info-item__description">
                                <?for ($i = 0; $i<=count($description['PROPERTY_DESCRIPTION_VALUE'])-1;$i++){?>
                                    <p>
                                        <?=$description['PROPERTY_DESCRIPTION_VALUE'][$i]['TEXT']?>
                                    </p>
                                <?}?>
                                <ul>
                                    <?for ($i = 0; $i<=count($description['PROPERTY_ADVANTAGES_VALUE'])-1;$i++){?>
                                        <li><?=$description['PROPERTY_ADVANTAGES_VALUE'][$i]?></li>
                                    <?}?>
                                </ul>
                            </div>
                        </div>
                        <div class="info-item__img border-b">
                            <img src="<?= CFile::GetPath($description['PROPERTY_PHOTO_VALUE']) ?>" alt="">
                        </div>
                    </div>
                <?endwhile;?>
            </div>
        </div>
    </section>
    </main>
    <script>


        if (( /Android|webOS|iPhone|iPod|iPad|BlackBerry/i.test(navigator.userAgent))) {

            window.onload = function () {
                let box = document.getElementsByClassName('box_review');
                let box1 = document.getElementsByClassName('box_services');
                let btn = document.getElementById('button_review');
                let btn1 = document.getElementById('button_services');
                for (let i=8;i<box1.length;i++) {
                    box1[i].style.display = "none";
                }
                if (box1.length<=4){
                    btn1.style.display = "none"
                }
                var countD1 = 4;
                btn1.addEventListener("click", function() {
                    var box1=document.getElementsByClassName('box_services');
                    countD1 += 4;
                    if (countD1 < box1.length){
                        for(let i=0;i<countD1;i++){
                            box1[i].style.display = "block";
                        }
                    }else{
                        for(let i=0;i<box1.length;i++){
                            box1[i].style.display = "block";
                            btn1.style.display= "none";
                        }
                    }

                })
                for (let i=4;i<box.length;i++) {
                    box[i].style.display = "none";
                }
                if (box.length<=4){
                    btn.style.display = "none"
                }
                var countD = 4;
                btn.addEventListener("click", function() {
                    var box=document.getElementsByClassName('box_review');
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

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>