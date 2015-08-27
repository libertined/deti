<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Кабинет попечителя");
?>
    <div class="wrapper wrapper--fill clearfix">
        <div class="breadcrumbs col-xs-7"><a href="/" class="breadcrumbs__item">главная</a> <span class="breadcrumbs__separator">&frasl;</span> <a href="/cabinet/" class="breadcrumbs__item">Мои дети</a> <span class="breadcrumbs__separator">&frasl;</span> <span class="breadcrumbs__current">Профиль ребенка</span></div>
        <h1 class="page-title page-title--h1 col-xs-9">
            Профиль ребенка
        </h1>
    </div>
    <div class="wrapper wrapper--fill content-block clearfix">
        <div class="col-xs-10 centered-col clearfix">
            <?if(cabinetAccess()):?>
                <?$APPLICATION->IncludeComponent(
                    "dr:child.info",
                    "page",
                    Array(
                        "CABINET_PATH" => "/cabinet/",
                        "ID" => $_REQUEST['id'],
                        "TIME" => "",
                        "EXIST" => "Y"
                    )
                );?>
            <?else:?>

                <p class="error">У вас недостаточно прав для доступа к данной странице.</p>
            <?endif;?>
        </div>
    </div>
<?$APPLICATION->AddHeadScript('/local/js/jquery.form.js');?>
<?$APPLICATION->AddHeadScript('/local/js/child_list.js', true);?>
<?include $_SERVER["DOCUMENT_ROOT"]."/local/include/ask_quest.php";?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>