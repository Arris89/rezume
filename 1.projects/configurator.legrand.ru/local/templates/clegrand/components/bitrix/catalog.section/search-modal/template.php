<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Grid\Declension;
$postDeclension = new Declension('пост', 'поста', 'постов');
?>

<?if (! empty($arResult['ITEMS'])):?>
    <?foreach ($arResult['ITEMS'] as $item):
        $sectionId = $item['IBLOCK_SECTION_ID'];
        $sectionCode = mb_strtolower($arResult['SECTIONS'][ $sectionId ]);
        $elementId = $item['ID'];
        $collectionId = $item['PROPERTIES']['COLLECTION']['VALUE'][0];
        $collectionName = $arResult['COLLECTIONS'][ $collectionId ]['NAME'];


if ($collectionName=='Etika') {
   $FilterCode = 1506916091;
} 

if ($collectionName=='Celiane') {
   $FilterCode = 785811053;
} 

if ($collectionName=='Valena Life') {
   $FilterCode = 3235440449;
} 

if ($collectionName=='Valena Allure') {
   $FilterCode = 3084900311;
} 

if ($collectionName=='Livinglight (немецкий стандарт)') {
   $FilterCode = 4189819658;
} 

if ($collectionName=='Livinglight (итальянский стандарт)') {
   $FilterCode = 2394727324;
} 


        $href = '/configurator/?set_filter=y&arrFilter_102='.$FilterCode.'';

         $collectionName1 = '<a href="'.$href.'" class="legrand-link_blue">'.$collectionName.'<a/>';



        $collectionCode = $arResult['COLLECTIONS'][ $collectionId ]['CODE'];
        if (stripos($collectionCode, 'livinglight') !== false) {
            $collectionCode = 'livinglight';
            $collectionName = 'Livinglight';
        }

        if ($sectionCode === 'frame') {
            $image = \CFile::GetPath($item['PROPERTIES']['FRAME_IMG_HORIZONTAL']['VALUE']);
            $price[ $elementId ] = $item['PRICES']['DEFAULT']['VALUE'];
            $postText = $item['PROPERTIES']['FRAME_COUNT_FUNCTION']['VALUE'].' '.$postDeclension->get($item['PROPERTIES']['FRAME_COUNT_FUNCTION']['VALUE']);
            $title = 'Рамка ('.$collectionName.'), цвет '.$item['PROPERTIES']['FRAME_COLOR']['VALUE'].', '.$postText;
            $title1 = 'Рамка '.$collectionName1.' , цвет '.$item['PROPERTIES']['FRAME_COLOR']['VALUE'].', '.$postText;
            $dataTitle = 'Рамка ('.$collectionName.'), '.$postText;
            $color = $item['PROPERTIES']['FRAME_COLOR']['VALUE'];
        }

        if ($sectionCode === 'function') {
            $image = \CFile::GetPath($item['PROPERTIES']['FUNCTION_IMG']['VALUE']);
            $title1 = trim($item['NAME']).', ( '.$collectionName1.' ), цвет '.$item['PROPERTIES']['FUNCTION_COLOR']['VALUE'];

            $title = $item['NAME'].', цвет '.$item['PROPERTIES']['FUNCTION_COLOR']['VALUE'];
            $dataTitle = $item['NAME'];
            $color = $item['PROPERTIES']['FUNCTION_COLOR']['VALUE'];

            foreach ($item['PROPERTIES']['PACKAGE_ARTICUL']['VALUE'] as $xmlId) {
                $price[ $elementId ] += $arResult['XML_ID_PRICES'][ $xmlId ];
            }
        }
        ?>

        <li class="search__item"
            data-id="<?= $item['ID']?>"
            data-articul="<?= $item['PROPERTIES']['ARTICUL']['VALUE']?>"
            data-title="<?=$title?>"
            data-modal="<?=$dataTitle?>"
            data-color="<?=$color?>"
            data-price="<?= $price[ $elementId ]?>"
            data-picture="<?= $image?>"
            data-collection-code="<?= $collectionCode?>"
            data-section-code="<?= $sectionCode?>">
            <div class="search-product">
                <div class="search-product__top">
                    <div class="search-product__image">
                        <img src="<?= $image?>"
                             alt="<?= $title?>"
                        >
                    </div>

                    <div class="search-product__info">
                        <div class="search-product__info-title">
                            <strong>
                                <?= $item['PROPERTIES']['ARTICUL']['VALUE']?>
                            </strong>
                        </div>

                        <div class="search-product__info-title">
                            <?= $title1?>
                        </div>

                        <div class="search-product__info-price price-js">
                            <?= number_format($price[$elementId], 2, '.', ' ');?> руб.
                        </div>
                    </div>
                </div>

                <div class="search-product__bottom">
                    <div class="search-product__count">
                        <div class="kit-number kit-number_str"
                             data-target=".js-result-price"
                             data-parent=".search__item"
                        >
                            <div class="kit-number__text">
                                кол-во
                            </div>

                            <div class="kit-number__btn kit-number__btn_min mod">
                                -
                            </div>

                            <div class="kit-number__value mod">
                                1 шт
                            </div>

                            <div class="kit-number__btn kit-number__btn_plus mod">
                                +
                            </div>
                        </div>
                    </div>

                    <div class="search-product__price">
                        Сумма:
                        <span class="js-result-price">
                            <?=number_format($price[$elementId], 2, '.', ' ');?>
                        </span>
                        руб.
                    </div>

                    <div class="search-product__add">
                        <div class="my-btn my-btn_sm btn-add-spec-js">
                            добавить
                        </div>
                    </div>
                </div>
            </div>
        </li>
    <?endforeach?>
<?endif?>