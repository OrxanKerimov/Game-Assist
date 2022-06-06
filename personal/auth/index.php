<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>

	<main>
		<section class="authorization">

		<?$APPLICATION->IncludeComponent(
	"bitrix:main.auth.form",
	"auth",
	array(
		"AUTH_FORGOT_PASSWORD_URL" => "/personal/auth/get_password.php",
		"AUTH_REGISTER_URL" => "/personal/auth/registration.php",
		"AUTH_SUCCESS_URL" => "/personal",
		"COMPONENT_TEMPLATE" => "auth"
	),
	false
);?>
		</section>
	</main>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>