<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<div class="curator__ava avatar centered-col">
	<?if(!empty($arResult["USER"]["AVATAR"])):?>
		<img src="<?=$arResult["USER"]["AVATAR"]["src"]?>" alt="<?=$arResult["USER"]["NAME"]?> <?=$arResult["USER"]["SECOND_NAME"]?> <?=$arResult["USER"]["LAST_NAME"]?>"/>
	<?endif;?>
</div>
<p class="curator__name"><?=$arResult["USER"]["NAME"]?> <?=$arResult["USER"]["SECOND_NAME"]?> <?=$arResult["USER"]["LAST_NAME"]?></p>
<p class="curator__link modal-open" data-src="simple-wnd" data-load="/ajax/curator_edit.php">Редактировать профиль</p>
<p class="curator__link"><a href="/">Правила и условия попечительства</a></p>
<p class="curator__status">Статус: Попечитель. Дети: <?=$arResult["CHILDREN"]?></p>
<?include $_SERVER["DOCUMENT_ROOT"]."/local/include/simple_wnd.php";?>