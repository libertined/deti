<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<?if($arResult["PAGE"] == 1 && !$arResult["IS_FILTER"]):?>
<div class="kids-list col-xs-6 left-col">
	<h2 class="kids-list__title">Дети без попечителей</h2>
	<div class="kids-list__filter justify-block">
		<span class="kids-list__filter-item active js-kl-sex js-kid-filter" data-value="">Все</span>
		<span class="kids-list__filter-item js-kl-sex js-kid-filter" data-value="1">Мальчики</span>
		<span class="kids-list__filter-item js-kl-sex js-kid-filter" data-value="2">Девочки</span>
		<span class="kids-list__filter-item js-kl-age js-kid-filter" data-value="junior">3-6 лет</span>
		<span class="kids-list__filter-item js-kl-age js-kid-filter" data-value="child">7-10 лет</span>
		<span class="kids-list__filter-item js-kl-age js-kid-filter" data-value="teen">11-18 лет</span>
		<span class="kids-list__filter-item active js-kl-age js-kid-filter" data-value="">Любой возраст</span>
	</div>
	<div class="kids-list__list-icon clearfix" id="child_area">
		<p class="kid-icon__pseudo_link modal-open js-kid-info-link" data-src="choose-kid"></p>
<?endif;?>
<?if($arResult["PAGE"] == 1):?>
	<p class="kid-icon__pseudo_link modal-open js-kid-info-link" data-src="choose-kid"></p>
<?endif;?>
<?if($arResult["ALL_COUNT"] > 0):?>
	<?foreach($arResult["ITEMS"] as $kid):?>
		<div class="kid-icon kid-icon--<?=constant(SEX.$kid["PROPERTY_SEX_ENUM_ID"])?> js-kid-info" style="width: 25%" data-kid="<?=$kid["ID"]?>">
			<div class="kid-icon__img centered-col"></div>
			<span class="kid-icon__text"><?=$kid["NAME"]?></span>
			<span class="kid-icon__age"><?=$kid["PROPERTY_AGE_VALUE"]?> лет</span>
		</div>
	<?endforeach;?>
<?endif;?>
<div class="kids-list__more <?if(!$arResult['IS_MORE']):?>kids-list__more--hide<?endif;?>" id="kids_more" data-page="<?=$arResult['PAGE']+1?>">показать еще</div>
<?if($arResult["PAGE"] == 1):?>
	<?if($arResult["ALL_COUNT"] == 0):?>
		<p>К нашей большой радости у всех детей уже есть попечителт, Ю-ху!</p>
	<?endif;?>
	</div>
</div>
<?endif;?>
