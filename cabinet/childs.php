<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Кабинет попечителя");
?>
    <div class="wrapper wrapper--fill clearfix">
        <div class="breadcrumbs col-xs-7"><a href="/" class="breadcrumbs__item">главная</a> <span class="breadcrumbs__separator">&frasl;</span> <span class="breadcrumbs__current">Добавить ребенка</span></div>
        <h1 class="page-title page-title--h1 col-xs-9">
            Добавить ребенка
        </h1>
    </div>
    <div class="wrapper wrapper--fill content-block clearfix">
        <div class="col-xs-10 centered-col clearfix">
            <?if(cabinetAccess()):?>
            <div class="kids-list col-xs-6 left-col">
                <?$APPLICATION->IncludeComponent(
                    "dr:child.list",
                    "",
                    Array(
                        "IBLOCK_ID" => IBLOCK_CHILDS,
                        "COUNT" => 8,
                        "USER" => ""
                    )
                );?>
            </div>
            <div class="curator right-col col-xs-4">
                <?$APPLICATION->IncludeComponent(
                    "dr:curator.info",
                    "",
                    Array(
                        "CABINET_PATH" => "/cabinet/",
                        "AUTH_PAGE" => AUTH_PAGE
                    )
                );?>
                <div class="separator"></div>
                <div class="btn btn--full btn--gray modal-open" data-src="question-form" data-load="/ajax/ask_form.php">Задать вопрос</div>
                <p class="curator__link marg10-10"><a href="/cabinet/">Перейти к Мои дети</a></p>
            </div>
            <?else:?>

                <p class="error">У вас недостаточно прав для доступа к данной странице.</p>
            <?endif;?>
        </div>
    </div>
<?$APPLICATION->AddHeadScript('/local/js/jquery.form.js');?>
<?$APPLICATION->AddHeadScript('/local/js/child_list.js', true);?>
<?include $_SERVER["DOCUMENT_ROOT"]."/local/include/choose_kid.php";?>
<?include $_SERVER["DOCUMENT_ROOT"]."/local/include/ask_quest.php";?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>