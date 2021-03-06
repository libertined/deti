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
	<?//if(!$USER->IsAuthorized()):?>
		<div class="single_col clearfix marg10-10">
			<div class="left-col simple-form__right-col-small">
				<p class="simple-form__label"><?=$arResult["QUESTIONS"]["NAME"]["CAPTION"]?></p>
				<?=$arResult["QUESTIONS"]["NAME"]["HTML_CODE"]?>
			</div>
			<div class="col-xs-6 right-col">
				<p class="simple-form__label"><?=$arResult["QUESTIONS"]["EMAIL"]["CAPTION"]?></p>
				<?=$arResult["QUESTIONS"]["EMAIL"]["HTML_CODE"]?>
			</div>
		</div>
	<?//endif;?>
	<?=$arResult["QUESTIONS"]["SUBJECT"]["HTML_CODE"]?>

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
						url: "/ajax/ask_open_form.php",
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