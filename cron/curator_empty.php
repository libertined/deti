<?php // Запускаем в 00.10, т.е. в саммом начале дня
ini_set("display_errors", 1);
set_time_limit(0);
ignore_user_abort(true);

$_SERVER["DOCUMENT_ROOT"] = realpath(dirname(__FILE__)."/..");
$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

if(!CModule::IncludeModule("iblock"))
{
	$this->AbortResultCache();
	ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
	return;
}

// Получаем список детей у которых есть попечители с истекшим сроком
$arFilter = array (
	"IBLOCK_ID" => IBLOCK_CHILDS,
	"!PROPERTY_CURATOR" => false,
	"<PROPERTY_TIME" => ConvertTimeStamp(mktime(0, 0, 0, date("m"), date("d"), date("Y")), "FULL")
);
$arSelect = array( "ID", "ACTIVE", "NAME", "PROPERTY_CURATOR", "PROPERTY_TIME", "PROPERTY_TIME_FROM");
$rsElement = CIBlockElement::GetList(array("ID" => "ASC"), $arFilter, false, false, $arSelect);
$arResult["CHILDREN"] = array();
$arTmpCuratorId = array();
$dateLimit = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
while($arItem = $rsElement->GetNext()) {
	$isEmpty = false;
	$timesBegin = array();
	$timesEnd = array();
	$curators = array();
	foreach($arItem["PROPERTY_TIME_VALUE"] as $number => $timeStr){
		$timeValue = MakeTimeStamp($timeStr);
		if($timeValue < $dateLimit){
			$arTmpCuratorId[ $arItem["PROPERTY_CURATOR_VALUE"][$number] ] = $arItem["PROPERTY_CURATOR_VALUE"][$number];
			$arTmpCurator = array(
				"CHILD_ID" => $arItem["ID"],
				"CHILD_NAME" => $arItem["NAME"],
				"CURATOR_ID" => $arItem["PROPERTY_CURATOR_VALUE"][$number],
			);
			$arResult["CHILDREN"][] = $arTmpCurator;
			$isEmpty = true;
		}
		else{
			$timesBegin[] = $arItem["PROPERTY_TIME_FROM_VALUE"][$number];
			$timesEnd[] = $arItem["PROPERTY_TIME_VALUE"][$number];
			$curators[] = $arItem["PROPERTY_CURATOR_VALUE"][$number];
		}
	}
	if($isEmpty){
		CIBlockElement::SetPropertyValues($arItem["ID"], IBLOCK_CHILDS, $timesBegin, "TIME_FROM");
        CIBlockElement::SetPropertyValues($arItem["ID"], IBLOCK_CHILDS, $timesEnd, "TIME");
        CIBlockElement::SetPropertyValues($arItem["ID"], IBLOCK_CHILDS, $curators, "CURATOR");
	}
}

if(!empty($arTmpCuratorId)){
	$arFilterUser = array(
		"GROUPS_ID" => CURATOR_GROUP,
		"ID" => implode(" | ", $arTmpCuratorId),
	);
}
$rsUser = CUser::GetList(($by="ID"), ($order="desc"),
	$arFilterUser,
	array(
		"SELECT"=>array("UF_*"),
		"FIELDS"=>array("ID", "NAME", "LAST_NAME", "SECOND_NAME"))
);
$arResult["CURATOR"] = array();
while($arItem = $rsUser->Fetch()) {
	$arResult["CURATOR"][ $arItem["ID"] ] = $arItem;
}
$arResult["MSG"] = array();
foreach($arResult["CHILDREN"] as $child){
	$strTmpChild = $arTmpCurator["CHILD_NAME"]." (".$arTmpCurator["CHILD_ID"].") Попечитель: ".
		$arResult["CURATOR"][ $arTmpCurator["CURATOR_ID"] ]["NAME"]." ".$arResult["CURATOR"][ $arTmpCurator["CURATOR_ID"] ]["SECOND_NAME"].
		" ".$arResult["CURATOR"][ $arTmpCurator["CURATOR_ID"] ]["LAST_NAME"]." (".$arTmpCurator["CURATOR_ID"].")";
	$arResult["MSG"][] = $strTmpChild;
}
if(!empty($arResult["MSG"])){
	$arEventFields["LIST"] = implode("<br>", $arResult["MSG"]);
	CEvent::SendImmediate("CURATOR_EMPTY", "s1", $arEventFields);
}
echo "<pre>";
print_r($arResult["MSG"]);
echo "</pre>";
?>