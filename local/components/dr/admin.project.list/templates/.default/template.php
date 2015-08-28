<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<?if(!$arResult["FILTER"]):?>
<div class="filter justify-block">
	<span class="filter__item active js-kl-type js-adm-proj-filter" data-value="">Все</span>
	<span class="filter__item js-kl-type js-adm-proj-filter" data-value="<?=IBLOCK_GEBNERAL_PROJ?>">Публичные</span>
	<span class="filter__item js-kl-type js-adm-proj-filter" data-value="<?=IBLOCK_CHILD_PROLECT?>">Индивидуальные</span>
	<span class="filter__item js-kl-time js-adm-proj-filter" data-value="3">в ближайшие 3 дня</span>
	<span class="filter__item js-kl-time js-adm-proj-filter" data-value="week">на текущей неделе</span>
	<span class="filter__item active js-kl-time js-adm-proj-filter" data-value="">в текущем месяце</span>
</div>
	<div id="proj-block">
<?endif;?>
<?if($arResult["ALL_COUNT"] > 0):?>
	<?foreach($arResult["ITEMS"] as $project):?>
		<p><?=$project["NAME"]?> - <?=$project["DATE_ACTIVE_TO"]?></p>
	<?endforeach;?>
<?endif;?>
<?if($arResult["ALL_COUNT"] == 0):?>
	<p>Сейчас нет активных проектов</p>
<?endif;?>
<?if(!$arResult["FILTER"]):?>
	</div>
<?endif;?>
