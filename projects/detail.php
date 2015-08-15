<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Проект");
?>
<?$APPLICATION->IncludeComponent(
	"dr:project.detail",
	"",
	Array(
		"IBLOCK_ID" => IBLOCK_GEBNERAL_PROJ,
		"ID" => $_REQUEST["PROJECT"]
	)
);?>
<?$APPLICATION->AddHeadScript('/local/js/jquery.form.js');?>
<?include $_SERVER["DOCUMENT_ROOT"]."/local/include/ask_quest.php";?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>