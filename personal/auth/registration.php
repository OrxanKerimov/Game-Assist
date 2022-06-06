<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords_inner", "Регистрация");
$APPLICATION->SetPageProperty("title", "Регистрация");
$APPLICATION->SetPageProperty("keywords", "Регистрация");
$APPLICATION->SetPageProperty("description", "Регистрация");
$APPLICATION->SetTitle("GAME-ASSIST Регистрация");
?>

	<main>
		<section class="authorization">
			<div class="container">
				<?$APPLICATION->IncludeComponent(
	"bitrix:main.register", 
	"Registration", 
	array(
		"AUTH" => "Y",
		"REQUIRED_FIELDS" => array(
		),
		"SET_TITLE" => "Y",
		"SHOW_FIELDS" => array(
			0 => "EMAIL",
		),
		"SUCCESS_PAGE" => "/personal/",
		"USER_PROPERTY" => array(
		),
		"USER_PROPERTY_NAME" => "",
		"USE_BACKURL" => "Y",
		"COMPONENT_TEMPLATE" => "Registration"
	),
	false
);?>

			</div>
		</section>
	</main>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>