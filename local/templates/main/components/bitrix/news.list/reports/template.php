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
		<p class="partner-item__title"><?=$arItem["NAME"]?></p>
		<div class="partner-item__desc">
			<?=$arItem["PREVIEW_TEXT"];?>
		</div>
		<?if(isset($arItem["DISPLAY_PROPERTIES"]["FILE"]["VALUE"])):?>
			<div class="col-xs-3 right-col single-col marg10-10"><a href="<?=$arItem["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"]["SRC"]?>" class="btn btn--full btn--right btn--download" target="_blank">Скачать PDF</a></div>
		<?endif;?>
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