<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<section class="payment clearfix" id="payment-anch">
    <form class="payment__wrapper" action="https://lmi.paymaster.ua/ru/" method="post">
        <p class="payment__title justify-block">Пожертвовать фонду любую сумму</p>
        <p class="payment__desc justify-block">Любая перечисленная сумма будет потрачена на нужды детей</p>
        <input class="payment__count col-xs-3 js-pay-sum" type="text" name="pay_sum" />
        <button class="payment__btn col-xs-3 js-pay_submit" type="button" name="pay">Перечислить</button>
        <div class="payment__tools justify-block">
            <img src="/local/img/payment_visa.png" alt=""/>
            <img src="/local/img/payment_master.png" alt=""/>
            <img src="/local/img/payment_privat24.png" alt=""/>
            <img src="/local/img/payment_webmoney.png" alt=""/>
            <img src="/local/img/payment_monexy.png" alt=""/>
        </div>
    </form>
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
                <div class="pseudo-select__text"><?if(LANGUAGE_ID == "en"):?>Английский<?else:?>Русский<?endif;?></div>
                <ul class="pseudo-select__list">
                    <li class="pseudo-select__option" data-value="<?= $APPLICATION->GetCurPageParam("lang=ru",array("lang"));?>">Русский</li>
                    <li class="pseudo-select__option" data-value="<?= $APPLICATION->GetCurPageParam("lang=en",array("lang"));?>">Английский</li>
                </ul>
                <select name="lang" class="pseudo-select__real">
                    <option value="<?= $APPLICATION->GetCurPageParam("lang=ru",array("lang"));?>" <?if(LANGUAGE_ID == "ru"):?>selected="selected"<?endif;?> selected="selected">Русский</option>
                    <option value="<?= $APPLICATION->GetCurPageParam("lang=en",array("lang"));?>" <?if(LANGUAGE_ID == "en"):?>selected="selected"<?endif;?>>Английский</option>
                </select>
            </div>
        </div>
        <div class="design-info col-xs-5">
            <p class="design-info__text col-xs-3">дизайн создан<br>в брендинговом агентстве:</p>
            <p class="design-info__links">
                <a href="http://startbrand.ru" target="_blank"><img src="/local/img/starbrand_logo.png" alt=""/></a><br>
                <a href="http://startbrand.ru" class="design-info__site" target="_blank">www.startbrand.ru</a>
            </p>
        </div>
    </div>
</footer>
<div class="to_begin"></div>
<?if(!$USER->IsAuthorized()):?>
    <?include $_SERVER["DOCUMENT_ROOT"]."/local/include/auth.php";?>
<?endif;?>
<script type="text/javascript" src="/local/js/script.js"></script>
</body>
</html>