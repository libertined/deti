<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<div class="simple-form">
	<p class="simple-form__title simple-form__title--small">Форма обратной связи:</p>
	<?if($arResult["FORM_NOTE"] != ""):?>
	<p class="sucsess simple-form__sucsess"><?=$arResult["FORM_NOTE"]?></p>
	<?endif;?>


<?if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>
<?/***********************************************************************************
						form questions
***********************************************************************************/
?>		<?if ($arResult["isFormErrors"] == "Y"):?><p class="error simple-form__error"><?=$arResult["FORM_ERRORS_TEXT"];?></p><?endif;?>
		<?//if(!$USER->IsAuthorized()):?>
			<div class="single_col clearfix">
				<div class="left-col col-xs-3">
					<p class="simple-form__label"><?=$arResult["QUESTIONS"]["NAME"]["CAPTION"]?></p>
					<?=$arResult["QUESTIONS"]["NAME"]["HTML_CODE"]?>
				</div>
				<div class="col-xs-3">
					<p class="simple-form__label"><?=$arResult["QUESTIONS"]["EMAIL"]["CAPTION"]?></p>
					<?=$arResult["QUESTIONS"]["EMAIL"]["HTML_CODE"]?>
				</div>
				<div class="col-xs-4 right-col">
					<p class="simple-form__label"><?=$arResult["QUESTIONS"]["SUBJECT"]["CAPTION"]?></p>
					<?=$arResult["QUESTIONS"]["SUBJECT"]["HTML_CODE"]?>
				</div>
			</div>
		<?//endif;?>

		<?=$arResult["QUESTIONS"]["MESSAGE"]["HTML_CODE"]?>
		<div class="col-xs-4 simple-form__submit-block">
			<button class="btn btn--full js-submit-ask" type="submit" name="web_form_submit">Отправить</button>
			<input type="hidden" name="web_form_apply" value="Y" />
		</div>
<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
?>
</div>