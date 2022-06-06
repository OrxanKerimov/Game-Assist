<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
global $APPLICATION;
CModule::IncludeModule('iblock');

echo CIBlockElement::CounterInc();

$modals = CIBlockElement::GetList(array(), Array('IBLOCK_ID' => 10, 'ACTIVE' => 'Y'), false, array('nPageSize'=> $_GET['per_page']??8,'iNumPage' => $_GET['page']??1),
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
