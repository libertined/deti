<?php
// Склонение существительных взависимости от числительного
function NumberEnd($number, $titles) {
    $cases = array (2, 0, 1, 1, 1, 2);
    return $titles[ ($number%100>4 && $number%100<20)? 2 : $cases[min($number%10, 5)] ];
}

function cabinetAccess($authPage = AUTH_PAGE){
    global $USER;

    if(!$USER->IsAuthorized()){
        LocalRedirect($authPage);
    }

    $arUserAccessGroups = array(CURATOR_GROUP);
    $arParams["USER_ID"] = $USER->GetID();

    /* Проверяем что пользователь состоит в необходимых группах */
    $arGroups = CUser::GetUserGroup( $arParams["USER_ID"] );
    $resIntersectAccess = array_intersect($arUserAccessGroups, $arGroups);

    if(empty($resIntersectAccess) && !$USER->IsAdmin()){
        return false;
    }
    return true;
}

?>