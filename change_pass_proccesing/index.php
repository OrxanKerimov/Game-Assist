<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
CModule::IncludeModule('iblock');
use Bitrix\Main\UserTable;
$APPLICATION->SetPageProperty("title", "Смена пароля");
$APPLICATION->SetPageProperty("description", "Как по мне, это лучший сервис по прокачке WOT цены и наличие бонусных предложений лучше чем у кого либо");


$user = UserTable::getList([
    'select' => ['ID'],
    'filter' => ['LOGIN' => $_POST['LOGIN']]
])->fetch();

$userData = CUser::GetByID(4);
$userAr = $userData->Fetch();
$uniqKey = $userAr['CHECKWORD'];
echo $uniqKey;
$url = $APPLICATION->GetCurPage();
$remove_http = str_replace('http://', '', $url);
$split_url = explode('?', $remove_http);
$pageURL = explode('/', $split_url[0]);

?>

    <section class="authorization page-recovery">
        <div class="container">
            <div class="authorization-content border border-b">
                <h1 class="authorization-title">Восстановление пароля</h1>
                <div class="alert alert-warning" style=" display: none; color: red; text-align: center;background: #191F29; border: red 1px solid; border-radius: 2rem; margin-bottom: 20px; font-size: 16px; padding-bottom: 10px; padding-top: 10px">
                    <p><font class="errortext"></font></p></div>
                <form class="authorization-form page-recovery-form form changepassword-ajax">
                    <input type="hidden" name="LANG" value="ru">
                    <label>
                        <span>Ваш логин</span>
                        <input name="LOGIN" type="text" value="<?=$_GET['USER_LOGIN']?>">
                    </label>

                    <label>
                        <span>Код восстановления</span>
                        <input name="CODE" type="text" value="<?=$_GET['USER_CHECKWORD']?>">
                    </label>

                    <label>
                        <span>Новый пароль</span>
                        <input name="PASSWORD" type="password" value="">
                    </label>

                    <label>
                        <span>Подтверждение пароля</span>
                        <input name="PASSWORD_CONFIRM" type="password" value="">
                    </label>

                    <div class="authorization-btns">
                        <button type="submit" class="authorization-btn page-recovery-btn btn">Оставить отзыв</button>
                    </div>
                </form>

            </div>
        </div>
    </section>
<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>