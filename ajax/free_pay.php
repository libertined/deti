<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
$APPLICATION->IncludeComponent(
    "dr:new_pay",
    "",
    Array(
        "IBLOCK_ID" => '13',
        "PAYMENT_SYSTEM_PATH" => "https://lmi.paymaster.ua/",
        "MERCHANT_ID" => "1996",
        /*"PAYMENT_SYSTEM" => "18",*/
        "PAYMENT_DESC" => "Благотворительный взнос",
        "PAYMENT_SUM" => $_REQUEST['sum'],
        "PAYMENT_SIM_MODE" => "2",
        "PURPOSE" => $_REQUEST['purpose'],
        "PURPOSE_ID" => $_REQUEST['purpose_id'],
        "PURPOSE_LIST" => $_REQUEST['purpose_list']
    )
);?>