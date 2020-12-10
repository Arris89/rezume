<?
define("HIDE_SIDEBAR", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");

if ($USER->IsAuthorized()) {

    session_start ();
    $_SESSION['message'] = $_POST['message'];
    $_SESSION['address'] = $_POST['address'];

/*     echo $_SESSION["message"].' *****коммент <br>';
    echo $_SESSION["address"].' *****адрес <br>';*/

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
                    <div id="carrier_area">
                        <h1 class="page-heading">Доставка:</h1>


                        <!-- Steps -->
                        <ul class="step clearfix" id="order_step">
                            <li class="step_done first">
                                <a href="/personal/cart/">
                                    <em>01.</em> Сводка
                                </a>
                            </li>
                            <li class="step_done second">
                                <a href="javascript:void(0)">
                                    <em>02.</em> Войти
                                </a>
                            </li>
                            <li class="step_done step_done_last third">
                                <a href="/personal/cart/step/">
                                    <em>03.</em> Адрес
                                </a>
                            </li>
                            <li class="step_current four">
                                <span><em>04.</em> Доставка</span>
                            </li>
                            <li id="step_end" class="step_todo last">
                                <span><em>05.</em> Оплата</span>
                            </li>
                        </ul>
                        <!-- /Steps -->


                        <form id="form" action="/personal/cart/step3/" method="post">
                            <div class="order_carrier_content box">
                                <div id="HOOK_BEFORECARRIER">
                                   
                                    <br>
                                    <p id="dateofdelivery" style="display: none;">
                                        Ориентировочная дата доставки этим перевозчиком с
                                        <span id="minimal"></span> и <span id="maximal"></span> <sup>*</sup>
                                        <br>
                                        <span style="font-size:10px;margin:0;padding:0;"><sup>*</sup> способами прямой оплаты (например, банковские карты)</span>
                                    </p>

                                </div>
                                <div class="delivery_options_address">
                                    <p class="carrier_title">
                                        Выберите способ доставки для адреса: Мой адрес
                                    </p>
                                    <div class="delivery_options">
<? $i = 0;

$db_dtype = CSaleDelivery::GetList(
    array(
            "SORT" => "ASC",
        ),
    array(
            "LID" => SITE_ID,
            "ACTIVE" => "Y",
        ),
    false,
    false,
    array()
);
if ($ar_dtype = $db_dtype->Fetch())
{


/*echo '<pre>'; 
print_r($ar_dtype);
echo '<pre>';*/

  

/*$ar_dtype['LOGOTIP']*/

 /*  echo "Вам доступны следующие способы доставки:<br>";*/
   do
   {      $rsFile = CFile::GetByID($ar_dtype['LOGOTIP']);
        $arFile = $rsFile->Fetch();
      
       $href = "upload/".$arFile['SUBDIR']."/".$arFile['FILE_NAME'].""; ?>
     <!--  echo $ar_dtype["NAME"]." - стоимость ".CurrencyFormat($ar_dtype["PRICE"], $ar_dtype["CURRENCY"]); -->


                                        <div class="delivery_option item">
                                            <div>
                                                <table class="resume table table-bordered">
                                                    <tbody>
                                                    <tr>
                                                        <td class="delivery_option_radio">
                                                        <!--     <div class="radio" id="uniform-delivery_option_212_0"> -->
                 <span>
                    <?if($i==0){?>
                    <input id="delivery_option_<?=$ar_dtype['ID']?>" class="delivery_option_radio" type="radio" name="delivery" data-name="<?=$ar_dtype['NAME']?>" value="<?=$ar_dtype['ID']?>" checked>
                 <?} else {?>
                    <input id="delivery_option_<?=$ar_dtype['ID']?>" class="delivery_option_radio" type="radio" name="delivery" data-name="<?=$ar_dtype["NAME"]?>" value="<?=$ar_dtype['ID']?>">
                    <?}?>
                 </span>
                                                           <!--  </div> -->
                                                        </td>
                                                        <td class="delivery_option_logo">
                                                            <img class="order_carrier_logo" src="/<?=$href?>"
                                                                 alt="<?=$ar_dtype["NAME"]?>">
                                                        </td>
                                                        <td>
                                                            <strong><?=$ar_dtype["NAME"]?></strong>
                                                            <br><?=$ar_dtype["DESCRIPTION"]?><br>
                                                        </td>
                                                        <td class="delivery_option_price">
                                                            <div class="delivery_option_price">
                                             <?
                                                if($ar_dtype["PRICE"]==0)
                                                    {  echo 'Бесплатно'; }
                                                        else
                                                    { echo $ar_dtype["PRICE"].' руб'; }

                                                ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div> 


   <? $i++;}
   while ($ar_dtype = $db_dtype->Fetch());
}?>

       


                                
                           
                                    </div> 

                                    <div class="hook_extracarrier" id="HOOK_EXTRACARRIER_212">
                                    </div>
                                </div> <!-- end delivery_options_address -->
                                <div id="extra_carrier" style="display: none;"></div>
                            </div> <!-- end delivery_options_address -->
                            <p class="cart_navigation clearfix">
                                <input type="hidden" name="step" value="3">
                                <input type="hidden" name="back" value="">
                                <a href="/" title="Назад"
                                   class="button-exclusive btn btn-default">
                                    <i class="icon-chevron-left"></i>
                                    Продолжить покупки
                                </a>
                                <button type="submit" name="processCarrier"
                                        class="button btn btn-default standard-checkout button-medium" style="">
                            <span>
                                Перейти к оформлению
                                <i class="icon-chevron-right right"></i>
                            </span>
                                </button>
                            </p>
                        </form>


                    </div> <!-- end carrier_area -->
                </div><!-- #center_column -->
            </div><!-- .row -->
        </div><!-- #columns -->
    </div>
<? } ?>
 <script>
 $(document).ready(function() {
$(".delivery_option_radio").change(function() {
    if(this.checked) {
    var delivery = $(this).attr('data-name'); 
        $(".devtext").val(delivery);

    }
})
}); 
</script>
<script>   

    $("#form").submit(function(e) {  
     /*   e.preventDefault();*/
    //указать вашу форму
/*    e.preventDefault(); // отменит перезагрузку
        var form = $(this);
    var url = form.attr('action'); //урл указанный в форме
   
    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // вся информация с формы
           success: function(data)
           {
                  setTimeout(function(){document.location.href = "/personal/cart/step3/";},100);
           }
         });*/

});
</script>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>