<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Контакты");
?>
    <div class="wrapper wrapper--fill clearfix">
        <div class="breadcrumbs col-xs-7"><a href="/" class="breadcrumbs__item">главная</a> <span class="breadcrumbs__separator">⁄</span> <span class="breadcrumbs__current">Контакты</span></div>
        <h1 class="page-title page-title--h1 col-xs-9">
            Контакты
        </h1>
    </div>
    <div class="wrapper wrapper--fill content-block clearfix">
        <div class="col-xs-10 centered-col clearfix about-page">
            <div class="content-block__img-title">
                <iframe src="https://www.google.com/maps/d/u/0/embed?mid=zkLLq1bJ-4ZI.kxNpvmqoEfF0" width="780" height="300"></iframe>
            </div>
            <div class="col-xs-3 left">
                <p class="content-block__sect-title">Местонахождение:</p>
                <div class="content-block__text">
                    Украина, Одесская область,<br>
                    г. Белгород-Днестровский,<br>
                    ул. Солнечная, 14А и<br>
                    ул. Победы, 9
                </div>
            </div>
            <div class="col-xs-3">
                <p class="content-block__sect-title">Телефоны:</p>
                <div class="content-block__text">
                    +38 (04849) 2 70 50<br>
                    +38 (04849) 3 62 96
                </div>
            </div>
            <div class="col-xs-3">
                <p class="content-block__sect-title">Контактные лица:</p>
                <div class="content-block__text">
                    Глава попечительского совета<br>
                    Иван Иванов<br>
                    телефон<br>
                    email<br><br>
                    Должность сотрудника<br>
                    Иван Иванов<br>
                    телефон<br>
                    email
                </div>
            </div>
        </div>
        <div class="col-xs-4 centered-col clearfix content-block">
            <div class="btn btn--full modal-open" data-src="question-form" data-load="/ajax/ask_open_form.php">Обратная связь</div>
        </div>
    </div>
<?$APPLICATION->AddHeadScript('/local/js/jquery.form.js');?>
<?include $_SERVER["DOCUMENT_ROOT"]."/local/include/ask_quest.php";?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>