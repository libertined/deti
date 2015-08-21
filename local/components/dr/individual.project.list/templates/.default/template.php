<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<?if($arResult["ALL_COUNT"] > 0):?>
	<?foreach($arResult["ITEMS"] as $project):?>
		<div class="kids-list__item clearfix" id="10">
			<div class="col-xs-4 left-col">
				<p class="kids-list__item-title">Кроссовки для занятия бегом Nike Air</p>
				<p class="kids-list__item-text">Маша стала серьезно относиться к спорту и дисциплине, у нее появился график и она каждое утро стала совершать пробежки. Также, Маша записалась на участие в кроссе. Для предупреждения спортивных травм ей необходима удобна обувь.</p>
			</div>
			<div class="kids-list__item-payment col-xs-2 right-col">
				<p class="kids-list__item-price">2200 грн.</p>
				<p class="btn btn--full kids-list__item-pay js-kid-pay">Оплатить</p>
				<p class="kids-list__item-date">
					Актуально до:<br>
					10 августа 2015 года
				</p>
				<a class="kids-list__item-decline" href="">отказаться</a>
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
