<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
?><?$APPLICATION->IncludeComponent("bitrix:main.register", "register", Array(
                    "COMPONENT_TEMPLATE" => "aviator",
                    "SHOW_FIELDS" => array(	// Поля, которые показывать в форме
                        0 => "EMAIL",
                        1 => "NAME",
                        2 => "LAST_NAME",
                        3 => "PERSONAL_GENDER",
                    ),
                    "REQUIRED_FIELDS" => "",	// Поля, обязательные для заполнения
                    "AUTH" => "Y",	// Автоматически авторизовать пользователей
                    "USE_BACKURL" => "Y",	// Отправлять пользователя по обратной ссылке, если она есть
                    "SUCCESS_PAGE" => "",	// Страница окончания регистрации
                    "SET_TITLE" => "N",	// Устанавливать заголовок страницы
                    "USER_PROPERTY" => "",	// Показывать доп. свойства
                    "USER_PROPERTY_NAME" => "",	// Название блока пользовательских свойств
                    "AJAX_MODE" => "Y",
                    "AJAX_OPTION_SHADOW" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N"
                ),
                    false
                );

       ?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>