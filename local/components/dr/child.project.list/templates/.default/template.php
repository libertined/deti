<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<h2 class="kids-list__title">Ваши дети</h2>
<div class="kids-list__list-icon clearfix">
	<?foreach($arResult["ITEMS"] as $kid):?>
		<div class="kid-icon kid-icon--left kid-icon--<?=constant(SEX.$kid["PROPERTY_SEX_ENUM_ID"])?> js-choose-kid <?if($arResult["ACTIVE"] == $kid["ID"]):?>active<?endif;?>" data-kid="<?=$kid["ID"]?>">
			<div class="kid-icon__img centered-col"></div>
			<span class="kid-icon__text"><?=$kid["NAME"]?></span>
			<p class="kid-icon__date-block">
				Окончание:<br>
				<span><?=$kid["DATE"]?></span><br>
				через:<br>
				<span><?=$kid["DAY"]?> <?=NumberEnd($kid["DAY"], array("день", "дня", "дней"))?></span>
			</p>
		</div>
	<?endforeach;?>
	<div class="kid-icon kid-icon--left">
		<a class="kid-icon__img centered-col" href="/cabinet/childs.php"></a>
		<a class="kid-icon__text" href="/cabinet/childs.php">Выбрать</a>
	</div>
</div>
<a class="btn btn--full btn--gray js-child-info-link" href="/cabinet/child_info.php?id=<?=$arResult["ACTIVE"]?>">Перейти в профиль выбранного
	ребенка</a>
<?foreach($arResult["ITEMS"] as $kid):?>
	<div class="kids-list__item-block <?if($arResult["ACTIVE"] == $kid["ID"]):?>active<?endif;?> js-kid-tab" id="kid<?=$kid["ID"]?>">
		<?$APPLICATION->IncludeComponent(
			"dr:individual.project.list",
			"",
			Array(
				"IBLOCK_ID" => IBLOCK_CHILD_PROLECT,
				"COUNT" => 10,
				"PAGE" => 1,
				"FILTER" => '',
				"KID" => $kid["ID"]
			)
		);?>
	</div>
<?endforeach;?>
<?$APPLICATION->AddHeadScript('/local/js/curator_child.js');?>