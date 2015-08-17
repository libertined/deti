<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
$APPLICATION->IncludeComponent(
    "bitrix:system.auth.form",
    "window",
    Array(
        "COMPONENT_TEMPLATE" => ".default",
        "REGISTER_URL" => "/cabinet/auth.php",
        "FORGOT_PASSWORD_URL" => "/cabinet/auth.php",
        "PROFILE_URL" => "/cabinet/index.php",
        "SHOW_ERRORS" => "Y"
    )
);?>