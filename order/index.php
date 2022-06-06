<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle('Оформление заказа');
$APPLICATION->SetPageProperty("description", "Как по мне, это лучший сервис по прокачке WOT цены и наличие бонусных предложений лучше чем у кого либо");

?>

<main>
    <section class="authorization page-feedback">
        <div class="container">
            <div class="authorization-content border border-b">
                <div class="authorization-title">Оформите быстрый заказ</div>

                <div class="alert alert-warning" style=" display: none; color: red; text-align: center;background: #191F29; border: red 1px solid; border-radius: 2rem; margin-bottom: 20px; font-size: 16px; padding-bottom: 10px; padding-top: 10px">
                    <p><font class="errortext"></font></p></div>

                <div class="alert alert-success" style=" display: none; color: green; text-align: center;background: #191F29; border: green 1px solid; border-radius: 2rem; margin-bottom: 20px; font-size: 16px; padding-bottom: 10px; padding-top: 10px">
                    <p><font class="successtext"></font></p></div>

                <input type="hidden" value="RU" class="lang-ajax">
                <form class="authorization-form page-feedback-form form quick-form-ajax">
                    <input type="hidden" name="URL" value="<?=$APPLICATION->GetCurPage()?>">
                    <input type="hidden" name="LANG" value="ru">
<!--                    --><?php //if(CUser::IsAuthorized()):?>
                    <label>
                        <span>Ваше имя</span>
                        <input required name="NAME" type="text" value="<?=$userAr['LOGIN']?>">
                    </label>

                    <label>
                        <span>E-mail</span>
                        <input required name="EMAIL" type="email" value="<?=$userAr['EMAIL']?>">
                    </label>

                    <label>
                        <span>Телефон</span>
                        <input required name="PHONE_NUMBER" type="text" value="<?=$userAr['PERSONAL_PHONE']?>">
                    </label>
<!--                    <div class="form-group">-->
<!--                        <label class="label-checkbox">-->
<!--                            <input name="OUT_QUEUE" type="checkbox" class="visually-hidden">-->
<!--                            <span></span>-->
<!--                            <div class="checkbox-text">-->
<!--                                <div class="ckeckbox-title">Выполнить заказ вне очереди</div>-->
<!--                                <div class="ckeckbox-description">+ 25% к стоимости заказа</div>-->
<!--                            </div>-->
<!--                        </label>-->
<!---->
<!--                        <label class="label-checkbox">-->
<!--                            <input name="ONLY_NIGHT" type="checkbox" class="visually-hidden">-->
<!--                            <span></span>-->
<!--                            <div class="checkbox-text">-->
<!--                                <div class="ckeckbox-title">Аккаунт свободен только ночью</div>-->
<!--                                <div class="ckeckbox-description">+ 40% к стоимости заказа</div>-->
<!--                            </div>-->
<!--                        </label>-->
<!--                    </div>-->
                    <div class="authorization-btns">
                        <button class="authorization-btn page-feedback-btn btn">Отправить</button>
                    </div>


                </form>

            </div>
        </div>
    </section>
</main>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>