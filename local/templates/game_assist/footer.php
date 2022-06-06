<?php
$url = $APPLICATION->GetCurPage();
$remove_http = str_replace('http://', '', $url);
$split_url = explode('?', $remove_http);
$pageURL = explode('/', $split_url[0]);

?>
<?php if ($pageURL[1] == 'en'):
    $menu = ['bottom1',];
$link = "/en/";
else:
    $menu = ['bottom',];
    $link = '/';
endif; ?>

<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <a href="<?=$link?>" class="footer-logo">GAME-ASSIST</a>
            <div class="footer-nav">
                <?$APPLICATION->IncludeComponent("bitrix:menu", "nijneye_menyu", Array(
                    "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
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

            </div>
            <a href="#" class="footer-copy">
                <div class="footer-copy__text">
                    <div class="footer-copy__subtitle">Разработано</div>
                    <div class="footer-copy__title"><span>Request</span> Design</div>
                </div>
                <div class="footer-copy__img">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/copy.svg" alt="">
                </div>
            </a>
        </div>
    </div>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(88991276, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/88991276" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</footer>

<div class="popup" id="popup">
    <div class="popup-wrap">
        <div class="popup-content">
            <div class="popup-close">
                <img src="<?=SITE_TEMPLATE_PATH?>/img/delete.svg" alt="">
            </div>
            <form action="#" class="popup-form form border border-b">
                <div class="popup-title">Пополнение баланса</div>

                <div class="popup-subtitle">Введите сумму</div>

                <label class="label-price">
                    <input type="text" value="2 190">
                </label>

                <div class="payments-title">Выберите способ оплаты</div>

                <div class="payments-form__items">
                    <label>
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/payments-method-1.svg" alt="">
                        <input type="radio" name="popup-payments-method" class="visually-hidden" checked>
                        <span></span>
                    </label>
                    <label>
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/payments-method-2.svg" alt="">
                        <input type="radio" name="popup-payments-method" class="visually-hidden">
                        <span></span>
                    </label>
                    <label>
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/payments-method-3.svg" alt="">
                        <input type="radio" name="popup-payments-method" class="visually-hidden">
                        <span></span>
                    </label>
                    <label>
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/payments-method-4.svg" alt="">
                        <input type="radio" name="popup-payments-method" class="visually-hidden">
                        <span></span>
                    </label>
                    <label>
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/payments-method-5.svg" alt="">
                        <input type="radio" name="popup-payments-method" class="visually-hidden">
                        <span></span>
                    </label>
                    <label>
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/payments-method-6.svg" alt="">
                        <input type="radio" name="popup-payments-method" class="visually-hidden">
                        <span></span>
                    </label>
                    <label>
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/payments-method-7.svg" alt="">
                        <input type="radio" name="popup-payments-method" class="visually-hidden">
                        <span></span>
                    </label>
                    <label>
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/payments-method-8.svg" alt="">
                        <input type="radio" name="popup-payments-method" class="visually-hidden">
                        <span></span>
                    </label>
                </div>

                <div class="payments-form__info">
                    <div class="payments-form__info-title">
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/details-icon-3.svg" alt="">
                        Комиссия <span>10%</span> (взимается <span>при оплате</span>)
                    </div>
                    <ul class="payments-form__info-description">
                        <li>Включают в себя налоги и&nbsp;комиссию платежной системы</li>
                    </ul>
                </div>

                <button class="popup-form__btn btn">Пополнить баланс</button>
            </form>
        </div>
    </div>
</div>



</body>
</html>