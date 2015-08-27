<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<div class="kid-info__img-block col-xs-3 left-col">
	<?if($arResult["CHILD"]["IMG_PATH"] != ""):?>
		<img src="<?=$arResult["CHILD"]["IMG_PATH"]?>" alt="" class="kid-info__img"/>
	<?else:?>
		<div class="kid-icon__img centered-col"></div>
	<?endif;?>
</div>
<div class="col-xs-7 right-col kid-info__text-block">
	<p class="kid-info__name"><?=$arResult["CHILD"]["NAME"]?></p>
	<p class="kid-info__age"><?=$arResult["CHILD"]["PROPERTY_AGE_VALUE"]?> лет</p>
	<p class="kid-info__title">История ребенка</p>
	<p class="kid-info__text"><?=$arResult["CHILD"]["PREVIEW_TEXT"]?></p>
	<p class="kid-info__title">Интересы и мечты</p>
	<p class="kid-info__text"><?=$arResult["CHILD"]["DETAIL_TEXT"]?></p>
</div>
<?if(!empty($arResult["CHILD"]["CURATORS"])):?>
	<div class="kid-info__section col-xs-10 single-col clearfix">
		<p class="kid-info__section-title">Попечители ребенка на данный момент:</p>
		<?foreach($arResult["CHILD"]["CURATORS"] as $number => $curator):?>
			<div class="curator-info col-xs-5 <?if($number%2 == 0):?>left-col<?else:?>right-col<?endif;?>">
				<div class="col-xs-2 curator-info__img left-col <?if($curator["IMG_URL"] == ""):?>curator-info__img--def<?endif;?>">
					<?if($curator["IMG_URL"] != ""):?>
						<img src="<?=$curator["IMG_URL"]?>" alt="<?=$curator["NAME"]?> <?=$curator["SECOND_NAME"]?> <?=$curator["LAST_NAME"]?>"/>
					<?endif;?>
				</div>
				<div class="curator-info__text-block col-xs-3 right-col">
					<p class="curator-info__name"><?=$curator["NAME"]?> <?=$curator["SECOND_NAME"]?> <?=$curator["LAST_NAME"]?></p>
					<p class="curator-info__text">
						<span>Начало попечительства:</span><br>
						<?=$curator["FROM"]?> г.<br>
						<span>Окончание попечительства:</span><br>
						<?=$curator["TO"]?> г.<br>
						<span>Осталось дней:</span> <?=$curator["DAY"]?>
					</p>
				</div>
			</div>
		<?endforeach;?>
	</div>
<?endif;?>
<?if(!empty($arResult["ERRORS"])):?>
	<p class="error"><?=implode("<br>", $arResult["ERRORS"])?></p>
<?endif;?>
<?if($arResult["MSG"] != ""):?>
	<p class="sucsess simple-form__sucsess"><?=$arResult["MSG"]?></p>
<?else:?>
	<form action="/" method="POST" class="simple-form col-xs-10 centered-col">
		<div class="kid-info__section col-xs-10 single-col clearfix">
			<p class="kid-info__section-title">Продлить или отказаться от попечительства этого ребенка</p>
			<input type="hidden" name="time" class="js-choose-time-value" value=""/>
			<input type="hidden" name="id" value="<?=$arResult["CHILD"]["ID"]?>"/>
			<div class="kid-info__choose-periods kid-info__choose-periods--left">
				<span class="kid-info__choose-time kid-info__choose-time--size js-choose-time" data-value="6">6 месяцев</span>
				<span class="kid-info__choose-time kid-info__choose-time--size js-choose-time" data-value="12">12 месяцев</span>
				<span class="kid-info__choose-time kid-info__choose-time--size js-choose-time" data-value="24">24 месяца</span>
				<span class="kid-info__choose-time kid-info__choose-time--size js-choose-time" data-value="0">Отказаться</span>
				<button class="kid-info__choose-time kid-info__choose-time-btn" type="submit" name="request-send">Отправить заявку</button>
			</div>
		</div>
	</form>
<?endif;?>
