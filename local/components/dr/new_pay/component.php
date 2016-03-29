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


/* Передаем какие-то параметры в Шаблон */
$arResult["MSG"] = "";
$arResult["ERRORS"] = $arParams["IBLOCK_ID"];
$arResult["MERCHANT_ID"] = $arParams["MERCHANT_ID"];
$arResult["PAYMENT_SYSTEM"] = $arParams["PAYMENT_SYSTEM"];
$arResult["PAYMENT_SUM"] = $arParams["PAYMENT_SUM"];
$arResult["PAYMENT_DESC"] = $arParams["PAYMENT_DESC"];
$arResult["PAYMENT_SIM_MODE"] = $arParams["PAYMENT_SIM_MODE"];

/* Получаем информацию по ребенку
*/
if(isset($_REQUEST["new_pay"]) && $_REQUEST["new_pay"] == 'Y'){
    $el = new CIBlockElement;

    $PROP = array();
    $PROP["USER"] = $USER->GetID();  // свойству с кодом 12 присваиваем значение "Белый"
    $PROP["COUNT"] = $arResult["PAYMENT_SUM"];// свойству с кодом 3 присваиваем значение 38

    $arLoadProductArray = Array(
        "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
        "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
        "IBLOCK_ID"      => $arParams["IBLOCK_ID"],
        "PROPERTY_VALUES"=> $PROP,
        "NAME"           => "Платеж ".time(),
        "ACTIVE"         => "N",
    );
    if($PRODUCT_ID = $el->Add($arLoadProductArray)){
        $arResult["ORDER"] = $PRODUCT_ID;
    }
    else
        $arResult["ERRORS"] = $el->LAST_ERROR;

}

$this->IncludeComponentTemplate();
?>