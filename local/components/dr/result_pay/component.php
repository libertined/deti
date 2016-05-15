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
$arParams["RESULT"] = strtolower($arParams["RESULT"]);

/* Передаем какие-то параметры в Шаблон */
$arResult["MSG"] = "";
$arResult["ERROR"] = [];

/* Получаем информацию по ребенку
*/
if(!empty($arParams["ELEMENT_ID"])){
    $arFilter = array (
      "IBLOCK_ID" => $arParams["IBLOCK_ID"],
      "ID" => $arParams["ELEMENT_ID"],
    );

    $arSelect = array( "ID", "ACTIVE", "NAME", "PROPERTY_USER", "PROPERTY_COUNT", "PROPERTY_STATUS", "PROPERTY_PAYMENT_ID");

    $rsElement = CIBlockElement::GetList(array("ID" => "ASC"), $arFilter, false, false, $arSelect);
    $arResult["ITEM"] = [];
    while($arItem = $rsElement->Fetch()) {
        $arResult["ITEM"] = $arItem;
    }

    if(empty($arResult["ITEM"])){
        $arResult["ERROR"][] = 'Платежа с таким id не найдено.';
    }
    else{
        $el = new CIBlockElement;

        $PROP = array();
        $PROP["USER"] = $arResult["PROPERTY_USER_VALUE"];
        $PROP["COUNT"] = $arParams["PAYMENT_SUM"];
        $PROP["PAYMENT_ID"] = $arParams["SYS_PAYMENT_ID"];
        $PROP["STATUS"] = $arParams["RESULT"];

        $arLoadProductArray = [
          "IBLOCK_ID"      => $arParams["IBLOCK_ID"],
          "PROPERTY_VALUES"=> $PROP,
          "ACTIVE"         => "Y"
        ];

        if($arParams["RESULT"] != 'success'){
            $arLoadProductArray["ACTIVE"] = 'N';
        }

        if($el->Update($arResult["ITEM"]["ID"], $arLoadProductArray)){
            $arResult["MSG"] = 'Платеж обработан '.$arResult["ITEM"]["ID"];
        }
        else
            $arResult["ERRORS"][] = $el->LAST_ERROR;
    }
}
$log_file=$_SERVER["DOCUMENT_ROOT"]."/upload/pay.log";
$log = "";
foreach($arResult["ITEM"] as $key=>$val){
    $log .= $key.": ".$val."\n\n";
}
foreach($arLoadProductArray as $key=>$val){
    $log .= $key.": ".$val."\n\n";
}
if( !empty($arResult["ERRORS"]) ) {
    $log .= "Errors: ".implode(" * ", $arResult["ERRORS"])."\n";
}
$log .= $arResult["MSG"];
$log .= "\n ******** \n";
$f=fopen($log_file,"wb");
fputs($f, $log);
fclose($f);

$this->IncludeComponentTemplate();
?>