<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<form action="" method="POST" class="reg-form">
	<p class="reg-form__title">Регистрация нового пользователя</p>
	<?if(!empty($arResult["ERRORS"])):?>
		<p class="error"><?=implode("<br>", $arResult["ERRORS"])?></p>
	<?endif;?>
	<?if($arResult["MSG"] != ""):?>
		<p class="sucsess simple-form__sucsess"><?=$arResult["MSG"]?></p>
	<?else:?>
	<div class="col-xs-5 left-col">
		<label class="reg-form__label" for="form-name">Имя</label>
		<input class="reg-form__input" type="text" name="name" id="form-name" value="<?=$arResult["CURRENT"]["NAME"]?>"/>
		<label class="reg-form__label" for="form-sname">Отчество (если есть)</label>
		<input class="reg-form__input" type="text" name="sname" id="form-sname" value="<?=$arResult["CURRENT"]["SNAME"]?>"/>
		<label class="reg-form__label" for="form-lname">Фамилия</label>
		<input class="reg-form__input" type="text" name="lname" id="form-lname" value="<?=$arResult["CURRENT"]["LNAME"]?>"/>
		<div class="single-col clearfix">
			<div class="col-xs-3 left-col">
				<label class="reg-form__label" for="form-date">Дата рождения</label>
				<input class="reg-form__input" type="text" name="date" id="form-date" placeholder="дд.мм.гггг"  value="<?=$arResult["CURRENT"]["DATE"]?>"/>
			</div>
			<div class="col-xs-2 right-col">
				<? $sex = 1;
				if($arResult["CURRENT"]["SEX"] != "") $sex = $arResult["CURRENT"]["SEX"];
				$arResult["CURRENT"]["SEX"] = $sex;
				?>
				<label class="reg-form__label" for="form-sex">Пол</label>
				<div class="pseudo-select pseudo-select--white">
					<div class="pseudo-select__text"><?if($arResult["CURRENT"]["SEX"] == 1):?>Мужской<?else:?>Женский<?endif;?></div>
					<ul class="pseudo-select__list">
						<li class="pseudo-select__option" data-value="1">Мужской</li>
						<li class="pseudo-select__option" data-value="2">Женский</li>
					</ul>
					<select name="sex" class="pseudo-select__real" id="form-sex">
						<option value="1" <?if($arResult["CURRENT"]["SEX"] == 1):?>selected="selected"<?endif;?>>Мужской</option>
						<option value="2" <?if($arResult["CURRENT"]["SEX"] == 2):?>selected="selected"<?endif;?>>Женский</option>
					</select>
				</div>
			</div>
		</div>
		<? $citizen = 1;
		if($arResult["CURRENT"]["CITIZEN"] != "") $citizen = $arResult["CURRENT"]["CITIZEN"];
		$arResult["CURRENT"]["CITIZEN"] = $citizen;
		?>
		<label class="reg-form__label" for="form-citizen">Гражданство</label>
		<div class="pseudo-select pseudo-select--white">
			<div class="pseudo-select__text"><?if($arResult["CURRENT"]["CITIZEN"] == 1):?>Россия<?else:?>Украина<?endif;?></div>
			<ul class="pseudo-select__list">
				<li class="pseudo-select__option" data-value="1">Россия</li>
				<li class="pseudo-select__option" data-value="2">Украина</li>
			</ul>
			<select name="citizen" class="pseudo-select__real" id="form-citizen">
				<option value="1" <?if($arResult["CURRENT"]["CITIZEN"] == 1):?>selected="selected"<?endif;?>>Россия</option>
				<option value="2" <?if($arResult["CURRENT"]["CITIZEN"] == 2):?>selected="selected"<?endif;?>>Украина</option>
			</select>
		</div>
	</div>
	<div class="col-xs-5 right-col">
		<label class="reg-form__label" for="form-email">Email-адрес</label>
		<input class="reg-form__input" type="text" name="email" id="form-email" value="<?=$arResult["CURRENT"]["EMAIL"]?>"/>
		<label class="reg-form__label" for="form-email_rep">Повторите Email-адрес</label>
		<input class="reg-form__input js-check-equal" type="text" name="email_rep" id="form-email_rep" data-equal="form-email" value="<?=$arResult["CURRENT"]["REP_EMAIL"]?>"/>
		<label class="reg-form__label" for="form-pass">Пароль (не менее 8 символов)</label>
		<input class="reg-form__input" type="password" name="pass" id="form-pass" value="<?=$arResult["CURRENT"]["PASS"]?>"/>
		<label class="reg-form__label" for="form-pass_rep">Повторите пароль</label>
		<input class="reg-form__input js-check-equal" type="password" name="pass_rep" id="form-pass_rep" data-equal="form-pass" value="<?=$arResult["CURRENT"]["REP_PASS"]?>"/>
	</div>
	<div class="col-xs-8 reg-form__text">Нажимая кнопку «Зарегистрироваться», я даю своё согласие на обработку моих персональных данных Благотворительному фонду «Мечтатели»</div>
	<button class="col-xs-4 reg-form__submit" name="regist" type="submit">Зарегистрироваться</button>
	<?endif;?>
	<script>
		$(document).ready( function(){
			$("#regist-form form").ajaxForm(
				{
					type: 'POST',
					url: "/ajax/reg_form.php",
					//dataType: 'json',
					success: function(data){
						$("#regist-form .modal-wnd__content").html(data);

					}
				}
			);
			if(void 0 !== $("#regist-form .error")){
				var popMargTop = ($('#regist-form').height() + 40) / 2;
				//Устанавливаем величину отступа
				$('#regist-form').css({
					'margin-top' : -popMargTop
				});
			}
		});
	</script>
</form>
