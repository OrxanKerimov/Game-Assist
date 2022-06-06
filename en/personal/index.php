<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Профиль");
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
                            Exit
                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/logout.svg" alt="">
                        </a>
                    </div>

                    <div class="profile-side__bottom">
                        <a href="#" class="profile-side__btn profile-side__btn-action active" data-profile="profile">
                            <div class="profile-side__btn-inner">
                                <div class="profile-side__btn-title">Profile</div>
                                <div class="profile-side__btn-img">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/profile-avatar.svg" alt="">
                                </div>
                            </div>
                        </a>

                        <a href="#" class="profile-side__btn profile-side__btn-action" data-profile="orders">
                            <div class="profile-side__btn-inner">
                                <div class="profile-side__btn-title">My orders</div>
                                <div class="profile-side__btn-img">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/details-icon-2.svg" alt="">
                                </div>
                            </div>
                        </a>

                        <a href="?logout=Y" class="profile-side__btn profile-side__btn-logout">
                            <div class="profile-side__btn-inner">
                                <div class="profile-side__btn-title">Exit</div>
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
                        <h1 class="profile-title title">Profile</h1>
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
                                        <input type="hidden" name="LANG" value="en">
                                        <div class="profile-info__photo-change">
                                            <label id="default-styles" for="files">Change avatar</label>
                                        </div>
                                        <input class="getAvatar" style="visibility:hidden;" type="file" id="files" name="AVATAR" > <!-- style="visibility:hidden;" -->
                                </div>

                                <div class="profile-info__group">
                                    <label>
                                        <span>Your name</span>
                                        <input name="LOGIN" type="text" value="<?=$userAr['LOGIN']?>">
                                    </label>

                                    <label>
                                        <span>E-mail</span>
                                        <input name="EMAIL" type="email" value="<?=$userAr['EMAIL']?>">
                                    </label>

                                    <a href="#" class="profile-group__btn btn mobile">Save Changes</a>
                                </div>
                            </div>

                            <div class="profile-group">
                                <div class="profile-group__title">Contact Information</div>
                                <label>
                                    <span>Skype</span>
                                    <input name="SKYPE" type="text" value="<?=$userAr['UF_SKYPE']?>">
                                </label>

                                <label>
                                    <span>Telephone</span>
                                    <input name="PHONE_NUMBER" type="tel" value="<?=$userAr['PERSONAL_PHONE']?>">
                                </label>

                                <button class="profile-group__btn btn" type="submit">
                                    Save Changes
                                </button>
                            </div>
                            </form>



                            <div class="profile-group">
                                <div class="alert alert-warning" style="display: none; color: red; text-align: center;background: #191F29; border: red 1px solid; border-radius: 2rem; margin-bottom: 20px; font-size: 16px; padding-bottom: 10px; padding-top: 10px">
                                    <p><font class="errortext"></font></p></div>
                                <div class="profile-group__title">Password</div>
                                <form class="change-pass-ajax">
                                    <input type="hidden" name="LANG" value="en">
                                    <label>
                                        <span>Old password</span>
                                        <input name="PAST_PASSWORD" type="password" value="" placeholder="Enter password...">
                                    </label>

                                    <label>
                                        <span>New password</span>
                                        <input name="PASSWORD" type="password" value="" placeholder="Enter password...">
                                    </label>

                                    <label>
                                        <span>Repeat password</span>
                                        <input name="PASSWORD_CONFIRM" type="password" value="" placeholder="Enter password...">
                                    </label>

                                    <button class="profile-group__btn btn" type="submit">
                                        Save Changes
                                    </button>
                                </form>

                            </div>

<!--                            <div class="profile-group">-->
<!--                                <div class="profile-group__title">Social Networking</div>-->
<!---->
<!--                                <div class="profile-social">-->
<!--                                    <a href="#" class="profile-social__item border active">-->
<!--                                        <div class="profile-social__item-checked">-->
<!--                                            <div class="profile-social__title">Facebook connected</div>-->
<!--                                            <div class="profile-social__img social__img-delete">-->
<!--                                                <img src="--><?//= SITE_TEMPLATE_PATH ?><!--/img/social-delete.svg" alt="">-->
<!--                                            </div>-->
<!--                                        </div>-->
<!---->
<!--                                        <div class="profile-social__title">Login with Facebook</div>-->
<!--                                        <div class="profile-social__img">-->
<!--                                            <img src="--><?//= SITE_TEMPLATE_PATH ?><!--/img/social-icon-1.svg" alt="">-->
<!--                                        </div>-->
<!--                                    </a>-->
<!---->
<!--                                    <a href="#" class="profile-social__item border">-->
<!--                                        <div class="profile-social__item-checked">-->
<!--                                            <div class="profile-social__title">Google connected</div>-->
<!--                                            <div class="profile-social__img social__img-delete">-->
<!--                                                <img src="--><?//= SITE_TEMPLATE_PATH ?><!--/img/social-delete.svg" alt="">-->
<!--                                            </div>-->
<!--                                        </div>-->
<!---->
<!--                                        <div class="profile-social__title">Login with Google</div>-->
<!--                                        <div class="profile-social__img">-->
<!--                                            <img src="--><?//= SITE_TEMPLATE_PATH ?><!--/img/social-icon-2.svg" alt="">-->
<!--                                        </div>-->
<!--                                    </a>-->
<!---->
<!--                                    <a href="#" class="profile-social__item border">-->
<!--                                        <div class="profile-social__item-checked">-->
<!--                                            <div class="profile-social__title">Twitter connected</div>-->
<!--                                            <div class="profile-social__img social__img-delete">-->
<!--                                                <img src="--><?//= SITE_TEMPLATE_PATH ?><!--/img/social-delete.svg" alt="">-->
<!--                                            </div>-->
<!--                                        </div>-->
<!---->
<!--                                        <div class="profile-social__title">Login with Twitter</div>-->
<!--                                        <div class="profile-social__img">-->
<!--                                            <img src="--><?//= SITE_TEMPLATE_PATH ?><!--/img/social-icon-3.svg" alt="">-->
<!--                                        </div>-->
<!--                                    </a>-->
<!---->
<!--                                    <a href="#" class="profile-social__item border">-->
<!--                                        <div class="profile-social__item-checked">-->
<!--                                            <div class="profile-social__title">Vkontakte connected</div>-->
<!--                                            <div class="profile-social__img social__img-delete">-->
<!--                                                <img src="--><?//= SITE_TEMPLATE_PATH ?><!--/img/social-delete.svg" alt="">-->
<!--                                            </div>-->
<!--                                        </div>-->
<!---->
<!--                                        <div class="profile-social__title">Login with Vkontakte</div>-->
<!--                                        <div class="profile-social__img">-->
<!--                                            <img src="--><?//= SITE_TEMPLATE_PATH ?><!--/img/social-icon-4.svg" alt="">-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                </div>-->
<!---->
<!--                                <a href="#" class="profile-group__btn btn">Save Changes</a>-->
<!--                            </div>-->
                        </div>
                    </div>

                    <div class="profile-block__item" data-profile="orders">
                        <div class="profile-title title">My orders</div>
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
                                    array('ID', 'PROPERTY_FOTO', 'PROPERTY_NAME_EN'));

                                $usluga = $uslugi->GetNext();
                                ?>
                                <div class="profile-order border">
                                    <div class="profile-order__img border">
                                        <img src="<?=CFile::GetPath($usluga['PROPERTY_FOTO_VALUE'])?>" alt="">
                                    </div>
                                    <div class="profile-order__text">
                                        <div class="profile-order__title"><?=$usluga['PROPERTY_NAME_EN_VALUE']?></div>
                                        <div class="profile-order__description"><?=$status['~PROPERTY_SELECTED_FIELDS_VALUE']['TEXT']?></div>
                                        <?php switch ($status['PROPERTY_STATUS_VALUE'])
                                        {
                                            case 'Ожидает выполнения':
                                                echo "<div style='color: ".$statusAr['Ожидает выполнения'].";' class=\"profile-order__status\">Awaiting execution</div>";
                                                break;
                                            case 'Выполняется':
                                                echo "<div style='color: ".$statusAr['Выполняется'].";' class=\"profile-order__status\">In progress</div>";
                                                break;
                                            case 'Выполнен':
                                                echo "<div style='color: ".$statusAr['Выполнен'].";' class=\"profile-order__status\">Complete</div>";
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