<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Обратная связь");
$APPLICATION->SetPageProperty("description", "Как по мне, это лучший сервис по прокачке WOT цены и наличие бонусных предложений лучше чем у кого либо");

?>

<main>
    <section class="authorization page-feedback">
        <div class="container">
            <div class="authorization-content border border-b">
                <h1 class="authorization-title">Contact us</h1>

                <div class="alert alert-warning" style=" display: none; color: red; text-align: center;background: #191F29; border: red 1px solid; border-radius: 2rem; margin-bottom: 20px; font-size: 16px; padding-bottom: 10px; padding-top: 10px">
                    <p><font class="errortext"></font></p></div>

                <div class="alert alert-success" style=" display: none; color: green; text-align: center;background: #191F29; border: green 1px solid; border-radius: 2rem; margin-bottom: 20px; font-size: 16px; padding-bottom: 10px; padding-top: 10px">
                    <p><font class="successtext"></font></p></div>

                <form class="authorization-form page-feedback-form form feedback-ajax">
                    <input type="hidden" name="URL" value="<?=$APPLICATION->GetCurPage()?>">
                    <input type="hidden" name="LANG" value="en">

                    <label>
                        <span>Your name</span>
                        <input required name="NAME" type="text">
                    </label>

                    <label>
                        <span>E-mail</span>
                        <input required name="EMAIL" type="email">
                    </label>

                    <label>
                        <span>Phone number</span>
                        <input required name="PHONE_NUMBER" type="text">
                    </label>

                    <div class="authorization-btns">
                        <button class="authorization-btn page-feedback-btn btn">Send</button>
                    </div>


                </form>

            </div>
        </div>
    </section>
</main>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>