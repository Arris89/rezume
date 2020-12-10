<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use \Bitrix\Main\Application;

?>
<div class="orders">
    <div class="cabinet__subhead">
        <div class="basket-kit">
            <div class="basket-kit__head">
                <div class="basket-kit__head-left">история заказов</div>
                   <div class="basket-kit__head-right">
                    <a class="icon-text icon-text_hover popup-with-move-anim" href="#popup-complaint" style="font-size: 13px; font-weight: bold; color: #86c5c1;">
                   Оставить обращение
                    </a>
               </div>
            </div>
         <!--      <div class="basket-kit__head">
           <div class="basket-kit__head-right">оставить обращение</div>
                     </div> -->
        </div>
    </div>
    <div class="cabinet__orders orders">
        <?if(!empty($arResult['ORDERS'])){?>
            <? foreach ($arResult['ORDERS'] as $arOrder) {?>
                <div class="order orders__item">
                    <div class="order__top">
                      <div class="order__top-title">Заказ № <?=$arOrder['ORDER']['ID']?>
                      </div>
                      <div class="order__top-right">
                        <div class="order__top-date">
                          <div class="param-block param-block_at">
                            <div class="param-block__key">ДАТА:
                            </div>
                            <div class="param-block__val"><?=$arOrder['ORDER']['DATE_INSERT_FORMATED']?>
                            </div>
                          </div>
                        </div>
                        <div class="order__top-shop">
                          <div class="param-block param-block_at">
                            <div class="param-block__key">МАГАЗИН:
                            </div>
                            <div class="param-block__val"><?=$arResult['SHOPS'][$arOrder['ORDER']['PROPS']['SHOP_ID']]['NAME']?>
                            </div>
                          </div>
                        </div>
                        <div class="order__top-phone">
                          <div class="param-block param-block_at">
                            <div class="param-block__key">тел.:
                            </div>
                            <div class="param-block__val"><?=$arResult['SHOPS'][$arOrder['ORDER']['PROPS']['SHOP_ID']]['PHONE']?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="order__body">
                      <div class="m-table m-table_basket m-table_cabinet">
                        <div class="m-table__head">
                          <div class="m-table__head-item m-table-column-1">СОСТАВ КОМПЛЕКТУЮЩИХ
                          </div>
                          <div class="m-table__head-item m-table-column-2">КОЛ-ВО (шт.)
                          </div>
                          <div class="m-table__head-item m-table-column-3">СТОИМОСТЬ
                          </div>
                        </div>
                        <div class="m-table__content">
                          <?foreach ($arOrder['BASKET_ITEMS'] as $complect){?>
                              <div class="m-table__body">
                                  <div class="m-table__body-item m-table-column-1">
                                    <strong><?=$complect['NAME']?></strong>
                                  </div>
                                  <div class="m-table__body-item m-table-column-2">
                                    <div class="m-table__desktop">
                                      <div class="kit-number kit-number_centered">
                                        <div class="kit-number__value">1
                                        </div>
                                      </div>
                                    </div>
                                    <div class="m-table__mob">
                                      <div class="m-table__row">
                                        <div class="m-table__row-left">
                                          <div class="kit-mob">
                                            <div class="kit-mob__price">ЦЕНА:
                                            </div>
                                            <div class="kit-mob__price-val"><strong><?=$complect['PRICE']?> руб.</strong>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="m-table__row-right">кол-во: <strong>1</strong>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="m-table__body-item m-table-column-3"><strong><?=$complect['PRICE']?> руб.</strong>
                                  </div>
                            </div>
                          <?}?>
                        </div>
                      </div>
                    </div>
                    <div class="order__bottom">
                        <div class="cabinet-bottom">
                            <div class="cabinet-bottom__btns">
                                <div class="cabinet-bottom__btn">
                                    <div class="icon-text icon-text_hover" role="button">
                                        <div class="icon-text__icon">
                                            <svg class="icon icon_trash">
                                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/svg/sprite/sprite.svg#trash"></use>
                                            </svg>
                                        </div>
                                        <a href="#order-cancel" class="icon-text__text popup-with-move-anim js-cancel" data-id="<?=$arOrder['ORDER']['ID']?>">Удалить</a>
                                    </div>
                                </div>
                                <div class="cabinet-bottom__btn">
                                    <a href="/personal/order/print/?ID=<?=$arOrder['ORDER']['ID']?>&format=pdf" class="icon-text icon-text_hover">
                                        <div class="icon-text__icon">
                                            <svg class="icon icon_print">
                                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/svg/sprite/sprite.svg#print"></use>
                                            </svg>
                                        </div>
                                        <div class="icon-text__text">Скачать PDF
                                        </div>
                                    </a>
                                </div>
                                <div class="cabinet-bottom__btn">
                                    <a class="icon-text icon-text_hover" download="download" href="/personal/order/print/?ID=<?=$arOrder['ORDER']['ID']?>&format=xls">
                                        <span class="icon-text__icon">
                                    <svg class="icon icon_xls">
                                      <use xlink:href="<?=SITE_TEMPLATE_PATH?>/svg/sprite/sprite.svg#xls"></use>
                                    </svg></span><span class="icon-text__text">Скачать XLS</span></a>
                                </div>
                                <div class="cabinet-bottom__btn">
                                    <a href="<?=$arOrder['ORDER']['URL_TO_DETAIL']?>" class="icon-text icon-text_hover" role="button">
                                        <div class="icon-text__text">Посмотреть детали</div>
                                    </a>
                                </div>
                            </div>
                            <div class="cabinet-bottom__price">
                                <div class="p-price p-price_inline">
                                    <div class="p-price__text">стоимость <br> заказа</div>
                                    <div class="p-price__value"><span> <?=$arOrder['ORDER']['FORMATED_PRICE']?> </span> руб.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="orders__item">
                    <div class="cabinet__info">
                        <div class="cabinet__info-title">Заказ № <?=$arOrder['ORDER']['ID']?></div>
                        <div class="cabinet__info-list">
                            <div class="cabinet__info-date">
                                <div class="param-block">
                                    <div class="param-block__key">дата:</div>
                                    <div class="param-block__val"><?=$arOrder['ORDER']['DATE_INSERT_FORMATED']?></div>
                                </div>
                            </div>
                            <div class="cabinet__info-shop">
                                <div class="param-block">
                                    <div class="param-block__key">Магазин:
                                    </div>
                                    <div class="param-block__val"><?=$arResult['SHOPS'][$arOrder['ORDER']['PROPS']['SHOP_ID']]['NAME']?>
                                    </div>
                                </div>
                            </div>
                            <div class="cabinet__info-phone">
                                <div class="param-block">
                                    <div class="param-block__key">тел.:</div>
                                    <div class="param-block__val"><?=$arResult['SHOPS'][$arOrder['ORDER']['PROPS']['SHOP_ID']]['PHONE']?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cabinet__info">
                        <div class=""><?=$arOrder['ORDER']['PROPS']['PROJECT_NAME']?></div>
                        <div class=""><?=$arOrder['ORDER']['USER_DESCRIPTION']?></div>
                    </div>
                    <div class="cabinet__middle">
                        <?foreach ($arOrder['BASKET_ITEMS'] as $complect){?>
                            <div class="complect">
                                <strong class="complect__name"><?=$complect['NAME']?></strong>
                                <span class="complect__price">Стоимость: <?=$complect['PRICE']?> руб.</span>
                            </div>
                        <?}?>
                    </div>
                    <div class="cabinet__bottom">
                        <div class="cabinet-bottom">
                            <div class="cabinet-bottom__btns">
                                <div class="cabinet-bottom__btn">
                                    <div class="icon-text icon-text_hover" role="button">
                                        <div class="icon-text__icon">
                                            <svg class="icon icon_trash">
                                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/svg/sprite/sprite.svg#trash"></use>
                                            </svg>
                                        </div>
                                        <a href="#order-cancel" class="icon-text__text popup-with-move-anim js-cancel" data-id="<?=$arOrder['ORDER']['ID']?>">Удалить</a>
                                    </div>
                                </div>
                                <div class="cabinet-bottom__btn">
                                    <a href="/personal/order/print/?ID=<?=$arOrder['ORDER']['ID']?>&format=pdf" class="icon-text icon-text_hover">
                                        <div class="icon-text__icon">
                                            <svg class="icon icon_print">
                                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/svg/sprite/sprite.svg#print"></use>
                                            </svg>
                                        </div>
                                        <div class="icon-text__text">Распечатать проект
                                        </div>
                                    </a>
                                </div>
                                <div class="cabinet-bottom__btn">
                                    <a class="icon-text icon-text_hover" download="download" href="/personal/order/print/?ID=<?=$arOrder['ORDER']['ID']?>&format=xls">
                                        <span class="icon-text__icon">
                                    <svg class="icon icon_xls">
                                      <use xlink:href="<?=SITE_TEMPLATE_PATH?>/svg/sprite/sprite.svg#xls"></use>
                                    </svg></span><span class="icon-text__text">Скачать XLS</span></a>
                                </div>
                                <div class="cabinet-bottom__btn">
                                    <a href="<?=$arOrder['ORDER']['URL_TO_DETAIL']?>" class="icon-text icon-text_hover" role="button">
                                        <div class="icon-text__text">Посмотреть детали</div>
                                    </a>
                                </div>
                            </div>
                            <div class="cabinet-bottom__price">
                                <div class="cabinet-bottom__settings">
                                    <div class="cabinet-bottom__setting">
                                        <div class="param-block">
                                            <div class="param-block__key">Магазин:</div>
                                            <div class="param-block__val"><?=$arResult['SHOPS'][$arOrder['ORDER']['PROPS']['SHOP_ID']]['NAME']?></div>
                                        </div>
                                    </div>
                                    <div class="cabinet-bottom__setting">
                                        <div class="param-block">
                                            <div class="param-block__key">тел.:</div>
                                            <div class="param-block__val"><?=$arResult['SHOPS'][$arOrder['ORDER']['PROPS']['SHOP_ID']]['PHONE']?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-price p-price_inline">
                                    <div class="p-price__text">стоимость <br> заказа</div>
                                    <div class="p-price__value"><span> <?=$arOrder['ORDER']['FORMATED_PRICE']?> </span> руб.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            <? } ?>
        </div> 
        <div class="popup popup_review zoom-anim-dialog mfp-hide" id="order-cancel">
            <div class="popup__content">
                <div class="review-popup">
                    <div class="review-popup__title popup-title">Удалить заказ </div>
                    <div class="">Вы уверены, что хотите удалить заказ?</div>

                    <form class="popup-form js-cancel-form" action="/personal/order/" method="post">
                        <input type="hidden" name="CANCEL" value="Y">
                        <?=bitrix_sessid_post()?>
                        <input type="hidden" name="ID" value="4">

                        <div class="popup-form__fields">
                            <div class="popup-form__field">
                                <label class="label-style"><span class="label-style__head"><span class="label-style__hint">Укажите, пожалуйста, причину отмены заказа</span><span class="label-style__error">Заполните поле</span></span>
                                    <textarea class="textarea-style" name="REASON_CANCELED" cols="30" rows="5"></textarea>
                                </label>
                            </div>
                            <div class="popup-form__send">
                                <input class="popup-form__submit my-btn" type="submit" name="action" value="Удалить">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?}else{?>
        <div>
            <p>
                На данный момент вы не сделали еще ни одного заказа.
                Перейдите в раздел <a href="/configurator/">Создать проект</a> или <a href="/specification/">Собрать спецификацию</a> и оформите новый заказ.
            </p>
        </div>
    <?}?>
</div>
<?
// удаление заказа
$arRequest = Application::getInstance()->getContext()->getRequest()->getPostList()->toArray();
if($arRequest['CANCEL'] === 'Y' && $arRequest['ID'] > 0){
    $APPLICATION->IncludeComponent(
        "bitrix:sale.personal.order.cancel",
        "",
        Array(
            "ID" => $arRequest['ID'],
            "PATH_TO_DETAIL" => "",
            "PATH_TO_LIST" => "",
            "SET_TITLE" => "N"
        ),
        $component
    );
}
?>


    <div class="popup popup_review zoom-anim-dialog mfp-hide" id="popup-complaint">
            <div class="popup__content">
                <div class="review-popup">
                    <div class="review-popup__title popup-title">связаться с legrand
                    </div>
                    Если ваш заказ не был обработан в течение 24 часов, сообщите нам!
                    <br><br>
                    <?$APPLICATION->IncludeComponent(
    "4px:main.feedback", 
    "complaint", 
    array(
        "USE_CAPTCHA" => "N",
        "AJAX_MODE"=>"Y",
        "AJAX_OPTION_JUMP" => "N",
        "OK_TEXT" => "Спасибо, ваше сообщение принято.",
        "EMAIL_TO" => "alex@4px.ru",
        "REQUIRED_FIELDS" => array(
            0 => "NAME",
            1 => "MESSAGE",
        ),
        "EVENT_MESSAGE_ID" => array(
            0 => "7",
        ),
        "COMPONENT_TEMPLATE" => "review"
    ),
    false
);?>
                </div>
            </div>
        </div>


        <style>
        	div[id^="wait_"] { display: none !important; background: none !important; border: 0 !important; color: #000000; font-family: Verdana, Arial, sans-serif; font-size: 11px; font-style: normal !important; font-variant: normal !important; font-weight: normal; letter-spacing: normal !important; line-height: normal; padding: 0 !important; position: absolute; text-align: center !important; text-indent: 0 !important; width: 0px !important; height: 0px !important; word-spacing: normal !important; z-index: 0; content: ""; }
        	
        </style>