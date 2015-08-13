<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if(!CModule::IncludeModule("iblock"))
{
    $this->AbortResultCache();
    ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
    return;
}
/* Обработка параметров */
$arParams["IBLOCK_ID"] = trim($arParams["IBLOCK_ID"]);
if(!isset($arParams["COUNT"]) || strlen($arParams["COUNT"])<=0)
    $arParams["COUNT"] = 4;

if(!isset($arParams["PAGE"]) || strlen($arParams["PAGE"])<=0)
    $arParams["PAGE"] = 1;

$arParams["DETAIL_PAGE"] = "/projects/detail.php/?";

/* Передаем какие-то параметры в Шаблон */
$arResult["MSG"] = "";
$arResult["ERRORS"] = "";
$arResult["PAGE"] = $arParams["PAGE"];
$arResult["ACTIVE"] = strtoupper($arParams["ACTIVE"]);

/* Получаем все проекты опубликованные
 * Предварительный список
*/
$arTmpItems = array();
$arFilter = array (
    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
    "<DATE_ACTIVE_FROM" => ConvertTimeStamp(time(),"FULL"),
);

if($arParams["ACTIVE"] != ""){
    $arFilter["ACTIVE"] =  strtoupper($arParams["ACTIVE"]);
}

$arSelect = array( "ID", "ACTIVE", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE");

$rsElement = CIBlockElement::GetList(array("ID" => "ASC"), $arFilter, false, false, $arSelect);
$arResult["ALL_COUNT"] = $rsElement->SelectedRowsCount(); //Всего анкет
while($arItem = $rsElement->GetNext()) {
    $arItem["IMG_PATH"] = CFile::GetPath($arItem["PREVIEW_PICTURE"]);
    $arItem["URL"] = $arParams["DETAIL_PAGE"]."id=".$arItem["ID"];
    $arTmpItems[] = $arItem;
}

$arResult["IS_MORE"] = false;
if(($arParams["PAGE"]-1)*$arParams["COUNT"]+$arParams["COUNT"] < $arResult['ALL_COUNT'])
    $arResult['IS_MORE'] = true;

$arResult['ITEMS'] = array_slice($arTmpItems, ($arParams["PAGE"]-1)*$arParams["COUNT"], $arParams["COUNT"]);


$this->IncludeComponentTemplate();
?>