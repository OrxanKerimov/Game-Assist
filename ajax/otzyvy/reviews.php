<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
global $APPLICATION;
CModule::IncludeModule('iblock');

$per_page =  $_GET['per_page'] ?? 8;
$page = $_GET['page'] ?? 1;

$reviews = CIBlockElement::GetList(array("ID" => "DESC"), array('IBLOCK_ID' => 10, 'ACTIVE' => 'Y',), false, array('nPageSize' => $per_page, 'iNumPage' => $page),
    array('ID', 'PROPERTY_igra', 'PROPERTY_igra_en', 'PROPERTY_name', 'PROPERTY_zvezdi', 'PROPERTY_otziv', 'PROPERTY_foto', 'PROPERTY_tema', 'TIMESTAMP_X')); ?>

<?php
if ($reviews->NavRecordCount <= (($page - 1)*$per_page)){
    die();
}
?>


<? while ($review = $reviews->GetNext()): ?>
<div class="box swiper-slide reviews-slider__item review-modal-up" data-modal="<?= $review['ID'] ?>">
    <div class="reviews-slider__item-wrap">
        <?php

        if (empty($review['PROPERTY_FOTO_VALUE'])){
        ?>
        <div class="reviews-slider__author empty">
            <img src="<?= SITE_TEMPLATE_PATH ?>/img/reviews-author.png" alt="">

            <? }else{
            ?>
            <div class="reviews-slider__author ">
                <img src="<?= CFile::GetPath($review['PROPERTY_FOTO_VALUE']) ?>" alt="">
                <? } ?>
            </div>
            <div class="reviews-slider__text">
                <div class="reviews-slider__name"><?= $review['PROPERTY_NAME_VALUE'] ?></div>
                <div class="reviews-slider__service"><?= $review['PROPERTY_IGRA_EN_VALUE'] ?></div>
            </div>
        </div>
        <div class="reviews-slider__group">
            <div class="reviews-text__rating">
                <?
                for ($i = 1; $i <= $review['PROPERTY_ZVEZDI_VALUE']; $i++) {
                    ?>
                    <div class="reviews-text__rating-item"></div>
                <? } ?>
            </div>
            <div class="reviews-text__title"><?= $review['PROPERTY_TEMA_VALUE'] ?></div>
            <div class="reviews-text__description">
                <?= $review['~PROPERTY_OTZIV_VALUE']['TEXT'] ?>
            </div>
            <div class="reviews-text__date"><?= $review['TIMESTAMP_X'] ?></div>
        </div>
    </div>


    <? endwhile; ?>
