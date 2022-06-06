<?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("GAME-ASSIST Профиль");
$APPLICATION->SetPageProperty("description", "Как по мне, это лучший сервис по прокачке WOT цены и наличие бонусных предложений лучше чем у кого либо");
$userID = CUser::GetID();
$userData = CUser::GetByID($userID);
$userAr = $userData->Fetch();

$statusAr = [
    'Ожидает выполнения' => '#BF2E00',
    'Выполняется' => '#EAD72B',
    'Выполнен' => '#2BEA60'
];

?>

    <section class="profile">
        <div class="container">
            <div class="profile-content">
                <div class="profile-side border border-b">
                    <div class="profile-side__heading">
                        <div class="profile-side__info">
                            <div class="profile-side__info-photo border">
                                <?php if($userAr['UF_PHOTO_PROFILE']):?>
                                    <img src="<?=CFile::GetPath($userAr['UF_PHOTO_PROFILE'])?>" alt="">
                                <?php else:?>
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/user-profile.png" alt="">
                                <?php endif;?>
                            </div>
                            <div class="profile-side__info-text">
                                <div class="profile-side__info-name"><?=$userAr['LOGIN']?></div>
                                <a href="mailto:<?=$userAr['EMAIL']?>" class="profile-side__info-mail"><?=$userAr['EMAIL']?></a>
                            </div>
                        </div>

<!--                        <div class="profile-side__balance">-->
<!--                            <div class="profile-side__balance-info">-->
<!--                                Баланс:-->
<!--                                <div class="profile-side__balance-value"><span>22 990</span> ₽</div>-->
<!--                            </div>-->
<!--                            <a href="#" class="profile-side__balance-btn btn">Пополнить</a>-->
<!--                        </div>-->

                        <a href="#" class="profile-side__logout">
                            Выйти
                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/logout.svg" alt="">
                        </a>
                    </div>

                    <div class="profile-side__bottom">
                        <a href="#" class="profile-side__btn profile-side__btn-action active" data-profile="profile">
                            <div class="profile-side__btn-inner">
                                <div class="profile-side__btn-title">Профиль</div>
                                <div class="profile-side__btn-img">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/profile-avatar.svg" alt="">
                                </div>
                            </div>
                        </a>

                        <a href="#" class="profile-side__btn profile-side__btn-action" data-profile="orders">
                            <div class="profile-side__btn-inner">
                                <div class="profile-side__btn-title">Мои заказы</div>
                                <div class="profile-side__btn-img">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/details-icon-2.svg" alt="">
                                </div>
                            </div>
                        </a>

                        <a href="?logout=Y" class="profile-side__btn profile-side__btn-logout">
                            <div class="profile-side__btn-inner">
                                <div class="profile-side__btn-title">Выйти</div>
                                <div class="profile-side__btn-img">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/logout.svg" alt="">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <style>
                    #default-styles {
                        position: relative;
                        inset: 0;
                        border-radius: 0;
                        background: none;
                        height: 1px;
                        cursor: pointer;
                        padding: 0;
                        margin-top: -10px;

                    }
                    #default-styles::before {
                           content: '';
                           position: relative;
                           inset: 0;
                           border-radius: 0;
                           background: none;
                           z-index: -1;
                           height: 2px;
                           cursor: pointer;
                       }

                </style>

<?php


?>
                <div class="profile-block">
                    <div class="profile-block__item active" data-profile="profile">
                        <h1 class="profile-title title">Профиль</h1>
                        <div class="alert alert-warning-profile" style=" display: none; color: red; text-align: center;background: #191F29; border: red 1px solid; border-radius: 2rem; margin-bottom: 20px; font-size: 16px; padding-bottom: 10px; padding-top: 10px">
                            <p><font class="errortext"></font></p></div>
                        <div class="profile-body form">
                            <div class="profile-info">
                                <div class="profile-info__photo-block">
                                    <div class="profile-info__photo border">
                                        <?php if($userAr['UF_PHOTO_PROFILE']):?>
                                            <img src="<?=CFile::GetPath($userAr['UF_PHOTO_PROFILE'])?>" alt="">
                                        <?php else:?>
                                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/user-profile.png" alt="">
                                        <?php endif;?>
                                    </div>
                                    <form class="profile-contact-info-ajax" enctype="multipart/form-data">
                                        <input type="hidden" name="LANG" value="ru">
                                    <div class="profile-info__photo-change">
                                        <label id="default-styles" for="files">Сменить аватар</label>
                                    </div>
                                    <input class="getAvatar" style="visibility:hidden;" type="file" id="files" name="AVATAR" > <!-- style="visibility:hidden;" -->
                                </div>

                                <div class="profile-info__group">
                                    <label>
                                        <span>Ваше имя</span>
                                        <input name="LOGIN" type="text" value="<?=$userAr['LOGIN']?>">
                                    </label>

                                    <label>
                                        <span>E-mail</span>
                                        <input name="EMAIL" type="email" value="<?=$userAr['EMAIL']?>">
                                    </label>

                                    <a href="#" class="profile-group__btn btn mobile">Сохранить изменения</a>
                                </div>
                            </div>

                            <div class="profile-group">
                                <div class="profile-group__title">Контактная иформация</div>
                                <label>
                                    <span>Skype</span>
                                    <input name="SKYPE" type="text" value="<?=$userAr['UF_SKYPE']?>">
                                </label>

                                <label>
                                    <span>Телефон</span>
                                    <input name="PHONE_NUMBER" type="tel" value="<?=$userAr['PERSONAL_PHONE']?>">
                                </label>

                                <button class="profile-group__btn btn" type="submit">
                                    Сохранить изменения
                                </button>
                            </div>
                            </form>



                            <div class="profile-group">
                                <div class="alert alert-warning" style="display: none; color: red; text-align: center;background: #191F29; border: red 1px solid; border-radius: 2rem; margin-bottom: 20px; font-size: 16px; padding-bottom: 10px; padding-top: 10px">
                                    <p><font class="errortext"></font></p></div>
                                <div class="profile-group__title">Пароль</div>
                                    <form class="change-pass-ajax">
                                        <input type="hidden" name="LANG" value="ru">
                                        <label>
                                            <span>Старый пароль</span>
                                            <input name="PAST_PASSWORD" type="password" value="" placeholder="Введите пароль...">
                                        </label>

                                        <label>
                                            <span>Новый пароль</span>
                                            <input name="PASSWORD" type="password" value="" placeholder="Введите пароль...">
                                        </label>

                                        <label>
                                            <span>Повторите пароль</span>
                                            <input name="PASSWORD_CONFIRM" type="password" value="" placeholder="Введите пароль...">
                                        </label>

                                        <button class="profile-group__btn btn" type="submit">
                                            Сохранить изменения
                                        </button>
                                    </form>

                            </div>

<!--                            <div class="profile-group">-->
<!--                                <div class="profile-group__title">Связь с соцсетями</div>-->
<!---->
<!--                                <div class="profile-social">-->
<!--                                    <a href="#" class="profile-social__item border active">-->
<!--                                        <div class="profile-social__item-checked">-->
<!--                                            <div class="profile-social__title">Facebook подключен</div>-->
<!--                                            <div class="profile-social__img social__img-delete">-->
<!--                                                <img src="--><?//= SITE_TEMPLATE_PATH ?><!--/img/social-delete.svg" alt="">-->
<!--                                            </div>-->
<!--                                        </div>-->
<!---->
<!--                                        <div class="profile-social__title">Войдите с помощью Facebook</div>-->
<!--                                        <div class="profile-social__img">-->
<!--                                            <img src="--><?//= SITE_TEMPLATE_PATH ?><!--/img/social-icon-1.svg" alt="">-->
<!--                                        </div>-->
<!--                                    </a>-->
<!---->
<!--                                    <a href="#" class="profile-social__item border">-->
<!--                                        <div class="profile-social__item-checked">-->
<!--                                            <div class="profile-social__title">Google подключен</div>-->
<!--                                            <div class="profile-social__img social__img-delete">-->
<!--                                                <img src="--><?//= SITE_TEMPLATE_PATH ?><!--/img/social-delete.svg" alt="">-->
<!--                                            </div>-->
<!--                                        </div>-->
<!---->
<!--                                        <div class="profile-social__title">Войдите с помощью Google</div>-->
<!--                                        <div class="profile-social__img">-->
<!--                                            <img src="--><?//= SITE_TEMPLATE_PATH ?><!--/img/social-icon-2.svg" alt="">-->
<!--                                        </div>-->
<!--                                    </a>-->
<!---->
<!--                                    <a href="#" class="profile-social__item border">-->
<!--                                        <div class="profile-social__item-checked">-->
<!--                                            <div class="profile-social__title">Twitter подключен</div>-->
<!--                                            <div class="profile-social__img social__img-delete">-->
<!--                                                <img src="--><?//= SITE_TEMPLATE_PATH ?><!--/img/social-delete.svg" alt="">-->
<!--                                            </div>-->
<!--                                        </div>-->
<!---->
<!--                                        <div class="profile-social__title">Войдите с помощью Twitter</div>-->
<!--                                        <div class="profile-social__img">-->
<!--                                            <img src="--><?//= SITE_TEMPLATE_PATH ?><!--/img/social-icon-3.svg" alt="">-->
<!--                                        </div>-->
<!--                                    </a>-->
<!---->
<!--                                    <a href="#" class="profile-social__item border">-->
<!--                                        <div class="profile-social__item-checked">-->
<!--                                            <div class="profile-social__title">Vkontakte подключен</div>-->
<!--                                            <div class="profile-social__img social__img-delete">-->
<!--                                                <img src="--><?//= SITE_TEMPLATE_PATH ?><!--/img/social-delete.svg" alt="">-->
<!--                                            </div>-->
<!--                                        </div>-->
<!---->
<!--                                        <div class="profile-social__title">Войдите с помощью Vkontakte</div>-->
<!--                                        <div class="profile-social__img">-->
<!--                                            <img src="--><?//= SITE_TEMPLATE_PATH ?><!--/img/social-icon-4.svg" alt="">-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                </div>-->
<!---->
<!--                                <a href="#" class="profile-group__btn btn">Сохранить изменения</a>-->
<!--                            </div>-->

                        </div>

                    </div>
                    <div class="profile-block__item" data-profile="orders">
                        <div class="profile-title title">Мои заказы</div>
                        <div class="profile-orders">

                            <?php
                            $statusS = CIBlockElement::GetList(
                                array(),
                                array('IBLOCK_ID' => 14, 'ACTIVE' => 'Y', 'PROPERTY_CLIENT' => CUser::GetID()),
                                false,
                                false,
                                array('ID', 'PROPERTY_USLUGA', 'PROPERTY_STATUS', 'PROPERTY_SELECTED_FIELDS'));

                            while ($status = $statusS->GetNext()):

                                $uslugi = CIBlockElement::GetList(
                                    array(),
                                    array('IBLOCK_ID' => 9, 'ACTIVE' => 'Y', 'ID' => $status['PROPERTY_USLUGA_VALUE']),
                                    false,
                                    false,
                                    array('ID', 'PROPERTY_FOTO', 'PROPERTY_NAME'));

                                $usluga = $uslugi->GetNext();
                                ?>
                            <div class="profile-order border">
                                <div class="profile-order__img border">
                                    <img src="<?=CFile::GetPath($usluga['PROPERTY_FOTO_VALUE'])?>" alt="">
                                </div>
                                <div class="profile-order__text">
                                    <div class="profile-order__title"><?=$usluga['PROPERTY_NAME_VALUE']?></div>
                                    <div class="profile-order__description"><?=$status['~PROPERTY_SELECTED_FIELDS_VALUE']['TEXT']?></div>
                                    <?php switch ($status['PROPERTY_STATUS_VALUE'])
                                    {
                                        case 'Ожидает выполнения':
                                            echo "<div style='color: ".$statusAr['Ожидает выполнения'].";' class=\"profile-order__status\">".$status['PROPERTY_STATUS_VALUE']."</div>";
                                            break;
                                        case 'Выполняется':
                                            echo "<div style='color: ".$statusAr['Выполняется'].";' class=\"profile-order__status\">".$status['PROPERTY_STATUS_VALUE']."</div>";
                                            break;
                                        case 'Выполнен':
                                            echo "<div style='color: ".$statusAr['Выполнен'].";' class=\"profile-order__status\">".$status['PROPERTY_STATUS_VALUE']."</div>";
                                    }?>

                                </div>
                            </div>
                            <?php endwhile;?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>