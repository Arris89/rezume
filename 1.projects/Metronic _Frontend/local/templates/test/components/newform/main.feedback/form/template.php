<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>

<? 
//print_r ($arResult);

if (!empty($arResult["ERROR_MESSAGE"])) {
    foreach ($arResult["ERROR_MESSAGE"] as $v)



if ($v == 'Укажите ваше имя.') {

 $ddf1 = array('1'=> 'user_name','2'=> 'Укажите ваше имя.' );

}
elseif ($v == 'Укажите E-mail, на который хотите получить ответ.') {

      $ddf2 = array('1'=> 'user_email','2'=> "$v" );

}

elseif ($v == 'Указанный E-mail некорректен.') {

      $ddf2 = array('1'=> 'user_email','2'=>'Указанный E-mail некорректен.' );

}

elseif ($v == 'Вы не написали сообщение.') {

      $ddf3 = array('1'=> 'MESSAGE','2'=> 'Вы не написали сообщение.' );

}
 }



if($ddf1) {$spert = 1;}

if($ddf2) {$spert = 2;}

if($ddf3) {$spert = 3;}

if ($ddf1 & $ddf2){$spert = 4;}

if ($ddf1 & $ddf3)  {$spert = 5;}

if ($ddf2 & $ddf3)  {$spert = 6;}

if ($ddf1 & $ddf2 & $ddf3)  {$spert = 7; }


//print_r ($ddf1);
//print_r ($ddf2);
//print_r ($ddf3);
//echo "$spert".'eesdfsdfsdf';

print "<script>





switch (".$spert.") {
  case 1:
$('[name = ".$ddf1['1']."]').attr('placeholder','".$ddf1['2']."').css('background', '#F5DEB3');
$(document).mouseup(function (e)
{
    var container1 = $('[name = user_email]');


if ($('[name = user_email]').val() == '') {



    if (!container1.is(e.target)) {  
     
    $('[name = user_email]').css('color', 'red').css('background', '#F5DEB3');
    } else {

      
    $('[name = user_email]').css('color', '#a6a7aa').css('background', '#fafafa');
    }

}
else {

      $('[name = user_email]').css('color', '#a6a7aa').css('background', '#fafafa');

    }



    var container2 = $('[name = user_name]');


if ($('[name = user_name]').val() == '') {



    if (!container2.is(e.target)) {  
    
    $('[name = user_name]').css('color', 'red').css('background', '#F5DEB3');
    } else {

    
    $('[name = user_name]').css('color', '#a6a7aa').css('background', '#fafafa');
    }

}
else {

      $('[name = user_name]').css('color', '#a6a7aa').css('background', '#fafafa');

    }



    var container3 = $('[name = MESSAGE]');


if ($('[name = MESSAGE]').val() == '') {



    if (!container3.is(e.target)) {  
  
    $('[name = MESSAGE]').css('color', 'red').css('background', '#F5DEB3');
    } else {

   
    $('[name = MESSAGE]').css('color', '#a6a7aa').css('background', '#fafafa');
    }

}
else {

      $('[name = MESSAGE]').css('color', '#a6a7aa').css('background', '#fafafa');

    }

});
  case 2:
$('[name = ".$ddf2['1']."]').attr('placeholder','".$ddf2['2']."').css('background', '#F5DEB3');
$(document).mouseup(function (e)
{
    var container1 = $('[name = user_email]');


if ($('[name = user_email]').val() == '') {



    if (!container1.is(e.target)) {  
     
    $('[name = user_email]').css('color', 'red').css('background', '#F5DEB3');
    } else {

      
    $('[name = user_email]').css('color', '#a6a7aa').css('background', '#fafafa');
    }

}
else {

      $('[name = user_email]').css('color', '#a6a7aa').css('background', '#fafafa');

    }



    var container2 = $('[name = user_name]');


if ($('[name = user_name]').val() == '') {



    if (!container2.is(e.target)) {  
    
    $('[name = user_name]').css('color', 'red').css('background', '#F5DEB3');
    } else {

    
    $('[name = user_name]').css('color', '#a6a7aa').css('background', '#fafafa');
    }

}
else {

      $('[name = user_name]').css('color', '#a6a7aa').css('background', '#fafafa');

    }



    var container3 = $('[name = MESSAGE]');


if ($('[name = MESSAGE]').val() == '') {



    if (!container3.is(e.target)) {  
  
    $('[name = MESSAGE]').css('color', 'red').css('background', '#F5DEB3');
    } else {

   
    $('[name = MESSAGE]').css('color', '#a6a7aa').css('background', '#fafafa');
    }

}
else {

      $('[name = MESSAGE]').css('color', '#a6a7aa').css('background', '#fafafa');

    }

});
  case 3:
 $('[name = ".$ddf3['1']."]').attr('placeholder','".$ddf3['2']."').css('background', '#F5DEB3');
 $(document).mouseup(function (e)
{
    var container1 = $('[name = user_email]');


if ($('[name = user_email]').val() == '') {



    if (!container1.is(e.target)) {  
     
    $('[name = user_email]').css('color', 'red').css('background', '#F5DEB3');
    } else {

      
    $('[name = user_email]').css('color', '#a6a7aa').css('background', '#fafafa');
    }

}
else {

      $('[name = user_email]').css('color', '#a6a7aa').css('background', '#fafafa');

    }



    var container2 = $('[name = user_name]');


if ($('[name = user_name]').val() == '') {



    if (!container2.is(e.target)) {  
    
    $('[name = user_name]').css('color', 'red').css('background', '#F5DEB3');
    } else {

    
    $('[name = user_name]').css('color', '#a6a7aa').css('background', '#fafafa');
    }

}
else {

      $('[name = user_name]').css('color', '#a6a7aa').css('background', '#fafafa');

    }



    var container3 = $('[name = MESSAGE]');


if ($('[name = MESSAGE]').val() == '') {



    if (!container3.is(e.target)) {  
  
    $('[name = MESSAGE]').css('color', 'red').css('background', '#F5DEB3');
    } else {

   
    $('[name = MESSAGE]').css('color', '#a6a7aa').css('background', '#fafafa');
    }

}
else {

      $('[name = MESSAGE]').css('color', '#a6a7aa').css('background', '#fafafa');

    }

});
  case 4:
$('[name = ".$ddf1['1']."]').attr('placeholder','".$ddf1['2']."').css('background', '#F5DEB3');
$('[name = ".$ddf2['1']."]').attr('placeholder','".$ddf2['2']."').css('background', '#F5DEB3');
$(document).mouseup(function (e)
{
    var container1 = $('[name = user_email]');


if ($('[name = user_email]').val() == '') {



    if (!container1.is(e.target)) {  
     
    $('[name = user_email]').css('color', 'red').css('background', '#F5DEB3');
    } else {

      
    $('[name = user_email]').css('color', '#a6a7aa').css('background', '#fafafa');
    }

}
else {

      $('[name = user_email]').css('color', '#a6a7aa').css('background', '#fafafa');

    }



    var container2 = $('[name = user_name]');


if ($('[name = user_name]').val() == '') {



    if (!container2.is(e.target)) {  
    
    $('[name = user_name]').css('color', 'red').css('background', '#F5DEB3');
    } else {

    
    $('[name = user_name]').css('color', '#a6a7aa').css('background', '#fafafa');
    }

}
else {

      $('[name = user_name]').css('color', '#a6a7aa').css('background', '#fafafa');

    }



    var container3 = $('[name = MESSAGE]');


if ($('[name = MESSAGE]').val() == '') {



    if (!container3.is(e.target)) {  
  
    $('[name = MESSAGE]').css('color', 'red').css('background', '#F5DEB3');
    } else {

   
    $('[name = MESSAGE]').css('color', '#a6a7aa').css('background', '#fafafa');
    }

}
else {

      $('[name = MESSAGE]').css('color', '#a6a7aa').css('background', '#fafafa');

    }

});
      case 5:
 $('[name = ".$ddf1['1']."]').attr('placeholder','".$ddf1['2']."').css('background', '#F5DEB3');
 $('[name = ".$ddf3['1']."]').attr('placeholder','".$ddf3['2']."').css('background', '#F5DEB3');
 $(document).mouseup(function (e)
{
    var container1 = $('[name = user_email]');


if ($('[name = user_email]').val() == '') {



    if (!container1.is(e.target)) {  
     
    $('[name = user_email]').css('color', 'red').css('background', '#F5DEB3');
    } else {

      
    $('[name = user_email]').css('color', '#a6a7aa').css('background', '#fafafa');
    }

}
else {

      $('[name = user_email]').css('color', '#a6a7aa').css('background', '#fafafa');

    }



    var container2 = $('[name = user_name]');


if ($('[name = user_name]').val() == '') {



    if (!container2.is(e.target)) {  
    
    $('[name = user_name]').css('color', 'red').css('background', '#F5DEB3');
    } else {

    
    $('[name = user_name]').css('color', '#a6a7aa').css('background', '#fafafa');
    }

}
else {

      $('[name = user_name]').css('color', '#a6a7aa').css('background', '#fafafa');

    }



    var container3 = $('[name = MESSAGE]');


if ($('[name = MESSAGE]').val() == '') {



    if (!container3.is(e.target)) {  
  
    $('[name = MESSAGE]').css('color', 'red').css('background', '#F5DEB3');
    } else {

   
    $('[name = MESSAGE]').css('color', '#a6a7aa').css('background', '#fafafa');
    }

}
else {

      $('[name = MESSAGE]').css('color', '#a6a7aa').css('background', '#fafafa');

    }

});
      case 6:
$('[name = ".$ddf2['1']."]').attr('placeholder','".$ddf2['2']."').css('background', '#F5DEB3');
$('[name = ".$ddf3['1']."]').attr('placeholder','".$ddf3['2']."').css('background', '#F5DEB3');
$(document).mouseup(function (e)
{
    var container1 = $('[name = user_email]');


if ($('[name = user_email]').val() == '') {



    if (!container1.is(e.target)) {  
     
    $('[name = user_email]').css('color', 'red').css('background', '#F5DEB3');
    } else {

      
    $('[name = user_email]').css('color', '#a6a7aa').css('background', '#fafafa');
    }

}
else {

      $('[name = user_email]').css('color', '#a6a7aa').css('background', '#fafafa');

    }



    var container2 = $('[name = user_name]');


if ($('[name = user_name]').val() == '') {



    if (!container2.is(e.target)) {  
    
    $('[name = user_name]').css('color', 'red').css('background', '#F5DEB3');
    } else {

    
    $('[name = user_name]').css('color', '#a6a7aa').css('background', '#fafafa');
    }

}
else {

      $('[name = user_name]').css('color', '#a6a7aa').css('background', '#fafafa');

    }



    var container3 = $('[name = MESSAGE]');


if ($('[name = MESSAGE]').val() == '') {



    if (!container3.is(e.target)) {  
  
    $('[name = MESSAGE]').css('color', 'red').css('background', '#F5DEB3');
    } else {

   
    $('[name = MESSAGE]').css('color', '#a6a7aa').css('background', '#fafafa');
    }

}
else {

      $('[name = MESSAGE]').css('color', '#a6a7aa').css('background', '#fafafa');

    }

});
      case 7:
  $('[name = ".$ddf1['1']."]').attr('placeholder','".$ddf1['2']."').css('background', '#F5DEB3');
  $('[name = ".$ddf2['1']."]').attr('placeholder','".$ddf2['2']."').css('background', '#F5DEB3');
  $('[name = ".$ddf3['1']."]').attr('placeholder','".$ddf3['2']."').css('background', '#F5DEB3');
  $(document).mouseup(function (e)
{
    var container1 = $('[name = user_email]');


if ($('[name = user_email]').val() == '') {



    if (!container1.is(e.target)) {  
     
    $('[name = user_email]').css('color', 'red').css('background', '#F5DEB3');
    } else {

      
    $('[name = user_email]').css('color', '#a6a7aa').css('background', '#fafafa');
    }

}
else {

      $('[name = user_email]').css('color', '#a6a7aa').css('background', '#fafafa');

    }



    var container2 = $('[name = user_name]');


if ($('[name = user_name]').val() == '') {



    if (!container2.is(e.target)) {  
    
    $('[name = user_name]').css('color', 'red').css('background', '#F5DEB3');
    } else {

    
    $('[name = user_name]').css('color', '#a6a7aa').css('background', '#fafafa');
    }

}
else {

      $('[name = user_name]').css('color', '#a6a7aa').css('background', '#fafafa');

    }



    var container3 = $('[name = MESSAGE]');


if ($('[name = MESSAGE]').val() == '') {



    if (!container3.is(e.target)) {  
  
    $('[name = MESSAGE]').css('color', 'red').css('background', '#F5DEB3');
    } else {

   
    $('[name = MESSAGE]').css('color', '#a6a7aa').css('background', '#fafafa');
    }

}
else {

      $('[name = MESSAGE]').css('color', '#a6a7aa').css('background', '#fafafa');

    }

});
}






$(document).mouseup(function (e)
{
    var container1 = $('[name = user_email]');


if ($('[name = user_email]').val() == '') {



    if (!container1.is(e.target)) {  
     
    $('[name = user_email]').css('color', 'red').css('background', '#F5DEB3');
    } else {

      
    $('[name = user_email]').css('color', '#a6a7aa').css('background', '#fafafa');
    }

}
else {

      $('[name = user_email]').css('color', '#a6a7aa').css('background', '#fafafa');

    }



    var container2 = $('[name = user_name]');


if ($('[name = user_name]').val() == '') {



    if (!container2.is(e.target)) {  
    
    $('[name = user_name]').css('color', 'red').css('background', '#F5DEB3');
    } else {

    
    $('[name = user_name]').css('color', '#a6a7aa').css('background', '#fafafa');
    }

}
else {

      $('[name = user_name]').css('color', '#a6a7aa').css('background', '#fafafa');

    }



    var container3 = $('[name = MESSAGE]');


if ($('[name = MESSAGE]').val() == '') {



    if (!container3.is(e.target)) {  
  
    $('[name = MESSAGE]').css('color', 'red').css('background', '#F5DEB3');
    } else {

   
    $('[name = MESSAGE]').css('color', '#a6a7aa').css('background', '#fafafa');
    }

}
else {

      $('[name = MESSAGE]').css('color', '#a6a7aa').css('background', '#fafafa');

    }

});




</script>";








if (strlen($arResult["OK_MESSAGE"]) > 0) {
    ?>
    <div class="mf-ok-text"><?= $arResult["OK_MESSAGE"] ?></div>
    <?
}?>
<div class="col-md-5 col-sm-7">
    <form action="<?= POST_FORM_ACTION_URI ?>" method="POST">
        <?= bitrix_sessid_post() ?>


        <div class="margin-b-10">
            <input type="text" class="form-control" name="user_name" value="<?= $arResult["AUTHOR_NAME"] ?>"
                   placeholder="Name">
        </div>


        <div class="margin-b-10">
            <input type="text" class="form-control" name="user_email" value="<?= $arResult["AUTHOR_EMAIL"] ?>"
                   placeholder="Email">
        </div>
        <div class="margin-b-10">
            <input type="text" class="form-control" name="TELL" value="<?= $arResult["TELL"] ?>" placeholder="Phone">
        </div>

        <div class="margin-b-20">
            <textarea class="form-control" name="MESSAGE" rows="5" cols="40"
                      placeholder="Message"><?= $arResult["MESSAGE"] ?></textarea>
        </div>
        
<? print  "<script> $('.form-control').val(''); </script>";?>

        <? if ($arParams["USE_CAPTCHA"] == "Y"): ?>
            <div class="mf-captcha">
                <div class="mf-text"><?= GetMessage("MFT_CAPTCHA") ?></div>
                <input type="hidden" name="captcha_sid" value="<?= $arResult["capCode"] ?>">
                <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["capCode"] ?>" width="180" height="40"
                     alt="CAPTCHA">
                <div class="mf-text"><?= GetMessage("MFT_CAPTCHA_CODE") ?><span class="mf-req">*</span></div>
                <input type="text" name="captcha_word" size="30" maxlength="50" value="">
            </div>
        <? endif; ?>
        <input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">
        <input type="submit" name="submit" value="<?= GetMessage("MFT_SUBMIT") ?>"
               class="btn-theme btn-theme-sm btn-base-bg text-uppercase">
    </form>
</div>      