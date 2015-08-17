<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<form action="/" method="POST" class="auth-form">
	<p class="auth-form__title">Вход для зарегистрированных пользователей</p>
	<div class="auth-form__error"><?=implode("<br>", $arResult["ERRORS"])?></div>
	<div class="col-xs-4 centered-col">
		<input class="auth-form__input" type="email" name="login" placeholder="Логин (Email)"/>
		<input class="auth-form__input" type="password" name="password" placeholder="Пароль"/>
		<button class="auth-form__submit" type="submit">Войти</button>
		<p class="auth-form__link"><a href="/curator/">Зарегистрироваться</a></p>
		<p class="auth-form__link"><a href="/">Забыли пароль?</a></p>
	</div>
	<script>
		$(document).ready( function(){
			$("#auth-form form").ajaxForm(
				{
					type: 'POST',
					url: "/ajax/reg_form.php",
					//dataType: 'json',
					success: function(data){
						$("#auth-form .modal-wnd__content").html(data);

					}
				}
			);
			if(void 0 !== $("#auth-form .error")){
				var popMargTop = ($('#auth-form').height() + 40) / 2;
				//Устанавливаем величину отступа
				$('#auth-form').css({
					'margin-top' : -popMargTop
				});
			}
		});
	</script>
</form>
