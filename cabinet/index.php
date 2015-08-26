<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Кабинет попечителя");
?>
    <div class="wrapper wrapper--fill clearfix">
        <div class="breadcrumbs col-xs-7"><a href="/" class="breadcrumbs__item">главная</a> <span class="breadcrumbs__separator">&frasl;</span> <span class="breadcrumbs__current">ЛК список проектов детей</span></div>
        <h1 class="page-title page-title--h1 col-xs-9">
            Личный кабинет попечителя
        </h1>
    </div>
    <div class="wrapper wrapper--fill content-block clearfix">
        <div class="col-xs-10 centered-col clearfix">
        <?if(cabinetAccess()):?>
            <div class="kids-list col-xs-6 left-col">
                <?$APPLICATION->IncludeComponent(
                    "dr:child.project.list",
                    "",
                    Array(
                        "IBLOCK_ID" => IBLOCK_CHILDS,
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
                <div class="curator__filter">
                    <p class="curator__link curator__link--filter active js-kid-proj-filter" data-value="all">Показать все проекты</p>
                    <p class="curator__link curator__link--filter js-kid-proj-filter" data-value="active">Показать только активные проекты</p>
                    <p class="curator__link curator__link--filter js-kid-proj-filter" data-value="ready">Показать реализованные проекты</p>
                    <p class="curator__link curator__link--filter js-kid-proj-filter" data-value="fin">Показать просроченные проекты</p>
                </div>
                <div class="btn btn--full btn--small-text js-kid-pay-proj" data-value="all">Оплатить все текущие проекты этого ребенка</div>
                <div class="btn btn--full marg10-10 js-kid-pay-proj" data-value="choose">Оплатить выбранные проекты</div>
                <p class="hide-block modal-open js-kid-pay-proj-link" data-src="simple-wnd"></p>
            </div>
        <?else:?>

            <p class="error">У вас недостаточно прав для доступа к данной странице.</p>
        <?endif;?>
        </div>
    </div>
<?$APPLICATION->AddHeadScript('/local/js/jquery.form.js');?>
<?include $_SERVER["DOCUMENT_ROOT"]."/local/include/ask_quest.php";?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>