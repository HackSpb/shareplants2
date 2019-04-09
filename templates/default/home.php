


        <!-- Product Catagories Area Start -->
        <div class="products-catagories-area catalog-wrap clearfix" style="flex: 0 0 100%;   max-width: 100%; width: 100%;">
            <div class="amado-pro-catagory catalog-area clearfix">

                <!-- Single Catagory -->
                <?php
                  foreach ($adverts as $advert) {
                    echo '<div class="single-products-catagory clearfix" title="">
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
                                <p>'.$advert['advert_condition_name'].'</p>
                                <h4>'. $advert["advert_name"] .'</h4>
                            </div>
                        </a>
                    </div>';
                  }

                ?>


            </div>
        </div>
        <!-- Product Catagories Area End -->
