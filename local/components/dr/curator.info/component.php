<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
global $USER;
if(!CModule::IncludeModule("iblock"))
{
    $this->AbortResultCache();
    ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
    return;
}

/* Передаем какие-то параметры в Шаблон */
$arResult["MSG"] = "";
$arResult["ERRORS"] = array();

$arParams["USER_ID"] = $USER->GetID();

$arResult["USER"] = array();
$rsUser = CUser::GetByID($arParams["USER_ID"]);
$arResult["USER"] = $rsUser->Fetch();

$arResult["USER"]["AVATAR"] = array();
if($arResult["USER"]["PERSONAL_PHOTO"] != ""){
    $arResult["USER"]["AVATAR"] = CFile::ResizeImageGet(
        $arResult["USER"]["PERSONAL_PHOTO"],
        array("width" => 160, "height" => 160),
        BX_RESIZE_IMAGE_EXACT,
        true
    );
}

// *** Получаем кол-во детей *** //
$arFilter = array (
    "IBLOCK_ID" => IBLOCK_CHILDS,
    "PROPERTY_CURATOR" => $arParams["USER_ID"],
);
$rsElement = CIBlockElement::GetList(array("ID" => "ASC"), $arFilter, false, false, array("ID"));
$arResult["CHILDREN"] = $rsElement->SelectedRowsCount(); //Всего анкет

$this->IncludeComponentTemplate();
?>