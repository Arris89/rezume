<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Личная информация");

global $USER;

if (!$USER->IsAuthorized()) {
    ?>


    <div class="basket-wrap basket-order">
        <div class="title"><h2>Вход</h2></div>
        <div class="container">
            <div class="separate-line"></div>
            <div class="container-small">


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


    <?
    global $USER;
    $USER = new CUser;


    $us = $USER->GetID();

    $rsUser = CUser::GetByID($us);

    $arUser = $rsUser->Fetch();

    /*echo "<pre>";
    print_r($arUser);
    echo "</pre>";*/


    ?>


    <div class="cabinet-wrap">
        <div class="title"><h2>Личный кабинет</h2></div>
        <div class="container" style="margin-top: 35px" id="fullcont">

            <ul class="tabs-menu">
                <li class="active"><a href="/personal/profile">Личная информация</a></li>
                <li><a href="/personal/orders">Мои заказы</a></li>
                <li><a href="/personal/favorites">Избранное</a></li>
                <li><a href="/personal/mail/">Подписки</a></li>
            </ul>

            <div class="item">
                <form>
                    <div class="wa-form">
                        <div class="item">
                            <div class="sub-title">Контакты</div>
                            <div class="wrap">
                                <div class="part">
                                    <input name="firstname" type="text" value="<?= $arUser['NAME'] ?>" id="inp_name"
                                           placeholder="Имя">
                                    <input name="lastname" type="text" value="<?= $arUser['LAST_NAME'] ?>"
                                           id="inp_surname" placeholder="Фамилия">
                                </div>
                                <div class="part">
                                    <input name="phone" type="phone" value="<?= $arUser['PERSONAL_PHONE'] ?>"
                                           id="inp_phone" placeholder="Телефон">
                                    <input name="email" type="mail" value="<?= $arUser['EMAIL'] ?>" id="inp_email"
                                           placeholder="E-mail">
                                </div>
                                <div class="part sex">


                                    <!-- Важен верхний регистр букв указывающих пол пользователя-->

                                    <input name="sex" value="f" data-sex="F" id="women" type="radio"
                                           <? if ($arUser['PERSONAL_GENDER'] == F) { ?>checked <? } ?>>
                                    <label for="women">Женщина</label>
                                    <input name="sex" value="m" data-sex="M" id="men" type="radio"
                                           <? if ($arUser['PERSONAL_GENDER'] == M) { ?>checked <? } ?>>
                                    <label for="men">Мужчина</label>

                                    <!--   <input class="add" type="submit" value="Сохранить" id="addus"> -->

                                    <a rel="nofollow" href="javascript:void(0)" class="add-to-cart" id="addus" style="    margin-top: 29px;
    margin-right: 3px;
    padding: 0 33px 0 39px;
    line-height: 52px;
    cursor: pointer;
    background: #88003d;
    border-radius: 3px;
    display: inline-block;
    border: 2px solid #88003d;
    border-radius: 2px;
    font-size: 20px;
    color: #fff;
    font-family: 'Open Sans', Arial, sans-serif;">
                                        <span>Сохранить</span>
                                    </a>

                                </div>
                            </div>
                        </div>


                        <?php
                        $us_id = $arUser['ID'];
                        echo "<script>
window.us_id = $us_id;
</script>";
                        ?>

                        <script>
                            $(document).ready(function () {
                                $('#addus').on('click', function (e) {

                                    var user_name = $("#inp_name").val();
                                    var user_surname = $("#inp_surname").val();
                                    var user_email = $("#inp_email").val();
                                    var user_phone = $("#inp_phone").val();
                                    var user_gender = $("input[name='sex']:radio:checked").attr('data-sex');


                                    $.post('/ajax/profile.php', {
                                        us_id,
                                        user_name,
                                        user_surname,
                                        user_email,
                                        user_phone,
                                        user_gender
                                    }, function (datab) {
                                        $("#contresult").remove();
                                        $("#fullcont").prepend('<strong id="contresult"><i class="icon16 saved"></i><span style="color:green">Контактная информация успешно обновлена.</span></strong>');

                                    })
                                });
                            });
                        </script>


                        <div class="separate-line"></div>

                        <div class="item">
                            <div class="sub-title">Адреса доставки</div>

                            <input name="adress" checked="" class="prettyCheckable" id="adress_1" type="radio">
                            <label for="adress_1">Москва, Лазурная 55, Москва, Квартира, офис 55, 54058, Российская
                                Федерация</label>
                            <div class="clear"></div>
                            <input name="adress" checked="" class="prettyCheckable" id="adress_2" type="radio">
                            <label for="adress_2">Москва, тест, Адыгея республика, Квартира, офис 3685416, Российская
                                Федерация</label>
                            <div class="clear"></div>
                        </div>

                        <div class="separate-line"></div>
                        <div class="item">
                            <div class="sub-title" id="newpass">Изменить пароль</div>
                            <div class="wrap">
                                <div class="part">
                                    <input type="password" placeholder="Пароль" id="opass">
                                </div>
                                <div class="part">
                                    <input type="password" name="password" placeholder="Новый пароль" id="npass">
                                    <input type="password" name="password_confirm" placeholder="Повторите пароль"
                                           id="cpass">
                                </div>
                                <div class="part password">
                                    <a rel="nofollow" href="javascript:void(0)" class="add-to-cart" id="addpass" style="    margin-top: 29px;
    margin-right: 3px;
    padding: 0 33px 0 39px;
    line-height: 52px;
    cursor: pointer;
    background: #88003d;
    border-radius: 3px;
    display: inline-block;
    border: 2px solid #88003d;
    border-radius: 2px;
    font-size: 20px;
    color: #fff;
    font-family: 'Open Sans', Arial, sans-serif;">
                                        <span>Сохранить</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


            <script>
                $(document).ready(function () {
                    $('#addpass').on('click', function (e) {

                        var new_pass_l = $("#npass").val();
                        var pass_confirm_l = $("#cpass").val();

                        /* Проверка на длину пароля*/

                        if (new_pass_l.length >= 6 && pass_confirm_l.length >= 6) {

                            var old_pass = $("#opass").val();
                            var new_pass = $("#npass").val();
                            var pass_confirm = $("#cpass").val();


                            $.post('/ajax/profile_pass.php', {
                                old_pass,
                                new_pass,
                                pass_confirm,
                                us_id
                            }, function (datab) {
                                //alert(datab);
                                if (datab == 'no') {

                                    $("#newuspass").remove();
                                    $("#newpass").append('<span id="newuspass"><br><strong><span style="color:red">Текущий пароль указан неверно</span></strong></span>');
                                }
                                else if (datab == 'noconfirm') {

                                    $("#newuspass").remove();
                                    $("#newpass").append('<span id="newuspass"><br><strong><span style="color:red">Повторно пароль указан неверно</span></strong></span>');
                                }
                                else {
                                    $("#newuspass").remove();
                                    $("#newpass").append('<span id="newuspass"><br><strong><span style="color:green">Пароль успешно обновлен</span></strong></span>');
                                }

                            })

                        }
                        else {
                            $("#newuspass").remove();
                            $("#newpass").append('<span id="newuspass"><br><strong><span style="color:red">Длина пароля должна быть не менее 6 символов</span></strong></span>');

                        }

                    });
                });
            </script>


            <div class="clear-both"></div>

            <div class="clear-both"></div>

            <div id="dialog" class="dialog">
                <div class="dialog-background"></div>
                <div class="dialog-window">

                    <div class="cart">

                    </div>
                </div>
            </div>

            <aside id="compare-leash">

            </aside>
        </div>

    </div>
<? } ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>