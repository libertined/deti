<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if(!CModule::IncludeModule("iblock"))
{
    $this->AbortResultCache();
    ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
    return;
}
/* Обработка параметров */
if(!isset($arParams["COUNT"]) || strlen($arParams["COUNT"])<=0)
    $arParams["COUNT"] = 20;

$arParams["DETAIL_PAGE"] = "/projects/";

/* Передаем какие-то параметры в Шаблон */
$arResult["MSG"] = "";
$arResult["ERRORS"] = "";

/* Получаем все проекты опубликованные
 * Предварительный список
*/
$arTmpItems = array();
$arFilter = array (
    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
    "ACTIVE" => "Y",
    "<DATE_ACTIVE_TO" => ConvertTimeStamp(mktime(0, 0, 0, date("m")+1, 1, date("Y")), "FULL")
);

$arResult["FILTER"] = false;
if(isset($arParams["FILTER"]) && $arParams["FILTER"]=="Y"){
    $arResult["FILTER"] = true;
    if(isset($arParams["TYPE"]) && $arParams["TYPE"] != ""){
        $arFilter["IBLOCK_ID"] = $arParams["TYPE"];
    }
    if(isset($arParams["TIME"]) && $arParams["TIME"] != ""){
        if($arParams["TIME"] == "week")
            $arFilter["<DATE_ACTIVE_TO"] = ConvertTimeStamp(strtotime("next Monday"), "FULL");
        elseif($arParams["TIME"] == "3")
            $arFilter["<=DATE_ACTIVE_TO"] = ConvertTimeStamp(mktime(0, 0, 0, date("m"), date("d")+3, date("Y")), "FULL");
    }
}

$arSelect = array( "IBLOCK_ID", "ID", "ACTIVE", "NAME", "PREVIEW_TEXT", "DATE_ACTIVE_TO");

$rsElement = CIBlockElement::GetList(array("DATE_ACTIVE_TO" => "ASC"), $arFilter, false, false, $arSelect);
$arResult["ALL_COUNT"] = $rsElement->SelectedRowsCount(); //Всего анкет
while($arItem = $rsElement->GetNextElement()) {
    $arTmpItem = $arItem->GetFields();
    $arTmpItem["PROP"] = $arItem->GetProperties();
    $arTmpItem["URL"] = $arParams["DETAIL_PAGE"].$arTmpItem["ID"]."/";
    if($arTmpItem["PROP"]["IS_READY"]["VALUE"] != "Y"){
        $arTmpItems[] = $arTmpItem;
    }
}

$arResult['ITEMS'] = $arTmpItems;


$this->IncludeComponentTemplate();
?>