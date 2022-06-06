<?php
use \Bitrix\Main\Localization\Loc;
?><!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title><?= $APPLICATION->ShowTitle()?></title>
    <?php
    $APPLICATION->ShowMeta("description");
    $APPLICATION->ShowMeta("robots");
    $APPLICATION->ShowCSS();
    $APPLICATION->ShowHeadStrings();
    ?>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
     <link rel="icon" href="<?=SITE_TEMPLATE_PATH?>/img/favicon.png">
    <?php
    if ($_GET['id']){
    $_GET['id'] = $_GET['id'];}
    $url = $APPLICATION->GetCurPage();
    $remove_http = str_replace('http://', '', $url);
    $split_url = explode('?', $remove_http);
    $pageURL = explode('/', $split_url[0]);
    foreach ($pageURL as $val)
    {
        if($val) $pageURLAr[] = $val;
    }
    if ($_GET['logout'] == 'Y') {
        $USER->Logout();
        if ($pageURL[1] == 'en') LocalRedirect('/');
        elseif ($pageURL[1] == 'en') LocalRedirect('/en');

    }

//    CSS files
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/normalize.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/swiper-bundle.min.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/jquery.fancybox.min.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/style.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/new.css");

    //    JS files
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery-3.5.1.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/swiper-bundle.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery.maskedinput.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery.fancybox.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/new.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/main.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/dev.js");

    $APPLICATION->ShowHead();

    $userID = CUser::GetID();
    $userRs = CUser::GetByID($userID);
    $userAr = $userRs->Fetch();

    ?>
    <?php if ($pageURL[1] == 'en'):
        $lang = ['Feedback','Profile','Exit','Authorization','Registration','Russian','English'];
        $ssilka = ['/en/personal','/en/personal/auth','/en/signup','/en/feedback/', '/en'];
        $menu = ['top1',];
     else:
         $menu = ['top',];
         $lang =['Обратная связь','Профиль','Выход','Авторизация','Регистрация','Русский','Английский'];
         $ssilka = ['/personal','/personal/auth','/signup','/feedback/', '/'];
    endif; ?>


</head>
<div id="panel"><?= $APPLICATION->ShowPanel() ?></div>
<body>
<header class="header">
    <div class="container">
        <div class="header-content">
            <div class="header-burger mobile">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <a href="<?=$ssilka[4]?>" class="header-logo">
                GAME-ASSIST
            </a>

            <nav class="header-nav desktop">
                <?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"verxneye_menyu",
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => $menu[0],
		"USE_EXT" => "N",
		"COMPONENT_TEMPLATE" => "verxneye_menyu"
	),
	false
);?>

                <a href="<?=$ssilka[3]?>" class="header-btn btn"><?=$lang[0]?></a>
            </nav>

            <div class="header-right">
                <div class="header-right__btn header-profile">
                    <div id="profile" class="header-profile__inner">

                        <img src="<?=SITE_TEMPLATE_PATH?>/img/profile.svg" alt="">
                    </div>
                    <div id="select_profile" class="header-profile__dropdown">
                        <?php if(CUser::IsAuthorized()):?>
                            <ul class="border">
                                <li><a href="<?=$ssilka[0]?>"><?=$lang[1]?></a></li>
<!--                                <li><a href="profile.html">Мои заказы</a></li>-->
                                <li><a href="?logout=Y"><?=$lang[2]?></a></li>
                            </ul>
                        <?php else:?>
                            <ul class="border">
                                <li><a href="<?=$ssilka[1]?>"><?=$lang[3]?></a></li>
                                <li><a href="<?=$ssilka[2]?>"><?=$lang[4]?></a></li>
                            </ul>
                        <?php endif;?>
                    </div>
                </div>

<!--                <a href="/personal/cart/" class="header-right__btn header-basket">-->
<!--                    <img src="--><?//=SITE_TEMPLATE_PATH?><!--/img/basket.svg" alt="">-->
<!--                </a>-->

                <!-- <a href="#" class="header-right__btn header-language desktop">
                    ru
                </a> -->

                <div class="header-right__btn header-language desktop">
                    <input type="hidden" class="header-language__select" value="RU">
                    <div class="select">
                        <div id="lang" class="select_checked language-select_checked">
                            <?php if ($pageURL[1] == 'en'): ?>
                                <span class="select-text">EN</span>
                                <?
                                \Bitrix\Main\Localization\Loc::setCurrentLang("en");
                                Loc::loadMessages(FILE);?>
                            <? else: ?>
                                <?
                                \Bitrix\Main\Localization\Loc::setCurrentLang("ru");
                                Loc::loadMessages(FILE);?>
                                <span class="select-text">RU</span>
                            <? endif; ?>
                        </div>
                        <div id="select_lang" class="select-dropdown">
                            <div  class="select-dropdown__inner border">
                                <div class="header-language__item" data-language="RU"><?=$lang[5]?> (RU)</div>
                                <div class="header-language__item" data-language="EN"><?=$lang[6]?> (EN)</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <nav class="header-nav mobile">
            <?$APPLICATION->IncludeComponent("bitrix:menu", "verxneye_menyu", Array(
                "ALLOW_MULTI_SELECT" => "Y",	// Разрешить несколько активных пунктов одновременно
                "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                "DELAY" => "N",	// Откладывать выполнение шаблона меню
                "MAX_LEVEL" => "1",	// Уровень вложенности меню
                "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
                    0 => "",
                ),
                "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                "MENU_CACHE_TYPE" => "N",	// Тип кеширования
                "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                "ROOT_MENU_TYPE" => $menu[0],	// Тип меню для первого уровня
                "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
            ),
                false
            );?>


            <a href="/feedback/" class="header-btn btn"><?=$lang[0]?></a>

            <!-- <a href="#" class="header-right__btn header-language">
                ru
            </a> -->

            <div class="header-right__btn header-language">
                <input type="hidden" class="header-language__select" value="RU">
                <div  class="select">
                    <div  class="select_checked language-select_checked">
                        <?php if ($pageURL[1] == 'en'): ?>
                            <span class="select-text">EN</span>
                            <?
                            \Bitrix\Main\Localization\Loc::setCurrentLang("en");
                            Loc::loadMessages(FILE);?>
                        <? else: ?>
                            <?
                            \Bitrix\Main\Localization\Loc::setCurrentLang("ru");
                            Loc::loadMessages(FILE);?>
                            <span class="select-text">RU</span>
                        <? endif; ?>
                    </div>
                    <div class="select-dropdown">
                        <div class="select-dropdown__inner border">
                            <div class="header-language__item" data-language="RU"><?=$lang[5]?> (RU)</div>
                            <div class="header-language__item" data-language="EN"><?=$lang[6]?> (EN)</div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>

<div class="overlay-bg">
    <div class="overlay-bg__top">
        <span></span>
        <span></span>
    </div>
    <div class="overlay-bg__middle">
        <span></span>
    </div>
    <div class="overlay-bg__bottom">
        <span></span>
        <span></span>
    </div>
</div>

<script>
</script>

