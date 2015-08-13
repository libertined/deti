<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<section class="payment clearfix">
    <div class="payment__wrapper">
        <p class="payment__title justify-block">Пожертвовать фонду любую сумму</p>
        <p class="payment__desc justify-block">Любая перечисленная сумма будет потрачена на нужды детей</p>
        <input class="payment__count col-xs-3" type="text"/>
        <button class="payment__btn col-xs-3" type="submit" name="pay">Перечислить</button>
        <div class="payment__tools justify-block">
            <img src="local/img/payment_visa.png" alt=""/>
            <img src="local/img/payment_master.png" alt=""/>
            <img src="local/img/payment_maestro.png" alt=""/>
            <img src="local/img/payment_paypal.png" alt=""/>
            <img src="local/img/payment_webmoney.png" alt=""/>
            <img src="local/img/payment_yandex.png" alt=""/>
        </div>
    </div>
</section>
<footer class="footer clearfix">
    <div class="wrapper footer-wrapper clearfix">
        <nav class="bottom-menu">
            <ul class="bottom-menu__list">
                <li class="bottom-menu__item"><a href="">Новости</a></li>
                <li class="bottom-menu__item"><a href="">Информация о фонде</a></li>
                <li class="bottom-menu__item"><a href="">Попечительский совет</a></li>
                <li class="bottom-menu__item"><a href="">Обратная связь</a></li>
                <li class="bottom-menu__item"><a href="">Контакты</a></li>
            </ul>
            <ul class="bottom-menu__list">
                <li class="bottom-menu__item"><a href="">Стать попечителем</a></li>
                <li class="bottom-menu__item"><a href="">Помочь</a></li>
                <li class="bottom-menu__item"><a href="">Отчеты</a></li>
                <li class="bottom-menu__item"><a href="">Вопросы и ответы?</a></li>
            </ul>
            <ul class="bottom-menu__list">
                <li class="bottom-menu__item"><a href="">Наш персонал</a></li>
                <li class="bottom-menu__item"><a href="">Партнеры и попечители</a></li>
            </ul>
        </nav>
        <div class="social col-xs-3">
            <a href="/" class="social__item"><img src="local/img/ico_fb.png" alt=""/></a>
            <a href="/" class="social__item"><img src="local/img/ico_vk.png" alt=""/></a>
        </div>
        <div class="lang-list col-xs-3">
            <div class="pseudo-select">
                <div class="pseudo-select__text">Русский</div>
                <ul class="pseudo-select__list">
                    <li class="pseudo-select__option" data-value="1">Русский</li>
                    <li class="pseudo-select__option" data-value="2">Английский</li>
                </ul>
                <select name="lang" class="pseudo-select__real">
                    <option value="1" selected="selected">Русский</option>
                    <option value="2">Английский</option>
                </select>
            </div>
        </div>
        <div class="design-info col-xs-5">
            <p class="design-info__text col-xs-3">дизайн создан<br>в брендинговом агентстве:</p>
            <p class="design-info__links">
                <a href="http://startbrand.ru" target="_blank"><img src="local/img/starbrand_logo.png" alt=""/></a><br>
                <a href="http://startbrand.ru" class="design-info__site" target="_blank">www.startbrand.ru</a>
            </p>
        </div>
    </div>
</footer>
<div class="to_begin"></div>
<!-- Модальное окно -->
<div id="auth-form" class="modal-wnd modal-wnd--auth clearfix">
    <div class="modal-wnd__content">
        <form action="/" method="POST" class="auth-form">
            <p class="auth-form__title">Вход для зарегистрированных пользователей</p>
            <div class="auth-form__error"></div>
            <div class="col-xs-4 centered-col">
                <input class="auth-form__input" type="email" name="login" placeholder="Логин"/>
                <input class="auth-form__input" type="password" name="password" placeholder="Пароль"/>
                <button class="auth-form__submit">Войти</button>
                <p class="auth-form__link"><a href="/">Зарегистрироваться</a></p>
                <p class="auth-form__link"><a href="/">Забыли пароль?</a></p>
            </div>
        </form>
    </div>
    <span class="modal-wnd__close" href="/"></span>
</div>
<div id="modal" class="modal-wnd modal-wnd--regist clearfix">
    <div class="modal-wnd__content col-xs-10">
        <form action="/" method="POST" class="reg-form">
            <p class="reg-form__title">Регистрация нового пользователя</p>
            <div class="col-xs-5 left-col">
                <label class="reg-form__label" for="form-name">Имя</label>
                <input class="reg-form__input" type="text" name="name" id="form-name"/>
                <label class="reg-form__label" for="form-sname">Отчество (если есть)</label>
                <input class="reg-form__input" type="text" name="sname" id="form-sname"/>
                <label class="reg-form__label" for="form-lname">Фамилия</label>
                <input class="reg-form__input" type="text" name="lname" id="form-lname"/>
                <div class="single-col clearfix">
                    <div class="col-xs-3 left-col">
                        <label class="reg-form__label" for="form-date">Дата рождения</label>
                        <input class="reg-form__input" type="text" name="date" id="form-date" placeholder="дд.мм.гггг"/>
                    </div>
                    <div class="col-xs-2 right-col">
                        <label class="reg-form__label" for="form-sex">Пол</label>
                        <div class="pseudo-select pseudo-select--white">
                            <div class="pseudo-select__text">Мужской</div>
                            <ul class="pseudo-select__list">
                                <li class="pseudo-select__option" data-value="1">Мужской</li>
                                <li class="pseudo-select__option" data-value="2">Женский</li>
                            </ul>
                            <select name="sex" class="pseudo-select__real" id="form-sex">
                                <option value="1" selected="selected">Мужской</option>
                                <option value="2">Женский</option>
                            </select>
                        </div>
                    </div>
                </div>
                <label class="reg-form__label" for="form-citizen">Гражданство</label>
                <div class="pseudo-select pseudo-select--white">
                    <div class="pseudo-select__text">Россия</div>
                    <ul class="pseudo-select__list">
                        <li class="pseudo-select__option" data-value="1">Россия</li>
                        <li class="pseudo-select__option" data-value="2">Украина</li>
                    </ul>
                    <select name="citizen" class="pseudo-select__real" id="form-citizen">
                        <option value="1" selected="selected">Россия</option>
                        <option value="2">Украина</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-5 right-col">
                <label class="reg-form__label" for="form-email">Email-адрес</label>
                <input class="reg-form__input" type="text" name="email" id="form-email"/>
                <label class="reg-form__label" for="form-email_rep">Повторите Email-адрес</label>
                <input class="reg-form__input reg-form__input--correct" type="text" name="email_rep" id="form-email_rep"/>
                <label class="reg-form__label" for="form-pass">Пароль (не менее 8 символов)</label>
                <input class="reg-form__input" type="text" name="pass" id="form-pass"/>
                <label class="reg-form__label" for="form-pass_rep">Повторите пароль</label>
                <input class="reg-form__input reg-form__input--error" type="text" name="pass_rep" id="form-pass_rep"/>
            </div>
            <div class="col-xs-8 reg-form__text">Нажимая кнопку «Зарегистрироваться», я даю своё согласие на обработку моих персональных данных Благотворительному фонду «Мечтатели»</div>
            <button class="col-xs-4 reg-form__submit">Зарегестрироваться</button>
        </form>
    </div>
    <span class="modal-wnd__close" href="/"></span>
</div>
<script type="text/javascript" src="/local/js/script.js"></script>
</body>
</html>