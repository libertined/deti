<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
?>
<div class="simple-form forgot-pass col-xs-4 centered-col">
	<div class="forgot-pass__text"><?=$arParams["~AUTH_RESULT"]?></div>
	<div class="forgot-pass__text"><?=GetMessage("AUTH_FORGOT_PASSWORD_1")?></div>
	<form name="bform" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>" class="forgot-pass__form">
		<?
		if (strlen($arResult["BACKURL"]) > 0)
		{
		?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
		<?
		}
		?>
		<input type="hidden" name="AUTH_FORM" value="Y">
		<input type="hidden" name="TYPE" value="SEND_PWD">

		<input class="simple-form__input" type="email" name="USER_EMAIL" value="" placeholder="<?=GetMessage("AUTH_EMAIL")?>" />

		<button class="btn btn--full marg10-10" type="submit" name="send_account_info"><?=GetMessage("AUTH_SEND")?></button>
	</form>
</div>
<script type="text/javascript">
document.bform.USER_LOGIN.focus();
</script>
