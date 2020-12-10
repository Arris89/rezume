<!-- Footer -->

<div class="footer-container">
    <footer id="footer" class="container">
        <div class="row">
            <div id="newsletter_block_left" class="block">
                <div class="h4">Рассылка</div>
                <div class="block_content" style="display: block; bottom: 10px; position: relative;">

                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:sender.subscribe",
                        "main",
                        array(
                            "COMPONENT_TEMPLATE" => "main",
                            "USE_PERSONALIZATION" => "Y",
                            "CONFIRMATION" => "N",
                            "SHOW_HIDDEN" => "Y",
                            "AJAX_MODE" => "Y",
                            "AJAX_OPTION_JUMP" => "Y",
                            "AJAX_OPTION_STYLE" => "Y",
                            "AJAX_OPTION_HISTORY" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "3600",
                            "SET_TITLE" => "N",
                            "HIDE_MAILINGS" => "N",
                            "USER_CONSENT" => "N",
                            "USER_CONSENT_ID" => "0",
                            "USER_CONSENT_IS_CHECKED" => "Y",
                            "USER_CONSENT_IS_LOADED" => "N",
                            "AJAX_OPTION_ADDITIONAL" => ""
                        ),
                        false
                    );
                    ?>
                </div>
            </div>

            <section id="social_block" class="pull-right">
                <ul>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        ".default",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "incs",
                            "AREA_FILE_RECURSIVE" => "Y",
                            "PATH" => "/include/social.php"
                        ),
                        false
                    ); ?>
            </section>
            <div class="clearfix"></div>
            <!-- Block Newsletter module-->

            <section class="blockcategories_footer footer-block col-xs-12 col-sm-2">
                <div class="h4">Категории</div>
                <div class="category_footer toggle-footer">
                    <div class="list">
                        <? $APPLICATION->IncludeComponent("bitrix:menu", "footmenu", Array(
                                "ROOT_MENU_TYPE" => "bottom2",
                                "MAX_LEVEL" => "1",
                                "CHILD_MENU_TYPE" => "bottom",
                                "USE_EXT" => "Y",
                                "DELAY" => "N",
                                "ALLOW_MULTI_SELECT" => "Y",
                                "MENU_CACHE_TYPE" => "N",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "MENU_CACHE_GET_VARS" => ""
                            )
                        ); ?>
                    </div>
                </div> <!-- .category_footer -->
            </section>
            <section class="footer-block col-xs-12 col-sm-2" id="block_various_links_footer">
                <div class="h4">Информация</div>

                <? $APPLICATION->IncludeComponent("bitrix:menu", "footmenu", Array(
                        "ROOT_MENU_TYPE" => "bottom1",
                        "MAX_LEVEL" => "1",
                        "CHILD_MENU_TYPE" => "bottom",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "Y",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => ""
                    )
                ); ?>

            </section>
            <section class="footer-block col-xs-12 col-sm-4">
                <div class="h4">
                    <a href="/personal/" title="Управление моей учетной записью" rel="nofollow">
                        Моя учетная запись
                    </a>
                </div>
                <div class="block_content toggle-footer">
                    <?
                    $APPLICATION->IncludeComponent("bitrix:menu", "footmenu1", Array(
                            "ROOT_MENU_TYPE" => "bottom",
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "bottom",
                            "USE_EXT" => "Y",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "Y",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => ""
                        )
                    );
                    ?>
                </div>
            </section>
            <section id="block_contact_infos" class="footer-block col-xs-12 col-sm-4">
                <div>

                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        ".default",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "incs",
                            "AREA_FILE_RECURSIVE" => "Y",
                            "PATH" => "/include/footcont.php"
                        ),
                        false
                    ); ?>

                </div>
            </section>
        </div>

    </footer>
</div><!-- #footer -->
</div><!-- #page -->
<div itemscope="" itemtype="http://schema.org/Organization" style="display:none;">
    <meta itemprop="name" content="Style National Club">
    <div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
        <span itemprop="streetAddress">Левашовский пр., д. 13 лит. А офис 131</span>
        <span itemprop="postalCode">197110</span>
        <span itemprop="addressLocality">г. Санкт-Петербург</span>
    </div>
    <span itemprop="telephone">8 800 505 05 17</span>
    <span itemprop="telephone">8 (812) 677-13-86</span>
    <span itemprop="telephone">8 (812) 677-07-30</span>
    <span itemprop="email">info@style-spb.ru</span>
</div>
</div>

<script>
    //показ товаров корзины в header
    $(document).ready(function () {
        $('.shopping_cart').hover(
            function () {
                $('.cart_block.block.exclusive').css('display', 'block');
            },
            function () {

                $('.cart_block.block.exclusive').css('display', 'none');

            });
    });

    /*удаление товара из выпадающего списка корзины*/
    $(document).on('click', '.remove_link', function () {
        var del = $(this).attr('hc-id');
        $('[it-id=' + del + ']').remove();
        url = window.location.href;
        if (url.match('/personal/cart/')) {
            $('#' + del + '').remove();
        }
        $.post('/local/templates/style-spb/ajax/basketdel.php', {del}, function (data) {
            var datas = JSON.parse(data);
            $('.ajax_cart_no_product').text('' + datas.num + ' Товар');
            $('.price.cart_block_total.ajax_block_cart_total').text('' + datas.sum + ' руб');

            if (datas.num == 0) {
                $('.cart_block_list').remove();
                $('.ajax_cart_no_product').text('(пусто)');

                if (url.match('/personal/cart/')) {
                    location.reload();
                }

            }

        })

    });

    /*добавление товара в корзину*/
    $(document).on('click', '.cartadd', function () {

        var id = $(this).attr('data-id');
        /*id товара*/
        var quan = 1;
        /*количество*/
        $.post('/local/templates/style-spb/ajax/basket.php', {id, quan}, function (data) {

        })
    });

    /*показывать меню при наведении*/
    $('.ther.palto').hover(
        function () {
            $('.submenu-container.palto').css("display", "block");
        },
        function () {
            $('.submenu-container.palto').css("display", "none");
        });

    /*показывать меню при наведении 2*/
    $('.ther.women').hover(
        function () {
            $('.submenu-container.women').css("display", "block");
        },
        function () {
            $('.submenu-container.women').css("display", "none");
        });
</script>

</body>