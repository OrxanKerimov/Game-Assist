<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)
{
	die();
}

$url = $APPLICATION->GetCurPage();
$remove_http = str_replace('http://', '', $url);
$split_url = explode('?', $remove_http);
$pageURL = explode('/', $split_url[0]);
if($pageURL[1] == 'en') $urlENG = 'en/';

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

<div class="container">
    <div class="authorization-content border border-b">




            <h1 class="authorization-title"><?= Loc::getMessage('VXOD');?></h1>
        <?if ($arResult['ERRORS']):?>
            <div class="alert alert-warning" style="color: red; text-align: center;background: #191F29; border: red 1px solid; border-radius: 2rem; " >
                <b><? foreach ($arResult['ERRORS'] as $error)
                {
                    echo $error;
                }
                ?></b>
            </div>
        <?endif;?>
            <form name="<?= $arResult['FORM_ID'];?>" class="authorization-form login-form form" method="post" target="_top" action="<?= POST_FORM_ACTION_URI;?>">
                <label>
                    <span><?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_LOGIN');?></span>
                    <input type="text" name="<?= $arResult['FIELDS']['login'];?>" maxlength="255" value="<?= \htmlspecialcharsbx($arResult['LAST_LOGIN']);?>" autocomplete="off" />
                </label>

                <label>
                    <span><?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_PASS');?></span>
                    <input type="password" name="<?= $arResult['FIELDS']['password'];?>" maxlength="255" autocomplete="off" />
                </label>

                <div class="authorization-btns">
                    <button type="submit" class="authorization-btn login-btn btn" name="<?= $arResult['FIELDS']['action'];?>" value="<?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_SUBMIT');?>"><?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_SUBMIT');?></button>
                    <?if ($arResult['AUTH_FORGOT_PASSWORD_URL'] || $arResult['AUTH_REGISTER_URL']):?>
                        <?if ($arResult['AUTH_FORGOT_PASSWORD_URL']):?>
                            <a href="/<?=$urlENG?>signup" class="authorization-btn to-registration btn border"><?= Loc::getMessage('MAIN_AUTH_FORM_URL_REGISTER_URL');?>  </a>
                        <?endif;?>
                        <?if ($arResult['AUTH_REGISTER_URL']):?>


                            <a href="/<?=$urlENG?>change_password_page" class="authorization-link link"><?= Loc::getMessage('MAIN_AUTH_FORM_URL_FORGOT_PASSWORD');?></a>

                        <?endif;?>
                    <?endif;?>
                </div>

                <div class="authorization-social">
                    <div class="authorization-social__title"><?= Loc::getMessage('SET');?></div>

                        <?if ($arResult['AUTH_SERVICES']):?>
                            <?$APPLICATION->IncludeComponent('bitrix:socserv.auth.form',
                                'login',
                                array(
                                    'AUTH_SERVICES' => $arResult['AUTH_SERVICES'],
                                    'AUTH_URL' => $arResult['CURR_URI']
                                ),
                                $component,
                                array('HIDE_ICONS' => 'Y')
                            );
                            ?>
                        <?endif?>

                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
	<?if ($arResult['LAST_LOGIN'] != ''):?>
	try{document.<?= $arResult['FORM_ID'];?>.USER_PASSWORD.focus();}catch(e){}
	<?else:?>
	try{document.<?= $arResult['FORM_ID'];?>.USER_LOGIN.focus();}catch(e){}
	<?endif?>
</script>