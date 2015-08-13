<?php
define("NO_KEEP_STATISTIC", true);
define('NO_AGENT_CHECK', true);
define("NO_AGENT_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
define('DisableEventsCheck', true);
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

$APPLICATION->IncludeComponent(
    "dr:project.list",
    "",
    Array(
        "IBLOCK_ID" => IBLOCK_GEBNERAL_PROJ,
        "COUNT" => 4,
        "PAGE" => $_REQUEST['page'],
        "ACTIVE" => $_REQUEST['active'],
    )
);?>