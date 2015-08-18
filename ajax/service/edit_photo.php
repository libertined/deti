<?php  require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
/* AJAX загрузка фотографии */
global $USER;

$typesPhotoArr = array('image/jpeg', 'image/png', 'image/gif');
$dataFiles = array("id" => 0, "path" =>  "", "error" => "", "name" => "", "type" => "");

if(isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != ''){
    $arParams["ID"] = $_REQUEST['user_id'];
}
elseif(empty($_REQUEST)){
    $dataFiles["error"] = "Загружаемый файл слишком большого размера!";
}
else{
    $dataFiles["error"] = "Не задан попечитель";
}

if($dataFiles["error"] === ''){
    $filearray = $_FILES['uploadPhoto'];

    if(!is_array($filearray)) $dataFiles["error"] = "Ошибка при зарузке фотографиии";
    if(isset($filearray['error']) && $filearray['error'] == 2) $dataFiles["error"] = "Загружаемый файл слишком большого размера!";
    if(!in_array($filearray["type"], $typesPhotoArr) && $dataFiles["error"] == '') $dataFiles["error"] = "Загружаемый файл неправильного формата!";

    if($dataFiles["error"] == ""){
        $user = new CUser;
        if($filearray["type"] == $typesPhotoArr[0])
            $arTmpPhotoExt = ".jpg";
        elseif($filearray["type"] == $typesPhotoArr[1])
            $arTmpPhotoExt = ".png";
        else
            $arTmpPhotoExt = ".gif";

        $destinationFile =  $_SERVER['DOCUMENT_ROOT']."/upload/tmp/".time().$arTmpPhotoExt;
        $wmMini = CFile::ResizeImageFile(
            $filearray['tmp_name'],
            $destinationFile,
            array('width'=>400, 'height'=>400),
            BX_RESIZE_IMAGE_PROPORTIONAL,
            array(),
            100
        );

        $arFile = CFile::MakeFileArray($destinationFile);

        $arFile['del'] = "Y";
        $arFile['old_file'] = "";

        $fields = Array(
            "PERSONAL_PHOTO" => $arFile
        );
        $user->Update($arParams["ID"], $fields);
        $dataFiles["error"] = $user->LAST_ERROR;

        if($dataFiles["error"] == ""){
            $rsUser = CUser::GetByID($arParams["ID"]);
            $arResult["USER"] = $rsUser->Fetch();
            $arResult["USER"]["AVATAR"] = CFile::ResizeImageGet(
                $arResult["USER"]["PERSONAL_PHOTO"],
                array("width" => 160, "height" => 160),
                BX_RESIZE_IMAGE_EXACT,
                true
            );
            $dataFiles["path"] = $arResult["USER"]["AVATAR"]["src"]."?".time();
        }
        unlink($destinationFile);
    }
}
echo json_encode($dataFiles);
?>