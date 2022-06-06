<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Регистрация");
$APPLICATION->SetPageProperty("description", "Как по мне, это лучший сервис по прокачке WOT цены и наличие бонусных предложений лучше чем у кого либо");

if(CUser::IsAuthorized()) header('Location: /en');

echo $engVER;

?>


    <main>
        <section class="authorization">
            <div class="container">
                <div class="authorization-content border border-b">
                    <h1 class="authorization-title">Registration</h1>
                    <div class="alert alert-warning" style="display: none; color: red; text-align: center;background: #191F29; border: red 1px solid; border-radius: 2rem; margin-bottom: 20px; font-size: 16px">


                        <p><font class="errortext"></font></p></div>
                    <form action="#" class="authorization-form registration-form form">
                        <input type="hidden" name="LANG" value="en">
                        <label>
                            <span>E-mail</span>
                            <input name="EMAIL" type="email" value="">
                        </label>

                        <label>
                            <span>Password</span>
                            <input name="PASSWORD" type="password" value="">
                        </label>

                        <label>
                            <span>Repeat password</span>
                            <input name="PASSWORD_CONFIRM" type="password" value="">
                        </label>

                        <div class="payments-form__privacy">
                            <div class="payments-form__privacy-items">
                                <label class="label-checkbox">
                                    <input required name="AGREE" type="checkbox" class="visually-hidden">
                                    <span></span>
                                    <div class="checkbox-text">
                                        <div class="ckeckbox-description">I have read and agree to the <a href="#">User Agreement</a> and
                                            <a href="#">Privacy Policy</a>, I also agree to the processing of personal
                                            data.
                                        </div>
                                    </div>
                                </label>

                                <label class="label-checkbox">
                                    <input name="MAILING" type="checkbox" class="visually-hidden">
                                    <span></span>
                                    <div class="checkbox-text">
                                        <div class="ckeckbox-description">Yes, I would like to receive exclusive offers and information
                                            on products and services that may be of interest
                                            to me by email. Customers may unsubscribe in whole or in part at any time.
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="authorization-btns">
                            <button class="authorization-btn registration-btn btn">Registration</button>
                            <a href="/personal/auth/" class="authorization-link registration-link link">Already have an account? Sign in!</a>
                        </div>

                        <div class="authorization-social">
                            <div class="authorization-social__title">or login via social networks</div>
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:main.auth.form",
                                "authForSocials",
                                array(
                                    "AUTH_FORGOT_PASSWORD_URL" => "/en/personal/auth/get_password.php",
                                    "AUTH_REGISTER_URL" => "/en/signup/",
                                    "AUTH_SUCCESS_URL" => "/en/personal/",
                                    "COMPONENT_TEMPLATE" => "auth"
                                ),
                                false
                            );?>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>