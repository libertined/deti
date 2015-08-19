<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="clearfix">
	<?
if ($arResult['SHOW_ERRORS'] == 'Y' && isset($arResult['ERROR_MESSAGE']) && !empty($arResult['ERROR_MESSAGE'])):
	?><div class="col-xs-4 centered-col">
		<div class="auth-form__error"><?=$arResult['ERROR_MESSAGE']["MESSAGE"]?></div>
	</div>
<?endif;?>
<?if($arResult["FORM_TYPE"] == "login"):?>

<form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">

<?if($arResult["BACKURL"] <> ''):?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?endif?>
<?foreach ($arResult["POST"] as $key => $value):?>
	<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
<?endforeach?>
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="AUTH" />
	<div class="col-xs-4 centered-col">
		<input class="auth-form__input" type="email" name="USER_LOGIN" value="<?=$arResult["USER_LOGIN"]?>" placeholder="<?=GetMessage("AUTH_LOGIN")?>" />
		<input name="USER_PASSWORD" class="auth-form__input" type="password" autocomplete="off" placeholder="<?=GetMessage("AUTH_PASSWORD")?>" />

		<?if ($arResult["CAPTCHA_CODE"]):?>
			<p><?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:</p>
			<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
			<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br /><br />
			<input type="text" name="captcha_word" class="auth-form__input" />
		<?endif?>
		<button class="btn btn--full" type="submit"  name="Login"><?=GetMessage("AUTH_LOGIN_BUTTON")?></button>
		<?if($arResult["NEW_USER_REGISTRATION"] == "Y"):?>
			<p class="auth-form__link"><a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a></p>
		<?endif?>
	</div>
</form>
<?
else:
	LocalRedirect($arResult["PROFILE_URL"]);
?>
<?endif?>
</div>