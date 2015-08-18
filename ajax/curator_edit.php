<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
$APPLICATION->IncludeComponent(
    "dr:curator.edit",
    "",
    Array(
        "CABINET_PATH" => "/cabinet/"
    )
);?>