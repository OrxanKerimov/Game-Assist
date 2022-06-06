<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)
{
	die();
}


require_once 'header2.php';


use Bitrix\Main\Page\Asset;
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
\Bitrix\Main\Page\Asset::getInstance()->addCss(
    '/local/templates/game_assist/css/normalize.css'
);
\Bitrix\Main\Page\Asset::getInstance()->addCss(
    '/local/templates/game_assist/css/swiper-bundle.min.css'
);
\Bitrix\Main\Page\Asset::getInstance()->addCss(
    '/local/templates/game_assist/css/jquery.fancybox.min.css'
);
\Bitrix\Main\Page\Asset::getInstance()->addCss(
    '/local/templates/game_assist/css/style.css'
);


if ($arResult['AUTHORIZED'])
{
	echo Loc::getMessage('MAIN_AUTH_CHD_SUCCESS');
	return;
}

$fields = $arResult['FIELDS'];
?>


	<?if ($arResult['ERRORS']):?>
	<div class="alert alert-danger">
		<? foreach ($arResult['ERRORS'] as $error)
		{
			echo $error;
		}
		?>
	</div>
	<?elseif ($arResult['SUCCESS']):?>
	<div class="alert alert-success">
		<?= $arResult['SUCCESS'];?>
	</div>
	<?endif;?>
<style>

</style>
    	<form name="bform authorization-form page-recovery-form form" method="post" target="_top" action="<?= POST_FORM_ACTION_URI;?>"  >

                <label>
                    <span><?= Loc::getMessage('MAIN_AUTH_CHD_FIELD_LOGIN');?></span>
                    <input type="text" name="<?= $fields['login'];?>" maxlength="255" value="<?= \htmlspecialcharsbx($arResult['LAST_LOGIN']);?>" />
                </label>


            <label>
                <span><?= Loc::getMessage('MAIN_AUTH_CHD_FIELD_CHECKWORD');?></span>
                <input type="text" name="<?= $fields['checkword'];?>" maxlength="255" value="<?= \htmlspecialcharsbx($arResult[$fields['checkword']]);?>" />
            </label>

			<div class="bx-authform-input-container">
				<?if ($arResult['SECURE_AUTH']):?>
					<div class="bx-authform-psw-protected" id="bx_auth_secure" style="display:none">
						<div class="bx-authform-psw-protected-desc"><span></span>
							<?= Loc::getMessage('MAIN_AUTH_CHD_SECURE_NOTE');?>
						</div>
					</div>
					<script type="text/javascript">
						document.getElementById('bx_auth_secure').style.display = '';
					</script>
				<?endif;?>
                <label>
                    <span><?= Loc::getMessage('MAIN_AUTH_CHD_FIELD_PASS');?></span>
                    <input type="password" name="<?= $fields['password'];?>" value="<?= \htmlspecialcharsbx($arResult[$fields['password']]);?>" maxlength="255" autocomplete="off" />
                </label>
			</div>

			<div class="bx-authform-input-container">
				<?if ($arResult['SECURE_AUTH']):?>
					<div class="bx-authform-psw-protected" id="bx_auth_secure2" style="display:none">
						<div class="bx-authform-psw-protected-desc"><span></span>
							<?= Loc::getMessage('MAIN_AUTH_CHD_SECURE_NOTE');?>
						</div>
					</div>
					<script type="text/javascript">
						document.getElementById('bx_auth_secure2').style.display = '';
					</script>
				<?endif;?>
                <label>
                    <span><?= Loc::getMessage('MAIN_AUTH_CHD_FIELD_PASS2');?></span>
                    <input type="password" name="<?= $fields['confirm_password'];?>" value="<?= \htmlspecialcharsbx($arResult[$fields['confirm_password']]);?>" maxlength="255" autocomplete="off" />

                </label>
			</div>

		<?if ($arResult['CAPTCHA_CODE']):?>
			<input type="hidden" name="captcha_sid" value="<?= \htmlspecialcharsbx($arResult['CAPTCHA_CODE']);?>" />
			<div class="bx-authform-formgroup-container dbg_captha">
				<div class="bx-authform-label-container">
					<?= Loc::getMessage('MAIN_AUTH_CHD_FIELD_CAPTCHA');?>
				</div>
				<div class="bx-captcha"><img src="/bitrix/tools/captcha.php?captcha_sid=<?= \htmlspecialcharsbx($arResult['CAPTCHA_CODE']);?>" width="180" height="40" alt="CAPTCHA" /></div>
				<div class="bx-authform-input-container">
					<input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off" />
				</div>
			</div>
		<?endif;?>

		<div class="bx-authform-formgroup-container">
			<input type="submit" class="btn btn-primary" name="<?= $fields['action'];?>" value="<?= Loc::getMessage('MAIN_AUTH_CHD_FIELD_SUBMIT');?>" />
		</div>



		<?if ($arResult['AUTH_AUTH_URL'] || $arResult['AUTH_REGISTER_URL']):?>
			<hr class="bxe-light">
			<noindex>
			<?if ($arResult['AUTH_AUTH_URL']):?>
				<div class="bx-authform-link-container">
					<a href="<?= $arResult['AUTH_AUTH_URL'];?>" rel="nofollow">
						<?= Loc::getMessage('MAIN_AUTH_CHD_URL_AUTH_URL');?>
					</a>
				</div>
			<?endif;?>
			<?if ($arResult['AUTH_REGISTER_URL']):?>
				<div class="bx-authform-link-container">
					<a href="<?= $arResult['AUTH_REGISTER_URL'];?>" rel="nofollow">
						<?= Loc::getMessage('MAIN_AUTH_CHD_URL_REGISTER_URL');?>
					</a>
				</div>
			<?endif;?>
			</noindex>
		<?endif;?>

	</form>
<script type="text/javascript">
	document.bform.<?= $fields['login'];?>.focus();
</script>
