<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
$APPLICATION->IncludeComponent(
    "dr:child.info",
    "",
    Array(
        "CABINET_PATH" => "/cabinet/",
        "ID" => $_REQUEST['id'],
        "TIME" => $_REQUEST['time'],
    )
);?>