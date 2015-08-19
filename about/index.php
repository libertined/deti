<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("О фонде Мечтатели");
?>
    <div class="wrapper wrapper--fill clearfix">
        <div class="breadcrumbs col-xs-7"><a href="/" class="breadcrumbs__item">главная</a> <span class="breadcrumbs__separator">&frasl;</span> <span class="breadcrumbs__current">О фонде &laquo;Мечтатели&raquo;</span></div>
        <h1 class="page-title page-title--h1 col-xs-9">
            О фонде &laquo;Мечтатели&raquo;
        </h1>
    </div>
    <div class="wrapper wrapper--fill content-block clearfix">
        <div class="col-xs-10 centered-col clearfix about-page">
            <div class="content-block__img-title"><img src="/images/curator_page.jpg" alt=""/></div>
            <div class="col-xs-6 left-col content-block__text">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <h2>Lorem ipsum</h2>
                <p>dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <h2>Lorem ipsum</h2>
                <p>dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <h2>Lorem ipsum</h2>
                <p>dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
            <div class="right-col col-xs-4">
                <div class="about-page__img clearfix">
                    <img src="/images/about1.jpg" alt="" class="about-page__img-item"/>
                    <img src="/images/about1.jpg" alt="" class="about-page__img-item about-page__img-item--right"/>
                    <img src="/images/about2.jpg" alt="" class="about-page__img-item about-page__img-item--small"/>
                    <img src="/images/about2.jpg" alt="" class="about-page__img-item about-page__img-item--small about-page__img-item--marg-left"/>
                    <img src="/images/about2.jpg" alt="" class="about-page__img-item about-page__img-item--small about-page__img-item--right"/>
                </div>
                <p class="about-page__sect-titile">Местонахождение:</p>
                <div class="about-page__section">
                    Украина, Одесская область,<br>
                    г. Белгород-Днестровский,<br>
                    ул. Саночная, 14А и<br>
                    ул. Победы, 9<br>
                    телефон: +38 (04849) 2 70 50<br>
                    факс: +38 (04849) 3 62 96
                </div>
                <div class="separator"></div>
                <div class="btn btn--full btn--gray modal-open" data-src="question-form" data-load="/ajax/ask_open_form.php">Задать вопрос</div>
                <p class="separator"></p>
                <p class="about-page__sect-titile">Официальные документы:</p>
                <a class="about-page__link" href="/images/about1.jpg" target="_blank">Свидетельство о регистрации некоммерчесской благотворительной организации.</a>
                <a class="about-page__link" href="/images/about1.jpg" target="_blank">Попечительский совет (протокол)</a>

            </div>
        </div>
    </div>
<?$APPLICATION->AddHeadScript('/local/js/jquery.form.js');?>
<?include $_SERVER["DOCUMENT_ROOT"]."/local/include/ask_quest.php";?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>