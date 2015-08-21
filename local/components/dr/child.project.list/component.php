<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
global $USER;
if(!CModule::IncludeModule("iblock"))
{
    $this->AbortResultCache();
    ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
    return;
}
/* Обработка параметров */
$arParams["IBLOCK_ID"] = trim($arParams["IBLOCK_ID"]);
$arParams["USER"] = $USER->GetID();

/* Получаем всех детей
 * Предварительный список
*/
$arTmpItems = array();
$arFilter = array (
    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
    "PROPERTY_CURATOR" => $arParams["USER"]
);
$arSelect = array( "ID", "ACTIVE", "NAME", "PREVIEW_PICTURE",
    "PROPERTY_SEX", "PROPERTY_AGE", "PROPERTY_CURATOR");

$rsElement = CIBlockElement::GetList(array("ID" => "ASC"), $arFilter, false, false, $arSelect);
$arResult["ALL_COUNT"] = $rsElement->SelectedRowsCount(); //Всего анкет
$firstKid = 0;
while($arItem = $rsElement->GetNext()) {
    $arItem["IMG_PATH"] = CFile::GetPath($arItem["PREVIEW_PICTURE"]);
    $arTmpItems[] = $arItem;
    if($firstKid == 0) $firstKid = $arItem["ID"];
}

$arResult["ACTIVE"] = $firstKid;
$arResult["WIDTH"] = floor(100/($arResult["ALL_COUNT"] + 1));
$arResult['ITEMS'] = $arTmpItems;


$this->IncludeComponentTemplate();
?>