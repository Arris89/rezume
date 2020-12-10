<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main;

$request = Main\Application::getInstance()->getContext()->getRequest();

$projectName = $request->get('project_name');
if($projectName){
    $_SESSION['project_name'] = $projectName;
}

?>
<div class="order-page">
    <div class="js-make-order">
        <?
        # AJAX
        if ($request->get('make-order-ajax') == 'y') {
            $APPLICATION->RestartBuffer();
        }

        switch ($arResult['STEP']){
            case 2:
                include(Main\Application::getDocumentRoot().$templateFolder.'/step2.php');
                break;
            case 3:
                include(Main\Application::getDocumentRoot().$templateFolder.'/step3.php');
                break;
            case 4:
                include(Main\Application::getDocumentRoot().$templateFolder.'/confirm.php');
                unset($_SESSION['project_name']);
                unset($_SESSION['shop']);
                break;
        }
        # AJAX
        if ($request->get('make-order-ajax') == 'y') {
            die();
        }
        ?>
    </div>

    <div class="preloader js-preloader" style="display: none">
        <div class="sk-circle-bounce">
            <div class="sk-child sk-circle-1"></div>
            <div class="sk-child sk-circle-2"></div>
            <div class="sk-child sk-circle-3"></div>
            <div class="sk-child sk-circle-4"></div>
            <div class="sk-child sk-circle-5"></div>
            <div class="sk-child sk-circle-6"></div>
            <div class="sk-child sk-circle-7"></div>
            <div class="sk-child sk-circle-8"></div>
            <div class="sk-child sk-circle-9"></div>
            <div class="sk-child sk-circle-10"></div>
            <div class="sk-child sk-circle-11"></div>
            <div class="sk-child sk-circle-12"></div>
        </div>
    </div>
</div>