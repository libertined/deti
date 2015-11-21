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
);
$lAdmin->InitFilter($FilterArr);
if (CheckFilter()){
    if(!empty($find_id))
        $arFilter["ID"] = $find_id;
    if(!empty($find_name))
        $arFilter["%NAME"] = $find_name;
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
$arFilter["IBLOCK_ID"] = IBLOCK_CHILD_PROLECT;

if($find_start_from != ''){
    $arFilter[">=DATE_ACTIVE_FROM"] = $find_start_from;
}
if($find_start_to != ''){
    $timeStartTo = strtotime($find_start_to) + 86400;
    $arFilter["<=DATE_ACTIVE_FROM"] = date("d.m.Y", $timeStartTo);
}
if($find_end_from != ''){
    $arFilter[">=DATE_ACTIVE_TO"] = $find_end_from;
}
if($find_end_to != ''){
    $timeEndTo = strtotime($find_end_to) + 86400;
    $arFilter["<=DATE_ACTIVE_TO"] = date("d.m.Y", $timeEndTo);
}

$arSelect = array(
    "ID",
    "NAME",
    "ACTIVE_FROM",
    "ACTIVE_TO",
    "PROPERTY_ALL",
    "PROPERTY_PAYED",
    "PROPERTY_KID"
);

/* Получаем массив элементов */
$rsElement = CIBlockElement::GetList(array($by => $order), $arFilter, false, false, $arSelect);


/* Получаем попечителей */
$arFilterCurator = Array(
    "GROUPS_ID" => Array(CURATOR_GROUP)
);
$rsUsers = CUser::GetList(($by="id"), ($order="asc"), $arFilterCurator);
$arCurator = array();
while($curator = $rsUsers->Fetch()){
    $arCurator[$curator["ID"]]["NAME"] = $curator["LAST_NAME"]." ".substr($curator["NAME"], 0, 1).".";
    if($curator["SECOND_NAME"] != "")
        $arCurator[$curator["ID"]]["NAME"] .= substr($curator["SECOND_NAME"], 0, 1).".";
    $arCurator[$curator["ID"]]["NAME"] = "<nobr>".$arCurator[$curator["ID"]]["NAME"]."</nobr>";
}

/* Получаем детей */
$arFilterChild = array(
    "IBLOCK_ID" => IBLOCK_CHILDS
);
$arSelectChild = array(
    "ID",
    "NAME",
    "PROPERTY_CURATOR"
);
$rsChild = CIBlockElement::GetList(array($by => $order), $arFilterChild, false, false, $arSelectChild);
$arChilds = array();
while($kid = $rsChild->Fetch()){
    $arChilds[$kid["ID"]]["NAME"] = $kid["NAME"];
    $arChilds[$kid["ID"]]["CURATORS"] = array();
    foreach($kid["PROPERTY_CURATOR_VALUE"] as $curator){
        $arChilds[$kid["ID"]]["CURATORS"][] = $arCurator[$curator]["NAME"];
    }
    $arChilds[$kid["ID"]]["CURATORS"] = implode("<br>", $arChilds[$kid["ID"]]["CURATORS"]);
}

/* Получаем попечителей */

$rsData = new CAdminResult($rsElement, $sTableID);
$rsData->NavStart();
$lAdmin->NavText($rsData->GetNavPrint("Анкеты"));

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
    array(  "id"    =>"NAME",
        "content"  => "Название",
        "sort"    =>"name",
        "default"  =>true,
    ),
    array(  "id"    =>"CHILD",
        "content"  => "Ребенок",
        "sort"    =>"",
        "default"  =>true,
    ),
    array(  "id"    =>"CURATOR",
        "content"  => "Куратор",
        "sort"    =>"",
        "default"  =>true,
    ),
    array(  "id"    =>"ACTIVE_FROM",
        "content"  => "Дата начала",
        "sort"    =>"active_form",
        "align"    =>"center",
        "default"  =>true,
    ),
    array(  "id"    =>"ACTIVE_TO",
        "content"  => "Дата завершения",
        "sort"    =>"active_form",
        "align"    =>"center",
        "default"  =>true,
    ),
    array(  "id"    =>"DAYS",
        "content"  => "Осталось дней",
        "sort"    =>"days",
        "align"    =>"center",
        "default"  =>true,
    ),
    array(  "id"    =>"PROPERTY_ALL",
        "content"  => "Необходимая сумма",
        "sort"    =>"property_all",
        "align"    =>"center",
        "default"  =>true,
    ),
    array(  "id"    =>"PROPERTY_PAYED",
        "content"  => "Собранная сумма",
        "sort"    =>"property_payed",
        "align"    =>"center",
        "default"  =>true,
    ),
    array(  "id"    =>"NEED",
        "content"  => "Осталось собрать",
        "sort"    =>"need",
        "align"    =>"center",
        "default"  =>true,
    ),
));

while($arRes = $rsData->NavNext(true, "f_")):
    $row =& $lAdmin->AddRow($f_ID, $arRes);

    $row->AddViewField("PROPERTY_ALL", $arRes["PROPERTY_ALL_VALUE"]);
    $row->AddViewField("PROPERTY_PAYED", $arRes["PROPERTY_PAYED_VALUE"] );
    $row->AddViewField("NEED", ($arRes["PROPERTY_ALL_VALUE"] - $arRes["PROPERTY_PAYED_VALUE"]));

    //Даты
    $timeFrom = strtotime($arRes["ACTIVE_FROM"]);
    $timeTo = strtotime($arRes["ACTIVE_TO"]);

    $diff = ($timeTo-time())/60;//разница в минутах
    $days = floor($diff/(60*24));
    if($days < 0)
        $days = "Дата истекла";
    $row->AddViewField("DAYS", $days);
    $row->AddViewField("ACTIVE_FROM", ConvertTimeStamp($timeFrom, "SHORT", "ru"));
    $row->AddViewField("ACTIVE_TO", ConvertTimeStamp($timeTo, "SHORT", "ru"));

    //Дети
    $row->AddViewField("CHILD", $arChilds[ $arRes["PROPERTY_KID_VALUE"] ]["NAME"]);
    $row->AddViewField("CURATOR", $arChilds[ $arRes["PROPERTY_KID_VALUE"] ]["CURATORS"]);

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
$APPLICATION->SetTitle("Проекты персональные");
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
        "Название",
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
        <td>Название:</td>
        <td><input type="text" name="find_name" size="47" value="<?echo htmlspecialchars($find_name)?>"></td>
    </tr>
    <tr>
        <td>Дата начала:</td>
        <td><?echo CalendarPeriod("find_start_from", htmlspecialcharsex($find_start_from), "find_start_to", htmlspecialcharsex($find_start_to), "find_form", "N")?></td>
    </tr>
    <tr>
        <td>Дата завершения:</td>
        <td><?echo CalendarPeriod("find_end_from", htmlspecialcharsex($find_end_from), "find_end_to", htmlspecialcharsex($find_end_to), "find_form", "N")?></td>
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
