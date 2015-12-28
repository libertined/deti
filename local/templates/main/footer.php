<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<section class="payment clearfix" id="payment-anch">
    <div class="payment__wrapper">
        <p class="payment__title justify-block">Пожертвовать фонду любую сумму</p>
        <p class="payment__desc justify-block">Любая перечисленная сумма будет потрачена на нужды детей</p>
        <input class="payment__count col-xs-3" type="text"/>
        <button class="payment__btn col-xs-3" type="submit" name="pay">Перечислить</button>
        <div class="payment__tools justify-block">
            <img src="/local/img/payment_visa.png" alt=""/>
            <img src="/local/img/payment_master.png" alt=""/>
            <img src="/local/img/payment_maestro.png" alt=""/>
            <img src="/local/img/payment_paypal.png" alt=""/>
            <img src="/local/img/payment_webmoney.png" alt=""/>
            <img src="/local/img/payment_yandex.png" alt=""/>
        </div>
    </div>
</section>
<footer class="footer clearfix">
    <div class="wrapper footer-wrapper clearfix">
        <nav class="bottom-menu">
            <ul class="bottom-menu__list">
                <li class="bottom-menu__item"><a href="/news/">Новости</a></li>
                <li class="bottom-menu__item"><a href="/about/">Информация о фонде</a></li>
                <li class="bottom-menu__item"><a href="/trustee/">Попечительский совет</a></li>
                <li class="bottom-menu__item"><a href="/contact/">Контакты</a></li>
            </ul>
            <ul class="bottom-menu__list">
                <li class="bottom-menu__item"><a href="/curator/">Стать попечителем</a></li>
                <li class="bottom-menu__item"><a href="/reports/">Отчеты</a></li>
                <li class="bottom-menu__item"><a href="/faq/">Вопросы и ответы?</a></li>
            </ul>
            <ul class="bottom-menu__list">
                <li class="bottom-menu__item"><a href="/staff/">Наш персонал</a></li>
                <li class="bottom-menu__item"><a href="/partners/">Партнеры и попечители</a></li>
            </ul>
        </nav>
        <div class="social col-xs-3">
            <a href="/" class="social__item"><img src="/local/img/ico_fb.png" alt=""/></a>
            <a href="/" class="social__item"><img src="/local/img/ico_vk.png" alt=""/></a>
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
                <a href="http://startbrand.ru" target="_blank"><img src="/local/img/starbrand_logo.png" alt=""/></a><br>
                <a href="http://startbrand.ru" class="design-info__site" target="_blank">www.startbrand.ru</a>
            </p>
            <p class="design-info__text col-xs-3">веб-сайт разработан<br>в студии АЕ!:</p>
            <p class="design-info__links">
                <a href="http://ae-studio.ru" class="design-info__site" target="_blank">www.ae-studio.ru</a>
            </p>
        </div>
    </div>
</footer>
<div class="to_begin"></div>
<?include $_SERVER["DOCUMENT_ROOT"]."/local/include/auth.php";?>
<script type="text/javascript" src="/local/js/script.js"></script>
</body>
</html>