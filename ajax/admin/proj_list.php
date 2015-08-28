<?php
define("NO_KEEP_STATISTIC", true);
define('NO_AGENT_CHECK', true);
define("NO_AGENT_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
define('DisableEventsCheck', true);
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

$APPLICATION->IncludeComponent(
    "dr:admin.project.list",
    "",
    Array(
        "IBLOCK_ID" => array(IBLOCK_GEBNERAL_PROJ, IBLOCK_CHILD_PROLECT),
        "COUNT" => 20,
        "FILTER" => "Y",
        "TYPE" => $_REQUEST['type'],
        "TIME" => $_REQUEST['time'],
    )
);?>