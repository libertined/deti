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
    $arParams["COUNT"] = 8;

if(!isset($arParams["PAGE"]) || strlen($arParams["PAGE"])<=0)
    $arParams["PAGE"] = 1;

if(!isset($arParams["USER"]) || strlen($arParams["USER"])<=0)
    $arParams["USER"] = "";

/* Передаем какие-то параметры в Шаблон */
$arResult["MSG"] = "";
$arResult["ERRORS"] = "";
$arResult["PAGE"] = $arParams["PAGE"];
$arResult["ACTIVE"] = strtoupper($arParams["ACTIVE"]);
$arResult["IS_FILTER"] = false;
if($arParams["IS_FILTER"] != "") $arResult["IS_FILTER"] = true;

/* Получаем всех детей
 * Предварительный список
*/
$arTmpItems = array();
$arFilter = array (
    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
    "ACTIVE" => "Y"
);

if($arParams["USER"] != ""){
    $arFilter["PROPERTY_CURATOR"] =  $arParams["USER"];
    unset($arFilter["ACTIVE"]);
}

// *** Если есть фильтр *** //
if($arParams["AGE"] != ""){
    if($arParams["AGE"] == "junior"){
        $arFilter["<PROPERTY_AGE"] = 7;
    }
    elseif($arParams["AGE"] == "teen"){
        $arFilter[">PROPERTY_AGE"] = 10;
    }
    else{
        $arFilter["><PROPERTY_AGE"] = array(7,10);
    }
}
if($arParams["SEX"] != ""){
    $arFilter["PROPERTY_SEX"] =  $arParams["SEX"];
}

if(isset($arParams["EMPTY"]) && $arParams["EMPTY"] == "Y"){
    $arFilter["PROPERTY_CURATOR"] =  false;
}


$arSelect = array( "ID", "ACTIVE", "NAME", "PREVIEW_PICTURE",
                   "PROPERTY_SEX", "PROPERTY_AGE", "PROPERTY_CURATOR");

$rsElement = CIBlockElement::GetList(array("ID" => "ASC"), $arFilter, false, false, $arSelect);
$arResult["ALL_COUNT"] = $rsElement->SelectedRowsCount(); //Всего анкет
while($arItem = $rsElement->GetNext()) {
    $arItem["IMG_PATH"] = CFile::GetPath($arItem["PREVIEW_PICTURE"]);
    $arTmpItems[] = $arItem;
}

$arResult["IS_MORE"] = false;
if(($arParams["PAGE"]-1)*$arParams["COUNT"]+$arParams["COUNT"] < $arResult['ALL_COUNT'])
    $arResult['IS_MORE'] = true;

$arResult['ITEMS'] = array_slice($arTmpItems, ($arParams["PAGE"]-1)*$arParams["COUNT"], $arParams["COUNT"]);


$this->IncludeComponentTemplate();
?>