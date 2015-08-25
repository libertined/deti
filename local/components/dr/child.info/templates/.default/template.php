<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<form action="/" method="POST" class="simple-form col-xs-10 centered-col">
	<p class="simple-form__title">Ребенок нуждается в попечителе</p>
	<?if(!empty($arResult["ERRORS"])):?>
		<p class="error"><?=implode("<br>", $arResult["ERRORS"])?></p>
	<?endif;?>
	<?if($arResult["MSG"] != ""):?>
		<p class="sucsess simple-form__sucsess"><?=$arResult["MSG"]?></p>
	<?else:?>
		<div class="kid-info__img-block col-xs-2 left-col">
			<div class="kid-icon kid-icon--<?=constant(SEX.$arResult["CHILD"]["PROPERTY_SEX_ENUM_ID"])?> centered-col">
				<?if($arResult["CHILD"]["IMG_PATH"] != ""):?>
					<img src="<?=$arResult["CHILD"]["IMG_PATH"]?>" alt="" class="kid-info__img"/>
				<?else:?>
					<div class="kid-icon__img centered-col"></div>
				<?endif;?>
				<span class="kid-icon__text"><?=$arResult["CHILD"]["NAME"]?></span>
				<span class="kid-icon__age"><?=$arResult["CHILD"]["PROPERTY_AGE_VALUE"]?> лет</span>
			</div>
		</div>
		<div class="col-xs-8 right-col kid-info__text-block">
			<p class="kid-info__title">История ребенка</p>
			<p class="kid-info__text"><?=$arResult["CHILD"]["PREVIEW_TEXT"]?></p>
			<p class="kid-info__title">Интересы и мечты</p>
			<p class="kid-info__text"><?=$arResult["CHILD"]["DETAIL_TEXT"]?></p>
			<?if(!empty($arResult["CHILD"]["CURATORS"])):?>
				<p class="kid-info__title">Попечители</p>
				<p class="kid-info__text"><?=implode(", ", $arResult["CHILD"]["CURATORS"])?></p>
			<?endif;?>
		</div>
		<div class="kid-info__choose col-xs-10 single-col">
			<p class="kid-info__choose-title">Оформить заявку на попечительство этого ребёнка</p>
			<p class="kid-info__choose-info">Выберете желаемый срок:</p>
			<div class="kid-info__choose-periods">
				<span class="kid-info__choose-time col-xs-2 js-choose-time" data-value="6">6 месяцев</span>
				<span class="kid-info__choose-time col-xs-2 js-choose-time" data-value="12">12 месяцев</span>
				<span class="kid-info__choose-time col-xs-2 js-choose-time" data-value="24">24 месяца</span>
			</div>
		</div>
		<input type="hidden" name="time" class="js-choose-time-value" value=""/>
		<input type="hidden" name="id" value="<?=$arResult["CHILD"]["ID"]?>"/>
		<button class="btn col-xs-3 centered-col" type="submit" name="request-send">Отправить заявку</button>
	<?endif;?>
</form>
<script>
	$(document).ready( function(){
		$("#choose-kid form").ajaxForm(
			{
				type: 'POST',
				url: "/ajax/kid-info.php",
				//dataType: 'json',
				success: function(data){
					$("#choose-kid .modal-wnd__content").html(data);

				}
			}
		);
		if(void 0 !== $("#choose-kid .error")){
			var popMargTop = ($('#choose-kid').height() + 40) / 2;
			//Устанавливаем величину отступа
			$('#choose-kid').css({
				'margin-top' : -popMargTop
			});
		}
	});
</script>