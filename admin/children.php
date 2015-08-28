<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Кабинет администратора");
?>
    <div class="wrapper wrapper--fill clearfix">
        <div class="breadcrumbs col-xs-7"><a href="/" class="breadcrumbs__item">главная</a> <span class="breadcrumbs__separator">&frasl;</span> <a href="/admin/" class="breadcrumbs__item">Кабинет администратора</a> <span class="breadcrumbs__separator">&frasl;</span> <span class="breadcrumbs__current">Дети без попечителя</span></div>
        <h1 class="page-title page-title--h1 col-xs-9">
            Дети без попечителя
        </h1>
    </div>
    <div class="wrapper wrapper--fill content-block clearfix">
        <div class="col-xs-10 centered-col clearfix">
        <?if(cabinetAdminAccess()):?>
            <?$APPLICATION->IncludeComponent(
                "dr:child.list",
                "admin",
                Array(
                    "IBLOCK_ID" => IBLOCK_CHILDS,
                    "COUNT" => 100,
                    "USER" => "",
                    "EMPTY" => "Y"
                )
            );?>
        <?else:?>

            <p class="error">У вас недостаточно прав для доступа к данной странице.</p>
        <?endif;?>
        </div>
    </div>
<?$APPLICATION->AddHeadScript('/local/js/admin-page.js');?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
