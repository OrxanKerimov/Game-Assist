<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("GAME-ASSIST Регистрация");
$APPLICATION->SetPageProperty("description", "Как по мне, это лучший сервис по прокачке WOT цены и наличие бонусных предложений лучше чем у кого либо");
if(CUser::IsAuthorized()) header('Location: /');

echo $engVER;

?>


    <main>
        <section class="authorization">
            <div class="container">
                <div class="authorization-content border border-b">
                    <h1 class="authorization-title">Регистрация</h1>
                    <div class="alert alert-warning" style="display: none; color: red; text-align: center;background: #191F29; border: red 1px solid; border-radius: 2rem; margin-bottom: 20px; font-size: 16px">


                        <p><font class="errortext"></font></p></div>
                    <form action="#" class="authorization-form registration-form form">
                        <input type="hidden" name="LANG" value="ru">
                        <label>
                            <span>E-mail</span>
                            <input name="EMAIL" type="email" value="">
                        </label>

                        <label>
                            <span>Пароль</span>
                            <input name="PASSWORD" type="password" value="">
                        </label>

                        <label>
                            <span>Повторите пароль</span>
                            <input name="PASSWORD_CONFIRM" type="password" value="">
                        </label>

                        <div class="payments-form__privacy">
                            <div class="payments-form__privacy-items">
                                <label class="label-checkbox">
                                    <input required name="AGREE" type="checkbox" class="visually-hidden">
                                    <span></span>
                                    <div class="checkbox-text">
                                        <div class="ckeckbox-description">Я прочитал и согласен с&nbsp;<a href="#">Пользовательским
                                                соглашением</a>
                                            и&nbsp;<a href="#">Политикой конфиденциальности</a>, а&nbsp;также даю
                                            согласие на обработку персональных
                                            данных.
                                        </div>
                                    </div>
                                </label>

                                <label class="label-checkbox">
                                    <input name="MAILING" type="checkbox" class="visually-hidden">
                                    <span></span>
                                    <div class="checkbox-text">
                                        <div class="ckeckbox-description">Да, я хотел бы получать эксклюзивные
                                            предложения и&nbsp;информацию
                                            о&nbsp;продуктах и услугах, которые могут быть мне интересны, по электронной
                                            почте. Клиенты могут в любое время
                                            отказаться от подписки частично или&nbsp;полностью.
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="authorization-btns">
                            <button class="authorization-btn registration-btn btn">Зарегистрироваться</button>
                            <a href="/personal/auth/" class="authorization-link registration-link link">уже есть аккаунт? войдите!</a>
                        </div>

                        <div class="authorization-social">
                            <div class="authorization-social__title">или войдите через соцсети</div>
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:main.auth.form",
                                "authForSocials",
                                array(
                                    "AUTH_FORGOT_PASSWORD_URL" => "/personal/auth/get_password.php",
                                    "AUTH_REGISTER_URL" => "/personal/auth/registration.php",
                                    "AUTH_SUCCESS_URL" => "/personal",
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