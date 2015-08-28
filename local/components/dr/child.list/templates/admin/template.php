<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<?if(!$arResult["IS_FILTER"]):?>
<div class="filter justify-block">
	<span class="filter__item active js-kl-sex js-admin-kid-filter" data-value="">Все</span>
	<span class="filter__item js-kl-sex js-admin-kid-filter" data-value="1">Мальчики</span>
	<span class="filter__item js-kl-sex js-admin-kid-filter" data-value="2">Девочки</span>
	<span class="filter__item js-kl-age js-admin-kid-filter" data-value="junior">3-6 лет</span>
	<span class="filter__item js-kl-age js-admin-kid-filter" data-value="child">7-10 лет</span>
	<span class="filter__item js-kl-age js-admin-kid-filter" data-value="teen">11-18 лет</span>
	<span class="filter__item active js-kl-age js-admin-kid-filter" data-value="">Любой возраст</span>
</div>
<div id="child_area">
<?endif;?>
<?if($arResult["ALL_COUNT"] > 0):?>
	<?foreach($arResult["ITEMS"] as $kid):?>
		<p><?=$kid["NAME"]?> - <?=$kid["PROPERTY_AGE_VALUE"]?> лет</p>
	<?endforeach;?>
<?endif;?>
<?if($arResult["ALL_COUNT"] == 0):?>
	<p>К нашей большой радости у всех детей уже есть попечителт, Ю-ху!</p>
<?endif;?>
<?if(!$arResult["IS_FILTER"]):?>
</div>
<?endif;?>