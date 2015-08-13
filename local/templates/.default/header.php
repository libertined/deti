<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE html>
<html>
<head>
	<title><?$APPLICATION->ShowTitle()?></title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<link href="/local/additional/normalize.css" rel="stylesheet">
	<?$APPLICATION->ShowHead();?>
	<script src="/local/js/jquery-2.1.4.min.js"></script>
</head>
<body>
<?$APPLICATION->ShowPanel()?>
<div class="pseudo-header"></div>
<header class="header" id="header">
	<div class="wrapper clearfix">
		<div class="header__logo col-xs-2">
			<a class="header__logo-text justify-block" href="/">Фонд &laquo;Мечтатели&raquo;</a>
			<div class="header__logo-img col-xs-2">
				<a href="/"><img src="img/logo.png" alt="Мечтатели"/></a>
			</div>
		</div>
		<div class="header__right-side col-xs-9">
			<nav class="top-menu col-xs-6">
				<ul class="top-menu__list clearfix justify-block">
					<li class="top-menu__item"><a href="">О фонде</a></li>
					<li class="top-menu__item"><a href="">Помочь</a></li>
					<li class="top-menu__item"><a href="">Посмотреть</a></li>
					<li class="top-menu__item"><a href="">Связаться</a></li>
					<li class="top-menu__item"><a href="">Наши друзья</a></li>
				</ul>
			</nav>
			<div class="header__info">
				<div class="lang"><a href="?lang=ru" class="active">рус</a>/<a href="?lang=en" class="modal-open" data-src="modal">eng</a></div>
				<div class="auth"><a href="/auth.php" class="modal-open" data-src="auth-form">Вход</a></div>
			</div>
		</div>
	</div>
</header>