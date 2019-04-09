<div class="container-fluid error_page">
    <div class="row error_wrap">
        <div class="col-12 col-lg-8 error_text">

                    <div class="cart-title">
                        <h2>Ошибка</h2>
                    </div>
                    <div>
                  		<? if (!empty($errors)) : ?>
                  			<? foreach ($errors as $error): ?>
                  				<p style="color:red"> <?= $error; ?> </p>
                  			<? endforeach ?>
                  		<? endif ?>
                  	</div>

                  </div>
                </div>
              </div>
        
