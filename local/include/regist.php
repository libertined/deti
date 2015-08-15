<div id="regist" class="modal-wnd modal-wnd--regist clearfix">
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
            <button class="col-xs-4 reg-form__submit">Зарегистрироваться</button>
        </form>
    </div>
    <span class="modal-wnd__close" href="/"></span>
</div>