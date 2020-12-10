<?
define("HIDE_SIDEBAR", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Мои заказы");
?>

<?  if($USER->IsAuthorized()){?>

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

     <?$APPLICATION->IncludeComponent("style:sale.personal.order.list","style",Array(
        "STATUS_COLOR_N" => "green",
        "STATUS_COLOR_P" => "yellow",
        "STATUS_COLOR_F" => "gray",
        "STATUS_COLOR_PSEUDO_CANCELLED" => "red",
        "PATH_TO_DETAIL" => "order_detail.php?ID=#ID#",
        "PATH_TO_COPY" => "basket.php",
        "PATH_TO_CANCEL" => "order_cancel.php?ID=#ID#",
        "PATH_TO_BASKET" => "basket.php",
        "PATH_TO_PAYMENT" => "payment.php",
        "ORDERS_PER_PAGE" => 20,
        "ID" => $ID,
        "SET_TITLE" => "Y",
        "SAVE_IN_SESSION" => "Y",
        "NAV_TEMPLATE" => "",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_GROUPS" => "Y",
        "HISTORIC_STATUSES" => "F",
        "ACTIVE_DATE_FORMAT" => "d.m.Y"
    	)
	);?>

        </div><!-- #columns -->
    </div>

    <?} else {

            header('Location: /authentication/');

        }

 require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>