<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Свяжитесь с нами");
?>

    <div class="columns-container">
        <div id="columns" class="container">

            <!-- Breadcrumb -->
            <div class="breadcrumb clearfix">
                <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "style", Array(
                        "START_FROM" => "0",
                        "PATH" => "",
                        "SITE_ID" => "s1"
                    )
                ); ?>
            </div>
            <!-- /Breadcrumb -->

            <div id="slider_row" class="row">
            </div>
            <div class="row">
                <div id="center_column" class="qwe11 center_column col-xs-12 col-sm-12">
                    <h1 class="page-heading bottom-indent">
                        Служба поддержки - Свяжитесь с нами</h1>


                    <? $APPLICATION->IncludeComponent(
                        "contact-us:main.feedback",
                        "contact-us",
                        array(
                            "USE_CAPTCHA" => "N",
                            "OK_TEXT" => "Спасибо, ваше сообщение принято.",
                            "EMAIL_TO" => "my@email.com",
                            "REQUIRED_FIELDS" => array(
                                0 => "EMAIL",
                            ),
                            "EVENT_MESSAGE_ID" => array(),
                            "COMPONENT_TEMPLATE" => "contact-us"
                        ),
                        false
                    ); ?>

                </div><!-- #center_column -->
            </div><!-- .row -->
        </div><!-- #columns -->
    </div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>