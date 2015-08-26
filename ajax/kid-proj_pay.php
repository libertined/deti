<?php
define("NO_KEEP_STATISTIC", true);
define('NO_AGENT_CHECK', true);
define("NO_AGENT_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
define('DisableEventsCheck', true);
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

$APPLICATION->IncludeComponent(
    "dr:individual.project.list",
    "pay",
    Array(
        "IBLOCK_ID" => IBLOCK_CHILD_PROLECT,
        "COUNT" => 20,
        "FILTER" => "",
        "KID" => $_REQUEST['kid'],
        "PROJECTS" => $_REQUEST['proj'],
        "PAY_TYPE" => $_REQUEST['pay'],
    )
);?>