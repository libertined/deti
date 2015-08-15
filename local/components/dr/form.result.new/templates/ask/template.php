<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<div class="simple-form">
	<p class="simple-form__title"><?=$arResult["arForm"]["NAME"]?></p>
	<p class="simple-form__text"><?=$arResult["arForm"]["DESCRIPTION"]?></p>

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
		<div class="pseudo-select pseudo-select--white">
			<?if(!$USER->IsAuthorized()):?>
				<div class="single_col clearfix">
					<div class="left-col simple-form__right-col-small">
						<p class="simple-form__label"><?=$arResult["QUESTIONS"]["NAME"]["CAPTION"]?></p>
						<?=$arResult["QUESTIONS"]["NAME"]["HTML_CODE"]?>
					</div>
					<div class="col-xs-6 right-col">
						<p class="simple-form__label"><?=$arResult["QUESTIONS"]["EMAIL"]["CAPTION"]?></p>
						<?=$arResult["QUESTIONS"]["EMAIL"]["HTML_CODE"]?>
					</div>
				</div>
			<?endif;?>
			<label class="simple-form__label" for="form-subject"><?=$arResult["QUESTIONS"]["SUBJECT_LIST"]["CAPTION"]?></label>
			<div class="pseudo-select__text"><?=$arResult["QUESTIONS"]["SUBJECT_LIST"]["STRUCTURE"][0]["MESSAGE"]?></div>
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
			<button class="btn btn--full js-submit-ask" type="submit" name="web_form_submit">Отправить</button>
			<input type="hidden" name="web_form_apply" value="Y" />
		</div>

	<script>
		$(document).ready( function(){
			$("#question-form form").ajaxForm(
				{
					type: 'POST',
					url: "/ajax/ask_form.php",
					//dataType: 'json',
					success: function(data){
						$("#question-form .modal-wnd__content").html(data);
					}
				}
			);
		});
	</script>

<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
?>
</div>