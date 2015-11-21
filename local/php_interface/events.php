<?php
AddEventHandler("main", "OnBuildGlobalMenu", Array("MainHandlers", "customAdminMenu"));

include(GetLangFileName(dirname(__FILE__)."/", "/init.php"));

class MainHandlers
{
    function customAdminMenu(&$adminMenu, &$moduleMenu)
    {
        global $USER;
        $arGroupAvalaible = array("PANEL_GROUP"); // массив групп, в которых нужно проверить доступность пользователя
        $arCurGroups = CUser::GetUserGroup($USER->GetID());
        if ($USER->IsAdmin() || in_array(PANEL_GROUP, $arCurGroups)) {
            $adminMenu['global_menu_msgagency'] = array(
                "menu_id" => "msgagency",
                "sort" => 1000,
                "text" => 'Управление',       // текст пункта меню
                "title" => 'Меню Управление', // текст всплывающей подсказки
                "icon" => "form_menu_icon", // малая иконка
                "index_icon" => "form_page_icon", // большая иконка
                "items_id" => "global_menu_dreamers",  // идентификатор ветви
                "items" => array()          // остальные уровни меню сформируем ниже.
            );

        }
        $result_intersect = array_intersect($arCurGroups, $arGroupAvalaible);
        if ($USER->IsAdmin() || !empty($result_intersect)) {
            $moduleMenu[] = array(
                "parent_menu" => "global_menu_msgagency",
                "section" => "Проекты публичные",
                "sort" => 1000,
                "url" => "deti_project_publ.php",
                "text" => 'Проекты публичные',
                "title" => 'Проекты публичные',
                "icon" => "sys_menu_icon",
                "page_icon" => "form_page_icon",
                "items_id" => "project_publ",
                "items" => array()
            );
            $moduleMenu[] = array(
                "parent_menu" => "global_menu_msgagency",
                "section" => "Проекты персональные",
                "sort" => 1000,
                "url" => "deti_project_personal.php",
                "text" => 'Проекты персональные',
                "title" => 'Проекты персональные',
                "icon" => "sys_menu_icon",
                "page_icon" => "form_page_icon",
                "items_id" => "project_personal",
                "items" => array()
            );
            $moduleMenu[] = array(
                "parent_menu" => "global_menu_msgagency",
                "section" => "Попечители",
                "sort" => 1000,
                "url" => "deti_trustee.php",
                "text" => 'Попечители',
                "title" => 'Попечители',
                "icon" => "sys_menu_icon",
                "page_icon" => "form_page_icon",
                "items_id" => "trustee",
                "items" => array()
            );
            $moduleMenu[] = array(
                "parent_menu" => "global_menu_msgagency",
                "section" => "Дети",
                "sort" => 1000,
                "url" => "deti_children.php",
                "text" => 'Дети',
                "title" => 'Дети',
                "icon" => "sys_menu_icon",
                "page_icon" => "form_page_icon",
                "items_id" => "children",
                "items" => array()
            );
        }
    }
}