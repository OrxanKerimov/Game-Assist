<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
CModule::IncludeModule('iblock');
$APPLICATION->SetPageProperty("title", "Отзывы");
$APPLICATION->SetPageProperty("description", "Как по мне, это лучший сервис по прокачке WOT цены и наличие бонусных предложений лучше чем у кого либо");

?>

    <main>
        <section class="banner-template banner-all-reviews">
            <div class="container">
                <div class="banner-template__content">
                    <div class="banner-template__text">
                        <div class="path">
                            <ul>
                                <li><a href="/en/">Home</a></li>
                                <li><a href="#">Review</a></li>
                            </ul>
                        </div>
                        <? $reviews = CIBlockElement::GetList(array("ID"=>"DESC"), Array('IBLOCK_ID' => 10, 'ACTIVE' => 'Y' ,), false, array('nPageSize'=> 8,'iNumPage' => 1),
                            array('ID', 'PROPERTY_igra','PROPERTY_igra_en', 'PROPERTY_name','PROPERTY_zvezdi','PROPERTY_otziv','PROPERTY_foto','PROPERTY_tema','TIMESTAMP_X')); ?>
                        <div class="banner-template__title title">Reviews</div>
                        <div class="banner-template__subtitle">Received <span><?=$reviews->NavRecordCount?></span> reviews on the site</div>
                        <div class="banner-template__group">
                            <a href="#" class="banner-all-reviews-filter btn border">All games</a>
                            <a href="/en/otzyvy/ostavit_otziv" class="banner-template__btn btn">Leave a comment</a>
                        </div>
                    </div>

                    <div class="banner-template__img">
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/banner-reviews-img.png" alt="">
                    </div>
                </div>
            </div>
        </section>

        <section class="all-reviews">
            <div class="container">
                <div class="all-reviews__content" id="allreviews">
                    <?      while($review = $reviews->GetNext()):?>
                    <div  class="box swiper-slide reviews-slider__item review-modal-up" data-modal="<?=$review['ID']?>">
                        <div  class="reviews-slider__item-wrap">
                            <?php

                            if (empty($review['PROPERTY_FOTO_VALUE'])){?>
                            <div class="reviews-slider__author empty">
                                <img src="<?=SITE_TEMPLATE_PATH?>/img/reviews-author.png" alt="">

                                <?}else{?>
                                <div class="reviews-slider__author ">
                                    <img src="<?=CFile::GetPath($review['PROPERTY_FOTO_VALUE'])?>" alt="">
                                    <?}?>
                                </div>
                                <div class="reviews-slider__text">
                                    <div class="reviews-slider__name"><?=$review['PROPERTY_NAME_VALUE']?></div>
                                    <div class="reviews-slider__service"><?=$review['PROPERTY_IGRA_EN_VALUE']?></div>
                                </div>
                            </div>
                            <div class="reviews-slider__group">
                                <div class="reviews-text__rating">
                                    <?
                                    for ($i=1;$i<=$review['PROPERTY_ZVEZDI_VALUE'];$i++){
                                        ?>
                                        <div class="reviews-text__rating-item"></div>
                                    <?}?>
                                </div>
                                <div class="reviews-text__title"><?=$review['PROPERTY_TEMA_VALUE']?></div>
                                <div class="reviews-text__description">
                                    <?=$review['~PROPERTY_OTZIV_VALUE']['TEXT']?>
                                </div>
                                <div class="reviews-text__date"><?=$review['TIMESTAMP_X']?></div>
                            </div>
                        </div>


                        <?endwhile;?>
                    </div>
                    <button id="button" class="all-reviews__more btn">Load more</button>

                    <div class="all-reviews__img">
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/all-reviews-img.png" alt="">
                    </div>
                </div></div>
        </section>
    </main>

<div id="popups">


<? $modals = CIBlockElement::GetList(array("ID"=>"DESC"), Array('IBLOCK_ID' => 10, 'ACTIVE' => 'Y'), false, array('nPageSize'=> 8,'iNumPage' => 1),
    array('ID', 'PROPERTY_igra','PROPERTY_igra_en', 'PROPERTY_name','PROPERTY_zvezdi','PROPERTY_otziv','PROPERTY_foto','PROPERTY_tema','TIMESTAMP_X')); ?>

<?      while($modal = $modals->GetNext()):?>
    <div class="popup popup-review popup-review-<?=$modal['ID']?>" id="popup-review">
        <div class="popup-wrap">
            <div class="popup-content all-reviews">
                <div class="popup-close">
                    <img class="close-response" data-close="<?=$modal['ID']?>" src="<?=SITE_TEMPLATE_PATH?>/img/delete.svg" alt="">
                </div>

                <div class="swiper-slide reviews-item border border-b">
                    <div class="popup-title">Reviews about our company</div>
                    <div class="reviews-slider__item-wrap">
                        <?php

                            if (empty($review['PROPERTY_FOTO_VALUE'])){?>
                            <div class="reviews-slider__author empty">
                                <img src="<?=SITE_TEMPLATE_PATH?>/img/reviews-author.png" alt="">

                                <?}else{?>
                                <div class="reviews-slider__author ">
                                    <img src="<?=CFile::GetPath($modal['PROPERTY_FOTO_VALUE'])?>" alt="">
                                    <?}?>

                            <img src="<?=SITE_TEMPLATE_PATH?>/img/reviews-author.png" alt="">
                        </div>
                        <div class="reviews-slider__text">
                            <div class="reviews-slider__name"><?=$modal['PROPERTY_NAME_VALUE']?></div>
                            <div class="reviews-slider__service"><?=$modal['PROPERTY_IGRA_EN_VALUE']?></div>
                        </div>
                    </div>

                    <div class="reviews-slider__group">
                        <div class="reviews-text__rating">
                            <div class="reviews-text__rating">
                                <?
                                for ( $i = 1; $i <= $modal['PROPERTY_ZVEZDI_VALUE']; $i++ ){
                                    ?>
                                    <div class="reviews-text__rating-item"></div>
                                <?}?>
                            </div>
                        </div>
                        <div class="reviews-text__title"><?=$modal['PROPERTY_TEMA_VALUE']?></div>
                        <div class="reviews-text__description">
                            <?=$modal['~PROPERTY_OTZIV_VALUE']['TEXT']?>
                        </div>
                        <div class="reviews-text__date"><?=$modal['TIMESTAMP_X']?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?endwhile;?>
    </div>

    <script>
        window.onload = function () {

            let page = 1;



            let btn=document.getElementById('button');
            let allreviews=document.getElementById('allreviews');
            let popups=document.getElementById('popups');

            btn.addEventListener("click", function() {
                page ++;

                $.ajax({
                    url: "/ajax/otzyvy/modals.php?page=" + page,
                }).done(function(html) {
                    popups.innerHTML += html
                });

                $.ajax({
                    url: "/ajax/otzyvy/reviews.php?page=" + page ,
                }).done(function(html) {
                    allreviews.innerHTML += html
                });


            })
        }
    </script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>