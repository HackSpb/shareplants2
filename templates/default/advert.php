<!-- Product Details Area Start -->
<div class="single-product-area section-padding-100 clearfix">
    <div class="container-fluid">

      <!-- BREADCRUMBS -->
      <div class="row">
          <div class="col-12">
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb mt-50">
                    <?
                      $count = count($breadCrumbs);
                      for ($i=0; $i < $count; $i++) {
                        $class = ($i==$count-1)?'class="breadcrumb-item active" aria-current="page"' : 'class="breadcrumb-item"';
                        echo "<li $class><a href='/catalog/".$breadCrumbs[$i]['catalog_id']."'>".$breadCrumbs[$i]['catalog_name']."</a></li>";
                      }
                    ?>
                    <li class="breadcrumb-item active" aria-current="page"><?= $advert['advert_name'] ?></li>
                  </ol>
              </nav>
          </div>
      </div>

        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="single_product_thumb">
                    <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li class="active" data-target="#product_details_slider" data-slide-to="0" style="background-image: url(/img/adverts/<?= $photos[0]['photo_file']?>);">
                            </li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <a class="gallery_img" href="img/product-img/pro-big-1.jpg">
                                    <img class="d-block w-100" src="/img/adverts/<?= $photos[0]['photo_file']?>" alt="First slide">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="single_product_desc">
                    <!-- Product Meta Data -->
                    <div class="product-meta-data">
                        <div class="line"></div>
                        <p class="product-price"><?= $advert['advert_name'] ?></p>
                       
                            <h5><?= $advert['landmark_name'] ?></h5>
                       
                        <!-- Ratings & Review -->
                        <!-- <div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
                            <div class="ratings">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                            <div class="review">
                                <a href="#">Write A Review</a>
                            </div>
                        </div> -->
                        <!-- Avaiable -->
                        <span class="advert_user_name"><?= $advert['user_firstname'] ?></span>
                        <? if ($advert['user_email']) {echo '<p class="advert_user_contacts"> '.$advert['user_email'].' </p>';} ?>
                        <? if ($advert['user_phone']) {echo '<p class="advert_user_contacts"></i> '.$advert['user_phone'].' </p>';} ?>

                    </div>

                    <div class="short_overview my-5">
                        <p class="advert_description"><?= $advert['advert_description'] ?></p>
                    </div>

                    <!-- Descriptions -->
                    <div class="descriptions">
                    <?
                    $old_group_id=0;
                    foreach($param_values as $group){
                        foreach ($group as $param) {
                          if($old_group_id!=$param['param_group_id'] && $param['param_group_id'] !=1)
                            // echo '<h4>'.$param['param_group_name'].'</h4>';
                          $old_group_id=$param['param_group_id'];
                          echo'<span class="param_name">' . $param['param_name'] . ': </span>';
                          if ($param['param_type_id'] == 1) {echo $param['param_value_int'];}
                          elseif ($param['param_type_id'] == 2) {echo $param['param_value_str'];}
                          elseif($param['param_type_id'] == 6) {
                            foreach ($param['options'] as $option) {

                              echo '<div class = "advert_color" style="background-color:'.$option['param_option_altername'] .'"></div>
                                ' ;

                              }
                            }
                          elseif($param['param_type_id'] == 4) {

                              }
                          else { echo $param['param_option_name'] ;
                            }
                          echo  '<br /> ';
                          }

                      }

                        //  print_r($param_values);
                      ?>
                    </div>

                    <!-- Add to Cart Form -->
<!--                     <div class="col-12 col-lg-5">

                </div> -->
            </div>
          </div>
              <div class="col-12 col-lg-3">
                    <form class="cart clearfix" method="post">
                        <!-- <div class="cart-btn d-flex mb-50">
                            <p>Qty</p>
                            <div class="quantity">
                                <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                                <input type="number" class="qty-text" id="qty" step="1" min="1" max="300" name="quantity" value="1">
                                <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-caret-up" aria-hidden="true"></i></span>
                            </div>
                        </div> -->

                        <? if($user)
                            if($user['user_id']==$advert['user_id'] || $user['user_is_admin']){
                              echo '
                              <div class="amado-btn-group mt-20 mb-30">
                                  <a href="/edit_advert/'.$advert['advert_id'].'" class="btn amado-btn mb-20 my_reg-btn">Редактировать</a>
                              </div>
                              <div class="amado-btn-group mt-20 mb-30">
                                  <a href="/archive/'.$advert['advert_id'].'" class="btn amado-btn mb-20 my_reg-btn">Архивировать</a>
                              </div>
                              ';
                            } ?>
                    </form>
                  </div>  

  
    </div>
</div>
<!-- Product Details Area End -->
