<?

if (empty($_POST) && empty($_GET)) {
    $url = '';

    if ($_SERVER['REQUEST_URI'] == '/index.php') {
        $url = '/';
    }
    if ($url != '') {
        header('Location: https://style-spb.ru' . $url, true, 301);
        exit();
    }
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Интернет-магазин женских пальто от производителя");
?>

    <div class="columns-container">
        <div id="columns" class="container">
            <div id="slider_row" class="row">
            </div>
            <div class="row">
                <div id="center_column" class="qwe11 center_column col-xs-12 col-sm-12">


                    <div class="grid-container">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            ".default",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "incs",
                                "AREA_FILE_RECURSIVE" => "Y",
                                "PATH" => "/include/mainlook.php"
                            ),
                            false
                        ); ?>

                    </div>


                    <!-- /banners mainpage -->
                    <div class="clearfix"><!-- MODULE Block cmsinfo -->
                        <div id="cmsinfo_block">

                            <div class="col-xs-6">

                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    ".default",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "incs",
                                        "AREA_FILE_RECURSIVE" => "Y",
                                        "PATH" => "/include/mainicon.php"
                                    ),
                                    false
                                ); ?>

                            </div>

                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "incs",
                                    "AREA_FILE_RECURSIVE" => "Y",
                                    "PATH" => "/include/maintext.php"
                                ),
                                false
                            ); ?>

                        </div>
                        <!-- /MODULE Block cmsinfo -->
                    </div>
                </div><!-- #center_column -->
            </div><!-- .row -->
        </div><!-- #columns -->
    </div><!-- .columns-container -->

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>