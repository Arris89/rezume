<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<div class="section-decor section-style">
    <div class="section-decor__container container">
        <div class="basket">
            <div class="basket__head">
                <h1 class="basket__title page-title">оформление заказа
                </h1>
                <div class="basket__nav">
                    <div class="basket-nav">
                        <div class="basket-nav__list"><a class="basket-nav__item" href="<?=$arParams['PATH_TO_BASKET']?>"><span class="basket-nav__icon">
                    <svg class="icon icon_list-on-window">
                      <use xlink:href="<?=SITE_TEMPLATE_PATH?>/svg/sprite/sprite.svg#list-on-window"></use>
                    </svg></span><span class="basket-nav__text">состав заказа</span><span class="basket-nav__arrow">
                    <svg class="icon icon_angle-right">
                      <use xlink:href="<?=SITE_TEMPLATE_PATH?>/svg/sprite/sprite.svg#angle-right"></use>
                    </svg></span></a><a class="basket-nav__item js-to-2-step" href="#"><span class="basket-nav__icon">
                    <svg class="icon icon_placeholder">
                      <use xlink:href="<?=SITE_TEMPLATE_PATH?>/svg/sprite/sprite.svg#placeholder"></use>
                    </svg></span><span class="basket-nav__text">выберите магазин партнера</span><span class="basket-nav__arrow">
                    <svg class="icon icon_angle-right">
                      <use xlink:href="<?=SITE_TEMPLATE_PATH?>/svg/sprite/sprite.svg#angle-right"></use>
                    </svg></span></a>
                            <div class="basket-nav__item basket-nav__item_active">
                                <div class="basket-nav__icon">
                                    <svg class="icon icon_id-card">
                                        <use xlink:href="<?=SITE_TEMPLATE_PATH?>/svg/sprite/sprite.svg#id-card"></use>
                                    </svg>
                                </div>
                                <div class="basket-nav__text">Даные покупателя
                                </div>
                                <div class="basket-nav__arrow">
                                    <svg class="icon icon_angle-right">
                                        <use xlink:href="<?=SITE_TEMPLATE_PATH?>/svg/sprite/sprite.svg#angle-right"></use>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="decor">
            <div class="decor__title">данные покупателя
            </div>
            <div class="decor__content">
                <div class="decor__left">
                    <div class="decor__form">
                        <?global $USER;
                        if(!$USER->IsAuthorized()) {?>
                            <div class="decor__form-title">Авторизация:</div>
                            <form class="decor-form decor-form_authorize" action="<?=$this->GetFolder()?>/ajax_auth.php" method="POST" name="AUTH_FORM" enctype="multipart/form-data">
                                <?= bitrix_sessid_post(); ?>
                                <div class="decor-form__error js-auth-error"></div>
                                <div class="decor-form__fields">
                                    <div class="decor-form__field">
                                        <label class="label-style">
                                            <span class="label-style__head">
                                                <span class="label-style__hint">Email</span>
                                            </span>
                                            <input class="input input-style" name="LOGIN" type="text">
                                        </label>
                                    </div>
                                    <div class="decor-form__field">
                                        <label class="label-style">
                                            <span class="label-style__head">
                                                <span class="label-style__hint">Пароль</span>
                                            </span>
                                            <input class="input input-style" name="PASSWORD" type="password">
                                        </label>
                                    </div>
                                    <div class="decor-form__row">
                                        <div class="decor-form__field flex">
                                            <a href="#" class="my-btn js-send-form block">Войти</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?}?>
                        <?if(!$USER->IsAuthorized()) {?>
                            <div class="decor__form-title">Новый пользователь:</div>
                        <?}?>
                        <form class="decor-form" action="<?=$this->GetFolder()?>/ajax_order.php" method="POST" name="ORDER_FORM" enctype="multipart/form-data">
                            <?= bitrix_sessid_post(); ?>
                            <input type="hidden" name="ORDER_PROP_<?=$arResult['ORDER_FIELDS']['SHOP']['ID']?>" value="<?=$arResult['SHOP']['NAME'].': '.$arResult['SHOP']['CITY'].', '.$arResult['SHOP']['ADDRESS']?>">
                            <input type="hidden" name="ORDER_PROP_<?=$arResult['ORDER_FIELDS']['SHOP_ID']['ID']?>" value="<?=$arResult['SHOP']['ID']?>">
                            <input type="hidden" name="ORDER_PROP_<?=$arResult['ORDER_FIELDS']['PROJECT_NAME']['ID']?>" value="<?=$_SESSION['project_name']?>">

                            <div class="decor-form__fields">
                                <?foreach ($arResult['FORM_FIELDS'] as $field){?>
                                    <div class="decor-form__field">
                                        <label class="label-style">
                                        <span class="label-style__head">
                                            <span class="label-style__hint"><?=$arResult['ORDER_FIELDS'][$field]['NAME']?></span>
                                            <span class="label-style__error">Заполните поле</span>
                                        </span>
                                            <? switch ($arResult['ORDER_FIELDS'][$field]['CODE']) {
                                                case 'PHONE':
                                                    ?>
                                                    <input class="input input-style js-phone-mask"
                                                           name="ORDER_PROP_<?= $arResult['ORDER_FIELDS'][$field]['ID'] ?>" value="<?= $arResult['ORDER_FIELDS'][$field]['VALUE'] ?>"
                                                           type="text">
                                                    <?
                                                    break;
                                                case 'EMAIL':
                                                    ?>
                                                    <input class="input input-style"
                                                           name="ORDER_PROP_<?= $arResult['ORDER_FIELDS'][$field]['ID'] ?>" value="<?= $arResult['ORDER_FIELDS'][$field]['VALUE'] ?>"
                                                           type="email">
                                                    <?
                                                    break;
                                                default:
                                                    ?>
                                                    <input class="input input-style"
                                                           name="ORDER_PROP_<?= $arResult['ORDER_FIELDS'][$field]['ID'] ?>"
                                                           value="<?= $arResult['ORDER_FIELDS'][$field]['VALUE'] ?>" type="text">
                                                    <?
                                                    break;
                                            } ?>
                                        </label>
                                    </div>
                                <?}?>
                                <div class="decor-form__field decor-form__field_wide">
                                    <label class="label-style">
                                        <span class="label-style__head">
                                            <span class="label-style__hint">Комментарий</span>
                                            <span class="label-style__error">Заполните поле</span>
                                        </span>
                                        <input class="input input-style" name="ORDER_DESCRIPTION" value="" type="text">
                                    </label>
                                </div>
                                <div class="decor-form__row">
                                    <div class="decor-form__field flex">
                                        <a href="#" class="my-btn js-send-form block">ОФОРМИТЬ ЗАКАЗ</a>
                                    </div>
                                    <div class="decor-form__field decor-form__field_checker">
                                        <div class="checker">
                                            <label class="checker__label">
                                                <input class="input checker__checkbox" name="agree" type="checkbox" checked>
                                                <span class="checker__box checker__box_2">
                                                    <span class="check-icon"></span>
                                                </span>
                                                <span class="checker__text">Я согласен на обработку персональных данных и ознакомился с правилами</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="decor__right">
                    <div class="decor__register-text">Вы автоматически регистрируетесь на нашем сайте, и на указанный e-mail придет письмо с ссылкой для задания пароля для входа в Личный кабинет.
                    </div>
                    <div class="decor__shop">
                        <div class="decor__shop-name">Данные магазина партнера
                        </div>
                        <div class="shops shops_static shops_cards">
                            <div class="shops__block">
                                <div class="shops__head">
                                    <div class="shops__title"><?=$arResult['SHOP']['NAME']?></div>
                                    <?if($arResult['SHOP']['SITE']){?>
                                        <div class="shops__link"><a href="//<?=$arResult['SHOP']['SITE']?>"><?=$arResult['SHOP']['SITE']?></a></div>
                                    <?}?>
                                </div>
                                <div class="shops__content">
                                  <div class="shops__visible">
                                      <?if($arResult['SHOP']['ADDRESS']){?>
                                          <div class="shops__place"><?=$arResult['SHOP']['ADDRESS']?></div>
                                      <?}?>
                                    <div class="shops__info">
                                        <?if($arResult['SHOP']['METRO']){?>
                                            <div class="shops__metro"><?=$arResult['SHOP']['METRO']?></div>
                                        <?}?>
                                        <?if($arResult['SHOP']['PHONE']){?>
                                            <div class="shops__phone"><a href="tel:<?=$arResult['SHOP']['PHONE']?>"><?=$arResult['SHOP']['PHONE']?></a></div>
                                        <?}?>
                                    </div>
                                  </div>
                                  <div class="shops__invisible">
                                        <div class="shops__invisible-bottom">
                                            <div class="shops__show-on-map">
                                              <a href="#" class="my-btn my-btn_stroked my-btn_sm js-to-2-step">Сменить магазин
                                              </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?if($arResult['SHOP']['SITE']){?>
                                    <div class="shops__show">
                                        <div class="my-btn balloon-btn">
                                            <a href="//<?= $arItem['PROPERTIES']['SITE']['DISPLAY_VALUE'] ?>" target="_blank" class="my-btn__text">
                                                <span class="pc-show">Перейти на сайт</span>
                                                <span class="laptop-show">Перейти</span>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- <div class="shops__show">
                                      <a href="//<?=$arResult['SHOP']['SITE']?>" target="_blank" class="my-btn balloon-btn">
                                        <div class="my-btn__text"><span class="pc-show">Перейти на сайт</span><span class="laptop-show">Сайт</span>
                                        </div>
                                      </a>
                                    </div> -->
                                <?}?>
                              </div>
                        </div>
                    </div>
                    <div class="decor__price">
                        <div class="p-price">
                            <div class="p-price__text">итоговая стоимость
                            </div>
                            <div class="p-price__value"><span> <?=$arResult['ORDER_TOTAL_PRICE']?> </span> руб.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>ajaxHandler();</script>