<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main,
    Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 * @var array $arResult
 * @var CMain $APPLICATION
 * @var CUser $USER
 * @var SaleOrderAjax $component
 * @var string $templateFolder
 */

$context = Main\Application::getInstance()->getContext();
$request = $context->getRequest();

if (empty($arParams['TEMPLATE_THEME'])) {
    $arParams['TEMPLATE_THEME'] = Main\ModuleManager::isModuleInstalled('bitrix.eshop') ? 'site' : 'blue';
}

if ($arParams['TEMPLATE_THEME'] === 'site') {
    $templateId = Main\Config\Option::get('main', 'wizard_template_id', 'eshop_bootstrap', $component->getSiteId());
    $templateId = preg_match('/^eshop_adapt/', $templateId) ? 'eshop_adapt' : $templateId;
    $arParams['TEMPLATE_THEME'] = Main\Config\Option::get('main', 'wizard_' . $templateId . '_theme_id', 'blue', $component->getSiteId());
}

if (!empty($arParams['TEMPLATE_THEME'])) {
    if (!is_file(Main\Application::getDocumentRoot() . '/bitrix/css/main/themes/' . $arParams['TEMPLATE_THEME'] . '/style.css')) {
        $arParams['TEMPLATE_THEME'] = 'blue';
    }
}

$arParams['ALLOW_USER_PROFILES'] = $arParams['ALLOW_USER_PROFILES'] === 'Y' ? 'Y' : 'N';
$arParams['SKIP_USELESS_BLOCK'] = $arParams['SKIP_USELESS_BLOCK'] === 'N' ? 'N' : 'Y';

if (!isset($arParams['SHOW_ORDER_BUTTON'])) {
    $arParams['SHOW_ORDER_BUTTON'] = 'final_step';
}

$arParams['HIDE_ORDER_DESCRIPTION'] = isset($arParams['HIDE_ORDER_DESCRIPTION']) && $arParams['HIDE_ORDER_DESCRIPTION'] === 'Y' ? 'Y' : 'N';
$arParams['SHOW_TOTAL_ORDER_BUTTON'] = $arParams['SHOW_TOTAL_ORDER_BUTTON'] === 'Y' ? 'Y' : 'N';
$arParams['SHOW_PAY_SYSTEM_LIST_NAMES'] = $arParams['SHOW_PAY_SYSTEM_LIST_NAMES'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_PAY_SYSTEM_INFO_NAME'] = $arParams['SHOW_PAY_SYSTEM_INFO_NAME'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_DELIVERY_LIST_NAMES'] = $arParams['SHOW_DELIVERY_LIST_NAMES'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_DELIVERY_INFO_NAME'] = $arParams['SHOW_DELIVERY_INFO_NAME'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_DELIVERY_PARENT_NAMES'] = $arParams['SHOW_DELIVERY_PARENT_NAMES'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_STORES_IMAGES'] = $arParams['SHOW_STORES_IMAGES'] === 'N' ? 'N' : 'Y';

if (!isset($arParams['BASKET_POSITION']) || !in_array($arParams['BASKET_POSITION'], array('before', 'after'))) {
    $arParams['BASKET_POSITION'] = 'after';
}

$arParams['EMPTY_BASKET_HINT_PATH'] = isset($arParams['EMPTY_BASKET_HINT_PATH']) ? (string)$arParams['EMPTY_BASKET_HINT_PATH'] : '/';
$arParams['SHOW_BASKET_HEADERS'] = $arParams['SHOW_BASKET_HEADERS'] === 'Y' ? 'Y' : 'N';
$arParams['HIDE_DETAIL_PAGE_URL'] = isset($arParams['HIDE_DETAIL_PAGE_URL']) && $arParams['HIDE_DETAIL_PAGE_URL'] === 'Y' ? 'Y' : 'N';
$arParams['DELIVERY_FADE_EXTRA_SERVICES'] = $arParams['DELIVERY_FADE_EXTRA_SERVICES'] === 'Y' ? 'Y' : 'N';
$arParams['SHOW_COUPONS_BASKET'] = $arParams['SHOW_COUPONS_BASKET'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_COUPONS_DELIVERY'] = $arParams['SHOW_COUPONS_DELIVERY'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_COUPONS_PAY_SYSTEM'] = $arParams['SHOW_COUPONS_PAY_SYSTEM'] === 'Y' ? 'Y' : 'N';
$arParams['SHOW_NEAREST_PICKUP'] = $arParams['SHOW_NEAREST_PICKUP'] === 'Y' ? 'Y' : 'N';
$arParams['DELIVERIES_PER_PAGE'] = isset($arParams['DELIVERIES_PER_PAGE']) ? intval($arParams['DELIVERIES_PER_PAGE']) : 9;
$arParams['PAY_SYSTEMS_PER_PAGE'] = isset($arParams['PAY_SYSTEMS_PER_PAGE']) ? intval($arParams['PAY_SYSTEMS_PER_PAGE']) : 9;
$arParams['PICKUPS_PER_PAGE'] = isset($arParams['PICKUPS_PER_PAGE']) ? intval($arParams['PICKUPS_PER_PAGE']) : 5;
$arParams['SHOW_PICKUP_MAP'] = $arParams['SHOW_PICKUP_MAP'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_MAP_IN_PROPS'] = $arParams['SHOW_MAP_IN_PROPS'] === 'Y' ? 'Y' : 'N';
$arParams['USE_YM_GOALS'] = $arParams['USE_YM_GOALS'] === 'Y' ? 'Y' : 'N';
$arParams['USE_ENHANCED_ECOMMERCE'] = isset($arParams['USE_ENHANCED_ECOMMERCE']) && $arParams['USE_ENHANCED_ECOMMERCE'] === 'Y' ? 'Y' : 'N';
$arParams['DATA_LAYER_NAME'] = isset($arParams['DATA_LAYER_NAME']) ? trim($arParams['DATA_LAYER_NAME']) : 'dataLayer';
$arParams['BRAND_PROPERTY'] = isset($arParams['BRAND_PROPERTY']) ? trim($arParams['BRAND_PROPERTY']) : '';

$useDefaultMessages = !isset($arParams['USE_CUSTOM_MAIN_MESSAGES']) || $arParams['USE_CUSTOM_MAIN_MESSAGES'] != 'Y';

if ($useDefaultMessages || !isset($arParams['MESS_AUTH_BLOCK_NAME'])) {
    $arParams['MESS_AUTH_BLOCK_NAME'] = Loc::getMessage('AUTH_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_REG_BLOCK_NAME'])) {
    $arParams['MESS_REG_BLOCK_NAME'] = Loc::getMessage('REG_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_BASKET_BLOCK_NAME'])) {
    $arParams['MESS_BASKET_BLOCK_NAME'] = Loc::getMessage('BASKET_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_REGION_BLOCK_NAME'])) {
    $arParams['MESS_REGION_BLOCK_NAME'] = Loc::getMessage('REGION_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_PAYMENT_BLOCK_NAME'])) {
    $arParams['MESS_PAYMENT_BLOCK_NAME'] = Loc::getMessage('PAYMENT_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_DELIVERY_BLOCK_NAME'])) {
    $arParams['MESS_DELIVERY_BLOCK_NAME'] = Loc::getMessage('DELIVERY_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_BUYER_BLOCK_NAME'])) {
    $arParams['MESS_BUYER_BLOCK_NAME'] = Loc::getMessage('BUYER_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_BACK'])) {
    $arParams['MESS_BACK'] = Loc::getMessage('BACK_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_FURTHER'])) {
    $arParams['MESS_FURTHER'] = Loc::getMessage('FURTHER_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_EDIT'])) {
    $arParams['MESS_EDIT'] = Loc::getMessage('EDIT_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_ORDER'])) {
    $arParams['MESS_ORDER'] = $arParams['~MESS_ORDER'] = Loc::getMessage('ORDER_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_PRICE'])) {
    $arParams['MESS_PRICE'] = Loc::getMessage('PRICE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_PERIOD'])) {
    $arParams['MESS_PERIOD'] = Loc::getMessage('PERIOD_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_NAV_BACK'])) {
    $arParams['MESS_NAV_BACK'] = Loc::getMessage('NAV_BACK_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_NAV_FORWARD'])) {
    $arParams['MESS_NAV_FORWARD'] = Loc::getMessage('NAV_FORWARD_DEFAULT');
}

$useDefaultMessages = !isset($arParams['USE_CUSTOM_ADDITIONAL_MESSAGES']) || $arParams['USE_CUSTOM_ADDITIONAL_MESSAGES'] != 'Y';

if ($useDefaultMessages || !isset($arParams['MESS_PRICE_FREE'])) {
    $arParams['MESS_PRICE_FREE'] = Loc::getMessage('PRICE_FREE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_ECONOMY'])) {
    $arParams['MESS_ECONOMY'] = Loc::getMessage('ECONOMY_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_REGISTRATION_REFERENCE'])) {
    $arParams['MESS_REGISTRATION_REFERENCE'] = Loc::getMessage('REGISTRATION_REFERENCE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_AUTH_REFERENCE_1'])) {
    $arParams['MESS_AUTH_REFERENCE_1'] = Loc::getMessage('AUTH_REFERENCE_1_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_AUTH_REFERENCE_2'])) {
    $arParams['MESS_AUTH_REFERENCE_2'] = Loc::getMessage('AUTH_REFERENCE_2_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_AUTH_REFERENCE_3'])) {
    $arParams['MESS_AUTH_REFERENCE_3'] = Loc::getMessage('AUTH_REFERENCE_3_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_ADDITIONAL_PROPS'])) {
    $arParams['MESS_ADDITIONAL_PROPS'] = Loc::getMessage('ADDITIONAL_PROPS_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_USE_COUPON'])) {
    $arParams['MESS_USE_COUPON'] = Loc::getMessage('USE_COUPON_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_COUPON'])) {
    $arParams['MESS_COUPON'] = Loc::getMessage('COUPON_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_PERSON_TYPE'])) {
    $arParams['MESS_PERSON_TYPE'] = Loc::getMessage('PERSON_TYPE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_SELECT_PROFILE'])) {
    $arParams['MESS_SELECT_PROFILE'] = Loc::getMessage('SELECT_PROFILE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_REGION_REFERENCE'])) {
    $arParams['MESS_REGION_REFERENCE'] = Loc::getMessage('REGION_REFERENCE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_PICKUP_LIST'])) {
    $arParams['MESS_PICKUP_LIST'] = Loc::getMessage('PICKUP_LIST_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_NEAREST_PICKUP_LIST'])) {
    $arParams['MESS_NEAREST_PICKUP_LIST'] = Loc::getMessage('NEAREST_PICKUP_LIST_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_SELECT_PICKUP'])) {
    $arParams['MESS_SELECT_PICKUP'] = Loc::getMessage('SELECT_PICKUP_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_INNER_PS_BALANCE'])) {
    $arParams['MESS_INNER_PS_BALANCE'] = Loc::getMessage('INNER_PS_BALANCE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_ORDER_DESC'])) {
    $arParams['MESS_ORDER_DESC'] = Loc::getMessage('ORDER_DESC_DEFAULT');
}

$useDefaultMessages = !isset($arParams['USE_CUSTOM_ERROR_MESSAGES']) || $arParams['USE_CUSTOM_ERROR_MESSAGES'] != 'Y';

if ($useDefaultMessages || !isset($arParams['MESS_PRELOAD_ORDER_TITLE'])) {
    $arParams['MESS_PRELOAD_ORDER_TITLE'] = Loc::getMessage('PRELOAD_ORDER_TITLE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_SUCCESS_PRELOAD_TEXT'])) {
    $arParams['MESS_SUCCESS_PRELOAD_TEXT'] = Loc::getMessage('SUCCESS_PRELOAD_TEXT_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_FAIL_PRELOAD_TEXT'])) {
    $arParams['MESS_FAIL_PRELOAD_TEXT'] = Loc::getMessage('FAIL_PRELOAD_TEXT_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_DELIVERY_CALC_ERROR_TITLE'])) {
    $arParams['MESS_DELIVERY_CALC_ERROR_TITLE'] = Loc::getMessage('DELIVERY_CALC_ERROR_TITLE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_DELIVERY_CALC_ERROR_TEXT'])) {
    $arParams['MESS_DELIVERY_CALC_ERROR_TEXT'] = Loc::getMessage('DELIVERY_CALC_ERROR_TEXT_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_PAY_SYSTEM_PAYABLE_ERROR'])) {
    $arParams['MESS_PAY_SYSTEM_PAYABLE_ERROR'] = Loc::getMessage('PAY_SYSTEM_PAYABLE_ERROR_DEFAULT');
}

$scheme = $request->isHttps() ? 'https' : 'http';

switch (LANGUAGE_ID) {
    case 'ru':
        $locale = 'ru-RU';
        break;
    case 'ua':
        $locale = 'ru-UA';
        break;
    case 'tk':
        $locale = 'tr-TR';
        break;
    default:
        $locale = 'en-US';
        break;
}


?>
    <NOSCRIPT>
        <div style="color:red"><?= Loc::getMessage('SOA_NO_JS') ?></div>
    </NOSCRIPT>
<?

if (strlen($request->get('ORDER_ID')) > 0) {
    include(Main\Application::getDocumentRoot() . $templateFolder . '/confirm.php');
} elseif ($arParams['DISABLE_BASKET_REDIRECT'] === 'Y' && $arResult['SHOW_EMPTY_BASKET']) {
    include(Main\Application::getDocumentRoot() . $templateFolder . '/empty.php');
} else {
    $hideDelivery = empty($arResult['DELIVERY']);
    ?>


    <?


    foreach ($arResult['ORDER_DATA']['QUANTITY_LIST'] as $key => $value) {
        $quanSum += $value;
    }


    ?>


    <div class="container order">
        <div class="checkout">
            <div class="basket-wrap basket-order">
                <div class="title"><h2>Оформление заказа</h2></div>
                <div class="separate-line"></div>


                <div id="checkout-contact-form" class="wrap">


                    <div class="checkout-step step-contactinfo items">
                        <form class="checkout-form" method="post" action="" id="contactinfo-form">


                            <div class="sub-title">Личная информация</div>


                            <?
                            //получение метостоположений для выпадающего списка
                            $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM");
                            $arFilter = Array("IBLOCK_ID" => IBLOCK_ID__MESTO, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
                            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 50), $arSelect);
                            while ($ob = $res->GetNextElement()) {
                                $arFields = $ob->GetFields();
                                $Region[] = "<option value=" . $arFields["NAME"] . ">" . $arFields["NAME"] . "</option>";
                            }


                            ?>



                            <?
                            if ($USER->IsAuthorized())
                            {


                            global $USER;
                            $arFilter = array('ID' => $USER->GetID());

                            $arRes = CUser::GetList($by, $desc, $arFilter, $arParams);
                            if ($res = $arRes->Fetch()) {
                            }


                            ?>


                            <div id="checkout-contact-form" class="wrap">

                                <div class="part first">
                                    <input type="text" value="<?= $res['NAME'] ?>" placeholder="Имя" class="ordname">
                                    <input type="text" value="<?= $res['LAST_NAME'] ?>" placeholder="Фамилия"
                                           class="ordfamilya">
                                </div>
                                <div class="part">
                                    <input type="text" value="<?= $res['PERSONAL_PHONE'] ?>" placeholder="Телефон*"
                                           class="ordtel">
                                    <input type="text" value="<?= $res['EMAIL'] ?>" placeholder="E-mail*"
                                           class="ordemail">
                                    <p></p>
                                </div>
                                <div class="part">
                                    <textarea autocomplete="off" name="comment" placeholder="Комментарий"
                                              class="ordcomment"></textarea>
                                </div>
                            </div>
                    </div>


                    <div class="separate-line"></div>


                    <div class="checkout-step step-contactinfo items">
                        <div class="contactinfo sub-title">
                            Адрес доставки
                        </div>
                        <div class="wa-form wa-address js-first">
                            <div class="part first">
                                <input type="text" placeholder="Город" value="<?= $res['PERSONAL_CITY'] ?>"
                                       class="ordgorod">
                                <input type="text" placeholder="Улица" value="<?= $res['PERSONAL_STREET'] ?>"
                                       class="ordstreet">


                                <select name="list1" class="ordgorod" style="margin-bottom: 7px;
    padding: 0 25px;
    width: 346px;
    box-sizing: border-box;
    line-height: 52px;
    font-size: 20px;
    font-style: italic;
    border: 2px solid #000;
    border-radius: 3px;
    height: 56px;">


                                    <?

                                    foreach ($Region as $key) {
                                        echo $key;
                                    }


                                    ?>

                                </select>


                            </div>


                            <div class="part">
                                <input type="text" placeholder="Дом, Квартира" value="" class="orddom">
                                <input type="text" placeholder="Индекс" id="zip_code"
                                       value="<?= $res['PERSONAL_ZIP'] ?>" class="ordpostindex">
                            </div>
                            <div class="part">

                            </div>
                        </div>


                        <?
                        }
                        else
                        {
                        ?>
                        <ul class="checkout-options payment">
                            <li>
                                <label class="prettycheckbox1">
                                    <div class="position-labelright clearfix prettyradio labelright  blue">
                                        <input id="newcust" type="radio" name="customer" class="prettyCheckable1"
                                               checked>
                                        <div class="checkpay"></div>
                                        Я новый пользователь
                                </label>
                    </div>
                    </li>
                    <li>
                        <label class="prettycheckbox1">
                            <div class="position-labelright clearfix prettyradio labelright  blue">
                                <input id="oldcust" type="radio" name="customer" data-name="newcustomer"
                                       class="prettyCheckable1">
                                <div class="checkpay"></div>
                                У меня уже есть аккаунт
                        </label>
                </div>
                </li>
                </ul>


                <div id="checkout-contact-form" class="wrap">

                    <div class="part first">
                        <input type="text" value="" placeholder="Имя" class="ordname">
                        <input type="text" value="" placeholder="Фамилия" class="ordfamilya">
                    </div>
                    <div class="part">
                        <input type="text" value="" placeholder="Телефон*" class="ordtel">
                        <input type="text" value="" placeholder="E-mail*" class="ordemail">
                        <p></p>
                    </div>
                    <div class="part">
                        <textarea autocomplete="off" name="comment" placeholder="Комментарий"
                                  class="ordcomment"></textarea>
                    </div>
                </div>
            </div>


            <div class="personal-data-wrap order">
                <label class="prettycheckbox">
                    <input type="checkbox" class="prettyCheckable" name="usecustomer" data-cust="1">
                    <div class="checkb"></div>
                    Зарегистрироваться как постоянный покупатель
                </label>
            </div>

            <div class="separate-line"></div>


            <div class="checkout-step step-contactinfo items">
                <div class="contactinfo sub-title">
                    Адрес доставки
                </div>
                <div class="wa-form wa-address js-first">
                    <div class="part first">
                        <input type="text" placeholder="Город" value="" class="ordgorod">
                        <input type="text" placeholder="Улица" value="" class="ordstreet">

                        <select name="list1" class="ordgorod" style="margin-bottom: 7px;
    padding: 0 25px;
    width: 346px;
    box-sizing: border-box;
    line-height: 52px;
    font-size: 20px;
    font-style: italic;
    border: 2px solid #000;
    border-radius: 3px;
    height: 56px;">


                            <?

                            foreach ($Region as $key) {
                                echo $key;
                            }


                            ?>

                        </select>

                    </div>
                    <div class="part">
                        <input type="text" placeholder="Дом, Квартира" value="" class="orddom">
                        <input type="text" placeholder="Индекс" id="zip_code" value="" class="ordpostindex">
                    </div>
                    <div class="part">
                    </div>
                </div>

                <?
                } ?>

                <div class="personal-data-wrap order">
                    <label class="prettycheckbox">
                        <input type="checkbox" class="prettyCheckable" id="sogldata">
                        <div class="checkb"></div>
                        Подтверждаю согласие на обработку персональных данных
                    </label>
                </div>
            </div>


            <div class="separate-line"></div>
            <div class="item">
                <div class="sub-title">Доставка</div>
                <ul class="checkout-options payment">
                    <?
                    $check = 1;
                    foreach ($arResult['DELIVERY'] as $key) {
                        if ($check == 1) {
                            echo
                                '<li>
							<label class="prettycheckbox1">
							 <div class="position-labelright clearfix prettyradio labelright  blue">
							<input deliv-id="' . $key['ID'] . '" type="radio" name="delivery" class="prettyCheckable1" checked>
							<div class="checkpay"></div>
							 ' . $key['NAME'] . '
							 </label>
							 </div>
							 </li>';
                        } else {
                            echo
                                '<li>
							<label class="prettycheckbox1">
							<div class="position-labelright clearfix prettyradio labelright  blue">
							<input deliv-id="' . $key['ID'] . '" type="radio" name="delivery" class="prettyCheckable1">
							<div class="checkpay"></div>
							 ' . $key['NAME'] . '
							 </label>
							 </div>
							 </li>';
                        }
                        $check++;
                    }
                    ?>
                </ul>
                <div class="clear"></div>
            </div>


            <div class="separate-line"></div>
            <div class="item">
                <div class="sub-title">Оплата</div>
                <div id="step-payment" class="wrap">
                    <div class="checkout-content" data-step-id="payment">
                        <ul class="checkout-options payment">

                            <?
                            $checkpay = 1;

                            foreach ($arResult['PAY_SYSTEM'] as $key1) {
                                if ($checkpay == 1) {
                                    echo
                                        '<li>
							<label class="prettycheckbox1">
							<div class="position-labelright clearfix prettyradio labelright  blue">
							<input pay-id="' . $key1['ID'] . '" type="radio" name="payment" class="prettyCheckable1" checked>
							<div class="checkpay">
							</div>
							' . $key1['NAME'] . '</label>
							</div>
							</li>';
                                } else {
                                    echo
                                        '<li>
							<label class="prettycheckbox1"><div class="position-labelright clearfix prettyradio labelright  blue">
							<input pay-id="' . $key1['ID'] . '" type="radio" name="payment" class="prettyCheckable1">
							<div class="checkpay"></div>
							' . $key1['NAME'] . '
							</label>
							</div>
							</li>';
                                }
                                $checkpay++;
                            }
                            ?>

                        </ul>
                    </div>
                </div>
                <div class="clear"></div>

            </div>


            <div class="separate-line"></div>
            <div class="sub-title">Подтверждение заказа</div>
            <div class="basket-total">
                Товаров в корзине: <strong class="quantity"><?= $quanSum; ?></strong> <br>
                Сумма: <strong><? print_r($arResult['JS_DATA']['TOTAL']['ORDER_PRICE_FORMATED']); ?></strong><br>
                Стоимость доставки: <strong><? print_r($arResult['JS_DATA']['TOTAL']['DELIVERY_PRICE']); ?></strong> р.
            </div>
            <div class="basket-total-sum">Общая сумма заказа: <strong>
                    <? print_r($arResult['JS_DATA']['TOTAL']['ORDER_TOTAL_PRICE']); ?></strong> р.
            </div>

            <div class="hint error contact" id="error-mail" style="display: none;">E-mail введен некорректно</div>
            <div class="hint error contact" id="error-mail-em" style="display: none;">E-mail не может быть пустым</div>
            <div class="hint error contact" id="error-tel" style="display: none;">Необходимо заполнить все поля</div>
            <div class="hint error contact" id="error-personal" style="display: none;">Необходимо принять условия
                обработки персональных данных
            </div>

            <div class="btn-wrap">
                <a href="javascript:void(0)" class="submit"><span>Подтвердить заказ</span></a>
            </div>
        </div>


        </form>
    </div>
    </div>


    <div class="checkout-step">

    </div>
    </div>
    </div>
    </div>


    <?
    /*код создания заказа*/
    foreach ($arResult['BASKET_ITEMS'] as $key) {

        $products[] = ['PRODUCT_ID' => $key['PRODUCT_ID'], 'NAME' => $key['NAME'], 'PRICE' => $key['PRICE'], 'CURRENCY' => 'RUB', 'QUANTITY' => $key['QUANTITY']];
    }


    $js_obj = json_encode($products);


    $USER1 = new CUser;


    if ($USER->IsAuthorized()) {

        $js_user = $USER1->GetID();

        print "<script language='javascript'>var obj=$js_obj; var user=$js_user; </script>";

    } else {

        print "<script language='javascript'>var obj=$js_obj;
	window.user='new'; </script>";

    }


    ?>

    <script>


        $(document).ready(function () {

            window.locm = $('select[name=list1]').val();

            $("select").change(function () {
                window.locm = $(this).val();

            });
        });


        $(document).ready(function () {
            $('.submit').on('click', function () {


                /*Валидация e-mail*/
                var pattern = /^[a-z0-9_-]+@[a-z0-9-]+\.([a-z]{1,6}\.)?[a-z]{2,6}$/i;
                var mail = $('.ordemail');
                if (mail.val() != '') {
                    if (mail.val().search(pattern) == 0) {
                        window.em = true;
                        $('#error-mail').css('display', 'none');
                        $('#error-mail-em').css('display', 'none');
                        $('.ordemail').css('border-color', 'black');

                    } else {
                        $('#error-mail').css('display', '');
                        $('.ordemail').css('border-color', 'red');

                        $('#error-mail-em').css('display', 'none');
                        /*E-mail не подходит*/
                        window.em = false;
                    }
                } else {
                    $('#error-mail-em').css('display', '');
                    $('.ordemail').css('border-color', 'red');
                    $('#error-mail').css('display', 'none');

                    /*Поле e-mail не должно быть пустым!*/
                    window.em = false;
                }


                var telIn = $('.ordtel').val();

                if (telIn == "") {
                    $('#error-tel').css('display', '');
                    $('.ordtel').css('border-color', 'red');
                }


                else {

                    $('#error-tel').css('display', 'none');
                    $('.ordtel').css('border-color', 'black');
                }


                var sogl = $("#sogldata").prop("checked");

                if (sogl == true) {

                    $('#error-personal').css('display', 'none');
                }
                else {
                    $('#error-personal').css('display', '');
                }

                if (!telIn == "" && sogl == true && em == true) {


                    var infox =
                        'Данные заказа: Имя:' + $('.ordname').val() +
                        ' Фамилия: ' + $('.ordfamilya').val() +
                        ' Телефон: ' + $('.ordtel').val() +
                        ' E-mail: ' + $('.ordemail').val() +

                        ' Комментарии: ' + $('.ordcomment').val() +
                        ' Область: ' + locm +
                        ' Город: ' + $('.ordgorod').val() +
                        ' Улица: ' + $('.ordstreet').val() +
                        ' Дом: ' + $('.orddom').val() +
                        ' Индекс:' + $('.ordpostindex').val() + '';

                    var pay = $('input[name="payment"]:radio:checked').attr('pay-id');


                    var delivery = $('input[name="delivery"]:radio:checked').attr('deliv-id');

                    var customer = $('input[name="usecustomer"]:checkbox:checked').attr('data-cust');


                    var name = $('.ordname').val();

                    var lastname = $('.ordfamilya').val();

                    var phone = $('.ordtel').val();

                    var email = $('.ordemail').val();


                    $.post('/ajax/order.php', {
                            obj,
                            infox,
                            delivery,
                            pay,
                            customer,
                            email,
                            phone,
                            lastname,
                            name,
                            user,
                            locm
                        },
                        function (sol) {

                            window.name = sol;
                            window.location.replace('/personal/order/success.php');

                        })

                }


            });
        });
    </script>


    <div id="bx-soa-saved-files" style="display:none"></div>
    <div id="bx-soa-soc-auth-services" style="display:none">
        <?
        $arServices = false;
        $arResult['ALLOW_SOCSERV_AUTHORIZATION'] = Main\Config\Option::get('main', 'allow_socserv_authorization', 'Y') != 'N' ? 'Y' : 'N';
        $arResult['FOR_INTRANET'] = false;

        if (Main\ModuleManager::isModuleInstalled('intranet') || Main\ModuleManager::isModuleInstalled('rest'))
            $arResult['FOR_INTRANET'] = true;

        if (Main\Loader::includeModule('socialservices') && $arResult['ALLOW_SOCSERV_AUTHORIZATION'] === 'Y') {
            $oAuthManager = new CSocServAuthManager();
            $arServices = $oAuthManager->GetActiveAuthServices(array(
                'BACKURL' => $this->arParams['~CURRENT_PAGE'],
                'FOR_INTRANET' => $arResult['FOR_INTRANET'],
            ));

            if (!empty($arServices)) {
                $APPLICATION->IncludeComponent(
                    'bitrix:socserv.auth.form',
                    'flat',
                    array(
                        'AUTH_SERVICES' => $arServices,
                        'AUTH_URL' => $arParams['~CURRENT_PAGE'],
                        'POST' => $arResult['POST'],
                    ),
                    $component,
                    array('HIDE_ICONS' => 'Y')
                );
            }
        }
        ?>
    </div>


    <?
    $signer = new Main\Security\Sign\Signer;
    $signedParams = $signer->sign(base64_encode(serialize($arParams)), 'sale.order.ajax');
    $messages = Loc::loadLanguageFile(__FILE__);
    ?>

    <script>
        <?

        $city = \Bitrix\Sale\Location\TypeTable::getList(array('filter' => array('=CODE' => 'CITY'), 'select' => array('ID')))->fetch();
        ?>
        BX.saleOrderAjax.init(<?=CUtil::PhpToJSObject(array(
            'source' => $component->getPath() . '/get.php',
            'cityTypeId' => intval($city['ID']),
            'messages' => array(
                'otherLocation' => '--- ' . Loc::getMessage('SOA_OTHER_LOCATION'),
                'moreInfoLocation' => '--- ' . Loc::getMessage('SOA_NOT_SELECTED_ALT'), // spike: for children of cities we place this prompt
                'notFoundPrompt' => '<div class="-bx-popup-special-prompt">' . Loc::getMessage('SOA_LOCATION_NOT_FOUND') . '.<br />' . Loc::getMessage('SOA_LOCATION_NOT_FOUND_PROMPT', array(
                        '#ANCHOR#' => '<a href="javascript:void(0)" class="-bx-popup-set-mode-add-loc">',
                        '#ANCHOR_END#' => '</a>'
                    )) . '</div>'
            )
        ))?>);
    </script>
    <?
    if ($arParams['SHOW_PICKUP_MAP'] === 'Y' || $arParams['SHOW_MAP_IN_PROPS'] === 'Y') {
        if ($arParams['PICKUP_MAP_TYPE'] === 'yandex') {
            $this->addExternalJs($templateFolder . '/scripts/yandex_maps.js');
            ?>
            <script src="<?= $scheme ?>://api-maps.yandex.ru/2.1.50/?load=package.full&lang=<?= $locale ?>"></script>
            <script>
                (function bx_ymaps_waiter() {
                    if (typeof ymaps !== 'undefined' && BX.Sale && BX.Sale.OrderAjaxComponent)
                        ymaps.ready(BX.proxy(BX.Sale.OrderAjaxComponent.initMaps, BX.Sale.OrderAjaxComponent));
                    else
                        setTimeout(bx_ymaps_waiter, 100);
                })();
            </script>
            <?
        }

        if ($arParams['PICKUP_MAP_TYPE'] === 'google') {
            $this->addExternalJs($templateFolder . '/scripts/google_maps.js');
            $apiKey = htmlspecialcharsbx(Main\Config\Option::get('fileman', 'google_map_api_key', ''));
            ?>
            <script async defer
                    src="<?= $scheme ?>://maps.googleapis.com/maps/api/js?key=<?= $apiKey ?>&callback=bx_gmaps_waiter">
            </script>
            <script>
                function bx_gmaps_waiter() {
                    if (BX.Sale && BX.Sale.OrderAjaxComponent)
                        BX.Sale.OrderAjaxComponent.initMaps();
                    else
                        setTimeout(bx_gmaps_waiter, 100);
                }
            </script>
            <?
        }
    }

    if ($arParams['USE_YM_GOALS'] === 'Y') {
        ?>
        <script>
            (function bx_counter_waiter(i) {
                i = i || 0;
                if (i > 50)
                    return;

                if (typeof window['yaCounter<?=$arParams['YM_GOALS_COUNTER']?>'] !== 'undefined')
                    BX.Sale.OrderAjaxComponent.reachGoal('initialization');
                else
                    setTimeout(function () {
                        bx_counter_waiter(++i)
                    }, 100);
            })();
        </script>
        <?
    }
}
?>