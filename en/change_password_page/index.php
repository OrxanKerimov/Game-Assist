<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Восстановление пароля");
$APPLICATION->SetPageProperty("description", "Как по мне, это лучший сервис по прокачке WOT цены и наличие бонусных предложений лучше чем у кого либо");

?>
    <main>
    <section class="authorization page-recovery">
        <div class="container">
            <div class="authorization-content border border-b">
                <h1 class="authorization-title" data-lang="en">
                    Enter your recovery email
                </h1>
                <div class="alert alert-warning" style=" display: none; color: red; text-align: center;background: #191F29; border: red 1px solid; border-radius: 2rem; margin-bottom: 20px; font-size: 16px; padding-bottom: 10px; padding-top: 10px">
                    <p><font class="errortext"></font></p></div>
                <div class="alert alert-success" style="display: none;  color: green; text-align: center;background: #191F29; border: green 1px solid; border-radius: 2rem; margin-bottom: 20px; font-size: 16px; padding-bottom: 10px; padding-top: 10px">
                    <p><font class="successtext"></font></p></div>


<!--                --><?php //$APPLICATION->IncludeComponent(
//                    "bitrix:system.auth.forgotpasswd",
//                    "template1",
//                    array("AUTH_RESULT" => $APPLICATION->arAuthResult)
//                ); ?>
                <form class="authorization-form page-recovery-form form forgot-pass-ajax">
                    <input type="hidden" name="LANG" value="en">
                    <label>
                        <span>E-mail</span>
                        <input name="EMAIL" type="email">
                    </label>
                    <div class="authorization-btns">
                        <button type="submit" class="authorization-btn page-recovery-btn btn">Get the link</button>
                    </div>
                </form>
            </div>
        </div>
    </section> </main><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>