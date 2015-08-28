<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<?if(!$arResult["FILTER"]):?>
	<div class="filter justify-block">
		<span class="filter__item active js-adm-curator-filter" data-value="">Без детей</span>
		<span class="filter__item js-adm-curator-filter" data-value="3">в ближайшие 3 дня</span>
		<span class="filter__item js-adm-curator-filter" data-value="week">на текущей неделе</span>
		<span class="filter__item js-adm-curator-filter" data-value="month">в текущем месяце</span>
	</div>
<div id="curator-block">
	<?endif;?>
	<?if($arResult["ALL_COUNT"] > 0):?>
		<?foreach($arResult["ITEMS"] as $curator):?>
			<? echo "<pre>";
			print_r($curator);
			echo "</pre>";?>
		<?endforeach;?>
	<?endif;?>
	<?if($arResult["ALL_COUNT"] == 0):?>
		<p>Сейчас нет активных проектов</p>
	<?endif;?>
	<?if(!$arResult["FILTER"]):?>
</div>
<?endif;?>
