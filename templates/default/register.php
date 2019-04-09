<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="checkout_details_area mt-50 clearfix">

                    <div class="cart-title">
                        <h2>Регистрация</h2>
                    </div>
                    <div>
                  		<? if (!empty($errors)) : ?>
                  			<? foreach ($errors as $error): ?>
                  				<p style="color:red"> <?= $error; ?> </p>
                  			<? endforeach ?>
                  		<? endif ?>
                  	</div>
                    <form action="#" method="post">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <input type="text" class="form-control" name="user_firstname" value="<?= $user_firstname ?>" placeholder="Имя" required>
                            </div>
                            <div class="col-12 mb-3">
                                <input type="phone" class="form-control" name="user_phone" id="user_phone" placeholder="Телефон" value="<?= $user_phone?>">
                            </div>
                            <div class="col-12 mb-3">
                                <input type="email" class="form-control" name="user_email" placeholder="Email" value="<?=$user_email?>">
                            </div>
                            <div class="col-12 mb-3">
                                <select class="w-100" name="city_id">
                                <option value="1" selected>Санкт-Петербург</option>
                            </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <input type="password" class="form-control" name="user_password" min="6" placeholder="Пароль" value="">
                            </div>
                            <div class="col-md-4 mb-3">
                                <input type="password" class="form-control" name="user_password_repeat" min="6" placeholder="Повторите пароль" value="">
                            </div>


                            <div class="col-12">
                                <div class="custom-control custom-checkbox d-block mb-2">
                                    <input type="checkbox" class="custom-control-input" id="customCheck2" required >
                                    <label class="custom-control-label" for="customCheck2">Я принимаю условия <a href="/info/agreement/">Пользовательского соглашения</a> </label>
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <input type="submit" class="btn" id="f" value="Зарегистрироваться">
                            </div>

                            <!-- <div class="col-12">
                                <div class="custom-control custom-checkbox d-block mb-2">
                                    <input type="checkbox" class="custom-control-input" id="customCheck2">
                                    <label class="custom-control-label" for="customCheck2">Create an accout</label>
                                </div>
                                <div class="custom-control custom-checkbox d-block">
                                    <input type="checkbox" class="custom-control-input" id="customCheck3">
                                    <label class="custom-control-label" for="customCheck3">Ship to a different address</label>
                                </div>
                            </div> -->
                        </div>
                    </form>
                </div>
            </div>
          </div>
        </div>
      </div>



<script>

 var listRu = [
   {mask: "+7(9##)###-##-##", region: "Россия", city: "СПб", operator: "", desc: ""},
   {mask: "+7(812)###-##-##", region: "Россия", city: "СПб", operator: "", desc: ""}
 ];

var maskOpts = {
  inputmask: {
    definitions: {
      '#': {
        validator: "[0-9]",
        cardinality: 1
      }
    },
    //clearIncomplete: true,
    showMaskOnHover: true,
    autoUnmask: true
  },
  match: /[0-9]/,
  replace: '#',
  list: listRu,
  listKey: "mask",
};


			$('#user_phone').inputmasks(maskOpts);



</script>
