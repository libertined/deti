<? require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
global $USER;
if(!CModule::IncludeModule("iblock"))
{
    $this->AbortResultCache();
    ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
    return;
}
/* Генерируем массив с группами, которым можно смотреть эту страницу  */
$arUserAdminGroups = array(PANEL_GROUP);

/* Проверяем что пользователь состоит в необходимых группах */
$arGroups = CUser::GetUserGroup( $USER->GetID() );
$result_intersect = array_intersect($arUserAdminGroups, $arGroups);

if ( empty($result_intersect) && !$USER->IsAdmin() )
    $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));

$sTableID = "tbl_profile"; // ID таблицы
$oSort = new CAdminSorting($sTableID, "ID", "desc"); // объект сортировки
$lAdmin = new CAdminList($sTableID, $oSort); // основной объект списка

// ******************************************************************** //
//                           ФИЛЬТР                                     //
// ******************************************************************** //

// *********************** CheckFilter ******************************** //
function CheckFilter()
{
    global $FilterArr, $lAdmin, $strError, $find_date;
    $str = "";

    if (strlen(trim($find_date))>0)
    {
        $date_1_ok = false;
        $date_stm = MkDateTime(FmtDate($find_date,"D.M.Y H:i"),"d.m.Y H:i");
        if (!$date_stm && strlen(trim($find_date))>0)
            $str.= "Не правильный формат даты<br>";
        else $date_ok = true;
    }
    $strError .= $str;
    if(strlen($str)>0)
    {
        global $lAdmin;
        $lAdmin->AddFilterError($str);
        return false;
    }
    return true;
}
// *********************** /CheckFilter ******************************* //

$FilterArr = Array(
    "find_id",
    "find_name",
    "find_lname",
    "find_sname",
);
$lAdmin->InitFilter($FilterArr);
if (CheckFilter()){
    if(!empty($find_id))
        $arFilter["ID"] = $find_id;
    if(!empty($find_name))
        $arFilter["%NAME"] = $find_name;
    if(!empty($find_name))
        $arFilter["%LAST_NAME"] = $find_lname;
    if(!empty($find_name))
        $arFilter["%SECOND_NAME"] = $find_sname;
}

// ******************************************************************** //
//                ОБРАБОТКА ДЕЙСТВИЙ НАД ЭЛЕМЕНТАМИ СПИСКА              //
// ******************************************************************** //
if(($arID = $lAdmin->GroupAction()))
{

    // пройдем по списку элементов
    foreach($arID as $ID){
        if(strlen($ID)<=0)
            continue;
        $ID = IntVal($ID);

        // для каждого элемента совершим требуемое действие
        switch($_REQUEST['action']){
            case "moderate":
                break;
        }
    }
}


// ******************************************************************** //
//                ВЫБОРКА ЭЛЕМЕНТОВ СПИСКА                              //
// ******************************************************************** //
$arFilter = Array(
    "GROUPS_ID" => Array(CURATOR_GROUP)
);
$rsUsers = CUser::GetList(($by="id"), ($order="asc"), $arFilter);
$arCurator = array();
while($curator = $rsUsers->Fetch()){
    $arCurator[$curator["ID"]]["NAME"] = $curator["LAST_NAME"]." ".substr($curator["NAME"], 0, 1).".";
    if($curator["SECOND_NAME"] != "")
        $arCurator[$curator["ID"]]["NAME"] .= substr($curator["SECOND_NAME"], 0, 1).".";
    $areCurator["REFERENCE"][] = $arCurator[$curator["ID"]]["NAME"];
    $areCurator["REFERENCE_ID"][] = $curator["ID"];
    $arCurator[$curator["ID"]]["NAME"] = "<nobr>".$arCurator[$curator["ID"]]["NAME"]."</nobr>";
    $arCurator[$curator["ID"]]["CHILD"] = array();
    $arCurator[$curator["ID"]]["TIME"] = array();
    $arCurator[$curator["ID"]]["DAYS"] = array();
}

//Получаем детей
$arFilterChild["IBLOCK_ID"] = IBLOCK_CHILDS;
$arSelect = array(
    "ID",
    "NAME",
    "PROPERTY_CURATOR",
    "PROPERTY_SEX",
    "PROPERTY_AGE",
    "PROPERTY_TIME",
    "PROPERTY_TIME_FROM"
);
/* Получаем массив элементов */
$rsElement = CIBlockElement::GetList(array($by => $order), $arFilter, false, false, $arSelect);
while($kid = $rsElement->Fetch()){
    //Попечители
    foreach($kid["PROPERTY_CURATOR_VALUE"] as $ind=>$curator){
        $arCurator[$curator]["CHILD"][$kid["ID"]] = $kid["NAME"]." (".$kid["ID"].")";

        //Срок попечительства
        $timeTo = strtotime($kid["PROPERTY_TIME_VALUE"][$ind]);
        $arCurator[$curator]["TIME"][$kid["ID"]] = "<nobr>".ConvertTimeStamp(strtotime($kid["PROPERTY_TIME_FROM_VALUE"][$ind]), "SHORT", "ru").
            " - ".ConvertTimeStamp($timeTo, "SHORT", "ru")."</nobr>";

        $diff = ($timeTo-time())/60;//разница в минутах
        $daysTmp = floor($diff/(60*24));
        if($daysTmp < 0)
            $daysTmp = "Дата истекла";
        $arCurator[$curator]["DAYS"][$kid["ID"]] = $daysTmp;
    }
}

$rsData = new CAdminResult($rsUsers, $sTableID);
$rsData->NavStart();
$lAdmin->NavText($rsData->GetNavPrint("Попечители"));

// ******************************************************************** //
//                ПОДГОТОВКА СПИСКА К ВЫВОДУ                            //
// ******************************************************************** //

$lAdmin->AddHeaders(array(
    array(  "id"    =>"ID",
        "content"  =>"ID",
        "sort"    =>"ID",
        "align"    =>"right",
        "default"  =>true,
    ),
    array(  "id"    =>"LAST_NAME",
        "content"  => "Фамилия",
        "sort"    =>"last_name",
        "default"  =>true,
    ),
    array(  "id"    =>"NAME",
        "content"  => "Имя",
        "sort"    =>"name",
        "default"  =>true,
    ),
    array(  "id"    =>"SECOND_NAME",
        "content"  => "Отчество",
        "sort"    =>"second_name",
        "default"  =>true,
    ),
    array(  "id"    =>"CHILD",
        "content"  => "Дети",
        "sort"    =>"",
        "default"  =>true,
    ),
    array(  "id"    =>"CURATOR_TIME",
        "content"  => "Срок попечительства",
        "sort"    =>"",
        "align"    =>"center",
        "default"  =>true,
    ),
    array(  "id"    =>"DAYS",
        "content"  => "Осталось дней",
        "sort"    =>"days",
        "align"    =>"center",
        "default"  =>true,
    ),
));

while($arRes = $rsData->NavNext(true, "f_")):
    $row =& $lAdmin->AddRow($f_ID, $arRes);

    $row->AddViewField("CHILD", implode("<br>", $arCurator[ $arRes["ID"] ]["CHILD"]) );
    $row->AddViewField("CURATOR_TIME", implode("<br>", $arCurator[ $arRes["ID"] ]["TIME"]) );
    $row->AddViewField("DAYS", implode("<br>", $arCurator[ $arRes["ID"] ]["DAYS"]) );

    // сформируем контекстное меню
    $arActions = Array();

    /*
    $arActions[] = array(
        "ICON"=>"edit",
        "TEXT"=> "Добавить отзыв",
        "ACTION"=> "window.open('/office/review.php?id=".$arRes["PROPERTY_USER_VALUE"]."&profile=".$f_ID."','_blank')"
    );
    $arActions[] = array(
        "ICON"=>"delete",
        "TEXT"=> "Принудительная модерация",
        "ACTION"=> "if(confirm('Вы действительно хотите поставить пользователя на Принудительную модерацию?')) ".$lAdmin->ActionDoGroup($f_ID, "moderate")
    );

    // вставим разделитель
    $arActions[] = array("SEPARATOR"=>true);

    // если последний элемент - разделитель, почистим мусор.
    if(is_set($arActions[count($arActions)-1], "SEPARATOR"))
        unset($arActions[count($arActions)-1]);

    // применим контекстное меню к строке
    $row->AddActions($arActions);*/
endwhile;

// резюме таблицы
$lAdmin->AddFooter(
    array(
        array("title"=>GetMessage("Выбрано:"), "value"=>$rsData->SelectedRowsCount()), // кол-во элементов
        array("counter"=>true, "title"=>GetMessage("Отмечено:"), "value"=>"0"), // счетчик выбранных элементов
    )
);

// ******************************************************************** //
//                ВЫВОД                                                 //
// ******************************************************************** //
$lAdmin->CheckListMode();
$APPLICATION->SetTitle("Дети");
// не забудем разделить подготовку данных и вывод
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");

// ******************************************************************** //
//                АДМИНИСТРАТИВНОЕ МЕНЮ                                 //
// ******************************************************************** //
$lAdmin->AddAdminContextMenu(array(), true, true);


// ******************************************************************** //
//                ВЫВОД ФИЛЬТРА                                         //
// ******************************************************************** //
// создадим объект фильтра
$oFilter = new CAdminFilter(
    $sTableID."_filter",
    array(
        "ID",
        "Фамилия",
        "Имя",
        "Отчество",
    )
);
?>
<form name="find_form" method="get" action="<?echo $APPLICATION->GetCurPage();?>">
    <?$oFilter->Begin();?>
    <tr>
        <td>ID:</td>
        <td>
            <input type="text" name="find_id" size="47" value="<?echo htmlspecialchars($find_id)?>">
        </td>
    </tr>
    <tr>
        <td>Фамилия:</td>
        <td><input type="text" name="find_lname" size="47" value="<?echo htmlspecialchars($find_lname)?>"></td>
    </tr>
    <tr>
        <td>Имя:</td>
        <td><input type="text" name="find_name" size="47" value="<?echo htmlspecialchars($find_name)?>"></td>
    </tr>
    <tr>
        <td>Отчество:</td>
        <td><input type="text" name="find_sname" size="47" value="<?echo htmlspecialchars($find_sname)?>"></td>
    </tr>
    <?
    $oFilter->Buttons(array("table_id"=>$sTableID,"url"=>$APPLICATION->GetCurPage(),"form"=>"find_form"));
    $oFilter->End();
    ?>
</form>

<?
// выведем таблицу списка элементов
$lAdmin->DisplayList();
?>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php"); ?>
