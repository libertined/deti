<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<?if($arResult["ALL_COUNT"] > 0):?>
	<?foreach($arResult["ITEMS"] as $project):?>
		<div class="kids-list__item <?if($project["STATUS"] != "ACTIVE"):?>kids-list__item--fin<?endif;?> clearfix" id="proj<?=$project["ID"]?>">
			<div class="col-xs-4 left-col">
				<p class="kids-list__item-title"><?=$project["NAME"]?></p>
				<p class="kids-list__item-text"><?=$project["PREVIEW_TEXT"]?></p>
			</div>
			<div class="kids-list__item-payment col-xs-2 right-col">
				<p class="kids-list__item-price"><?=$project["ALL"]?></p>
				<?if($project["STATUS"] == "READY"):?>
					<p class="btn btn--full kids-list__item-pay kids-list__item-pay--payed">Оплачено</p>
					<p class="kids-list__item-date">
						Оплачено:<br>
						<?=$project["DATE_ACTIVE_TO"]?>
					</p>
				<?elseif($project["STATUS"] == "FIN"):?>
					<p class="btn btn--full kids-list__item-pay kids-list__item-pay--fin">Просрочено</p>
				<?elseif($project["STATUS"] == "DECLINE"):?>
					<p class="btn btn--full kids-list__item-pay kids-list__item-pay--decline">Отказ</p>
					<p class="kids-list__item-date">
						Актуально до:<br>
						<?=$project["DATE_ACTIVE_TO"]?>
					</p>
				<?else:?>
					<p class="btn btn--full kids-list__item-pay js-kid-pay" data-id="<?=$project["ID"]?>">Выбрать</p>
					<p class="kids-list__item-date">
						Актуально до:<br>
						<?=$project["DATE_ACTIVE_TO"]?>
					</p>
					<a class="kids-list__item-decline js-kid-decline" href="">отказаться</a>
				<?endif;?>
			</div>
		</div>
	<?endforeach;?>
<?endif;?>
<div class="kids-list__more <?if(!$arResult['IS_MORE']):?>kids-list__more--hide<?endif;?>" id="btn_see_more" data-page="<?=$arResult['PAGE']+1?>">показать еще</div>
<?if($arResult["PAGE"] == 1):?>
	<?if($arResult["ALL_COUNT"] == 0):?>
		<p>Сейчас нет активных проектов</p>
	<?endif;?>
<?endif;?>
