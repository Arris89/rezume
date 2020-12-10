<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Мои заказы");
global $USER;
CModule::IncludeModule('iblock');
if (!$USER->IsAuthorized()) {
    ?>


    <div class="basket-wrap basket-order">
        <div class="title"><h2>Вход</h2></div>
        <div class="container">
            <div class="separate-line"></div>
            <div class="container-small">
                <p>Войдите с помощью аккаунта в соц сетях</p>
                <div class="socials-list">
                    <div class="wa-auth-adapters">
                        <ul>
                            <li class="wa-auth-adapter-facebook">
                                <a href="/oauth.php?app=shop&amp;provider=facebook">
                                    <img alt="Facebook" src="<?= SITE_TEMPLATE_PATH ?>/images/facebook.png"></a>
                            </li>
                            <li class="wa-auth-adapter-vkontakte">
                                <a href="/oauth.php?app=shop&amp;provider=vkontakte">
                                    <img alt="ВКонтакте" src="<?= SITE_TEMPLATE_PATH ?>/images/vkontakte.png"></a>
                            </li>
                        </ul>
                        <p>Авторизуйтесь, указав свои контактные данные, или воспользовавшись перечисленными выше
                            сервисами.</p>
                    </div>
                </div>

                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:system.auth.form",
                    "login",
                    array(
                        "AJAX_MODE" => "Y",
                        "AJAX_OPTION_SHADOW" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "AJAX_OPTION_HISTORY" => "N",
                        "FORGOT_PASSWORD_URL" => "/auth/?forgot_password=yes",
                        "PROFILE_URL" => "",
                        "REGISTER_URL" => "",
                        "SHOW_ERRORS" => "Y",
                        "COMPONENT_TEMPLATE" => "auth_popup"
                    ),
                    false
                );
                ?>

            </div>
        </div>
    </div>


<? } else {

    ?>


    <link href="/local/templates/aviator/css/arial/fontface.css" rel="stylesheet" type="text/css"/>

    <div class="title"><h2>Личный кабинет</h2></div>
    <div class="container" style="margin-top: 35px">

    <ul class="tabs-menu">
        <li><a href="/personal/profile">Личная информация</a></li>
        <li class="active"><a href="/personal/orders">Мои заказы</a></li>
        <li><a href="/personal/favorites">Избранное</a></li>
        <li><a href="/personal/mail/">Подписки</a></li>
    </ul>

    <div class="cabinet-wrap">

    <div class="accordion-header"><a href="/my/">Личная информация</a></div>
    <div class="tab-item accordion-content"></div>
    <div class="accordion-header "> Мои заказы</div>
    <div class="tab-item visible  open-content">
    <div class="item">
        <div class="sub-title">Сумма заказов и скидок</div>


        <div class="pink">Сумма всех оплаченных заказов: <? $APPLICATION->ShowViewContent('allsum_content'); ?> <span
                    class="ruble">Р</span><br></div>

    </div>
    <div class="separate-line"></div>

    <div class="item">
    <div class="sub-title">Текущие заказы</div>


    <?
    $statusResult = \Bitrix\Sale\Internals\StatusLangTable::getList(array(

        'order' => array('STATUS.SORT' => 'DESC'),

        'filter' => array('STATUS.TYPE' => 'O', 'LID' => LANGUAGE_ID),

        'select' => array('STATUS_ID', 'NAME', 'DESCRIPTION'),

    ));


    while ($status = $statusResult->fetch()) {

        $ordStat[$status['STATUS_ID']] = $status['NAME'];

    }
    ?>


    <?


// Выведем даты всех заказов текущего пользователя за текущий месяц, отсортированные по дате заказа
    $arFilter = Array(
        "USER_ID" => $USER->GetID()
    );


    $db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "DESC"), $arFilter);
    while ($key = $db_sales->Fetch()) {

        if (
            $key['STATUS_ID'] == 'F'
            or $key['STATUS_ID'] == 'Se'
            or $key['STATUS_ID'] == 'Ex'
            or $key['STATUS_ID'] == 'Rm'
            or $key['STATUS_ID'] == 'Ca'
        ) {
            $hist[] = $key;
        } else {
            $actual[] = $key;
        }

    }

    ?>


    <? foreach ($actual as $key) { ?>


        <div class="wrapper">
            <div class="part">
            <span class="pink">Заказ от:
                <?
                echo ConvertDateTime($key['DATE_INSERT'], "DD.MM.YYYY", "YYYY-MM-DD");

                ?>


            </span><br>
                <strong>Заказ:</strong>#<?= $key['ID'] ?> <br>
                <strong>Итого:</strong> <?= $key['PRICE'] ?> <span class="ruble">Р</span><br>
                <strong>Оплата:</strong>
                <?

                if ($key['PAYED'] == 'N') {
                    echo 'Нет';
                } else {
                    echo 'Да';
                }

                ?>
            </div>


            <div class="part">
                <strong>Текст:</strong> <br>
                <?
                $resq = CSaleBasket::GetList(array(), array("ORDER_ID" => $key['ID'])); // ID заказа
                $num = 1;
                while ($arItemq = $resq->Fetch()) {

                    $resu = CIBlockElement::GetByID($arItemq['PRODUCT_ID']);
                    if ($ar_resu = $resu->GetNext())

                        echo $num . ".<a href='" . $ar_resu['DETAIL_PAGE_URL'] . "'>" . $arItemq['NAME'] . "</a>" . $arItemq['QUANTITY'] . " шт.<br>";
                    $num++;
                }
                ?>

            </div>


            <div class="part status"><strong>Статус:</strong> <? echo $ordStat[$key['STATUS_ID']]; ?></div>
            <div class="part btn">


                <a href="javascript:void(0)" class="add" data-id="<?= $key['ID'] ?>"><span>Повторить</span></a>

                </a>
            </div>
        </div>
        <div class="empty"></div>

        <?

        if ($key['STATUS_ID'] == 'DF' or $key['STATUS_ID'] == 'P') {
            $allsum1 += $key['PRICE'];
        }
    }
    ?>

    <div class="separate-line"></div>


    <div class="item">


    <div class="sub-title">История заказов</div>

    <? foreach ($hist as $key1) { ?>

        <div class="wrapper">
            <div class="part">
                <span class="pink">Заказ от: <?= $key1['DATE_INSERT'] ?></span><br>
                <strong>Заказ:</strong>#<?= $key1['ID'] ?> <br>
                <strong>Итого:</strong> <?= $key1['PRICE'] ?> <span class="ruble">Р</span><br>
                <strong>Оплата:</strong>
                <?

                if ($key['PAYED'] == 'N') {
                    echo 'Нет';
                } else {
                    echo 'Да';
                }

                ?>                                </div>


            <div class="part">
                <strong>Текст:</strong> <br>


                <?
                $resw = CSaleBasket::GetList(array(), array("ORDER_ID" => $key1['ID'])); // ID заказа
                $numw = 1;
                while ($arItemw = $resw->Fetch()) {


                    $resx = CIBlockElement::GetByID($arItemw['PRODUCT_ID']);

                    if ($ar_res = $resx->GetNext()) {

                        echo $numw . ".<a href='" . $ar_res['DETAIL_PAGE_URL'] . "'>" . $ar_res['NAME'] . "</a>" . $arItemw['QUANTITY'] . " шт.<br>";

                        $numw++;
                    }
                }
                ?>

            </div>


            <div class="part status"><strong>Статус:</strong> <? echo $ordStat[$key1['STATUS_ID']]; ?></div>
            <div class="part btn">


                <a href="javascript:void(0)" class="add" data-id="<?= $key1['ID'] ?>"><span>Повторить</span></a>


                </a>
            </div>
        </div>
        <div class="empty"></div>


        <?
        if ($key1['STATUS_ID'] == 'F' or $key1['STATUS_ID'] == 'SE') {
            $allsum2 += $key1['PRICE'];
        }
    }

}
?>

    </div>


<? if ($APPLICATION->GetProperty('hide_allsum') != 'Y'): ?>
    <? ob_start(); ?>
    <? $pep = $allsum1 + $allsum2; ?>
    <? echo $pep; ?>

    <? $APPLICATION->AddViewContent('allsum_content', ob_get_contents()); ?>
    <? ob_end_clean(); ?>
<? endif; ?>


    <script>
        $(document).ready(function () {

            $('.add').on('click', function (e) {

                window.idOrder = $(this).attr('data-id');
                
                reorder(idOrder);
            });
            function reorder(IDbask){

                var ido = idOrder;

                $.post('/ajax/reorder.php', {ido}, function (datab) {
                    window.location.replace('/personal/cart/');
                })
            }
        });

    </script>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>