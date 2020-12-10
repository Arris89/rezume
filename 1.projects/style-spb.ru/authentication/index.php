<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/default-bootstrap/css/authentication.css" type="text/css"
          media="all"/>

<?
if (!$USER->IsAuthorized()) {
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
                <div id="center_column" class="qwe11 center_column col-xs-12 col-sm-12">
                    <h1 class="page-heading">Авторизация</h1>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">

                            <form action="/register/" method="post" class="box create-account_form">
                                <h3 class="page-subheading">Создание учетной записи</h3>
                                <div class="form_content clearfix">
                                    <p>Чтобы зарегистрироваться, укажите, пожалуйста, свой адрес электронной почты.</p>
                                    <div class="alert alert-danger" id="create_account_error"
                                         style="display:none"></div>
                                    <div class="form-group mail">
                                        <label for="email_create">Адрес E-mail</label>
                                        <input type="email" class="is_required validate account_input form-control"
                                               id="mail" name="mail" value=""> <span id="valid"></span>
                                    </div>
                                    <div class="submit">
                                        <button class="btn btn-default button button-medium exclusive" type="submit"
                                                id="SubmitCreate" name="SubmitCreate" disabled>
							<span>
								<i class="icon-user left"></i>
								Создание учетной записи
							</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <? $APPLICATION->IncludeComponent("bitrix:system.auth.form", "style", Array(
                                    "REGISTER_URL" => "register.php",
                                    "FORGOT_PASSWORD_URL" => "",
                                    "PROFILE_URL" => "profile.php",
                                    "SHOW_ERRORS" => "Y"
                                )
                            ); ?>

                        </div>
                    </div>
                </div><!-- #center_column -->
            </div><!-- .row -->
        </div><!-- #columns -->
    </div>

<? } else {
    header('Location: /personal/');
} ?>

    <script>
        /*валидация при регистрации*/
        $(document).ready(function () {
            var pattern = /^[a-z0-9_-]+@[a-z0-9-]+\.([a-z]{1,6}\.)?[a-z]{2,6}$/i; //name-_09@mail09-.ru
            var mail = $('#mail');

            mail.blur(function () {
                if (mail.val() != '') {
                    if (mail.val().search(pattern) == 0) {
                        $('#valid').text('Подходит');
                        $('#submit').attr('disabled', false);
                        $('.form-group.mail').removeClass('form-error').addClass('form-ok');

                        $('#SubmitCreate').removeAttr('disabled');

                    } else {
                        $('#valid').text('Не подходит');
                        $('#submit').attr('disabled', true);
                        $('.form-group.mail').addClass('form-error');
                    }
                } else {
                    $('#valid').text('Поле e-mail не должно быть пустым');
                    $('.form-group.mail').addClass('form-error');
                    $('#submit').attr('disabled', true);
                }
            });
        });
    </script>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>