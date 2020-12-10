<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Анкета перевозчика");
?>




<?php
/* Получение ID пользователя */
global $USER;

if (!$USER->IsAuthorized())
    LocalRedirect("/auth-client/");

$USER = new CUser;

$us = $USER->GetID();
$rsUser = CUser::GetByID($us);
$arUser = $rsUser->Fetch();

$us_id = $arUser['ID'];
echo "<script>
window.us_id = $us_id;
</script>";

$db_props = CIBlockElement::GetProperty(12, $arUser['UF_ANK'], array("sort" => "asc"), Array());
while ($ar_props = $db_props->Fetch()) {

    if ($ar_props[CODE] == 'DRIVEEXP') {
        $props[$ar_props['CODE']] = $ar_props['VALUE_ENUM'];
    } else {
        $props[$ar_props['CODE']] = $ar_props['VALUE'];
    }
}

?>



<?
$property_enums = CIBlockPropertyEnum::GetList(Array('ID' => 'ASC'), Array("IBLOCK_ID" => 12, "CODE" => "DRIVEEXP"));
while ($enum_fields = $property_enums->GetNext()) {

}
?>


<div class="container">
    <div class="row row_find">
        <div class="sidebar">

                    <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include", 
                    "", 
                    array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "/local/includes/cabinet_tr_left_menu.php",
                    "COMPONENT_TEMPLATE" => "named_area"
                    ),
                    false
                    );?>    

        </div>

        <main class="main main_request">
            <div class="submenu">
                <a href="/cabinet/transporter/anketa.php" class="submenu__item submenu__item--active">Анкета</a>
                <a href="/cabinet/transporter/settings.php" class="submenu__item">Настройки</a>
            </div>

            <div class="driver-info">
                <?

                $rsFile = CFile::GetByID($props['FOTO']);

                $arFile = $rsFile->Fetch();

                $href = "upload/" . $arFile['SUBDIR'] . "/" . $arFile['FILE_NAME'] . "";

                ?>

                <div class="driver-box">

                    <div class="driver-box__left" ><img class="driver-box__img" src="/<?= $href ?>" alt=""></div>

                    <div class="driver-box__right">
                        <div class="driver-box__txt">
                            Иванов Иван Иванович
                        </div>

                        <div class="driver-box__download">
                            <label class="label-download">
                                <span class="title-download">загрузить фото</span>
                                <input type="file" accept="image/jpeg,image/png">
                            </label>
                        </div>
                    </div>

                </div>

            </div>


            <div class="main-info myCard">
                <div class="main-info__title">
                    Общая информация
                </div>

                <div class="myCard__item">

                    <div class="myCard__item--left">
                        опыт работы
                    </div>

                    <div class="myCard__item--right">
                        <textarea cols="70" rows="4" name=""
                                  id="workexp"><?= $props['WORKEXP'] ?></textarea>
                    </div>
                </div>

                <div class="myCard__item">
                    <div class="myCard__item--left">
                        кратко о себе
                    </div>

                    <div class="myCard__item--right">
                        <textarea cols="70" rows="2" name="" 
                                  id="about"><?= $props['ABOUT'] ?></textarea>
                    </div>
                </div>

                <div class="myCard__item">
                    <div class="myCard__item--left">
                        подробно о себе
                    </div>
                    <div class="myCard__item--right">
                        <textarea cols="70" rows="4" name="" 
                                  id="aboutdetail"><?= $props['ABOUTDETAIL'] ?></textarea>
                    </div>
                </div>

                <div class="myCard__item">
                    <div class="myCard__item--left">
                        стаж водителя
                    </div>
                    <div class="myCard__item--right">
                        <select id="driveexp" class="mySelect">
                            <?
                            $property_enums = CIBlockPropertyEnum::GetList(Array('ID' => 'ASC'), Array("IBLOCK_ID" => 12, "CODE" => "DRIVEEXP"));
                            while ($enum_fields = $property_enums->GetNext()) {

                            if ($enum_fields["VALUE"] == $props['DRIVEEXP']) {
                            ?>
                            <option data-exp="<?= $enum_fields["ID"] ?>" selected><?= $enum_fields["VALUE"] ?></option>
                            <?
                            } else {
                            ?>
                            <option data-exp="<?= $enum_fields["ID"] ?>"><?= $enum_fields["VALUE"] ?></option>
                            <?
                            }
                            }
                            ?>
                        </select>
                    </div>
                </div>


            </div>
            АНКЕТА

            <div>Опыт работы</div>
            <div><textarea cols="70" rows="4" name="" placeholder="Опыт работы"
                           id="workexp"><?= $props['WORKEXP'] ?></textarea></div>

            <br>
            <div><span>Стаж водителя</span>
                <select id="driveexp">
                    <?
                    $property_enums = CIBlockPropertyEnum::GetList(Array('ID' => 'ASC'), Array("IBLOCK_ID" => 12, "CODE" => "DRIVEEXP"));
                    while ($enum_fields = $property_enums->GetNext()) {

                    if ($enum_fields["VALUE"] == $props['DRIVEEXP']) {
                    ?>
                    <option data-exp="<?= $enum_fields["ID"] ?>" selected><?= $enum_fields["VALUE"] ?></option>
                    <?
                    } else {
                    ?>
                    <option data-exp="<?= $enum_fields["ID"] ?>"><?= $enum_fields["VALUE"] ?></option>
                    <?
                    }
                    }
                    ?>
                </select>
            </div>
            <br>
            <div>Кратко о себе</div>
            <div>
                <textarea cols="70" rows="2" name="" placeholder="Кратко о себе"
                          id="about"><?= $props['ABOUT'] ?></textarea>
            </div>

            <div>Подробно о себе</div>
            <div>
                <textarea cols="70" rows="4" name="" placeholder="Подробно о себе"
                          id="aboutdetail"><?= $props['ABOUTDETAIL'] ?></textarea>
            </div>
            <br>

            <?
            /*Вывод местоположений*/

            $res = \Bitrix\Sale\Location\LocationTable::getList(array(
            'filter' => array('=TYPE.ID' => [1,2,3,4,5], '=NAME.LANGUAGE_ID' => LANGUAGE_ID),
            'select' => array('NAME_RU' => 'NAME.NAME', 'TYPE_CODE' => 'TYPE.CODE', 'CHILD_CNT',
            'PARENT_ID', 'DEPTH_LEVEL', 'ID'),
            'order' => array('DEPTH_LEVEL'=>'ASC','SORT'=>'ASC')
            ));
            while ($item = $res->fetch()) {
            $region[] = $item;
            }

            ?>


            <div>РАЙОНЫ И ГОРОДА</div>

            <div> <input type="checkbox">Россия</div>

            <div><input type="checkbox" style="margin-left: 15px;">Иркутская область</div>
            <div><input type="checkbox" style="margin-left: 15px;">Ленинградская область</div>
            <div><input type="checkbox" style="margin-left: 35px;">Иркутск</div>
            <div><input type="checkbox" style="margin-left: 35px;">Санкт-Петербург</div>

            <br>
            <div>Адрес</div>
            <br>
            Город
            <div><input type="text" id="city" value="<?= $props['CITY'] ?>"></div>
            Улица
            <div><input type="text" id="street" value="<?= $props['STREET'] ?>"></div>
            Дом
            <div><input type="text" id="home" value="<?= $props['HOME'] ?>"></div>
            Квартира
            <div><input type="text" id="kv" value="<?= $props['KVAR'] ?>"></div>
            <br>


            <?
            function form_tree($mess)
            {
            if (!is_array($mess)) {
            return false;
            }
            $tree = array();
            foreach ($mess as $value) {
            $tree[$value['PARENT_ID']][] = $value;
            }
            return $tree;
            }


            function build_tree($cats, $parent_id)
            {
            if (is_array($cats) && isset($cats[$parent_id])) {
            $tree = '<ul>';
            foreach ($cats[$parent_id] as $cat) {
            $tree .= '<li>' . $cat['NAME_RU'];
            $tree .= build_tree($cats, $cat['ID']);
            $tree .= '</li>';
            }
            $tree .= '</ul>';
            } else {
            return false;
            }
            return $tree;
            }


            /*Вывод дерева местоположений*/

            $tree = form_tree($region);
            echo build_tree($tree, 0);  ?>



            Выезд за граниицу
            <div>
                <?if ($props['TRAVEL']=='да') {?>
                <input type = "checkbox" id = "trav" checked>
                <?}
                else
                {?>
                <input type = "checkbox" id = "trav">
                <?}?>
            </div>
            <br>

            УСЛУГИ
            <div id="servlist" style="width: 180px;">
                <?
                $res = CIBlockElement::GetProperty(12, $arUser['UF_ANK'], "sort", "asc", array("CODE" => "SERVICES"));
                $i = 1;
                while ($ob = $res->GetNext()) {
                ?>
                <div><input type="text" placeholder="Введите описание услуги" value="<?= $ob["VALUE"] ?>" class="serv" id="<?= $i ?>"></div>
                <?
                $i++;
                } ?>
            </div>
            <span style="font-size: 25px;" id="addserv">+</span>

            <br> <br>
            СКИДКИ
            <div><textarea cols="70" rows="4" name="" placeholder="Укажите скидки"
                           id="sales"><?= $props['SALES'] ?></textarea></div>
            <br>



            <br>
            <div>
                <a rel="nofollow" href="javascript:void(0)"  id="anksave" ank-id="<?= $arUser['UF_ANK'] ?>">
                    <span>Сохранить</span>
                </a>
            </div>

        </main>
    </div>
</div>


<script>
    /*Сохранение информации анкеты */
    $(document).ready(function () {

        /* Получение значения Стажа водителя по умолчанию*/
        window.driveexp = $('select option:selected').attr('data-exp');

        /* Получение значения Стажа водителя*/
        $("select").change(function () {
            window.driveexp = $('select option:selected').attr('data-exp');
        });


        $('#anksave').on('click', function (e) {
            alert(driveexp);
            var ank_id = $("#anksave").attr('ank-id');

            var workexp = $("#workexp").val();
            alert(workexp);
            var about = $("#about").val();
            alert(about);
            var aboutdetail = $("#aboutdetail").val();
            alert(aboutdetail);
            var sales = $("#sales").val();
            alert(sales);


            var city = $("#city").val();
            alert(city);
            var street = $("#street").val();
            alert(street);
            var home = $("#home").val();
            alert(home);
            var kv = $("#kv").val();
            alert(kv);


            if ($('#trav').is(':checked')) {
                var trav = 'да';
                alert(trav);
            } else {
                var trav = 'нет';
                alert(trav);
            }


            var servlist = {};
            $('#servlist').find('input').each(function () {
                var that = $(this);
                servlist[this.id] = this.value;
            });


            $.post('/ajax/anketa.php', {
                ank_id,
                workexp,
                driveexp,
                about,
                aboutdetail,
                city,
                street,
                home,
                kv,
                servlist,
                sales,
                trav

            },
                    function (datab) {
                        alert('Анкета успешно обновлена');
                        location.reload();
                    })
        });

        /*Добавление поля ввода услуги*/

        $('#addserv').on('click', function (e) {

            var servL = $('.serv').length;

            if (servL < 10) {
                var servId = servL + 1;
                $('#servlist').append('<input type="text" placeholder="Введите описание услуги" value="" class="serv" id="' + servId + '">');
            }
            if (servL == 10) {

                $('#servlist').append('<div style="color:red;">Можно ввести не более 10 услуг</div>');
                $('#addserv').unbind('click');
            }

        });

    });
</script>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
