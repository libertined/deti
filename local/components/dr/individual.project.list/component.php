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
if(!isset($arParams["COUNT"]) || strlen($arParams["COUNT"])<=0)
    $arParams["COUNT"] = 2;

if(!isset($arParams["PAGE"]) || strlen($arParams["PAGE"])<=0)
    $arParams["PAGE"] = 1;

/* Передаем какие-то параметры в Шаблон */
$arResult["MSG"] = "";
$arResult["ERRORS"] = "";
$arResult["PAGE"] = $arParams["PAGE"];

/* Получаем все проекты опубликованные
 * Предварительный список
*/
$arTmpItems = array();
$arFilter = array (
    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
    "PROPERTY_KID" => $arParams["KID"],
);

if(strtoupper($arParams["FILTER"]) == "Y"){
    if($arParams["STATUS"] == "active"){
        $arFilter["ACTIVE"] = "Y";
        $arFilter[">DATE_ACTIVE_TO"] = ConvertTimeStamp(time(),"FULL");
        $arFilter["!PROPERTY_IS_READY_VALUE"] = "Y";
        $arFilter["!PROPERTY_DECLINE"] = $USER->GetID();
    }
    elseif($arParams["STATUS"] == "ready"){
        $arFilter["PROPERTY_IS_READY_VALUE"] = "Y";
    }
    elseif($arParams["STATUS"] == "fin"){
        $arFilter["ACTIVE"] = "N";
        $arFilter["!PROPERTY_IS_READY_VALUE"] = "Y";
    }
}
$arResult["PAY_TYPE"] = $arParams["PAY_TYPE"];
if(isset($arParams["PAY_TYPE"]) && $arParams["PAY_TYPE"] != ""){
    if($arParams["PAY_TYPE"] == "all"){
        $arFilter["ACTIVE"] = "Y";
        $arFilter[">DATE_ACTIVE_TO"] = ConvertTimeStamp(time(),"FULL");
        $arFilter["!PROPERTY_IS_READY_VALUE"] = "Y";
        $arFilter["!PROPERTY_DECLINE"] = $USER->GetID();
    }
    else{
        $arParams["PROJECTS"] .= ", 0";
        $arFilter["ID"] = explode(", ", $arParams["PROJECTS"]);
    }

    $arResult["CHILD"] = array();
    $arFilterChild = array (
        "IBLOCK_ID" => IBLOCK_CHILDS,
        "ID" => $arParams["KID"],
    );

    $arSelectChild = array( "ID", "ACTIVE", "NAME");

    $rsElementChild = CIBlockElement::GetList(array("ID" => "ASC"), $arFilterChild, false, false, $arSelectChild);
    while($arItem = $rsElementChild->GetNext()) {
        $arResult["CHILD"] = $arItem["NAME"];
    }
}
$arSelect = array( "ID", "ACTIVE", "NAME", "PREVIEW_TEXT", "DATE_ACTIVE_TO",
                    "PROPERTY_KID", "PROPERTY_ALL", "PROPERTY_PAYED", "PROPERTY_IS_READY", "PROPERTY_DECLINE");

$rsElement = CIBlockElement::GetList(array("ID" => "ASC"), $arFilter, false, false, $arSelect);
$arResult["ALL_COUNT"] = $rsElement->SelectedRowsCount(); //Всего анкет
$arResult["ALL_PAY"] = 0;
while($arItem = $rsElement->GetNext()) {
    $arItem["IMG_PATH"] = CFile::GetPath($arItem["PREVIEW_PICTURE"]);
    $arItem["URL"] = $arParams["DETAIL_PAGE"].$arItem["ID"]."/";
    $arItem["DATE_ACTIVE_TO"] = strtolower(FormatDate("d F Y", MakeTimeStamp($arItem["DATE_ACTIVE_TO"])));
    $arItem["ALL"] = number_format($arItem["PROPERTY_ALL_VALUE"], 0, '.', ' ')." ".MONEY_NAME;
    $arItem["STATUS"] = "ACTIVE";
    if($arItem["PROPERTY_IS_READY_VALUE"] == "Y"){
        $arItem["STATUS"] = "READY";
    }
    elseif($arItem["ACTIVE"] != "Y"){
        $arItem["STATUS"] = "FIN";
    }
    if($arItem["STATUS"] == "ACTIVE" && in_array($USER->GetID(), $arItem["PROPERTY_DECLINE_VALUE"])){
        $arItem["STATUS"] = "DECLINE";
    }
    $arResult["ALL_PAY"] += $arItem["PROPERTY_ALL_VALUE"];
    $arTmpItems[] = $arItem;
}

$arResult["ALL_PAY"] = number_format($arResult["ALL_PAY"], 0, '.', ' ');

$arResult["IS_MORE"] = false;
if(($arParams["PAGE"]-1)*$arParams["COUNT"]+$arParams["COUNT"] < $arResult['ALL_COUNT'])
    $arResult['IS_MORE'] = true;

$arResult['ITEMS'] = array_slice($arTmpItems, ($arParams["PAGE"]-1)*$arParams["COUNT"], $arParams["COUNT"]);


$this->IncludeComponentTemplate();
?>