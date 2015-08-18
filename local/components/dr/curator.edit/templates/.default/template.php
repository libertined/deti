<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<form action="/" method="POST" class="simple-form edit-profile clearfix" enctype="multipart/form-data">
	<?=bitrix_sessid_post();?>
	<input type="hidden" value="<?=$arResult["USER"]["ID"]?>" name="user_id" />
	<input type="hidden" value="<?=MAX_FILE_SIZE_MB*1024*1024?>" name="MAX_FILE_SIZE" />
	<p class="simple-form__title">Редактировать профиль</p>
	<div class="edit-profile__img-block col-xs-3 left-col">
		<div class="avatar centered-col">
			<?if(!empty($arResult["USER"]["AVATAR"])):?>
				<img src="<?=$arResult["USER"]["AVATAR"]["src"]?>" alt="<?=$arResult["USER"]["NAME"]?> <?=$arResult["USER"]["SECOND_NAME"]?> <?=$arResult["USER"]["LAST_NAME"]?>" id="js-ava-img"/>
			<?endif;?>
		</div>
		<a class="edit-profile__img-link js-photo-link">Изменить фото</a>
		<p class="error js-photo-error"></p>
	</div>
	<div class="col-xs-4">
		<input type="hidden" name="birth" value="28 января 1980"/>
		<input type="hidden" name="citizen" value="Гражданство"/>
		<p class="edit-profile__name">Вероника<br>Игоревна<br>Шатальская</p>
		<?if(!empty($arResult["ERRORS"])):?>
			<p class="error"><?=implode("<br>", $arResult["ERRORS"])?></p>
		<?endif;?>
		<?if($arResult["MSG"] != ""):?>
			<p class="sucsess simple-form__sucsess"><?=$arResult["MSG"]?></p>
		<?endif;?>

		<p class="edit-profile__info"><span class="edit-profile__info-title">Статус:</span> Попечитель</p>
		<label class="edit-profile__info" for="form-date">Дата рождения</label>
		<input class="simple-form__input" type="text" name="date" id="form-date" placeholder="дд.мм.гггг"  value="<?=$arResult["USER"]["PERSONAL_BIRTHDAY"]?>"/>
		<? $citizen = 1;
		if($arResult["USER"]["PERSONAL_COUNTRY"] != "") $citizen = $arResult["USER"]["PERSONAL_COUNTRY"];
		$arResult["USER"]["PERSONAL_COUNTRY"] = $citizen;
		?>
		<label class="reg-form__label" for="form-citizen">Гражданство</label>
		<div class="pseudo-select pseudo-select--white">
			<div class="pseudo-select__text"><?if($arResult["CURRENT"]["CITIZEN"] == 1):?>Россия<?else:?>Украина<?endif;?></div>
			<ul class="pseudo-select__list">
				<li class="pseudo-select__option" data-value="1">Россия</li>
				<li class="pseudo-select__option" data-value="14">Украина</li>
			</ul>
			<select name="citizen" class="pseudo-select__real" id="form-citizen">
				<option value="1" <?if($arResult["USER"]["PERSONAL_COUNTRY"] == 1):?>selected="selected"<?endif;?>>Россия</option>
				<option value="14" <?if($arResult["USER"]["PERSONAL_COUNTRY"] == 14):?>selected="selected"<?endif;?>>Украина</option>
			</select>
		</div>
		<p class="edit-profile__section-title">Загруженные документы:</p>
		<?foreach($arResult["USER"]["FILES"] as $file):?>
			<p class="edit-profile__link"><a href="<?=$file["URL"]?>"><?=$file["NAME"]?></a></p>
		<?endforeach;?>
		<input class="edit-profile__file-btn" type="file" name="documents" value="Загрузить еще документ"/>
		<button class="btn btn--full btn--edit-save" name="save" type="submit">Сохранить изменения</button>
		<p class="edit-profile__desc">Удалив профиль, вы потеряете свой статус и закрепленных за вами детей. </p>
		<button class="btn btn--full btn--gray" name="del" type="submit">Удалить профиль безвозвратно</button>
	</div>
</form>
<form action="/ajax/service/edit_photo.php" method="POST" class="hide-block" id="js-photo-form" enctype="multipart/form-data">
	<?=bitrix_sessid_post();?>
	<input type="hidden" value="<?=$arResult["USER"]["ID"]?>" name="user_id" />
	<input type="hidden" value="<?=MAX_FILE_SIZE_MB*1024*1024?>" name="MAX_FILE_SIZE" />
	<input type="file" name="uploadPhoto" value="Изменить фото" class="edit-profile__img-button js-photo-change" />
</form>
<script>
	$(document).ready( function(){
		$("form.edit-profile").ajaxForm(
			{
				type: 'POST',
				url: "/ajax/curator_edit.php",
				success: function(data){
					$("form.edit-profile").closest(".modal-wnd__content").html(data);

				}
			}
		);
		$("#js-photo-form").ajaxForm(
			{
				type: 'POST',
				dataType: 'json',
				success: function(data){
					if(data.error != ''){
						$(".js-photo-error").text(data.error);
					} else {
						$(".js-photo-error").text("");
						var img_wrap=$("#js-ava-img");
						img_wrap.attr('src',data.path);
					}
				}
			}
		);
		/*if(void 0 !== $("#regist-form .error")){
			var popMargTop = ($('#regist-form').height() + 40) / 2;
			//Устанавливаем величину отступа
			$('#regist-form').css({
				'margin-top' : -popMargTop
			});
		}*/
	});
</script>