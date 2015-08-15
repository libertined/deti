<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if(!CModule::IncludeModule("iblock"))
{
    $this->AbortResultCache();
    ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
    return;
}
/* Обработка параметров */
$arParams["IBLOCK_ID"] = trim($arParams["IBLOCK_ID"]);
if(!isset($arParams["ID"]) || strlen($arParams["ID"])<=0)
    LocalRedirect("/404.php");



/* Передаем какие-то параметры в Шаблон */
$arResult["MSG"] = "";
$arResult["ERRORS"] = "";

/* Получаем все проекты опубликованные
 * Предварительный список
*/
$arResult["PROJECT"] = array();
$arFilter = array (
    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
    "ID" => $arParams["ID"],
);

$arSelect = array( "ID", "ACTIVE", "NAME", "PREVIEW_TEXT", "DETAIL_TEXT", "DATE_ACTIVE_FROM", "DATE_ACTIVE_TO",
                   "PROPERTY_ALL", "PROPERTY_PAYED", "PROPERTY_PICT",
                 );

$rsElement = CIBlockElement::GetList(array("ID" => "ASC"), $arFilter, false, false, $arSelect);
if($arItem = $rsElement->Fetch()) {
    $arItem["ALL"] = number_format($arItem["PROPERTY_ALL_VALUE"], 0, '.', ' ')." ".MONEY_NAME;
    $arItem["PAYED"] = number_format($arItem["PROPERTY_PAYED_VALUE"], 0, '.', ' ')." ".MONEY_NAME;
    $arItem["DIFF"] = number_format($arItem["PROPERTY_ALL_VALUE"] - $arItem["PROPERTY_PAYED_VALUE"], 0, '.', ' ')." ".MONEY_NAME;
    $arItem["PROGRESS"] = ceil($arItem["PROPERTY_PAYED_VALUE"]/$arItem["PROPERTY_ALL_VALUE"]*100);
    $arItem["DATE_ACTIVE_FROM"] = strtolower(FormatDate("d F Y", MakeTimeStamp($arItem["DATE_ACTIVE_FROM"])));
    $arItem["DATE_ACTIVE_TO"] = strtolower(FormatDate("d F Y", MakeTimeStamp($arItem["DATE_ACTIVE_TO"])));
    //Работа с изображениями
    if(isset($arItem["PROPERTY_PICT_VALUE"][0])){
        $arItem["PIC1"] = CFile::ResizeImageGet(
            $arItem["PROPERTY_PICT_VALUE"][0],
            array("width" => 460, "height" => 240),
            BX_RESIZE_IMAGE_EXACT,
            true
        );
    }
    if(isset($arItem["PROPERTY_PICT_VALUE"][1])){
        $arItem["PIC2"] = CFile::ResizeImageGet(
            $arItem["PROPERTY_PICT_VALUE"][1],
            array("width" => 150, "height" => 130),
            BX_RESIZE_IMAGE_EXACT,
            true
        );
    }
    if(isset($arItem["PROPERTY_PICT_VALUE"][3])){
        $arItem["PIC3"] = CFile::ResizeImageGet(
            $arItem["PROPERTY_PICT_VALUE"][2],
            array("width" => 150, "height" => 130),
            BX_RESIZE_IMAGE_EXACT,
            true
        );
    }
    if(isset($arItem["PROPERTY_PICT_VALUE"][4])){
        $arItem["PIC4"] = CFile::ResizeImageGet(
            $arItem["PROPERTY_PICT_VALUE"][3],
            array("width" => 310, "height" => 100),
            BX_RESIZE_IMAGE_EXACT,
            true
        );
    }

    $arResult["PROJECT"] = $arItem;
}
$this->IncludeComponentTemplate();
?>