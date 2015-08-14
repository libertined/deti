<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE html>
<html class="<?= LANGUAGE_ID?>">
<head>
	<title><?$APPLICATION->ShowTitle()?></title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<link href="/local/additional/normalize.css" rel="stylesheet">
	<script src="/local/js/jquery-2.1.4.min.js"></script>
	<script src="/local/js/masonry.pkgd.min.js"></script>
	<script src="/local/js/jquery.waitforimages.js"></script>
	<?$APPLICATION->ShowHead();?>
</head>
<body>
<?$APPLICATION->ShowPanel()?>
<div class="pseudo-header"></div>
<header class="header" id="header">
	<div class="wrapper clearfix">
		<div class="header__logo col-xs-2">
			<a class="header__logo-text justify-block" href="/">Фонд &laquo;Мечтатели&raquo;</a>
			<div class="header__logo-img col-xs-2">
				<a href="/"><img src="local/img/logo.png" alt="Мечтатели"/></a>
			</div>
		</div>
		<div class="header__right-side col-xs-9">
			<nav class="top-menu col-xs-6">
				<?$APPLICATION->IncludeComponent("bitrix:menu", "top", array(
					"ROOT_MENU_TYPE" => "top_".LANGUAGE_ID,
					"MAX_LEVEL" => "2",	// Уровень вложенности меню
					"CHILD_MENU_TYPE" => "",	// Тип меню для остальных уровней
					"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
					"DELAY" => "N",	// Откладывать выполнение шаблона меню
					"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
					"MENU_CACHE_TYPE" => "N",	// Тип кеширования
					"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
					"MENU_CACHE_USE_GROUPS" => "N",	// Учитывать права доступа
					"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
					),
					false
				);?>
			</nav>
			<div class="header__info">
				<div class="lang"><a href="<?= $APPLICATION->GetCurPageParam("lang=ru",array("lang"));?>" class="<?=(LANGUAGE_ID == "ru")?"active":"";?>">рус</a>/<a href="<?=$APPLICATION->GetCurPageParam("lang=en",array("lang"));?>" class="<?=(LANGUAGE_ID == "en")?"active":"";?>">eng</a></div>
				<div class="auth"><a href="/auth.php" class="modal-open" data-src="auth-form">Вход</a></div>
			</div>
		</div>
	</div>
</header>