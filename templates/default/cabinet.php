<!-- Product Catagories Area Start -->
<div class="products-catagories-area clearfix">
    <!-- ##### Newsletter Area Start ##### -->
        <section class="newsletter-area section-padding-100-0 top" style="background:#FFF;">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Newsletter Text -->
                    <div class="col-12 col-lg-6 col-xl-7">
                        <div class="newsletter-text mb-100">
                          <h3> Добро пожаловать <?= $user['user_firstname']?>!</h3>
                          <div class="amado-btn-group mt-30 mb-100">
                          <a class="btn amado-btn mb-20 my_reg-btn" href="/logout/">Выйти</a>
                          </div>
                          <div class="amado-btn-group mt-30 mb-100">
                          Ваши объявления:
                          </div>


                        </div>
                    </div>
                    <!-- Newsletter Form -->
                    <div class="col-12 col-lg-6 col-xl-5">
                        <!-- <img src="img/bg-img/main_info.jpg" alt="main_info"> -->
                    </div>
                </div>
            </div>
        </section>



            <div class="amado-pro-catagory clearfix">




                <!-- Single Catagory -->
                <?php
                  foreach ($adverts as $advert) {
                    echo '<div class="single-products-catagory clearfix" title="супер цветочек">
                        <a href="/advert/'.$advert['advert_id'].'">';
                    if($advert['photo_file'])  echo '
                                  <img src="/img/adverts/'.$advert['photo_file'].'" alt="">';
                    else echo '
                    <img src="/templates/default/img/no_photo.jpg" alt="">
                    ';
                    echo '
                         <!-- Hover Content -->
                            <div class="hover-content" >
                                <div class="line"></div>
                                <p>'.$advert['advert_description'].'</p>
                                <h4>'. $advert["advert_name"] .'</h4>
                            </div>
                        </a>
                    </div>';
                  }

                ?>


            </div>
        </div>
        <!-- Product Catagories Area End -->
