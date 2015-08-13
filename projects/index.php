<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Проекты");
?>

<?$APPLICATION->IncludeComponent(
	"dr:project.list",
	"",
	Array(
		"IBLOCK_ID" => IBLOCK_GEBNERAL_PROJ,
		"COUNT" => 9
	)
);?>
	
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>