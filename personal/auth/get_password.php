<?
define ("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords_inner", "Восстановление пароля");
$APPLICATION->SetPageProperty("title", "Восстановление пароля");
$APPLICATION->SetPageProperty("keywords", "Восстановление пароля");
$APPLICATION->SetPageProperty("description", "Восстановление пароля");
$APPLICATION->SetTitle("GAME-ASSIST Восстановление пароля");
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:main.auth.forgotpasswd", 
	"get_password", 
	array(
		"AUTH_AUTH_URL" => "/personal/auth/index.php",
		"AUTH_REGISTER_URL" => "/personal/auth/registration.php",
		"COMPONENT_TEMPLATE" => "get_password"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>