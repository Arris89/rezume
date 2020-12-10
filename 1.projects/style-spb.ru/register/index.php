<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
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
            <div id="slider_row" class="row"></div>
            <div class="row">
                <div id="center_column" class="qwe11 center_column col-xs-12 col-sm-12">
                    <div id="noSlide" style="display: block;">
                        <h1 class="page-heading">Создание учетной записи</h1>

                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:main.register",
                            "style",
                            array(
                                "USER_PROPERTY_NAME" => "",
                                "SEF_MODE" => "Y",
                                "SHOW_FIELDS" => array(
                                    0 => "EMAIL",
                                    1 => "NAME",
                                    2 => "LAST_NAME",
                                    3 => "PERSONAL_GENDER",
                                    4 => "PERSONAL_BIRTHDAY",
                                ),
                                "REQUIRED_FIELDS" => array(
                                    0 => "EMAIL",
                                ),
                                "AUTH" => "Y",
                                "USE_BACKURL" => "Y",
                                "SUCCESS_PAGE" => "",
                                "SET_TITLE" => "Y",
                                "USER_PROPERTY" => array(),
                                "SEF_FOLDER" => "/",
                                "COMPONENT_TEMPLATE" => ".default",
                                "TAKEMAIL" => $_POST['mail']
                            ),
                            false
                        );
                        ?>

                    </div>
                </div><!-- #center_column -->
            </div><!-- .row -->
        </div><!-- #columns -->
    </div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>