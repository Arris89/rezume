<?

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");

if($USER->IsAuthorized()){
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
                    <h1 class="page-heading">Мои адреса</h1>


                    <!-- Steps -->
                    <ul class="step clearfix" id="order_step">
                        <li class="step_done first">
                            <a href="/personal/cart/">
                                <em>01.</em> Сводка
                            </a>
                        </li>
                        <li class="step_done step_done_last second">
                            <a href="javascript:void(0)">
                                <em>02.</em> Войти
                            </a>
                        </li>
                        <li class="step_current third">
                            <span><em>03.</em> Адрес</span>
                        </li>
                        <li class="step_todo four">
                            <span><em>04.</em> Доставка</span>
                        </li>
                        <li id="step_end" class="step_todo last">
                            <span><em>05.</em> Оплата</span>
                        </li>
                    </ul>
                    <!-- /Steps -->

                <form action="/personal/cart/step2/" method="post" id="step2">
                        <div class="addresses clearfix">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">

                                   <!--  <div class="address_delivery select form-group selector1">
                                        <label for="id_address_delivery">Выберите адрес доставки</label>
                                        <div class="selector" id="uniform-id_address_delivery"
                                             style="width: 267px;">
                                             <span style="width: 257px; user-select: none;">
						                      </span> -->
             <!--            <select name="id_address_delivery" id="id_address_delivery" class="address_select form-control">
                              <option value="212" selected="selected">
                                    Мой адрес
                               </option>
                        </select>
                  -->

   
<?
if (CModule::IncludeModule('highloadblock')) {

    $ID = 5; 

    $hldata = Bitrix\Highloadblock\HighloadBlockTable::getById($ID)->fetch();
    $hlentity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata);
    $entity_data_class = $hlentity->getDataClass();

    $result = $entity_data_class::getList(array(
                "select" => array("ID", "UF_USER","UF_CITY","UF_INDEX","UF_PHONE","UF_COUNTRY","UF_STREET","UF_COMPANY","UF_FIO", "UF_ALIAS"), 
                "order" => array(),
                "filter" => array("UF_USER"=>$arUser['ID']),
    ));

      $list = $result->getSelectedRowsCount();

    if($list>1){?>
<label for="id_address_delivery">Выберите адрес доставки</label>
    <select class="select">
    <?while ($resds = $result->fetch()) {
        $addr[] = $resds;
        echo '<option class="address_select form-control" data-adr="'.$resds["ID"].'">'.$resds["UF_FIO"].'</option>';
    }?>
<select>
<?} else


{

   while ($resds = $result->fetch()) {
        $addr[] = $resds;
    } 
}

}?>



<!-- 
                                        </div>
                                        <span class="waitimage"></span>
                                    </div> -->
                            <p class="checkbox addressesAreEquals">
                <div class="checker" id="uniform-addressesAreEquals">
                    <!-- <span class="checked"> -->
                     <!--    <input type="checkbox" name="same" id="addressesAreEquals" value="1" checked="checked"></span> -->
                    </div>
<!--                 <label for="addressesAreEquals">Использовать этот же адрес для оплаты заказа</label> -->
            </p>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div id="address_invoice_form" class="select form-group selector1"
                                         style="display: none;">
                                        <a href="/address/"
                                           title="Добавить" class="button button-small btn btn-default">
						<span>
							Добавить новый адрес
							<i class="icon-chevron-right right"></i>
						</span>
                                        </a>
                                    </div>
                                </div>
                            </div> <!-- end row -->
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">

                                    <ul class="address item box" id="address_delivery">

                                        <li class="address_title">
                                            <h3 class="page-subheading">Ваш адрес доставки</h3>
                                        </li>
                                        <li class="address_firstname address_lastname"><?=$addr[0]['UF_FIO'];?></li>
                                        <li class="address_company"><?=$addr[0]['UF_COMPANY'];?></li>
                                        <li class="address_address1"><?=$addr[0]['UF_STREET'];?></li>
                                        <li class="address_postcode address_city">
                                            <?=$addr[0]['UF_INDEX'];?> 
                                            <?=$addr[0]['UF_CITY'];?>
                                        </li>
                                        <li class="address_country_name"><?=$addr[0]['UF_COUNTRY'];?></li>
                                        <li class="address_phone"><?=$addr[0]['UF_PHONE'];?></li>
                                        <li class="address_update">
                                            <a class="button button-small btn btn-default"
                                                                      href=""
                                                                      title="Обновить">
                                                <span>Обновить<i class="icon-chevron-right right"></i>
                                                </span>
                                            </a>
                                        </li>
                                           <input type="hidden" name="address" value="<?=$addr[0]['UF_ALIAS'];?>">

                                    </ul>

                                </div>
                                <div class="col-xs-12 col-sm-6">
               <!--                      <ul class="address alternate_item box" id="address_invoice">
                                        <li class="address_title"><h3 class="page-subheading">Адрес оплаты</h3></li>

                                                           <li class="address_firstname address_lastname"><?=$addr[0]['UF_FIO'];?></li>
                                        <li class="address_company"><?=$addr[0]['UF_COMPANY'];?></li>
                                        <li class="address_address1"><?=$addr[0]['UF_STREET'];?></li>
                                        <li class="address_postcode address_city"><?=$addr[0]['UF_INDEX'];?> <?=$addr[0]['UF_CITY'];?></li>
                                        <li class="address_country_name"><?=$addr[0]['UF_COUNTRY'];?></li>
                                        <li class="address_phone"><?=$addr[0]['UF_PHONE'];?></li>


                                        <li class="address_update"><a class="button button-small btn btn-default"
                                                                      href=""
                                                                      title="Обновить"><span>Обновить<i
                                                            class="icon-chevron-right right"></i></span></a></li>
                                    </ul> -->
                                </div>
                            </div> <!-- end row -->
                            <p class="address_add submit">
                                <a href="/address/" title="Добавить"
                                   class="button button-small btn btn-default">
                                    <span>Добавить новый адрес<i class="icon-chevron-right right"></i></span>
                                </a>
                            </p>
                            <div id="ordermsg" class="form-group">
                                <label>Если вы хотите добавить комментарий к заказу, пожалуйста, напишите его
                                    ниже.</label>
                                <textarea class="form-control" cols="60" rows="6" name="message"></textarea>
                            </div>
                        </div> <!-- end addresses -->
                        <p class="cart_navigation clearfix">
                            <input type="hidden" class="hidden" name="step" value="2">
                            <input type="hidden" name="back" value="">
                            <a href="/" title="Назад" class="button-exclusive btn btn-default">
                                <i class="icon-chevron-left"></i>
                                Продолжить покупки
                            </a>
                        <a href="/" title="Назад">
                            <button type="submit" class="button btn btn-default button-medium">
                                <span>Перейти к оформлению<i class="icon-chevron-right right"></i></span>
                            </button>
                        </a>
                        </p>
                    </form>
                </div><!-- #center_column -->
            </div><!-- .row -->
        </div><!-- #columns -->
    </div>

<?} else {

 header('Location: /authentication/');
}?>


<script>

/*смена адреса*/

$(document).ready(function() { 
  $(".select").change(function(){
    var adr = $('select option:selected').attr('data-adr');
/*    alert(adr);*/

    $.post('/local/templates/style-spb/ajax/adress.php', {adr}, function (data) {
            var datad = JSON.parse(data);
/*            alert(JSON.stringify(datad));*/
             /*   alert(datad.UF_FIO);*/


     
                   var newadr =   `
                     <li class="address_title">
                                            <h3 class="page-subheading">Ваш адрес доставки</h3>
                                        </li>
                                        <li class="address_firstname address_lastname">${datad.UF_FIO}</li>
                                        <li class="address_company">${datad.UF_COMPANY}</li>
                                        <li class="address_address1">${datad.UF_STREET}</li>
                                        <li class="address_postcode address_city">
                                            ${datad.UF_INDEX} 
                                            ${datad.UF_STREET}
                                        </li>
                                        <li class="address_country_name">${datad.UF_COUNTRY}</li>
                                        <li class="address_phone">${datad.UF_PHONE}</li>
                                        <li class="address_update">
                                            <a class="button button-small btn btn-default"
                                                                      href=""
                                                                      title="Обновить">
                                                <span>Обновить<i class="icon-chevron-right right"></i>
                                                </span>
                                            </a>
                                        </li>
                                           <input type="hidden" name="address" value="${datad.UF_ALIAS}">`; 

                $('.address.item.box').html(newadr);
       })

  });
});

</script>

<script>   

    $("#step2").submit(function(e) {  //указать вашу форму
   /* e.preventDefault();*/ // отменит перезагрузку
       /* var form = $(this);
        var url = form.attr('action');*/ //урл указанный в форме
   
/*    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // вся информация с формы
           success: function(data)
           {
                  setTimeout(function(){document.location.href = "/personal/cart/step2/";},100);
           }
         });*/
});

</script>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>