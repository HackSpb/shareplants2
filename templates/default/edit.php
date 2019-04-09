

<div class="contact_form">
    <div class="form_subtitle"> Редактировать информацию </div>
	<div>
		<? if (!empty($errors)) : ?>
			<? foreach ($errors as $error): ?>
				<p style="color:red"> <?= $error; ?> </p>
			<? endforeach ?>
		<? endif ?>
	</div>
    <form method="POST" action="<?= DOMAIN . 'user\save'; ?>">
        <div class="form_row">
			<label class="contact"><strong>Логин:</strong></label>
			<input type="text" class="contact_input" name="login" value="<?= $user_info['user_login'];?>"/>
        </div>
        <div class="form_row">
			<label class="contact"><strong>Имя:</strong></label>
			<input type="text" class="contact_input" name="password"/>
        </div>
		<div class="form_row">
			<label class="contact"><strong>Фамилия:</strong></label>
			<input type="text" class="contact_input" name="login"/>
        </div>
		<div class="form_row">
			<label class="contact"><strong>Адрес:</strong></label>
			<input type="text" class="contact_input" name="login"/>
        </div>
		<div class="form_row">
			<label class="contact"><strong>Пол:</strong></label>
			<select>
				<? foreach ($genders as $gender): ?>
					<option value="<?= $gender['gender_id']; ?>" <?= (isset($user_info['user_gender_id']) && $user_info['user_gender_id'] == $gender['gender_id']) ? 'selected' : '' ?>> <?= $gender['gender_name'];  ?> </option>
				<? endforeach; ?>
			</select>
		</div>
		<div class="form_row">
			<label class="contact"><strong>Email:</strong></label>
			<input type="text" class="contact_input" name="login"/>
        </div>
		<div class="form_row">
			<label class="contact"><strong>Телефон:</strong></label>
			<input type="text" class="contact_input" name="login"/>
        </div>
        <div class="form_row">
			<input type="submit"  value="Сохранить" />
        </div>
    </form>
    </div>
<div class="clear"></div>
</div><!--end of left content-->
      
