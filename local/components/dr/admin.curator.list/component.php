<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if(!CModule::IncludeModule("iblock"))
{
    $this->AbortResultCache();
    ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
    return;
}
/* Обработка параметров */
$arParams["IBLOCK_ID"] = trim($arParams["IBLOCK_ID"]);
$arParams["ALL_EMPTY"] = true;

/* Передаем какие-то параметры в Шаблон */
$arResult["MSG"] = "";
$arResult["ERRORS"] = "";
$arResult["IS_FILTER"] = false;

/* Получаем всех детей
 * Предварительный список
*/
$arCuratorDate = array();
$arCuratorId = array();
$arCuratorAllId = array();

$arFilter = array (
    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
    "!PROPERTY_CURATOR" => false,
);

$dateLimitToday = $dateLimit = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
if(isset($arParams["FILTER"]) && $arParams["FILTER"]=="Y"){
    $arResult["FILTER"] = true;
    if(isset($arParams["TIME"]) && $arParams["TIME"] != ""){
        if($arParams["TIME"] == "week"){
            $dateLimit = strtotime("next Monday");
            $arParams["ALL_EMPTY"] = false;
        }
        elseif($arParams["TIME"] == "3"){
            $dateLimit = mktime(0, 0, 0, date("m"), date("d")+3, date("Y"));
            $arParams["ALL_EMPTY"] = false;
        }
        elseif($arParams["TIME"] == "month"){
            $dateLimit = mktime(0, 0, 0, date("m")+1, 1, date("Y"));
            $arParams["ALL_EMPTY"] = false;
        }
    }
}

$arSelect = array( "ID", "ACTIVE", "NAME",
                   "PROPERTY_SEX", "PROPERTY_AGE", "PROPERTY_CURATOR", "PROPERTY_TIME");

$rsElement = CIBlockElement::GetList(array("ID" => "ASC"), $arFilter, false, false, $arSelect);
$arResult["ALL_COUNT"] = $rsElement->SelectedRowsCount(); //Всего анкет
$arTmpChildren = array();
while($arItem = $rsElement->GetNext()) {
    $arTmpChildren[ $arItem["ID"] ] = $arItem;
    foreach($arItem["PROPERTY_TIME_VALUE"] as $number => $timeStr){
        $timeValue = MakeTimeStamp($timeStr);
        if($timeValue < $dateLimit){
            $arCuratorDate[ $arItem["PROPERTY_CURATOR_VALUE"][$number] ][ $arItem["ID"] ] = strtolower(FormatDate("d.m.Y", $timeValue));;
            $arCuratorId[ $arItem["PROPERTY_CURATOR_VALUE"][$number] ] = $arItem["PROPERTY_CURATOR_VALUE"][$number];
        }
        $arCuratorAllId[ $arItem["PROPERTY_CURATOR_VALUE"][$number] ] = $arItem["PROPERTY_CURATOR_VALUE"][$number];
    }
}

$arResult["ITEMS"] = array();

if($arParams["ALL_EMPTY"]){
    $arCuratorId = array_diff($arCuratorAllId, $arCuratorId);
    $arFilterUser = array(
        "GROUPS_ID" => CURATOR_GROUP,
        "ID" => "~".implode(" & ~", $arCuratorId),
    );
}
else{
    $arFilterUser = array(
        "GROUPS_ID" => CURATOR_GROUP,
        "ID" => implode(" | ", $arCuratorId),
    );
}

$rsUser = CUser::GetList(($by="ID"), ($order="desc"),
    $arFilterUser,
    array(
        "SELECT"=>array("UF_*"),
        "FIELDS"=>array("ID", "NAME", "LAST_NAME", "SECOND_NAME", "PERSONAL_BIRTHDAY", "PERSONAL_COUNTRY"))
    );
while($arItem = $rsUser->Fetch()) {
    $arItem["CHILDREN"] = array();
    if(isset($arCuratorDate[ $arItem["ID"] ]) && !$arParams["ALL_EMPTY"]){
        foreach($arCuratorDate[ $arItem["ID"] ] as $kid => $dateTo){
            $arTmpKid = array(
                "NAME" => $arTmpChildren[ $kid ]["NAME"],
                "AGE" => $arTmpChildren[ $kid ]["PROPERTY_AGE_VALUE"],
                "ID" => $kid,
                "TIME" => $dateTo,
            );
            $arItem["CHILDREN"][] = $arTmpKid;
        }
    }
    $arResult["ITEMS"][] = $arItem;
}

$this->IncludeComponentTemplate();
?>