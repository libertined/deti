<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Главная страница");
?>
<?$APPLICATION->IncludeComponent(
	"dr:project.list",
	"",
	Array(
		"IBLOCK_ID" => IBLOCK_GEBNERAL_PROJ,
		"COUNT" => 4,
		"PAGE" => 1,
		"ACTIVE" => $_REQUEST["active"],
	)
);?>
<?$APPLICATION->AddHeadScript('/local/js/proj_load.js', true);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>