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
                <h2 class="kids-list__title">Ваши дети</h2>
                <div class="kids-list__list-icon clearfix">
                    <div class="kid-icon kid-icon--girl active js-choose-kid" style="width: 33%" data-kid="1">
                        <div class="kid-icon__img centered-col"></div>
                        <span class="kid-icon__text">Вероника</span>
                    </div>
                    <div class="kid-icon kid-icon--boy js-choose-kid" style="width: 33%" data-kid="2">
                        <div class="kid-icon__img centered-col"></div>
                        <span class="kid-icon__text">Илья</span>
                    </div>
                    <div class="kid-icon" style="width: 33%">
                        <a class="kid-icon__img centered-col"></a>
                        <a class="kid-icon__text">Выбрать</a>
                    </div>
                </div>
                <div class="kids-list__item-block active js-kid-tab" id="kid1">
                    <div class="kids-list__item clearfix" id="10">
                        <div class="col-xs-4 left-col">
                            <p class="kids-list__item-title">Кроссовки для занятия бегом Nike Air</p>
                            <p class="kids-list__item-text">Маша стала серьезно относиться к спорту и дисциплине, у нее появился график и она каждое утро стала совершать пробежки. Также, Маша записалась на участие в кроссе. Для предупреждения спортивных травм ей необходима удобна обувь.</p>
                        </div>
                        <div class="kids-list__item-payment col-xs-2 right-col">
                            <p class="kids-list__item-price">2200 грн.</p>
                            <p class="btn btn--full kids-list__item-pay js-kid-pay">Оплатить</p>
                            <p class="kids-list__item-date">
                                Актуально до:<br>
                                10 августа 2015 года
                            </p>
                            <a class="kids-list__item-decline" href="">отказаться</a>
                        </div>
                    </div>
                    <div class="kids-list__item kids-list__item--fin clearfix" id="11">
                        <div class="col-xs-4 left-col">
                            <p class="kids-list__item-title">Кроссовки для занятия бегом Nike Air</p>
                            <p class="kids-list__item-text">Маша стала серьезно относиться к спорту и дисциплине, у нее появился график и она каждое утро стала совершать пробежки. Также, Маша записалась на участие в кроссе. Для предупреждения спортивных травм ей необходима удобна обувь.</p>
                        </div>
                        <div class="kids-list__item-payment col-xs-2 right-col">
                            <p class="kids-list__item-price">2200 грн.</p>
                            <p class="btn btn--full kids-list__item-pay kids-list__item-pay--payed">Оплачено</p>
                            <p class="kids-list__item-date">
                                Оплачено:<br>
                                10 августа 2015 года
                            </p>
                        </div>
                    </div>
                    <div class="kids-list__item kids-list__item--fin clearfix" id="12">
                        <div class="col-xs-4 left-col">
                            <p class="kids-list__item-title">3 занятия с тренером по бегу</p>
                            <p class="kids-list__item-text">Для постановки техники бега, Маше необходимо провести несколько тренировок с тренером.</p>
                        </div>
                        <div class="kids-list__item-payment col-xs-2 right-col">
                            <p class="kids-list__item-price">2200 грн.</p>
                            <p class="btn btn--full kids-list__item-pay kids-list__item-pay--fin">Просрочено</p>
                            <p class="kids-list__item-date">
                                Актуально до:<br>
                                10 августа 2015 года
                            </p>
                        </div>
                    </div>
                    <div class="kids-list__item clearfix" id="17">
                        <div class="col-xs-4 left-col">
                            <p class="kids-list__item-title">Кроссовки для занятия бегом Nike Air</p>
                            <p class="kids-list__item-text">Маша стала серьезно относиться к спорту и дисциплине, у нее появился график и она каждое утро стала совершать пробежки. Также, Маша записалась на участие в кроссе. Для предупреждения спортивных травм ей необходима удобна обувь.</p>
                        </div>
                        <div class="kids-list__item-payment col-xs-2 right-col">
                            <p class="kids-list__item-price">2200 грн.</p>
                            <p class="btn btn--full kids-list__item-pay js-kid-pay">Оплатить</p>
                            <p class="kids-list__item-date">
                                Актуально до:<br>
                                10 августа 2015 года
                            </p>
                            <a class="kids-list__item-decline" href="">отказаться</a>
                        </div>
                    </div>
                </div>
                <div class="kids-list__item-block js-kid-tab" id="kid2">
                    <div class="kids-list__item kids-list__item--fin clearfix" id="13">
                        <div class="col-xs-4 left-col">
                            <p class="kids-list__item-title">3 занятия с тренером по бегу</p>
                            <p class="kids-list__item-text">Для постановки техники бега, Маше необходимо провести несколько тренировок с тренером.</p>
                        </div>
                        <div class="kids-list__item-payment col-xs-2 right-col">
                            <p class="kids-list__item-price">2200 грн.</p>
                            <p class="btn btn--full kids-list__item-pay kids-list__item-pay--fin">Просрочено</p>
                            <p class="kids-list__item-date">
                                Актуально до:<br>
                                10 августа 2015 года
                            </p>
                        </div>
                    </div>
                    <div class="kids-list__item kids-list__item--fin clearfix" id="14">
                        <div class="col-xs-4 left-col">
                            <p class="kids-list__item-title">Кроссовки для занятия бегом Nike Air</p>
                            <p class="kids-list__item-text">Маша стала серьезно относиться к спорту и дисциплине, у нее появился график и она каждое утро стала совершать пробежки. Также, Маша записалась на участие в кроссе. Для предупреждения спортивных травм ей необходима удобна обувь.</p>
                        </div>
                        <div class="kids-list__item-payment col-xs-2 right-col">
                            <p class="kids-list__item-price">2200 грн.</p>
                            <p class="btn btn--full kids-list__item-pay kids-list__item-pay--payed">Оплачено</p>
                            <p class="kids-list__item-date">
                                Оплачено:<br>
                                10 августа 2015 года
                            </p>
                        </div>
                    </div>
                    <div class="kids-list__item clearfix" id="15">
                        <div class="col-xs-4 left-col">
                            <p class="kids-list__item-title">Кроссовки для занятия бегом Nike Air</p>
                            <p class="kids-list__item-text">Маша стала серьезно относиться к спорту и дисциплине, у нее появился график и она каждое утро стала совершать пробежки. Также, Маша записалась на участие в кроссе. Для предупреждения спортивных травм ей необходима удобна обувь.</p>
                        </div>
                        <div class="kids-list__item-payment col-xs-2 right-col">
                            <p class="kids-list__item-price">2200 грн.</p>
                            <p class="btn btn--full kids-list__item-pay js-kid-pay">Оплатить</p>
                            <p class="kids-list__item-date">
                                Актуально до:<br>
                                10 августа 2015 года
                            </p>
                            <a class="kids-list__item-decline" href="">отказаться</a>
                        </div>
                    </div>
                </div>
                <div class="kids-list__more">показать еще</div>
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
                    <p class="curator__link curator__link--filter active">Показать все проекты</p>
                    <p class="curator__link curator__link--filter">Показать только активные проекты</p>
                    <p class="curator__link curator__link--filter">Показать реализованные проекты</p>
                    <p class="curator__link curator__link--filter">Показать просроченные проекты</p>
                </div>
                <div class="btn btn--full btn--small-text">Оплатить все текущие проекты этого ребенка</div>
                <div class="btn btn--full marg10-10">Оплатить выбранные проекты</div>
            </div>
        <?else:?>

            <p class="error">У вас недостаточно прав для доступа к данной странице.</p>
        <?endif;?>
        </div>
    </div>
<?$APPLICATION->AddHeadScript('/local/js/jquery.form.js');?>
<?include $_SERVER["DOCUMENT_ROOT"]."/local/include/ask_quest.php";?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>