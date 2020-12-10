<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Анкета перевозчика");


/*Получение ID пользователя*/
global $USER;

if (!$USER->IsAuthorized()) LocalRedirect("/auth-client/");

$USER = new CUser;

$us = $USER->GetID();
$rsUser = CUser::GetByID($us);
$arUser = $rsUser->Fetch();

$us_id = $arUser['ID'];
echo "<script>
window.us_id = $us_id;
</script>";

$ank_id = $arUser['UF_ANK'];
echo "<script>
window.ank_id = $ank_id;
</script>";

?>


<div class="container">
    <div class="row row_find">
        <div class="sidebar">

            <ul class="sidebar-menu">
                <li class="sidebar-menu__item">
                    <a class="sidebar-menu__link sidebar-menu__link_main" href="/cabinet/transporter/">Основные
                        данные</a>
                </li>
         
                <li class="sidebar-menu__item">
                    <a class="sidebar-menu__link sidebar-menu__link_find" href="/cabinet/transporter/find.php">Поиск
                        заказов</a>
                </li>
                <li class="sidebar-menu__item">
                    <a class="sidebar-menu__link sidebar-menu__link_request" href="/cabinet/transporter/my_bet.php">Мои
                        заказы</a>
                </li>
            
                <li class="sidebar-menu__item">
                    <a class="sidebar-menu__link sidebar-menu__link_messages active"
                       href="/cabinet/transporter/messages.php">Чат<? $APPLICATION->IncludeComponent("d.partners:messages.dontread", ".default") ?></a>
                </li>
            </ul>

        </div>
        <main class="main main_request">


            ВАШ ТРАНСПОРТ
            <br> <br>
            <div class="translist">

                <?

                $arFilter = Array("IBLOCK_ID" => 13, "ACTIVE" => "Y", "PROPERTY_ANKETA" => $arUser['UF_ANK']);
                $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

                while ($ob = $res->GetNextElement()){
                $arFields = $ob->GetFields();
                $arProperties = $ob->GetProperties();
                ?>

                <div class="trans" name="<?= $arFields['ID'] ?>">
                    <div class="deltr" id="<?= $arFields['ID'] ?>">X&nbsp</div>
                    <span><b>Название:</b></span>&nbsp<?= $arFields['NAME'] ?>
                    <br>
                    <span><b>Описание:</b></span>&nbsp<?= $arFields['DETAIL_TEXT'] ?>
                    <br>
                  
                    <br><br>

                    <? foreach ($arProperties['TRANSPORT_FOTO']['VALUE'] as $key => $valuedocs) {
                        $rsFile = CFile::GetByID($valuedocs);
                        $arFile = $rsFile->Fetch();
                        $href = "upload/" . $arFile['SUBDIR'] . "/" . $arFile['FILE_NAME'] . ""; ?>
                        <img src="/<?= $href ?>" width="55" height="100">
                    <? } ?>
                </div>
                    <?
                    } ?>
            </div>
                    <br><br>

                    ДОБАВИТЬ ТРАНСПОРТ
                    <div>
                        <div>
                            <input type="text" value="" placeholder="Название" id="t_name">
                        </div>
                        <br>
                        <textarea cols="70" rows="4" name="" placeholder="Описание" id="t_desc"></textarea>
                        <div>Вы можете добавить не более 5 фотографий.</div>
                        <div>
                            <? $APPLICATION->IncludeComponent("bitrix:main.file.input", "transport", Array(
                                "INPUT_NAME" => "TEST_NAME_INPUT",
                                "MULTIPLE" => "Y",
                                "MODULE_ID" => "main",
                                "MAX_FILE_SIZE" => "",
                                "ALLOW_UPLOAD" => "A",
                                "ALLOW_UPLOAD_EXT" => "",
                                "COMPONENT_TEMPLATE" => "drag_n_drop"
                            ),
                                false
                            ); ?>
                        </div>


                        <button id="auto">Добавить транспорт</button>
                    </div>

        </main>

        <div>
            <ul>
                <li style="display:inline;"><a href="/cabinet/transporter/anketa.php">Анкета</a></li>
                <li style="display:inline;"><a href="/cabinet/transporter/settings.php">Настройки</a></li>
            </ul>
        </div>

    </div>
</div>


<script>
    $(document).ready(function () {
        /*Добавление транспорта*/

        $('#auto').on('click', function (e) {

            var autolist = $('.trans').length;

            if (autolist < 10) {


                var t_name = $("#t_name").val();

                if (t_name == 0) {
                    alert('Поле "Название" не может быть пустым');
                }
                else {

                    var t_desc = $("#t_desc").val();
       

                    var imaglist = {};
                    var im = 1;
                    $('.file-placeholder-tbody').find('tr').each(function () {
                        if (im < 6) {
                            var sImg = this.id.substr(6);
                            imaglist[sImg] = sImg;
                            im++;
                        }
                    });


                    var transId = 1;
                    $.post('/ajax/anketa.php', {
                            transId,
                            ank_id,
                            t_name,
                            t_desc,
                            imaglist

                        },
                        function (datab) {
                            location.reload();
                        })
                    }
                }
            else
                {

                    alert('можно добавить не более 10 автомобилей');
                    $('#auto').unbind('click');
                }


        });


        /*Удаление транспорта*/

        $('body').on('click', '.deltr', function (e) {
           var DelId =  $(this).attr('id');
            $('[name='+DelId+']').remove();
            alert(DelId);
            $.post('/ajax/anketa.php', {
                    DelId
                },
                function (datab) {
                    alert(datab);
                })

        });
    });

</script>


<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
