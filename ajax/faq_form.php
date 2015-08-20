<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
$APPLICATION->IncludeComponent(
    "dr:faq.form",
    "",
    Array(
        "CABINET_PATH" => "/faq/",
        "IBLOCK_ID" => IBLOCK_FAQ
    )
);?>