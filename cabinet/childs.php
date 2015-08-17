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
            <div class="kids-list col-xs-6 left-col">
                <h2 class="kids-list__title">Дети без попечителей</h2>
                <div class="kids-list__filter justify-block">
                    <span class="kids-list__filter-item active js-kl-sex">Все</span>
                    <span class="kids-list__filter-item js-kl-sex">Мальчики</span>
                    <span class="kids-list__filter-item js-kl-sex">Девочки</span>
                    <span class="kids-list__filter-item js-kl-age">3-6 лет</span>
                    <span class="kids-list__filter-item js-kl-age">7-10 лет</span>
                    <span class="kids-list__filter-item js-kl-age">11-18 лет</span>
                    <span class="kids-list__filter-item active js-kl-age">Любой возраст</span>
                </div>
                <div class="kids-list__list-icon clearfix">
                    <div class="kid-icon kid-icon--girl js-kid-info" style="width: 25%" data-kid="1">
                        <div class="kid-icon__img centered-col"></div>
                        <span class="kid-icon__text">Вероника</span>
                        <span class="kid-icon__age">9 лет</span>
                    </div>
                    <div class="kid-icon kid-icon--girl js-kid-info" style="width: 25%" data-kid="1">
                        <div class="kid-icon__img centered-col"></div>
                        <span class="kid-icon__text">Вероника</span>
                        <span class="kid-icon__age">3 года</span>
                    </div>
                    <div class="kid-icon kid-icon--boy js-kid-info" style="width: 25%" data-kid="2">
                        <div class="kid-icon__img centered-col"></div>
                        <span class="kid-icon__text">Рустам</span>
                        <span class="kid-icon__age">3 года</span>
                    </div>
                    <div class="kid-icon kid-icon--boy js-kid-info" style="width: 25%" data-kid="2">
                        <div class="kid-icon__img centered-col"></div>
                        <span class="kid-icon__text">Коля</span>
                        <span class="kid-icon__age">11 лет</span>
                    </div>
                    <div class="kid-icon kid-icon--girl js-kid-info" style="width: 25%" data-kid="1">
                        <div class="kid-icon__img centered-col"></div>
                        <span class="kid-icon__text">Вероника</span>
                        <span class="kid-icon__age">10 лет</span>
                    </div>
                    <div class="kid-icon kid-icon--boy js-kid-info" style="width: 25%" data-kid="2">
                        <div class="kid-icon__img centered-col"></div>
                        <span class="kid-icon__text">Миша</span>
                        <span class="kid-icon__age">15 лет</span>
                    </div>
                    <div class="kid-icon kid-icon--girl js-kid-info" style="width: 25%" data-kid="1">
                        <div class="kid-icon__img centered-col"></div>
                        <span class="kid-icon__text">Вероника</span>
                        <span class="kid-icon__age">13 лет</span>
                    </div>
                    <div class="kid-icon kid-icon--boy js-kid-info" style="width: 25%" data-kid="2">
                        <div class="kid-icon__img centered-col"></div>
                        <span class="kid-icon__text">Сережа</span>
                        <span class="kid-icon__age">10 лет</span>
                    </div>
                    <p class="kid-icon__pseudo_link modal-open js-kid-info-link" data-src="choose-kid"></p>
                </div>
                <div class="kids-list__more">показать еще</div>
            </div>
            <div class="curator right-col col-xs-4">
                <div class="curator__ava avatar centered-col"></div>
                <p class="curator__name">Вероника Игоревна Шатальская</p>
                <p class="curator__link modal-open" data-src="edit-profile">Редактировать профиль</p>
                <p class="curator__link"><a href="/">Правила и условия попечительства</a></p>
                <p class="curator__status">Статус: Попечитель. Дети: 2</p>
                <div class="separator"></div>
                <div class="btn btn--full btn--gray modal-open" data-src="question-form">Задать вопрос</div>
                <p class="curator__link marg10-10"><a href="/">Перейти к Мои дети</a></p>
            </div>
        </div>
    </div>
<?//$APPLICATION->AddHeadScript('/local/js/jquery.form.js');?>
<?//include $_SERVER["DOCUMENT_ROOT"]."/local/include/regist.php";?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>