<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<div class="container section-style">
    <?if (is_string($_REQUEST["backurl"]) && strpos($_REQUEST["backurl"], "/") === 0)
    {
        LocalRedirect($_REQUEST["backurl"]);
    }else{
        LocalRedirect('/personal/order/');
    }

    $APPLICATION->SetTitle("Авторизация");
    ?>
    <p>Вы зарегистрированы и успешно авторизовались.</p>

    <p>Используйте административную панель в верхней части экрана для быстрого доступа к функциям управления структурой и информационным наполнением сайта. Набор кнопок верхней панели отличается для различных разделов сайта. Так отдельные наборы действий предусмотрены для управления статическим содержимым страниц, динамическими публикациями (новостями, каталогом, фотогалереей) и т.п.</p>
    <br>
    <p><a href="<?=SITE_DIR?>">Вернуться на главную страницу</a></p>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>