<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/* Передаем какие-то параметры в Шаблон */
$arResult["MSG"] = "";
$arResult["ERRORS"] = array();

$arResult["CURRENT"] = array(
    "NAME" => htmlspecialchars(trim($_REQUEST["name"])),
    "SNAME" => htmlspecialchars(trim($_REQUEST["sname"])),
    "LNAME" => htmlspecialchars(trim($_REQUEST["lname"])),
    "DATE" => htmlspecialchars(trim($_REQUEST["date"])),
    "SEX" => $_REQUEST["sex"],
    "CITIZEN" => $_REQUEST["citizen"],
    "EMAIL" => htmlspecialchars(trim($_REQUEST["email"])),
    "REP_EMAIL" => htmlspecialchars(trim($_REQUEST["email_rep"])),
    "PASS" => htmlspecialchars(trim($_REQUEST["pass"])),
    "REP_PASS" => htmlspecialchars(trim($_REQUEST["pass_rep"])),
);

if(isset($_REQUEST["regist"])){
    //Валидация
    if($arResult["CURRENT"]["NAME"] == ""){
        $arResult["ERRORS"]["name"] = "На задано значение поля Имя";
    }
    if($arResult["CURRENT"]["LNAME"] == ""){
        $arResult["ERRORS"]["lname"] = "На задано значение поля Фамилия";
    }
    if($arResult["CURRENT"]["DATE"] == ""){
        $arResult["ERRORS"]["date"] = "На задано значение поля Дата рождения";
    }
    if($arResult["CURRENT"]["EMAIL"] == ""){
        $arResult["ERRORS"]["email"] = "На задано значение поля Email";
    }
    if(!isset($_REQUEST["email_rep"]) || trim($_REQUEST["email_rep"]) != $arResult["CURRENT"]["EMAIL"]){
        $arResult["ERRORS"]["email_rep"] = "Значение поля Повторите Email-адрес не совпадает со значением поля Email";
        $arResult["CURRENT"]["REP_EMAIL"] = "";
    }
    if(strlen($arResult["CURRENT"]["PASS"]) < 8){
        $arResult["ERRORS"]["pass"] = "Введенный вами пароль меньше 8 символов";
    }
    if(!isset($_REQUEST["pass_rep"]) || trim($_REQUEST["pass_rep"]) != $arResult["CURRENT"]["PASS"]){
        $arResult["ERRORS"]["pass_rep"] = "Значение поля Повторите пароль не совпадает со значением поля Пароль";
        $arResult["CURRENT"]["REP_PASS"] = "";
    }
    if($arResult["CURRENT"]["EMAIL"] != ''){
        $rsUser = CUser::GetByLogin($arResult["CURRENT"]["EMAIL"]);
        if($arUser = $rsUser->Fetch()){
            $arResult["ERRORS"]["user_exist"] = "Пользователь с таким email уже зарегестрирован";
        }
    }


    // *** Регистрируем нового попечителя *** //
    if(empty($arResult["ERRORS"])){
        $user = new CUser;
        $arFields = Array(
            "NAME"              => $arResult["CURRENT"]["NAME"],
            "SECOND_NAME"       => $arResult["CURRENT"]["SNAME"],
            "LAST_NAME"         => $arResult["CURRENT"]["LNAME"],
            "EMAIL"             => $arResult["CURRENT"]["EMAIL"],
            "LOGIN"             => $arResult["CURRENT"]["EMAIL"],
            "ACTIVE"            => "N",
            "GROUP_ID"          => array(CURATOR_GROUP),
            "PASSWORD"          => $arResult["CURRENT"]["PASS"],
            "CONFIRM_PASSWORD"  => $arResult["CURRENT"]["PASS"],
            "PERSONAL_GENDER"   => ($arResult["CURRENT"]["SEX"] == 1)? "M": "F",
            "PERSONAL_COUNTRY"   => $arResult["CURRENT"]["CITIZEN"],
            "PERSONAL_BIRTHDAY"  => $arResult["CURRENT"]["DATE"],
        );

        $ID = $user->Add($arFields);
        if (intval($ID) > 0){
            $arEventFields  =  $arResult["CURRENT"];
            $arEventFields["CITIZEN"] = ($arResult["CURRENT"]["CITIZEN"] == 1)? "Россия": "Украина";
            CEvent::Send("NEW_CURATOR", "s1", $arEventFields);
            $arResult["MSG"] = "Вы успешно зарегестрировались на сайте. После подтверждения администратором вы сможете воспользоваться всем доступным функционалом.";
        }
        else{
            $arResult["ERRORS"]["add"] = $user->LAST_ERROR;
        }
    }
}

$this->IncludeComponentTemplate();
?>