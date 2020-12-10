<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Подписки");
global $USER;

if ( !$USER->IsAuthorized() )
{?>




    <div class="basket-wrap basket-order">
        <div class="title"><h2>Вход</h2></div>
        <div class="container">
            <div class="separate-line"></div>
            <div class="container-small">
                <p>Войдите с помощью аккаунта в соц сетях</p>
                <div class="socials-list">
                    <div class="wa-auth-adapters">
                        <ul>
                            <li class="wa-auth-adapter-facebook">
                                <a href="/oauth.php?app=shop&amp;provider=facebook">
                                    <img alt="Facebook" src="<?=SITE_TEMPLATE_PATH?>/images/facebook.png"></a>
                            </li>
                            <li class="wa-auth-adapter-vkontakte">
                                <a href="/oauth.php?app=shop&amp;provider=vkontakte">
                                    <img alt="ВКонтакте" src="<?=SITE_TEMPLATE_PATH?>/images/vkontakte.png"></a>
                            </li>
                        </ul>
                        <p>Авторизуйтесь, указав свои контактные данные, или воспользовавшись перечисленными выше сервисами.</p>
                    </div>
                </div>

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


<? }

else

{

    ?>



    <div class="title">
        <h2>Личный кабинет</h2>
    </div>
    <div class="container" style="margin-top: 35px">
        <ul class="tabs-menu">
            <li><a href="/personal/profile">Личная информация</a></li>
            <li><a href="/personal/orders">Мои заказы</a></li>
            <li><a href="/personal/favorites">Избранное</a></li>
            <li class="active"><a href="/personal/mail/">Подписки</a></li>
        </ul>


        <div class="tab-item visible open-content">




            <?$APPLICATION->IncludeComponent(
	"bitrix:sender.subscribe", 
	"cabinet", 
	array(
		"COMPONENT_TEMPLATE" => "cabinet",
		"USE_PERSONALIZATION" => "N",
		"CONFIRMATION" => "N",
		"SHOW_HIDDEN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "Y",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"SET_TITLE" => "Y",
		"HIDE_MAILINGS" => "N",
		"USER_CONSENT" => "N",
		"USER_CONSENT_ID" => "0",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "N",
		"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>


            <div class="clear">
            </div>
        </div>


        <div class="clear-both">
        </div>
        <div class="clear-both">
        </div>
        <div id="dialog" class="dialog">
            <div class="dialog-background">
            </div>
            <div class="dialog-window">
                <div class="cart">
                </div>
            </div>
        </div>
        <aside id="compare-leash"> </aside>
    </div>



<? } ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>