<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

<?=$arResult["FORM_NOTE"]?>

<?if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>

<?/***********************************************************************************
						form questions
***********************************************************************************/
?>
	<div class="simple-form">
		<p class="simple-form__title"><?=$arResult["arForm"]["NAME"]?></p>
		<p class="simple-form__text"><?=$arResult["arForm"]["DESCRIPTION"]?></p>
		<label class="simple-form__label" for="form-subject"><?=$arResult["QUESTIONS"]["SUBJECT_LIST"]["CAPTION"]?></label>
		<div class="pseudo-select pseudo-select--white">
			<div class="pseudo-select__text"><?=$arResult["QUESTIONS"]["SUBJECT_LIST"]["STRUCTURE"][0]?></div>
			<ul class="pseudo-select__list">
				<?foreach($arResult["QUESTIONS"]["SUBJECT_LIST"]["STRUCTURE"] as $numb=>$subject):?>
					<li class="pseudo-select__option" data-value="<?=$subject["ID"]?>"><?=$subject["MESSAGE"]?></li>
				<?endforeach;?>
			</ul>
			<select name="form_dropdown_SIMPLE_QUESTION_995" class="pseudo-select__real" id="form-subject">
				<?foreach($arResult["QUESTIONS"]["SUBJECT_LIST"]["STRUCTURE"] as $numb=>$subject):?>
					<option value="<?=$subject["ID"]?>" <?if($numb == 0):?>selected="selected"<?endif;?>><?=$subject["MESSAGE"]?></option>
				<?endforeach;?>
			</select>
		</div>
		<?=$arResult["QUESTIONS"]["MESSAGE"]["HTML_CODE"]?>
		<div class="col-xs-4 simple-form__submit-block">
			<button class="btn btn--full" type="submit" name="web_form_apply">Отправить</button>
			<input type="hidden" name="web_form_apply" value="Y" />
		</div>
	</div>
<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
?>