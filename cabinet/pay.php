<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
$APPLICATION->IncludeComponent(
  "dr:result_pay",
  "",
  Array(
    "IBLOCK_ID" => '13',
    "PAYMENT_SYSTEM_PATH" => "https://lmi.paymaster.ua/",
    "MERCHANT_ID" => $_REQUEST['LMI_MERCHANT_ID'],
    "ELEMENT_ID" => $_REQUEST['LMI_PAYMENT_NO'],
    "PAYMENT_SYSTEM" => $_REQUEST['LMI_PAYMENT_SYSTEM'],
    "PAYMENT_DESC" => $_REQUEST['LMI_PAYMENT_DESC'],
    "PAYMENT_SUM" => $_REQUEST['LMI_PAYMENT_AMOUNT'],
    "SYS_PAYMENT_ID" => $_REQUEST['LMI_SYS_PAYMENT_ID'],
    "SYS_PAYMENT_DATE" => $_REQUEST['LMI_SYS_PAYMENT_DATE'],
    "RESULT" => $_REQUEST['res'],
  )
);?>