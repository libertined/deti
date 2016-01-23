<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<!--RestartBuffer-->
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="partner-item clearfix" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="col-xs-2 left-col">
			<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
				<img class="partner-item__img" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"/>
			<?endif?>
		</div>
		<div class="col-xs-8 right-col">
			<p class="partner-item__title"><?=$arItem["NAME"]?></p>
			<div class="partner-item__desc">
				<?=$arItem["PREVIEW_TEXT"];?>
			</div>
			<?if(isset($arItem["DISPLAY_PROPERTIES"]["LINK"]["VALUE"])):?>
				<p class="partner-item__link"><a href="http://<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>"><?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?></a></p>
			<?endif;?>
		</div>
	</div>
<?endforeach;?>
<?php
$paramName = 'PAGEN_'.$arResult['NAV_RESULT']->NavNum;
$paramValue = $arResult['NAV_RESULT']->NavPageNomer;
$pageCount = $arResult['NAV_RESULT']->NavPageCount;

if ($paramValue < $pageCount) {
	$paramValue = (int) $paramValue + 1;
	$url = htmlspecialcharsbx(
		$APPLICATION->GetCurPageParam(
			sprintf('%s=%s', $paramName, $paramValue),
			array($paramName, 'AJAX_PAGE',)
		)
	);
	echo sprintf('<div class="ajax-pager-wrap ">
                      <a class="ajax-pager-link" data-wrapper-class="news-list" href="%s"></a>
                  </div>',
		$url);
}
?>
<!--RestartBuffer-->