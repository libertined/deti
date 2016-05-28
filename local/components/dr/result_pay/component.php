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
$arResult["ERROR"] = [];

/* Получаем информацию по ребенку
*/
if(!empty($arParams["ELEMENT_ID"])){
    $arFilter = array (
      "IBLOCK_ID" => $arParams["IBLOCK_ID"],
      "ID" => $arParams["ELEMENT_ID"],
    );

    $arSelect = array( "ID", "ACTIVE", "NAME", "PROPERTY_USER", "PROPERTY_COUNT", "PROPERTY_STATUS", "PROPERTY_PAYMENT_ID",
                    "PROPERTY_PURPOSE", "PROPERTY_PURPOSE_ID", "PURPOSE_CODE", "PURPOSE_LIST");

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
        $PROP["USER"] = $arResult["ITEM"]["PROPERTY_USER_VALUE"];
        $PROP["COUNT"] = $arParams["PAYMENT_SUM"];
        $PROP["PAYMENT_ID"] = $arParams["SYS_PAYMENT_ID"];
        $PROP["PURPOSE"] = $arResult["ITEM"]["PROPERTY_PURPOSE_VALUE"];
        $PROP["PURPOSE_ID"] = $arResult["ITEM"]["PROPERTY_PURPOSE_ID_VALUE"];
        $PROP["PURPOSE_CODE"] = $arResult["ITEM"]["PROPERTY_PURPOSE_CODE_VALUE"];
        $PROP["PURPOSE_LIST"] = $arResult["ITEM"]["PROPERTY_PURPOSE_LIST_VALUE"];
        $PROP["STATUS"] = 'sucsess';

        $arLoadProductArray = [
          "IBLOCK_ID"      => $arParams["IBLOCK_ID"],
          "PROPERTY_VALUES"=> $PROP,
          "ACTIVE"         => "Y"
        ];

        if($el->Update($arResult["ITEM"]["ID"], $arLoadProductArray)){
            $arResult["MSG"] = 'Платеж обработан '.$arResult["ITEM"]["ID"];
            $arEventFields = [
                "HELLO" => "Здравствуйте",
                "PAY_ID" => $arResult["ITEM"]["ID"],
                "PAYMASTER_ID" => $PROP["PAYMENT_ID"],
                "PAY_PURPOSE" => $arResult["ITEM"]["PROPERTY_PURPOSE_VALUE"]." - ".$arResult["ITEM"]["PROPERTY_PURPOSE_ID_VALUE"],
                "EMAIL" => $arParams["SYS_PAYER_EMAIL"],
                "COUNT" => $PROP["COUNT"],
            ];
            CEvent::Send("PAY_ADMIN_SUCCESS", 's1', $arEventFields);
            if(!empty($PROP["USER"])){
                $rsUser = CUser::GetByID($PROP["USER"]);
                $arUser = $rsUser->Fetch();
                if($arUser["PERSONAL_GENDER"] == 'F'){
                    $arEventFields["HELLO"] = 'Уважаемая ';
                }
                else{
                    $arEventFields["HELLO"] = 'Уважаемый ';
                }
                $arEventFields["HELLO"] .= $arUser["NAME"]." ".$arUser["LAST_NAME"];
                if(empty($arParams["SYS_PAYER_EMAIL"]))
                    $arEventFields["EMAIL"] = $arUser["EMAIL"];
            }

            if(!empty($arEventFields["EMAIL"]))
                CEvent::Send("PAY_SUCCESS", 's1', $arEventFields);
        }
        else
            $arResult["ERRORS"][] = $el->LAST_ERROR;
    }
}
$log_file=$_SERVER["DOCUMENT_ROOT"]."/upload/pay.log";
$log = "";
if( !empty($arResult["ERRORS"]) ) {
    $log .= "Errors: ".implode(" * ", $arResult["ERRORS"])."\n";
}
$log .= $arResult["MSG"];
$log .= "\n ******** \n";
$f=fopen($log_file,"a");
fputs($f, $log);
fclose($f);

$this->IncludeComponentTemplate();
?>