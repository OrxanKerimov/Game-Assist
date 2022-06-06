<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)
{
	die();
}

use \Bitrix\Main\Localization\Loc;
//\Bitrix\Main\Localization\Loc::setCurrentLang("en");
Loc::loadMessages(__FILE__);

\Bitrix\Main\Page\Asset::getInstance()->addCss(
	'/bitrix/css/main/system.auth/flat/style.css'
);

if ($arResult['AUTHORIZED'])
{
	echo Loc::getMessage('MAIN_AUTH_FORM_SUCCESS');
	return;
}
?>





        <?if ($arResult['ERRORS']):?>
            <div class="alert alert-warning" style="color: red; text-align: center;background: #191F29; border: red 1px solid; border-radius: 2rem; " >
                <b><? foreach ($arResult['ERRORS'] as $error)
                {
                    echo $error;
                }
                ?></b>
            </div>
        <?endif;?>

<!--                        <a href="#" class="authorization-social__item">-->
<!--                            <img src="img/facebook.svg" alt="">-->
<!--                        </a>-->
                        <?if ($arResult['AUTH_SERVICES']):?>
                            <?$APPLICATION->IncludeComponent('bitrix:socserv.auth.form',
                                'signup',
                                array(
                                    'AUTH_SERVICES' => $arResult['AUTH_SERVICES'],
                                    'AUTH_URL' => $arResult['CURR_URI']
                                ),
                                $component,
                                array('HIDE_ICONS' => 'Y')
                            );
                            ?>
                        <?endif?>
            </form>

<script type="text/javascript">
	<?if ($arResult['LAST_LOGIN'] != ''):?>
	try{document.<?= $arResult['FORM_ID'];?>.USER_PASSWORD.focus();}catch(e){}
	<?else:?>
	try{document.<?= $arResult['FORM_ID'];?>.USER_LOGIN.focus();}catch(e){}
	<?endif?>
</script>