<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/projects/([0-9a-zA-Z-_]+)/.*\$#",
		"RULE" => "PROJECT=\$1",
		"ID" => "",
		"PATH" => "/projects/detail.php",
	),
	array(
		"CONDITION" => "#^/content/gallery/#",
		"RULE" => "",
		"ID" => "bitrix:photogallery_user",
		"PATH" => "/content/gallery/index.php",
	),
	array(
		"CONDITION" => "#^/content/photo/#",
		"RULE" => "",
		"ID" => "bitrix:photogallery",
		"PATH" => "/content/photo/index.php",
	),
	array(
		"CONDITION" => "#^/content/news/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/content/news/index.php",
	),
);

?>