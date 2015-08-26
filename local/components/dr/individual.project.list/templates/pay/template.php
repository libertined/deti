<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<div class="simple_form">
	<p class="simple-form__title">Ваша оплата по проекту (проектам):</p>
	<div class="col-xs-7 centered-col project-pay">
	<?if($arResult["ALL_COUNT"] > 0):?>
		<?foreach($arResult["ITEMS"] as $project):?>
			<div class="project-pay__item clearfix single-col" id="pay<?=$project["ID"]?>">
				<div class="col-xs-1 left-col project-pay__name"><?=$arResult["CHILD"]?></div>
				<div class="col-xs-4 project-pay__title"><?=$project["NAME"]?></div>
				<div class="col-xs-2 right-col project-pay__count"><?=$project["ALL"]?></div>
				<div class="project-pay__cancel js-proj-pay-cansel" data-id="<?=$project["ID"]?>" data-type="<?=$arResult["PAY_TYPE"]?>"></div>
				<input type="hidden" name="count" value="<?=$project["PROPERTY_ALL_VALUE"]?>" class="js-proj-to-pay-count"/>
			</div>
		<?endforeach;?>
		<div class="project-pay__all clearfix">
			<p class="project-pay__all-title col-xs-4 left-col">Всего к оплате</p>
			<p class="project-pay__all-count col-xs-3 right-col js-all-proj-to-pay-count"><span><?=$arResult["ALL_PAY"]?></span> <?=MONEY_NAME?></p>
		</div>
		<div class="project-pay__pay-block col-xs-4 centered-col">
			<div class="btn btn--full">Оплатить</div>
		</div>
	<?else:?>
		<p>Нет активных проектов для оплаты</p>
	<?endif;?>
	</div>
</div>
