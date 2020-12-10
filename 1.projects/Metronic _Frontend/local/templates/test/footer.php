<!--========== FOOTER ==========-->
<footer class="footer">
    <!-- Links -->
    <div class="section-seperator">
        <div class="content-md container">
            <div class="row">

                <? $APPLICATION->IncludeComponent("bitrix:menu", "testf", Array(
                    "ROOT_MENU_TYPE" => "left",    // Тип меню для первого уровня
                    "MAX_LEVEL" => "1",    // Уровень вложенности меню
                    "CHILD_MENU_TYPE" => "top",    // Тип меню для остальных уровней
                    "USE_EXT" => "Y",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                    "DELAY" => "N",    // Откладывать выполнение шаблона меню
                    "ALLOW_MULTI_SELECT" => "Y",    // Разрешить несколько активных пунктов одновременно
                    "MENU_CACHE_TYPE" => "N",    // Тип кеширования
                    "MENU_CACHE_TIME" => "3600",    // Время кеширования (сек.)
                    "MENU_CACHE_USE_GROUPS" => "Y",    // Учитывать права доступа
                    "MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
                ),
                    false
                ); ?>

            </div>
            <!--// end row -->
        </div>
    </div>
    <!-- End Links -->

    <!-- Copyright -->
    <div class="content container">
        <div class="row">
            <div class="col-xs-6">


                <? $APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
                        "AREA_FILE_SHOW" => "sect",
                        "AREA_FILE_SUFFIX" => "inc1",
                        "AREA_FILE_RECURSIVE" => "Y",
                        "EDIT_TEMPLATE" => "standard.php"
                    )
                ); ?>


            </div>
            <div class="col-xs-6 text-right">

                <? $APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
                        "AREA_FILE_SHOW" => "sect",
                        "AREA_FILE_SUFFIX" => "inc6",
                        "AREA_FILE_RECURSIVE" => "Y",
                        "EDIT_TEMPLATE" => "standard.php"
                    )
                ); ?>

            </div>
        </div>
        <!--// end row -->
    </div>
    <!-- End Copyright -->
</footer>
<!--========== END FOOTER ==========-->

<!-- Back To Top -->
<a href="javascript:void(0);" class="js-back-to-top back-to-top">Top</a>

<!-- JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- CORE PLUGINS -->


<?
use Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/vendor/jquery.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/vendor/jquery-migrate.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/vendor/bootstrap/js/bootstrap.min.js");

Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/vendor/jquery.easing.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/vendor/jquery.back-to-top.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/vendor/jquery.smooth-scroll.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/vendor/jquery.wow.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/vendor/swiper/js/swiper.jquery.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/vendor/masonry/jquery.masonry.pkgd.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/vendor/masonry/imagesloaded.pkgd.min.js");


Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/layout.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/components/wow.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/components/swiper.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/components/masonry.min.js");


?>
</body>
<!-- END BODY -->
</html>