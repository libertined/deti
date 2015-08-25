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

if(!isset($arParams["ID"]) || strlen($arParams["ID"])<=0)
    LocalRedirect("/404.php");

/* Передаем какие-то параметры в Шаблон */
$arResult["MSG"] = "";
$arResult["ERRORS"] = "";

/* Получаем информацию по ребенку
*/
$arResult["CHILD"] = array();
$arFilter = array (
    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
    "ID" => $arParams["ID"],
);

$arSelect = array( "ID", "ACTIVE", "NAME", "PREVIEW_PICTURE", "PREVIEW_TEXT", "DETAIL_TEXT",
                   "PROPERTY_SEX", "PROPERTY_AGE", "PROPERTY_CURATOR");

$rsElement = CIBlockElement::GetList(array("ID" => "ASC"), $arFilter, false, false, $arSelect);
$arResult["ALL_COUNT"] = $rsElement->SelectedRowsCount(); //Всего анкет
while($arItem = $rsElement->GetNext()) {
    $arItem["IMG_PATH"] = CFile::GetPath($arItem["PREVIEW_PICTURE"]);
    $arItem["CURATORS"] = array();
    if(!empty($arItem["PROPERTY_CURATOR_VALUE"])){
        $rsUser = CUser::GetList(($by="ID"), ($order="desc"), array("ID"=>implode(" | ", $arItem["PROPERTY_CURATOR_VALUE"])),array("FIELDS"=>array("ID", "NAME", "LAST_NAME", "SECOND_NAME")));
        while($arCuratorUser = $rsUser->Fetch()){
            $arItem["CURATORS"][] = $arCuratorUser["NAME"]." ".$arCuratorUser["LAST_NAME"];
        }
    }
    $arResult["CHILD"] = $arItem;
}

if(isset($_REQUEST["request-send"])){
    if(!isset($_REQUEST["time"]) || $_REQUEST["time"] == ''){
        $arResult["ERRORS"]["time"] = "Необходимо выбрать продолжительность попечительства";
    }
    else{
        $arEventFields = array(
            "CHILD_ID" => $arParams["ID"],
            "CHILD_NAME" => $arResult["CHILD"]["NAME"],
            "TIME" => $_REQUEST["time"],
            "CURATOR_ID" => $USER->GetID,
            "CURATOR_NAME" => $USER->GetFullName
        );
        CEvent::Send("ADD_CHILD_TO_CURATOR", "s1", $arEventFields);
        $arResult["MSG"] = "Запрос на попечительство данного ребенка успешно отправлен. Наш администратор свяжется с вами в ближайшее время";
    }
}

$this->IncludeComponentTemplate();
?>