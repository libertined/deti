<?php
define("NO_KEEP_STATISTIC", true);
define('NO_AGENT_CHECK', true);
define("NO_AGENT_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
define('DisableEventsCheck', true);
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

$APPLICATION->IncludeComponent(
    "dr:child.list",
    "",
    Array(
        "IBLOCK_ID" => IBLOCK_CHILDS,
        "COUNT" => 8,
        "PAGE" => $_REQUEST['page'],
        "AGE" => $_REQUEST['age'],
        "SEX" => $_REQUEST['sex'],
        "USER" => "",
        "IS_FILTER" => $_REQUEST['filter'],
    )
);?>