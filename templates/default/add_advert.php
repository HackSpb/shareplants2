<!-- Product Catagories Area Start -->
<div class="products-catagories-area clearfix">
  <div class="section-padding-100 ">
    <div class="container-fluid">

      <!-- BREADCRUMBS -->
      <div class="row single-product-area ">
          <div class="col-12">
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb mt-50">
                    <?
                      $count = count($breadCrumbs);
                      for ($i=0; $i < $count; $i++) {
                        $class = ($i==$count-1)?'class="breadcrumb-item active" aria-current="page"' : 'class="breadcrumb-item"';
                        echo "<li $class><a href='/form_advert/".$breadCrumbs[$i]['catalog_id']."/".$breadCrumbs[$i]['catalog_parent']."'>".$breadCrumbs[$i]['catalog_name']."</a></li>";
                      }
                    ?>
                  </ol>
              </nav>
          </div>
      </div>

        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="checkout_details_area mt-50 clearfix">

                    <div class="cart-title">

                        <h2>  <?= ($advert['advert_id'])?'Редактировать':'Добавить'?>  объявление</h2>
                    </div>


                    <form action="/save_advert/<?= $catalog_id ?>" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="catalog_id" value="<?= $catalog_id ?>">
<?
  if($advert['advert_id']) echo '<input type="hidden" name="advert_id" value="'.$advert['advert_id'].'">';
  else echo '<input type="hidden" name="advert_id" value="">';
?>

            <!-- NAME -->
                        <div class="row">
                            <div class="col-12 mb-3">
                                <input type="text" maxlength="100" name="advert_name" class="form-control" id="company" placeholder="Название" value="<?= $advert['advert_name']?>">
                            </div>
                        </div>
            <!-- DESCRIPTION -->
                        <div class="row">
                            <div class="col-12 mb-3">
                                <textarea name="advert_description" maxlength="100" class="form-control w-100" id="comment" cols="30" rows="10" placeholder="Описание"><?= $advert['advert_description']?></textarea>
                            </div>
                          </div>
                        <div class="row">
            <!-- LANDMARKS -->
                            <div class="col-6 mb-3">
                                <select name="landmark_id" class="w-100" id="country">
                                  <?
                                    foreach ($landmarks as $value) {
                                      if($advert['landmark_id']==$value['landmark_id']) {
                                        echo '<option selected value="'. $value['landmark_id'] . '">' . $value['landmark_name'] . '</option>';
                                      }else
                                      echo '<option value="'. $value['landmark_id'] . '">' . $value['landmark_name'] . '</option>';
                                    }
                                  ?>
                                </select>
                            </div>

            <!-- CONDITION -->
                            <div class="col-6 mb-3">
                                <select name="advert_condition_id" class="w-100" id="country">
                                    <option value="1"  <?= ($advert['advert_condition_id']==1)?'selected':'' ?> >Бесплатно</option>
                                    <option value="1" <?= ($advert['advert_condition_id']==2)?'selected':'' ?>>Платно</option>
                                    <option value="1" <?= ($advert['advert_condition_id']==3)?'selected':'' ?>>Обмен</option>
                                </select>
                            </div>
                          </div>

                        <div class="row">
              <!-- ADDRESS -->

                            <div class="col-md-6 mb-3">
                                <input name="advert_address" type="text" class="form-control" id="last_name" value="<?= $advert['advert_address']?>" placeholder="Адрес" required>
                            </div>
                        </div>


            <!-- PARAMS -->
                            <?php
                                  foreach ($params as $group) {
                                    // echo '<h3>'.$group[0]['param_group_name'].'</h3><div style="border:1px solid">';
                                    foreach ($group as $param) {
                                        if($param['param_type_id']==1){
                                          if(isset($param_values[$param['param_group_id']][$param['param_id']]['param_value_int'])) $value=$param_values[$param['param_group_id']][$param['param_id']]['param_value_int'];
                                          else $value='';
                                          echo '
                                          <div class="col-12">'.$param['param_name'] . '
                                            <input value="'.$value.'" class="form-control" id="company" min="'.$param['param_min_value'].'" max="'.$param['param_max_value'].'" type="number" placeholder="'.$param['param_name'].'" name="params_values['.$param['param_id'].']">
                                          </div>';

                                        }else if($param['param_type_id']==2){
                                          if(isset($param_values[$param['param_group_id']][$param['param_id']]['param_value_str'])) $value=$param_values[$param['param_group_id']][$param['param_id']]['param_value_str'];
                                          else $value='';
                                          echo '
                                          <div class="col-12">'.$param['param_name'] . '
                                            <input value="'.$value.'" class="form-control" id="company" maxlength="'.$param['param_max_value'].'" type="text" placeholder="'.$param['param_name'].'" name="params_values['.$param['param_id'].']">
                                          </div>';

                                        }else if($param['param_type_id']==3){
                                          $count = count($param['options']);
                                          echo '<br />';
                                          for ($i = 0; $i < $count; $i++) {
                                            $option = $param['options'][$i];
                                            if(isset($param_values[$param['param_group_id']][$param['param_id']]['options'][ $option['param_option_id'] ])) $checked ='checked';
                                            else $checked =false;

                                            echo '<input '.$checked.' type="radio" name="params_values['.$param['param_id'].']" value="'.$option['param_option_id'] .'"> '.$param['options'][$i]['param_option_name'] ;
                                          }

                                        }else if($param['param_type_id']==4){
                                          echo '<br />'.$param['param_name'] . ': ';
                                          $count = count($param['options']);
                                          for ($i = 0; $i < $count; $i++) {
                                            echo '<input type="checkbox" name="params_values['.$param['param_id'].']['.$param['options'][$i]['param_option_id'] .']" value="'.$param['options'][$i]['param_option_id'] .'"> '.$param['options'][$i]['param_option_name'] ;
                                          }

                                        }else if($param['param_type_id']==5){
                                          echo '  <div class="col-12  mb-3">'.$param['param_name'] . ':
                                           <select class="w-100" name="params_values['.$param['param_id'].'][]">
                                          <option value="">----</option>';
                                          $count = count($param['options']);
                                          for ($i = 0; $i < $count; $i++) {
                                            $option = $param['options'][$i];
                                            //print_R($group) ;
                                            if(isset($param_values[$param['param_group_id']][$param['param_id']]['options'][ $option['param_option_id'] ])) $selected ='selected';
                                            else $selected =false;

                                            echo '<option '.$selected.' value="'.$option['param_option_id'] .'"> '.$option['param_option_name'] . '</option>';
                                          }
                                          echo '</select></div>';

                                        }else if($param['param_type_id']==6){
                                          echo '<br />'.$param['param_name'] . ': ';
                                          $count = count($param['options']);
                                          for ($i = 0; $i < $count; $i++) {
                                            $option = $param['options'][$i];
                                            //print_R($group) ;
                                            if(isset($param_values[$param['param_group_id']][$param['param_id']]['options'][ $option['param_option_id'] ])) $checked ='checked';
                                            else $checked =false;


                                            echo '<input '.$checked.' data-color="'.$option['param_option_altername'] .'" style=" background:'.$param['options'][$i]['param_option_altername'] .'" type="checkbox" name="params_values['.$param['param_id'].']['.$param['options'][$i]['param_option_id'] .']" value="'.$option['param_option_id'] .'">  <label>'.$option['param_option_name'] .'</label>';
                                          }
                                        }

                                    }
                            //echo '</div>';
                                  }
                                ?>



                            <div class="col-md-3 mb-3">
                                <input type="file" class="btn" id="f" name="photo" multiple accept="image/*,image/jpeg">
                            </div>

                            <div class="col-md-12 mb-3">
                                <input type="submit" class="btn" id="f" value="Добавить">
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
            <!-- <div class="col-12 col-lg-4">
                <div class="cart-summary">
                    <h5>Cart Total</h5>
                    <ul class="summary-table">
                        <li><span>subtotal:</span> <span>$140.00</span></li>
                        <li><span>delivery:</span> <span>Free</span></li>
                        <li><span>total:</span> <span>$140.00</span></li>
                    </ul>

                    <div class="payment-method"> -->
                        <!-- Cash on delivery -->
                        <!-- <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="cod" checked>
                            <label class="custom-control-label" for="cod">Cash on Delivery</label>
                        </div> -->
                        <!-- Paypal -->
                        <!-- <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="paypal">
                            <label class="custom-control-label" for="paypal">Paypal <img class="ml-15" src="img/core-img/paypal.png" alt=""></label>
                        </div>
                    </div>

                    <div class="cart-btn mt-100">
                        <a href="#" class="btn amado-btn w-100">Checkout</a>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>

</form>
