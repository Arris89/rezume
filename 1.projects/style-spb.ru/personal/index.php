<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Моя учетная запись");
?>
<style>
    
   .addresses-lists {
  margin-bottom: 30px; }
ul.myaccount-link-list li {
  overflow: hidden;
  padding-bottom: 10px; }
ul.myaccount-link-list li a {
    display: block;
    overflow: hidden;
    font: 600 16px/20px "Conv_EngraversGothic BT", sans-serif;
    color: #555454;
    text-shadow: 0px 1px white;
    text-transform: uppercase;
    text-decoration: none;
    position: relative;
    border: 1px solid;
    border-color: #cacaca #b7b7b7 #9a9a9a #b7b7b7;
    background-image: url('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4gPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PGxpbmVhckdyYWRpZW50IGlkPSJncmFkIiBncmFkaWVudFVuaXRzPSJvYmplY3RCb3VuZGluZ0JveCIgeDE9IjAuNSIgeTE9IjAuMCIgeDI9IjAuNSIgeTI9IjEuMCI+PHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2Y3ZjdmNyIvPjxzdG9wIG9mZnNldD0iMTAwJSIgc3RvcC1jb2xvcj0iI2VkZWRlZCIvPjwvbGluZWFyR3JhZGllbnQ+PC9kZWZzPjxyZWN0IHg9IjAiIHk9IjAiIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JhZCkiIC8+PC9zdmc+IA==');
    background-size: 100%;
    background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #f7f7f7), color-stop(100%, #ededed));
    background-image: -moz-linear-gradient(#f7f7f7, #ededed);
    background-image: -webkit-linear-gradient(#f7f7f7, #ededed);
    background-image: linear-gradient(#f7f7f7, #ededed);
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    border-radius: 4px; }
ul.myaccount-link-list li a i {
      font-size: 25px;
      color: #fd7e01;
      position: absolute;
      left: 0;
      top: 0;
      width: 52px;
      height: 100%;
      padding: 10px 0 0 0;
      text-align: center;
      border: 1px solid #fff;
      -moz-border-radius-topleft: 4px;
      -webkit-border-top-left-radius: 4px;
      border-top-left-radius: 4px;
      -moz-border-radius-bottomleft: 4px;
      -webkit-border-bottom-left-radius: 4px;
      border-bottom-left-radius: 4px; }
  ul.myaccount-link-list li a span {
      display: block;
      padding: 13px 15px 15px 17px;
      overflow: hidden;
      border: 1px solid;
      margin-left: 52px;
      border-color: #fff #fff #fff #c8c8c8;
      -moz-border-radius-topright: 5px;
      -webkit-border-top-right-radius: 5px;
      border-top-right-radius: 5px;
      -moz-border-radius-bottomright: 5px;
      -webkit-border-bottom-right-radius: 5px;
      border-bottom-right-radius: 5px; }
 ul.myaccount-link-list li a:hover {
      filter: none;
      background: #e7e7e7;
      border-color: #9e9e9e #c2c2c2 #c8c8c8 #c2c2c2; }

/*# sourceMappingURL=my-account.css.map */

</style>
<?
/* $APPLICATION->IncludeComponent(
    "bitrix:sale.personal.section",
    "style",
    Array(
        "ACCOUNT_PAYMENT_ELIMINATED_PAY_SYSTEMS" => array("0"),
        "ACCOUNT_PAYMENT_PERSON_TYPE" => "1",
        "ACCOUNT_PAYMENT_SELL_SHOW_FIXED_VALUES" => "Y",
        "ACCOUNT_PAYMENT_SELL_TOTAL" => array("100", "200", "500", "1000", "5000", ""),
        "ACCOUNT_PAYMENT_SELL_USER_INPUT" => "Y",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "3600",
        "CACHE_TYPE" => "A",
        "CHECK_RIGHTS_PRIVATE" => "N",
        "COMPATIBLE_LOCATION_MODE_PROFILE" => "N",
        "CUSTOM_PAGES" => "",
        "CUSTOM_SELECT_PROPS" => array(""),
        "NAV_TEMPLATE" => "",
        "ORDER_HISTORIC_STATUSES" => array("F"),
        "PATH_TO_BASKET" => "/personal/cart",
        "PATH_TO_CATALOG" => "/catalog/",
        "PATH_TO_CONTACT" => "/about/contacts",
        "PATH_TO_PAYMENT" => "/personal/order/payment/",
        "PER_PAGE" => "20",
        "PROP_1" => array(),
        "PROP_2" => array(),
        "SAVE_IN_SESSION" => "Y",
        "SEF_FOLDER" => "/personal/",
        "SEF_MODE" => "Y",
        "SEF_URL_TEMPLATES" => array(
            "account" => "account/",
            "index" => "index.php",
            "order_cancel" => "cancel/#ID#",
            "order_detail" => "orders/#ID#",
            "orders" => "orders/",
            "private" => "private/",
            "profile" => "profiles/",
            "profile_detail" => "profiles/#ID#",
            "subscribe" => "subscribe/"
        ),
        "SEND_INFO_PRIVATE" => "N",
        "SET_TITLE" => "Y",
        "SHOW_ACCOUNT_COMPONENT" => "Y",
        "SHOW_ACCOUNT_PAGE" => "Y",
        "SHOW_ACCOUNT_PAY_COMPONENT" => "Y",
        "SHOW_BASKET_PAGE" => "Y",
        "SHOW_CONTACT_PAGE" => "Y",
        "SHOW_ORDER_PAGE" => "Y",
        "SHOW_PRIVATE_PAGE" => "Y",
        "SHOW_PROFILE_PAGE" => "Y",
        "ALLOW_INNER" => "N",
        "ONLY_INNER_FULL" => "N",
        "SHOW_SUBSCRIBE_PAGE" => "Y",
        "USER_PROPERTY_PRIVATE" => array(),
        "USE_AJAX_LOCATIONS_PROFILE" => "N"
    )
);*/


if($USER->IsAuthorized()) {
 ?>
    <div class="columns-container">
        <div id="columns" class="container">

            <!-- Breadcrumb -->
            <div class="breadcrumb clearfix">
           
<?$APPLICATION->IncludeComponent("bitrix:breadcrumb","style",Array(
        "START_FROM" => "0", 
        "PATH" => "", 
        "SITE_ID" => "s1" 
    )
);?>
            </div>
            <!-- /Breadcrumb -->

            <div id="slider_row" class="row">
            </div>
            <div class="row">
                <div id="center_column" class="qwe11 center_column col-xs-12 col-sm-12">


                    <h1 class="page-heading">Моя учетная запись</h1>
                    <p class="info-account">Добро пожаловать в вашу учетную запись. Здесь вы можете управлять личными
                        данными и заказами.</p>
                    <div class="row addresses-lists">
                        <div class="col-xs-12 col-sm-6 col-lg-4">
                            <ul class="myaccount-link-list">
                                <li>
                                  <a href="/personal/orders/" title="Заказы">
                                    <i class="icon-list-ol"></i>
                                    <span>Мои заказы</span>
                                  </a>
                                  </li>
                                <li>
                                  <a href="/personal/addresses/" title="Адреса">
                                  <i class="icon-building"></i><span>Мои адреса</span></a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4">
                            <ul class="myaccount-link-list">
                                <li>
                                  <a href="/personal/discount/" title="Купоны">
                                    <i class="icon-barcode"></i>
                                    <span>Мои купоны</span>
                                  </a>
                                </li>
                                <li>
                                  <a href="/personal/identity/" title="Информация">
                                    <i class="icon-user"></i>
                                    <span>Моя информация</span>
                                  </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <ul class="footer_links clearfix">
                        <li><a class="btn btn-default button button-small" href="/" title="Главная"><span><i
                                            class="icon-chevron-left"></i> Главная</span></a></li>
                    </ul>
                </div><!-- #center_column -->
            </div><!-- .row -->
        </div><!-- #columns -->
    </div>

    <br>
    <br>
<? } else{

  header('Location: /authentication/');

}


require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>