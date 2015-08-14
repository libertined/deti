<div id="question-form" class="modal-wnd modal-wnd--wide clearfix">
    <div class="modal-wnd__content modal-wnd__content--padd15">
        <form action="/" method="POST" class="simple-form">
            <p class="simple-form__title">Задать вопрос</p>
            <p class="simple-form__text">Если у вас возник вопрос относительно размещенных проектов или по работе системы, напишите нам через форму представленную ниже. Мы в ближайшее время свяжемся с вами.</p>
            <label class="simple-form__label" for="form-subject">Выберете тему вопроса:</label>
            <div class="pseudo-select pseudo-select--white">
                <div class="pseudo-select__text">Сообщение по описанию проекта</div>
                <ul class="pseudo-select__list">
                    <li class="pseudo-select__option" data-value="1">Сообщение по описанию проекта</li>
                    <li class="pseudo-select__option" data-value="2">Сообщение по оплате проекта</li>
                </ul>
                <select name="subject" class="pseudo-select__real" id="form-subject">
                    <option value="1" selected="selected">Сообщение по описанию проекта</option>
                    <option value="2">Сообщение по оплате проекта</option>
                </select>
            </div>
            <textarea name="message" class="simple-form__textarea" placeholder="Текст сообщения"></textarea>
            <div class="col-xs-4 simple-form__submit-block">
                <button class="btn btn--full" type="submit" name="submit">Отправить</button>
            </div>
        </form>
    </div>
    <span class="modal-wnd__close" href="/"></span>
</div>