<?
define("HIDE_SIDEBAR", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Добавить адрес");

if ($USER->IsAuthorized()) {
    ?>

    <div class="columns-container">
        <div id="columns" class="container">

            <!-- Breadcrumb -->
            <div class="breadcrumb clearfix">
            <?$APPLICATION->IncludeComponent("bitrix:breadcrumb","style",Array(
        			"START_FROM" => "0", 
        			"PATH" => "", 
        			"SITE_ID" => "s1" 
    			)
			);?>
            </div>
            <!-- /Breadcrumb -->

            <div id="slider_row" class="row">
            </div>
            <div class="row">
                <div id="center_column" class="qwe11 center_column col-xs-12 col-sm-12">
                    <div class="box">
                        <h1 class="page-subheading">Ваши адреса</h1>
                        <p class="info-title">
                            Чтобы добавить адрес, заполните эту форму:
                        </p>
                        <?
                            $user = $USER->GetID();
                        ?>
                        <p class="required"><sup>*</sup>Обязательное поле</p>
                        <form action="/local/templates/style-spb/ajax/addhl.php" method="post" class="std" id="add_address" style="    max-width: 271px;">
                            <input name="user" type="hidden" value="<?=$user['ID']?>">

                            <div class="required form-group">
                                <label for="firstname">ФИО <sup>*</sup></label>
                                <input class="is_required validate form-control" data-validate="isName" type="text"
                                       name="fio" id="firstname" value="">
                            </div>

                            <div class="form-group">
                                <label for="company">Организация</label>
                                <input class="form-control validate" data-validate="isGenericName" type="text"
                                       id="company" name="comp" value="">
                            </div>

                            <div class="required form-group">
                                <label for="address1">Адрес <sup>*</sup></label>
                                <input class="is_required validate form-control" data-validate="isAddress" type="text"
                                       id="address1" name="street" value="">
                            </div>

                            <div class="required postcode form-group unvisible" style="display: block;">
                                <label for="postcode">Почтовый индекс <sup>*</sup></label>
                                <input class="is_required validate form-control uniform-input text"
                                       data-validate="isPostCode" type="text" id="postcode" name="index" value="">
                            </div>
                            <div class="required form-group">
                                <label for="city">Город <sup>*</sup></label>
                                <input class="is_required validate form-control" data-validate="isCityName" type="text"
                                       name="city" id="city" value="" maxlength="64">
                            </div>

                            <div class="required form-group">
                                <label for="id_country">Страна <sup>*</sup></label>
                                 <input class="is_required validate form-control" data-validate="isCityName" type="text"
                                       name="country" id="country" value="" maxlength="64">
                            </div>
                            <div class="form-group phone-number">
                                <label for="phone">Телефон <sup>*</sup></label>
                                <input class="is_required validate form-control" data-validate="isPhoneNumber"
                                       type="tel" id="phone" name="phone" value="">
                            </div>
                            <div class="clearfix"></div>
                            <div class="clearfix"></div>
                            <div class="required form-group" id="adress_alias">
                                <label for="alias">Название указанного адреса, например "Дом" или "Работа" <sup>*</sup></label>
                                <input type="text" id="alias" class="is_required validate form-control"
                                       data-validate="isGenericName" name="alias" value="Мой адрес">
                            </div>
                            <p class="submit2">

                                <button name="submitAddress" class="btn btn-default button button-medium">
				                    <span>
					                   Сохранить
					                   <i class="icon-chevron-right right"></i>
				                    </span>
                                </button>
                            </p>
                        </form>
                    </div>
                    <ul class="footer_links clearfix">
                        <li>
                            <a class="btn btn-defaul button button-small" href="/personal/addresses/">
                                <span><i class="icon-chevron-left"></i> Вернуться к адресам</span>
                            </a>
                        </li>
                    </ul>
                </div><!-- #center_column -->
            </div><!-- .row -->
        </div><!-- #columns -->
    </div>
<?}?>

<script>   

    $("#add_address").submit(function(e) {  //указать вашу форму
    e.preventDefault(); // отменит перезагрузку
    var form = $(this);
    var url = form.attr('action'); //урл указанный в форме
    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // вся информация с формы
           success: function(data)
           {
                 location.replace('/personal/cart/step/');
           }
         });
});

</script>

    <? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>