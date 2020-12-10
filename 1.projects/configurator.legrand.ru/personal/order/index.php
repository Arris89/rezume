<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Личный кабинет");
use \Bitrix\Main\Application;
$arRequest = Application::getInstance()->getContext()->getRequest();
$ORDER_ID = $arRequest->get('ID');
$isCancel = $arRequest->get('CANCEL');

if(!$ORDER_ID || $isCancel === 'Y'){
    // список
    ?>
    <div class="section-cabinet section-style">
        <div class="section-cabinet__container container">
            <div class="cabinet">
                <div class="cabinet__head">
                    <h1 class="cabinet__title page-title">личный кабинет</h1>
                </div>
                <div class="cabinet__content">
                    <div class="cabinet__left">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:sale.personal.order.list",
                            "legrand",
                            Array(
                                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                "CACHE_GROUPS" => "Y",
                                "CACHE_TIME" => "3600",
                                "CACHE_TYPE" => "A",
                                "DEFAULT_SORT" => "DATE_INSERT",
                                "DISALLOW_CANCEL" => "N",
                                "HISTORIC_STATUSES" => array(),
                                "NAV_TEMPLATE" => "",
                                "ORDERS_PER_PAGE" => "20",
                                "PATH_TO_BASKET" => "",
                                "PATH_TO_CANCEL" => "",
                                "PATH_TO_CATALOG" => "/configurator/",
                                "PATH_TO_COPY" => "",
                                "PATH_TO_DETAIL" => "/personal/order/#ID#/",
                                "PATH_TO_PAYMENT" => "payment.php",
                                "REFRESH_PRICES" => "N",
                                "RESTRICT_CHANGE_PAYSYSTEM" => array("0"),
                                "SAVE_IN_SESSION" => "Y",
                                "SET_TITLE" => "N",
                                "STATUS_COLOR_F" => "gray",
                                "STATUS_COLOR_N" => "green",
                                "STATUS_COLOR_PSEUDO_CANCELLED" => "red"
                            )
                        );?>
                    </div>
                    <div class="cabinet__right">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.profile",
                            "pesonal",
                            Array(
                                "CHECK_RIGHTS" => "Y",
                                "SEND_INFO" => "Y",
                                "SET_TITLE" => "N",
                                "USER_PROPERTY" => array(),
                                "USER_PROPERTY_NAME" => ""
                            )
                        );?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<? } else{
    // детальная страница заказа
    ?>
    <?$APPLICATION->IncludeComponent(
        "bitrix:sale.personal.order.detail",
        "legrand",
        Array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "3600",
            "CACHE_TYPE" => "A",
            "CUSTOM_SELECT_PROPS" => array("", ""),
            "DISALLOW_CANCEL" => "N",
            "ID" => $ORDER_ID,
            "PATH_TO_CANCEL" => "",
            "PATH_TO_COPY" => "",
            "PATH_TO_LIST" => "/personal/order/",
            "PATH_TO_PAYMENT" => "payment.php",
            "PICTURE_HEIGHT" => "110",
            "PICTURE_RESAMPLE_TYPE" => "1",
            "PICTURE_WIDTH" => "110",
            "PROP_1" => array(),
            "REFRESH_PRICES" => "N",
            "RESTRICT_CHANGE_PAYSYSTEM" => array("0"),
            "SET_TITLE" => "N"
        )
    );?>
<? } ?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>