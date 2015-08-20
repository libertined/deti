<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<form action="" method="POST" class="simple-form">
	<p class="simple-form__title">Задать вопрос</p>
	<p class="simple-form__text">Вы можете задать любой интересующий вас вопрос и мы в ближайшее время свяжемся с вами.</p>
	<?if(!empty($arResult["ERRORS"])):?>
		<p class="error"><?=implode("<br>", $arResult["ERRORS"])?></p>
	<?endif;?>
	<?if($arResult["MSG"] != ""):?>
		<p class="sucsess simple-form__sucsess"><?=$arResult["MSG"]?></p>
	<?else:?>
		<div class="single_col clearfix marg10-10">
			<div class="left-col simple-form__right-col-small">
				<p class="simple-form__label">Представьтесь пожалуйста</p>
				<input class="simple-form__input" name="name" value=""type="text">
			</div>
			<div class="col-xs-6 right-col">
				<p class="simple-form__label">Ваш E-mail</p>
				<input class="simple-form__input" name="email" value="" type="text">
			</div>
		</div>
		<input class="simple-form__input" placeholder="Тема сообщения" name="subject" value="" type="text">
		<textarea name="message" placeholder="Текст сообщения" class="simple-form__textarea"></textarea>
		<div class="col-xs-4 simple-form__submit-block">
			<button class="btn btn--full" type="submit" name="form_submit">Отправить</button>
		</div>
	<?endif;?>
	<script>
		$(document).ready( function(){
			$("#question-form form").ajaxForm(
				{
					type: 'POST',
					url: "/ajax/faq_form.php",
					//dataType: 'json',
					success: function(data){
						$("#question-form .modal-wnd__content").html(data);
					}
				}
			);
			if(void 0 !== $("#question-form .error")){
				var popMargTop = ($('#question-form').height() + 40) / 2;
				//Устанавливаем величину отступа
				$('#question-form').css({
					'margin-top' : -popMargTop
				});
			}
		});
	</script>
</form>