<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
?>
<div class="simple-form forgot-pass <?if(isset($_REQUEST["forgot_password"]) && $_REQUEST["forgot_password"] != ''):?>forgot-pass--show<?endif;?> js-forgot-block">
	<div class="simple-form__text"><?=$arParams["~AUTH_RESULT"]?></div>
	<div class="simple-form__text"><?=GetMessage("AUTH_FORGOT_PASSWORD_1")?></div>

	<div class="col-xs-4 centered-col">

		<form name="bform" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
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

			<div class="simple-form__text"><?=GetMessage("AUTH_GET_CHECK_STRING")?></div>
			<input class="simple-form__input" type="email" name="USER_EMAIL" value="" placeholder="<?=GetMessage("AUTH_EMAIL")?>" />

			<button class="btn btn--full marg10-10" type="submit" name="send_account_info"><?=GetMessage("AUTH_SEND")?></button>
		</form>
	</div>
</div>
<script type="text/javascript">
document.bform.USER_LOGIN.focus();
</script>
