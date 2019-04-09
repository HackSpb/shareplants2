<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="checkout_details_area mt-50 clearfix">

                    <div class="cart-title">
                        <h2>Обратная связь</h2>
                    </div>
                    <div>
                  		<? if (!empty($errors)) : ?>
                  			<? foreach ($errors as $error): ?>
                  				<p style="color:red"> <?= $error; ?> </p>
                  			<? endforeach ?>
                  		<? endif ?>
                  	</div>
					<form method="POST">

					<div class="row">
                        <div class="col-md-12 mb-3">
							<input type="text" name="email"  placeholder="Email" required value="<?= $email?>">
					    </div>
						<div class="col-md-12 mb-3">
							<input type="text" name="name" placeholder="Имя" required value="<?= $name?>">
						</div>
						<div class="col-md-12 mb-3">
							<textarea name="message" cols="70" rows="4" placeholder="текст" required></textarea>
						</div>
						<div class="col-md-12 mb-3">
							<input type="submit" value="отправить" name="save">
						</div>

					</form>


 				</div>
            </div>
          </div>
        </div>
      </div>
