<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>

	<main>
		<section class="authorization">

		<?$APPLICATION->IncludeComponent(
	"bitrix:main.auth.form", 
	"auth", 
	array(
		"AUTH_FORGOT_PASSWORD_URL" => "/en/change_password_page",
		"AUTH_REGISTER_URL" => "/en/signup",
		"AUTH_SUCCESS_URL" => "/en/personal",
		"COMPONENT_TEMPLATE" => "auth"
	),
	false
);?>
		</section>
	</main>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>