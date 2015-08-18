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

if(isset($_REQUEST["save"])){
    if(!isset($_REQUEST["date"]) || $_REQUEST["date"] == ""){
        $arResult["ERRORS"]["date"] = "Необходимо заполнить поле Дата рождения";
    }
    if(empty($arResult["ERRORS"])){
        $user = new CUser;
        $fields = Array(
            "PERSONAL_BIRTHDAY" => $_REQUEST["date"],
            "PERSONAL_COUNTRY" => $_REQUEST["citizen"],
        );
        if(isset($_FILES["documents"]) && !empty($_FILES["documents"]) > 0){
            $typesFiles = array('image/jpeg', 'image/png', 'image/gif', 'image/pjpeg', 'text/plain', 'text/csv', 'application/vnd.ms-excel',
                'application/vnd.oasis.opendocument.text', 'application/vnd.oasis.opendocument.spreadsheet', 'application/pdf',
                'application/vnd.oasis.opendocument.presentation', 'application/vnd.oasis.opendocument.graphics',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-powerpoint',
                'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
            $filesArr = array();
            if(check_bitrix_sessid()) {
                //Добавляем новые файлы
                $filearray = $_FILES["documents"];
                if(!is_array($filearray)) $arResult["ERROR"]["file"] = "Ошибка при загрузке файла";
                if(!in_array($filearray["type"], $typesFiles)) $arResult["ERROR"]["file"]  = "Неправильный формат файла ";
                if($filearray["size"] > $_POST['MAX_FILE_SIZE']) $arResult["ERROR"]["file"]  = "Слишком большой размер файла ";

                $rsUser = CUser::GetList(($by="ID"), ($order="desc"), array("ID"=>$arParams["USER_ID"]),array("SELECT"=>array("UF_*")));
                $arTmpUser = $rsUser->Fetch();
                $existFile = $arTmpUser["UF_FILES_CURATOR"];
                if(count($existFile) >= MAX_CURATOR_FILE) $arResult["ERROR"]["file"]  = "Вы загрузили максимальн овозможное количество файлов";

                if(empty($arResult["ERROR"]) && !empty($filearray) && !empty($filearray['name'])) {
                    $filearray["MODULE_ID"] = "main";
                    $fid = CFile::SaveFile($filearray, "my_files");
                    if(intval($fid) < 0){
                        $arResult["ERRORS"]["save_file"] = "Ошибка при сохранении файла";
                    }
                    else{
                        $existFile[] = $fid;
                    }
                }
            }
            $fields["UF_FILES_CURATOR"] = $existFile;
        }
        $user->Update($arParams["USER_ID"], $fields);
        $strError = $user->LAST_ERROR;
        if($strError != ""){
            $arResult["ERRORS"]["save"] = $strError;
        }
        else{
            $arResult["MSG"] = "Ваш профиль успешно сохранен";
        }
    }
}

if(isset($_REQUEST["del"])){
    if($USER->IsAdmin()){
        $arResult["ERRORS"]["del_user"] = "Удаление аккаунта администратора невозможно";
    }
    else{
        //Получаем всех детей
        $arFilter = array (
            "IBLOCK_ID" => IBLOCK_CHILDS,
            "PROPERTY_CURATOR" => $arParams["USER_ID"],
        );
        $rsElement = CIBlockElement::GetList(array("ID" => "ASC"), $arFilter, false, false, array("ID"));
        while($arItem = $rsElement->GetNext()){
            CIBlockElement::SetPropertyValues($arItem["ID"], IBLOCK_CHILDS, "", "CURATOR");
        }

        //Переносим аккаунт
        $user = new CUser;
        $fields = Array(
            "LOGIN" => time().'#'.$USER->GetLogin(),
            "EMAIL" => time().'#'.$USER->GetEmail(),
            "GROUP_ID" => array(DELITION_GROUP),
            "ACTIVE" => "N"
        );
        $user->Update($arParams["USER_ID"], $fields);
        $strError = $user->LAST_ERROR;
        if($strError != "") $arResult["ERRORS"]["del_user"] = $strError;
        if(empty($arResult["ERRORS"])){
            $USER->Logout();
            LocalRedirect("/");
        }
    }
}

$arResult["USER"] = array();
$rsUser = CUser::GetList(($by="ID"), ($order="desc"), array("ID"=>$arParams["USER_ID"]),array("SELECT"=>array("UF_*"), "FIELDS"=>array("ID", "NAME", "LAST_NAME", "SECOND_NAME", "PERSONAL_PHOTO", "PERSONAL_BIRTHDAY", "PERSONAL_COUNTRY")));
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
$arResult["USER"]["FILES"] = array();
if(!empty($arResult["USER"]["UF_FILES_CURATOR"])){
    foreach($arResult["USER"]["UF_FILES_CURATOR"] as $files){
        $tmpFile = CFile::GetByID($files);
        $tmpFile = $tmpFile->Fetch();
        $tmpFile["URL"] = CFile::GetPath($files);
        $tmpFile["NAME"] = $tmpFile["ORIGINAL_NAME"];
        $arResult["USER"]["FILES"][] = $tmpFile;
    }
}



$this->IncludeComponentTemplate();
?>