
        <?$APPLICATION->IncludeComponent("bitrix:system.auth.form", "", Array(
            "AJAX_MODE" => "Y",
            "AJAX_OPTION_SHADOW" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "FORGOT_PASSWORD_URL" => "",	// Страница забытого пароля
            "PROFILE_URL" => "",	// Страница профиля
            "REGISTER_URL" => "",	// Страница регистрации
            "SHOW_ERRORS" => "Y"	// Показывать ошибки
        ),
            false
        );?>

