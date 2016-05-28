<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<div class="wrapper wrapper--fill clearfix">
	<div class="breadcrumbs col-xs-7"><a href="/" class="breadcrumbs__item">главная</a> <span class="breadcrumbs__separator">&frasl;</span> <span class="breadcrumbs__current"><?=$arResult["PROJECT"]["NAME"]?></span></div>
	<h1 class="page-title page-title--h1 col-xs-9">
		<?=$arResult["PROJECT"]["NAME"]?>
	</h1>
</div>
<div class="wrapper wrapper--fill content-block clearfix">
	<div class="project-detail col-xs-10 centered-col clearfix">
		<?if(isset($arResult["PROJECT"]["PIC1"])):?>
		<div class="project-detail__images">
			<div>
				<a href="<?=$arResult["PROJECT"]["PIC1"]["ORIGINAL"]?>" class="fancybox" rel="group">
					<img src="<?=$arResult["PROJECT"]["PIC1"]["src"]?>" alt=""/>
				</a>
			</div>
			<?if(!isset($arResult["PROJECT"]["PIC3"])):?>
				<div></div>
			<?endif;?>
			<?if(isset($arResult["PROJECT"]["PIC2"])):?>
				<div>
					<a href="<?=$arResult["PROJECT"]["PIC2"]["ORIGINAL"]?>" class="fancybox" rel="group">
						<img src="<?=$arResult["PROJECT"]["PIC2"]["src"]?>" alt=""/>
					</a>
				</div>
			<?endif;?>
			<?if(isset($arResult["PROJECT"]["PIC3"])):?>
				<div>
					<a href="<?=$arResult["PROJECT"]["PIC3"]["ORIGINAL"]?>" class="fancybox" rel="group">
						<img src="<?=$arResult["PROJECT"]["PIC3"]["src"]?>" alt=""/>
					</a>
				</div>
			<?endif;?>
			<?if(isset($arResult["PROJECT"]["PIC4"])):?>
				<div>
					<a href="<?=$arResult["PROJECT"]["PIC4"]["ORIGINAL"]?>" class="fancybox" rel="group">
						<img src="<?=$arResult["PROJECT"]["PIC4"]["src"]?>" alt=""/>
					</a>
				</div>
			<?endif;?>
		</div>
		<?endif;?>
		<div class="project-detail__text left-col col-xs-6">
			<?=$arResult["PROJECT"]["DETAIL_TEXT"]?>
			<div class="project-detail__social">
				<?$APPLICATION->IncludeComponent(
					"bitrix:catalog.socnets.buttons",
					"dreamers",
					Array(
						"COMPONENT_TEMPLATE" => ".default",
						"URL_TO_LIKE" => $APPLICATION->GetCurPage(),
						"TITLE" => $arResult["PROJECT"]["NAME"],
						"DESCRIPTION" => $arResult["PROJECT"]["PREVIEW_TEXT"],
						"IMAGE" => "",
						"FB_USE" => "Y",
						"TW_USE" => "N",
						"TW_VIA" => "",
						"TW_HASHTAGS" => "",
						"TW_RELATED" => "",
						"GP_USE" => "N",
						"VK_USE" => "Y"
					)
				);?>

			</div>
		</div>
		<div class="project-detail__info right-col col-xs-4">
			<p class="project-detail__info-item">Необходимо собрать: <span class="project-detail__price"><?=$arResult["PROJECT"]["ALL"]?></span></p>
			<p class="project-detail__info-item">Уже собрано: <span class="project-detail__price"><?=$arResult["PROJECT"]["PAYED"]?></span></p>
			<p class="project-detail__info-item">Сколько осталось: <span class="project-detail__price"><?=$arResult["PROJECT"]["DIFF"]?></span></p>
			<p class="project-detail__info-item">Начало реализации: <span class="project-detail__date"><?=$arResult["PROJECT"]["DATE_ACTIVE_FROM"]?></span></p>
			<p class="project-detail__info-item">Завершение реализации: <span class="project-detail__date"><?=$arResult["PROJECT"]["DATE_ACTIVE_TO"]?></span></p>
			<div class="progress">
				<p class="progress__title">процесс</p>
				<div class="progress__empty">
					<div class="progress__fill" style="width: <?=$arResult["PROJECT"]["PROGRESS"]?>%"></div>
					<div class="progress__num"><?=$arResult["PROJECT"]["PROGRESS"]?>%</div>
				</div>
			</div>
			<div class="project-detail__payment">
				<?if($arResult["PROJECT"]["ACTIVE"] == "Y"):?>
					<form class="project-detail__payment-form" action="https://lmi.paymaster.ua/ru/" method="post">
						<input type="hidden" name="purpose" value="project" class="js-purpose">
						<input type="hidden" name="purpose_id" value="<?=$arResult["PROJECT"]["ID"]?>" class="js-purpose-id">
						<p class="project-detail__payment-item">Оплатить недостающую часть проекта</p>
						<div class="btn btn--full js-pay-project-full" data-count="<?=$arResult["PROJECT"]["PAY_SUM"]?>">Оплатить проект</div>
						<p class="project-detail__payment-item">Оплатить часть проекта</p>
						<div class="single-col clearfix">
							<div class="col-xs-2 left-col"><input type="number" class="project-detail__payment-numb js-pay-project-sum"></div>
							<div class="col-xs-2 right-col btn js-pay-project-partly">Оплатить</div>
						</div>
					</form>
				<?endif;?>
				<p class="project-detail__payment-item">Задать вопрос по этому проекту</p>
				<div class="btn btn--full btn--gray modal-open" data-src="question-form" data-load="/ajax/ask_form.php">Задать вопрос</div>
			</div>
		</div>
	</div>
</div>
	<script>
		$(document).ready(function() {
			$(".fancybox").fancybox();
		});
	</script>
<?$APPLICATION->AddHeadScript('/local/js/fancybox/jquery.fancybox.pack.js?v=2.1.5');?>
<?$APPLICATION->AddHeadString('<link rel="stylesheet" href="/local/js/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />',true)?>