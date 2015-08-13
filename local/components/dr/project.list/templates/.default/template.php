<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<?if($arResult["PAGE"] == 1):?>
<div class="wrapper">
	<div class="page-title col-xs-9">
		<ul class="page-title__list">
			<li class="page-title__item <?if($arResult["ACTIVE"] == ""):?>active<?endif;?>" data-active=""><a href="<?=$APPLICATION->GetCurPageParam("",array("active"));
				?>">все</a></li>
			<li class="page-title__item <?if($arResult["ACTIVE"] == "Y"):?>active<?endif;?>" data-active="y"><a href="<?=$APPLICATION->GetCurPageParam("active=y",array("active"));
				?>">актуальные</a></li>
			<li class="page-title__item <?if($arResult["ACTIVE"] == "N"):?>active<?endif;?>" data-active="n"><a href="<?=$APPLICATION->GetCurPageParam("active=n",array("active"));
				?>">завершенные</a></li>
		</ul>
	</div>
</div>
<div class="wrapper content-block">
	<div class="project-list clearfix" id="catalog_area">
<?endif;?>
<?if($arResult["ALL_COUNT"] > 0):?>
	<?foreach($arResult["ITEMS"] as $project):?>
		<div class="project-list__item">
			<?if($project["ACTIVE"] == "Y"):?>
				<a class="project-list__img" href="<?=$project["URL"]?>">
					<img src="<?=$project["IMG_PATH"]?>" alt=""/>
				</a>
			<?else:?>
				<a class="project-list__img project-list__img--finish" href="<?=$project["URL"]?>">
					<img src="<?=$project["IMG_PATH"]?>" alt=""/>
					<p class="project-list__item-finish-text">проект<br>завершен,<br>спасибо всем кто<br>прирнял участие</p>
				</a>
			<?endif;?>
			<a class="project-list__item-title" href="<?=$project["URL"]?>"><?=$project["NAME"]?></a>
			<p class="project-list__item-desc"><?=$project["PREVIEW_TEXT"]?></p>
			<a class="project-list__item-link" href="<?=$project["URL"]?>">посмотреть проект</a>
		</div>
	<?endforeach;?>
<?endif;?>
<div class="project-list__more <?if(!$arResult['IS_MORE']):?>project-list__more--hide<?endif;?>" id="btn_see_more"
	 data-page="<?=$arResult['PAGE']+1?>">
	<span></span><span></span><span></span>
</div>
<?if($arResult["PAGE"] == 1):?>
	<?if($arResult["ALL_COUNT"] == 0):?>
		<p>Сейчас нет активных проектов</p>
	<?endif;?>
	</div>
</div>
<?endif;?>
