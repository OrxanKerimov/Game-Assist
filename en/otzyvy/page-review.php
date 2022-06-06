<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("GAME-ASSIST Отзывы");
$APPLICATION->SetPageProperty("description", "Как по мне, это лучший сервис по прокачке WOT цены и наличие бонусных предложений лучше чем у кого либо");
CModule::IncludeModule('iblock');



?>


<main>
    <section class="authorization page-review">
        <div class="container">
            <div class="authorization-content border border-b">
                <div class="authorization-title" data-lang="en">Leave a review</div>
                <div class="alert alert-warning" style="display: none; color: red; text-align: center; border: red 1px solid; margin-bottom: 20px; font-size: 16px; padding-bottom: 10px; padding-top: 10px; border-radius: 10px">
                    <p><font class="errortext"></font></p></div>

                <div class="alert alert-success" style="display: none; color: green; text-align: center;background: #191F29; border: green 1px solid; border-radius: 10px; margin-bottom: 20px; font-size: 16px; padding-bottom: 10px; padding-top: 10px;">
                    <p><font class="successtext"></font></p></div>

                <form class="authorization-form page-review-form form form-rate-ajax">
                    <input type="hidden" name="URL" value="<?=$APPLICATION->GetCurPage()?>">

                    <label>
                        <span>Your name</span>
                        <input name="NAME" type="text" autocomplete="off">
                    </label>

                    <label>
                        <span>Theme</span>
                        <input name="THEME" type="text" autocomplete="off">
                    </label>
                    <div class="block-rating">
                        <div class="block-rating__content">
                            <div class="block-rating__item" data-rate="18"></div>
                            <div class="block-rating__item" data-rate="19"></div>
                            <div class="block-rating__item" data-rate="20"></div>
                            <div class="block-rating__item" data-rate="21"></div>
                            <div class="block-rating__item" data-rate="22"></div>
                        </div>
                        <input type="hidden" name="RATE" id="rate_hidden_input"  value="">
                    </div>

                    <div class="quick-filter__wrap">
                        <div class="quick-filter border">
                            <div class="select">
                                <div class="select_checked quick-select_checked">
                                    <div class="select-name">Service</div>
                                    <span class="select-text">Choose service</span>
                                </div>
                                <? $services = CIBlockElement::GetList(array(), array('IBLOCK_ID' => 9, 'ACTIVE' => 'Y'), false, array(),
                                    array('PROPERTY_NAME_EN')); ?>
                                <ul class="select-dropdown">
                                    <? while ($service = $services->GetNext()): ?>
                                        <li class="select-dropdown__option quick-filter__option"
                                            data-filter="<?= $service['PROPERTY_NAME_EN_VALUE'] ?>">
                                            <?= $service['PROPERTY_NAME_EN_VALUE'] ?>
                                        </li>
                                    <? endwhile; ?>
                                </ul>

                                <input type="hidden" name="USLUGA" id="filter__select_id" class="quick-filter__select" value="">
                            </div>
                        </div>
                    </div>

                    <label class="label-textarea">
                        <textarea name="COMMENT" placeholder="Your commentary"></textarea>
                    </label>

                    <div class="authorization-btns">
                        <button id="buttonk" class="authorization-btn page-review-btn btn">Leave a review</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
