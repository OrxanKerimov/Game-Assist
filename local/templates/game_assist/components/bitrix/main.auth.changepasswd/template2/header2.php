<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title><?= $APPLICATION->ShowTitle() ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <!-- <meta name="description" content="another website"> -->
    <link rel="icon" href="<?=SITE_TEMPLATE_PATH?>/img/favicon.png">
    <?php
    if ($_GET['logout'] == 'Y') {
        $USER->Logout();
        LocalRedirect('/');
    }

    //    CSS files
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/normalize.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/swiper-bundle.min.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/jquery.fancybox.min.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/style.css");
    //    JS files
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery-3.5.1.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/swiper-bundle.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery.maskedinput.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery.fancybox.min.js");

    $APPLICATION->ShowHead();
    ?>


</head>
</html>
