
<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="checkout_details_area mt-50 clearfix">

                    <div class="cart-title">
                        <h2>Авторизация</h2>
                    </div>
                    <div>
                  		<? if (!empty($errors)) : ?>
                  			<? foreach ($errors as $error): ?>
                  				<p class="reg_error"> <?= $error; ?> </p>
                  			<? endforeach ?>
                  		<? endif ?>
                  	</div>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <input type="text" class="form-control" name="login" value="<?= $login ?>" placeholder="e-mail или телефон" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <input type="password" class="form-control" name="user_password" min="6" placeholder="Пароль" value="" required>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <input type="submit" class="btn" id="f" value="Войти">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
          </div>
        </div>
      </div>
