<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Карта сайта");
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

                <?php
                $IDcat = \IbHelp\Helper::getIblockIdByCodes('clothes')["clothes"];
                $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE");
                $arFilter = Array(
                    "IBLOCK_ID" => $IDcat,
                    "ACTIVE" => "Y",
                    "PROPERTY_SALELEADER_VALUE" => "да",
                );
                $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
                while ($ob = $res->GetNextElement()) {
                    $arFields = $ob->GetFields();
                    $arProps = $ob->GetProperties();

                    $rsFile = CFile::GetByID($arFields['DETAIL_PICTURE']);
                    $arFile = $rsFile->Fetch();

                    $href = "upload/" . $arFile['SUBDIR'] . "/" . $arFile['FILE_NAME'] . "";

                    if (CModule::IncludeModule('highloadblock')) {

                        $ID = 4; /* ID справочника*/

                        $hldata = Bitrix\Highloadblock\HighloadBlockTable::getById($ID)->fetch();

                        $hlentity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata);
                        $entity_data_class = $hlentity->getDataClass();

                        $result = $entity_data_class::getList(array(
                            "select" => array("UF_NAME"), // Поля для выборки
                            "order" => array(),
                            "filter" => array("UF_XML_ID" => $arProps['COLOR']['VALUE']),
                        ));

                        while ($resds = $result->fetch()) {
                            $itemColor = $resds["UF_NAME"];
                        }
                    } ?>

                    <li class="clearfix">
                        <a href="<?= $arFields['DETAIL_PAGE_URL']; ?>" title="<?= $arFields['NAME']; ?>"
                           class="products-block-image content_img clearfix">
                            <img class="replace-2x img-responsive" src="/<?= $href ?>"
                                 alt="<?= $arFields['NAME']; ?>" width="98" height="98">
                        </a>
                        <div class="product-content">
                            <div class="h5" style="margin-top:9px">
                                <a class="product-name" href="<?= $arFields['DETAIL_PAGE_URL']; ?>"
                                   title="<?= $arFields['NAME']; ?>">
                                    <?= $arFields['NAME']; ?>
                                </a>
                            </div>
                            <p class="product-description">Состав:

                                <?= $arProps['SOSTAV']['VALUE'] ?>

                                Цвет: <?= $itemColor ?></p>
                        </div>
                    </li>

                <? } ?>

                </ul>
                <div class="lnk">
                    <a href="https://style-spb.ru/best-sales" title="Все популярные товары"
                       class="btn btn-default button button-small"><span>Все популярные товары<i
                                    class="icon-chevron-right right"></i></span></a>
                </div>
            </div>
        </div>

        <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            ".default",
            array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "incs",
                "AREA_FILE_RECURSIVE" => "Y",
                "PATH" => "/include/sitemapinfo.php"
            ),
            false
        ); ?>

        </ul>
    </div>
    </section>

    <div id="center_column" class="qwe11 center_column col-xs-12 col-sm-9">

        <h1 class="page-heading">
            <? $APPLICATION->ShowTitle() ?>
        </h1>
        <div id="sitemap" class="row">
            <div class="col-xs-12 col-sm-6">
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="sitemap_block box">
                    <div class="h3 page-subheading">
                        Ваша учетная запись
                    </div>
                    <ul>

                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            ".default",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "incs",
                                "AREA_FILE_RECURSIVE" => "Y",
                                "PATH" => "/include/auth.php"
                            ),
                            false
                        ); ?>

                    </ul>
                </div>
            </div>
        </div>
        <div id="listpage_content" class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="sitemap_block box">
                    <div class="h3 page-subheading">Страницы</div>
                    <ul>

                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            ".default",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "incs",
                                "AREA_FILE_RECURSIVE" => "Y",
                                "PATH" => "/include/sitemap.php"
                            ),
                            false
                        ); ?>


                    </ul>
                </div>
            </div>
        </div>
    </div><!-- #center_column -->
    </div><!-- .row -->
    </div><!-- #columns -->
    </div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>