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
$arParams["DETAIL_PAGE"] = "http://all-luxury.ru/projects/";

// Получаем список детей у которых есть попечители с истекшим сроком
$arFilter = array (
	"IBLOCK_ID" => IBLOCK_GEBNERAL_PROJ,
	"ACTIVE" => "Y",
	"<DATE_ACTIVE_TO" => ConvertTimeStamp(time(),"FULL"),
);
$arSelect = array( "ID", "ACTIVE", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", "DATE_ACTIVE_TO",
				   "PROPERTY_IS_READY", "PROPERTY_ALL", "PROPERTY_PAYED");

$rsElement = CIBlockElement::GetList(array("ID" => "ASC"), $arFilter, false, false, $arSelect);
$arResult["ALL_COUNT"] = $rsElement->SelectedRowsCount(); //Всего анкет
$arResult["MSG"] = array();
while($arItem = $rsElement->GetNext()) {
	$arItem["URL"] = $arParams["DETAIL_PAGE"].$arItem["ID"]."/";
	$strTmpMess = "ID ".$arItem["ID"]." Всего оплатить: ".$arItem["PROPERTY_ALL_VALUE"]." ".MONEY_NAME.
		" Оплатили: ".$arItem["PROPERTY_PAYED_VALUE"]." ".MONEY_NAME.
		" <a href='".$arItem["URL"]."' target='_blanc'>".$arItem["URL"]."</a>";
	$arResult["MSG"][] = $strTmpMess;
}

if(!empty($arResult["MSG"])){
	$arEventFields["LIST"] = implode("<br>", $arResult["MSG"]);
	//CEvent::SendImmediate("DEACT_PUBL_PROJECTS", "s1", $arEventFields);
}
echo "<pre>";
print_r($arResult["MSG"]);
echo "</pre>";
?>