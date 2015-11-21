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
    "find_sex",
    "find_curator"
);
$lAdmin->InitFilter($FilterArr);
if (CheckFilter()){
    if(!empty($find_id))
        $arFilter["ID"] = $find_id;
    if(!empty($find_name))
        $arFilter["%NAME"] = $find_name;
    if(!empty($find_sex))
        $arFilter["PROPERTY_SEX"] = $find_sex;
    if(!empty($find_curator))
        $arFilter["PROPERTY_CURATOR"] = $find_curator;
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
$arFilter["IBLOCK_ID"] = IBLOCK_CHILDS;
$areSex = array(
    "REFERENCE" => array("Все", "Мальчик", "Девочка"),
    "REFERENCE_ID" =>  array("", "1", "2")
);
$areCurator = array(
    "REFERENCE" => array("Все"),
    "REFERENCE_ID" =>  array("")
);
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
    $areCurator["REFERENCE"][] = $arCurator[$curator["ID"]]["NAME"];
    $areCurator["REFERENCE_ID"][] = $curator["ID"];
    $arCurator[$curator["ID"]]["NAME"] = "<nobr>".$arCurator[$curator["ID"]]["NAME"]."</nobr>";
}

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
$arChild = array();
while($kid = $rsElement->Fetch()){
    $kidInfo = array();
    //Попечители
    $curators = array();
    foreach($kid["PROPERTY_CURATOR_VALUE"] as $curator){
        $curators[] = $arCurator[$curator]["NAME"];
    }
    $kidInfo["CURATOR"] = implode("<br>", $curators);

    //Срок попечительства
    $times = array();
    $days = array();
    foreach($kid["PROPERTY_TIME_FROM_VALUE"] as $ind=>$time){
        $timeTo = strtotime($kid["PROPERTY_TIME_VALUE"][$ind]);
        $times[] = "<nobr>".ConvertTimeStamp(strtotime($time), "SHORT", "ru").
            " - ".ConvertTimeStamp($timeTo, "SHORT", "ru")."</nobr>";

        $diff = ($timeTo-time())/60;//разница в минутах
        $daysTmp = floor($diff/(60*24));
        if($daysTmp < 0)
            $daysTmp = "Дата истекла";
        $days[] = $daysTmp;
    }
    $kidInfo["CURATOR_TIME"] = implode("<br>", $times);
    $kidInfo["DAYS"] = implode("<br>", $days);

    $arChild[ $kid["ID"] ] = $kidInfo;
}

$rsData = new CAdminResult($rsElement, $sTableID);
$rsData->NavStart();
$lAdmin->NavText($rsData->GetNavPrint("Дети"));

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
        "content"  => "Имя",
        "sort"    =>"name",
        "default"  =>true,
    ),
    array(  "id"    =>"PROPERTY_SEX",
        "content"  => "Пол",
        "sort"    =>"sex",
        "default"  =>true,
    ),
    array(  "id"    =>"PROPERTY_AGE",
        "content"  => "Возраст",
        "sort"    =>"",
        "default"  =>true,
    ),
    array(  "id"    =>"CURATOR",
        "content"  => "Куратор",
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
    $row->AddViewField("PROPERTY_SEX", $arRes["PROPERTY_SEX_VALUE"]);
    $row->AddViewField("PROPERTY_AGE", $arRes["PROPERTY_AGE_VALUE"] );

    $row->AddViewField("CURATOR", $arChild[ $arRes["ID"] ]["CURATOR"] );
    $row->AddViewField("CURATOR_TIME", $arChild[ $arRes["ID"] ]["CURATOR_TIME"] );
    $row->AddViewField("DAYS", $arChild[ $arRes["ID"] ]["DAYS"] );

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
        "Имя",
        "Пол",
        "Попечитель",
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
        <td>Имя:</td>
        <td><input type="text" name="find_name" size="47" value="<?echo htmlspecialchars($find_name)?>"></td>
    </tr>
    <tr>
        <td>Пол:</td>
        <td><?echo SelectBoxFromArray("find_sex", $areSex, $find_sex, GetMessage("POST_ALL"), "");?></td>
    </tr>
    <tr>
        <td>Попечитель:</td>
        <td><?echo SelectBoxFromArray("find_curator", $areCurator, $find_curator, GetMessage("POST_ALL"), "");?></td>
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
