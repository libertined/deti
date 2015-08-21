<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<h2 class="kids-list__title">Ваши дети</h2>
<div class="kids-list__list-icon clearfix">
	<?foreach($arResult["ITEMS"] as $kid):?>
		<div class="kid-icon kid-icon--<?=constant(SEX.$kid["PROPERTY_SEX_ENUM_ID"])?> js-choose-kid <?if($arResult["ACTIVE"] == $kid["ID"]):?>active<?endif;?>" style="width: <?=$arResult["WIDTH"]?>%" data-kid="<?=$kid["ID"]?>">
			<div class="kid-icon__img centered-col"></div>
			<span class="kid-icon__text"><?=$kid["NAME"]?></span>
		</div>
	<?endforeach;?>
	<div class="kid-icon" style="width: <?=$arResult["WIDTH"]?>%">
		<a class="kid-icon__img centered-col" href="/cabinet/childs.php"></a>
		<a class="kid-icon__text" href="/cabinet/childs.php">Выбрать</a>
	</div>
</div>
<?foreach($arResult["ITEMS"] as $kid):?>
	<div class="kids-list__item-block <?if($arResult["ACTIVE"] == $kid["ID"]):?>active<?endif;?> js-kid-tab" id="kid<?=$kid["ID"]?>">
		<?$APPLICATION->IncludeComponent(
			"dr:individual.project.list",
			"",
			Array(
				"IBLOCK_ID" => IBLOCK_CHILD_PROLECT,
				"COUNT" => 2,
				"PAGE" => 1,
				"FILTER" => '',
				"KID" => $kid["ID"]
			)
		);?>
	</div>
<?endforeach;?>