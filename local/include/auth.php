<div id="auth-form" class="modal-wnd modal-wnd--auth clearfix">
    <div class="modal-wnd__content">
        <form action="/" method="POST" class="auth-form">
            <p class="auth-form__title">Вход для зарегистрированных пользователей</p>
            <div class="auth-form__error"></div>
            <div class="col-xs-4 centered-col">
                <input class="auth-form__input" type="email" name="login" placeholder="Логин (Email)"/>
                <input class="auth-form__input" type="password" name="password" placeholder="Пароль"/>
                <button class="auth-form__submit">Войти</button>
                <p class="auth-form__link"><a href="/">Зарегистрироваться</a></p>
                <p class="auth-form__link"><a href="/">Забыли пароль?</a></p>
            </div>
        </form>
    </div>
    <span class="modal-wnd__close" href="/"></span>
</div>