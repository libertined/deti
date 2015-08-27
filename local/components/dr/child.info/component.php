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
                   "PROPERTY_SEX", "PROPERTY_AGE", "PROPERTY_CURATOR", "PROPERTY_TIME", "PROPERTY_TIME_FROM");

$rsElement = CIBlockElement::GetList(array("ID" => "ASC"), $arFilter, false, false, $arSelect);
$arResult["ALL_COUNT"] = $rsElement->SelectedRowsCount(); //Всего анкет
while($arItem = $rsElement->GetNext()) {
    $arItem["IMG_PATH"] = CFile::GetPath($arItem["PREVIEW_PICTURE"]);
    $arItem["CURATORS"] = array();
    $arItem["CURATORS_LIST"] = array();
    if(!empty($arItem["PROPERTY_CURATOR_VALUE"])){
        $numberCurator = array_flip($arItem["PROPERTY_CURATOR_VALUE"]);
        $startTime = new Datetime();

        $rsUser = CUser::GetList(($by="ID"), ($order="desc"), array("ID"=>implode(" | ", $arItem["PROPERTY_CURATOR_VALUE"])),array("FIELDS"=>array("ID", "NAME", "LAST_NAME", "SECOND_NAME", "PERSONAL_PHOTO")));
        while($arCuratorUser = $rsUser->Fetch()){
            $arCuratorUser["IMG_URL"] = "";
            if($arCuratorUser["PERSONAL_PHOTO"] != ""){
                $arCuratorUser["AVATAR"] = CFile::ResizeImageGet(
                    $arCuratorUser["PERSONAL_PHOTO"],
                    array("width" => 160, "height" => 160),
                    BX_RESIZE_IMAGE_EXACT,
                    true
                );
                $arCuratorUser["IMG_URL"] = $arCuratorUser["AVATAR"]["src"];
            }
            $arCuratorUser["CURRENT"] = false;
            if($arCuratorUser["ID"] == $USER->GetID()){
                $arCuratorUser["CURRENT"] = true;
            }
            $arCuratorUser["FROM"] = strtolower(FormatDate("d.m.Y", MakeTimeStamp($arItem["PROPERTY_TIME_FROM_VALUE"][ $numberCurator[$arCuratorUser["ID"]] ])));
            $arCuratorUser["TO"] = strtolower(FormatDate("d.m.Y", MakeTimeStamp($arItem["PROPERTY_TIME_VALUE"][ $numberCurator[$arCuratorUser["ID"]] ])));
            $endTime = new DateTime($arItem["PROPERTY_TIME_VALUE"][ $numberCurator[$arCuratorUser["ID"]] ]);
            $diff = $endTime->diff($startTime);
            $arCuratorUser["DAY"] = $diff->format('%a');

            $arItem["CURATORS"][] = $arCuratorUser;
            $arItem["CURATORS_LIST"][] = $arCuratorUser["NAME"]." ".$arCuratorUser["SECOND_NAME"]." ".$arCuratorUser["LAST_NAME"];
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
        if(isset($arParams["EXIST"]) && $arParams["EXIST"] == "Y"){
            if($_REQUEST["time"] == 0)
                $arEventFields["TIME"]  = "Отказаться";
            CEvent::Send("CHANGE_CHILD_TO_CURATOR", "s1", $arEventFields);
            $arResult["MSG"] = "Ваш запрос успешно отправлен. Наш администратор свяжется с вами в ближайшее время";
        }
        else{
            CEvent::Send("ADD_CHILD_TO_CURATOR", "s1", $arEventFields);
            $arResult["MSG"] = "Запрос на попечительство данного ребенка успешно отправлен. Наш администратор свяжется с вами в ближайшее время";
        }
    }
}

$this->IncludeComponentTemplate();
?>