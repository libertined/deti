<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<input type="hidden" name="LMI_MERCHANT_ID" value="<?=$arResult["MERCHANT_ID"]?>">
<input type="hidden" name="LMI_PAYMENT_NO" value="<?=$arResult["ORDER"]?>">
<input type="hidden" name="LMI_PAYMENT_DESC" value="<?=$arResult["PAYMENT_DESC"]?>">
<input type="hidden" name="LMI_SIM_MODE" value="<?=$arResult["PAYMENT_SIM_MODE"]?>">
<input type="hidden" name="LMI_PAYMENT_AMOUNT" value="<?=$arResult["PAYMENT_SUM"]?>" />