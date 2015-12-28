<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if(!CModule::IncludeModule("iblock"))
{
    $this->AbortResultCache();
    ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
    return;
}
/* Передаем какие-то параметры в Шаблон */
$arResult["MSG"] = "";
$arResult["ERRORS"] = array();

$arResult["CURRENT"] = array(
    "NAME" => htmlspecialchars(trim($_REQUEST["name"])),
    "EMAIL" => htmlspecialchars(trim($_REQUEST["email"])),
    "SUBJECT" => htmlspecialchars(trim($_REQUEST["subject"])),
    "MESSAGE" => htmlspecialchars(trim($_REQUEST["message"])),
);

if(isset($_REQUEST["form_submit"])){
    //Валидация
    if($arResult["CURRENT"]["NAME"] == ""){
        $arResult["ERRORS"]["name"] = "Не задано значение поля Имя";
    }
    if($arResult["CURRENT"]["EMAIL"] == ""){
        $arResult["ERRORS"]["email"] = "Не задано значение поля Email";
    }
    if($arResult["CURRENT"]["SUBJECT"] == ""){
        $arResult["ERRORS"]["subject"] = "Не задано значение поля Тема сообщения";
    }
    if($arResult["CURRENT"]["MESSAGE"] == ""){
        $arResult["ERRORS"]["message"] = "Не задано значение поля Текст сообщения";
    }

    // *** Регистрируем новый вопрос *** //
    if(empty($arResult["ERRORS"])){
        $el = new CIBlockElement;

        $PROP = array();
        $PROP["NAME"] = $arResult["CURRENT"]["NAME"];
        $PROP["EMAIL"] = $arResult["CURRENT"]["EMAIL"];

        $arLoadProductArray = Array(
            "IBLOCK_SECTION_ID" => false,
            "IBLOCK_ID"      => $arParams["IBLOCK_ID"],
            "PROPERTY_VALUES"=> $PROP,
            "NAME"           => $arResult["CURRENT"]["SUBJECT"],
            "ACTIVE"         => "N",
            "PREVIEW_TEXT"   => $arResult["CURRENT"]["MESSAGE"],
            "DETAIL_TEXT"    => "",
        );

        if($PRODUCT_ID = $el->Add($arLoadProductArray)){
            $arResult["MSG"] = "Ваш вопрос отправлен администраторам. Спасибо за внимание.";
            $arEventFields  =  $arResult["CURRENT"];
            CEvent::Send("NEW_FAQ_MESSAGE", "s1", $arEventFields);
        }
        else
            $arResult["ERRORS"]["add"] = $el->LAST_ERROR;
    }
}

$this->IncludeComponentTemplate();
?>