<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

if($arResult["SHOW_SMS_FIELD"] == true)
{
	CJSCore::Init('phone_auth');
}?>


    <div class="authorization-content border border-b">
        <div class="authorization-title"><?=GetMessage("AUTH_REGISTER")?></div>
        <?php

        if (count($arResult["ERRORS"]) > 0):

            foreach ($arResult["ERRORS"] as $key => $error)
            ?>
                <div class="alert alert-warning" style="color: red; text-align: center;background: #191F29; border: red 1px solid; border-radius: 2rem; margin-bottom: 20px">

               <? if (intval($key) == 0 && $key !== 0)
                    $arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;" . GetMessage("REGISTER_FIELD_" . $key) . "&quot;", $error);

            ShowError(implode("<br />", $arResult["ERRORS"]));?></div><?
        elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):
            ?>
        <?endif?>
        <form class="authorization-form registration-form form" method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
            <?
            if($arResult["BACKURL"] <> ''):
                ?>
                <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
            <?
            endif;
            ?>
                <?foreach ($arResult["SHOW_FIELDS"] as $FIELD):?>
                   <?
                            switch ($FIELD)
                            {
                                case "PASSWORD":
                                    ?>
                                    <label>
                                        <span>Пароль</span>
                                        <input type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" class="bx-auth-input">
                                    </label>
                                    <?
                                    break;
                                case "CONFIRM_PASSWORD":
                                    ?>
                                    <label>
                                        <span>Повторите пароль</span>
                                        <input type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off">
                                    </label>
                                    <?
                                    break;
                                case "EMAIL":
                                    ?>
                                    <label>
                                        <span>E-mail</span>
                                        <input type="email" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off">
                                    </label>
                                    <?
                                    break;
                            }?>

                <?endforeach?>
                <?// ********************* User properties ***************************************************?>
                <?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
                    <?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
                        <tr><td><?=$arUserField["EDIT_FORM_LABEL"]?>:<?if ($arUserField["MANDATORY"]=="Y"):?><span class="starrequired">*</span><?endif;?></td><td>
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:system.field.edit",
                                    $arUserField["USER_TYPE"]["USER_TYPE_ID"],
                                    array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "regform"), null, array("HIDE_ICONS"=>"Y"));?></td></tr>
                    <?endforeach;?>
                <?endif;?>
                <?// ******************** /User properties ***************************************************?>




            <div class="payments-form__privacy">
                <div class="payments-form__privacy-items">
                    <label class="label-checkbox">
                        <input type="checkbox" class="visually-hidden" id="checkbox-confirm" name="checkbox">
                        <span></span>
                        <div class="checkbox-text">
                            <div class="ckeckbox-description">Я прочитал и согласен с&nbsp;<a href="#">Пользовательским
                                    соглашением</a>
                                и&nbsp;<a href="#">Политикой конфиденциальности</a>, а&nbsp;также даю согласие на обработку персональных
                                данных.
                            </div>
                        </div>
                    </label>

                    <label class="label-checkbox">
                        <input type="checkbox" class="visually-hidden">
                        <span></span>
                        <div class="checkbox-text">
                            <div class="ckeckbox-description">Да, я хотел бы получать эксклюзивные предложения и&nbsp;информацию
                                о&nbsp;продуктах и услугах, которые могут быть мне интересны, по электронной почте. Клиенты могут в любое время
                                отказаться от подписки частично или&nbsp;полностью.</div>
                        </div>
                    </label>
                </div>
            </div>

            <div class="authorization-btns">
                <button type="submit" id="button_success" class="authorization-btn registration-btn btn" name="register_submit_button" value="<?=GetMessage("AUTH_REGISTER")?>"  ><?=GetMessage("AUTH_BUTTON")?></button>
                <a href="/personal/auth/index.php" class="authorization-link registration-link link">уже есть аккаунт? войдите!</a>
            </div>

            <div class="authorization-social">
                <div class="authorization-social__title">или войдите через соцсети</div>
                <div class="authorization-social__items">
                    <a href="#" class="authorization-social__item">
                        <img src="img/facebook.svg" alt="">
                    </a>

                    <a href="#" class="authorization-social__item">
                        <img src="img/google.svg" alt="">
                    </a>

                    <a href="#" class="authorization-social__item">
                        <img src="img/twitter.svg" alt="">
                    </a>

                    <a href="#" class="authorization-social__item">
                        <img src="img/vk.svg" alt="">
                    </a>
                </div>
            </div>
        </form>
    </div>
