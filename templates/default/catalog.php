




        <!-- Product Catagories Area Start -->
        <div class="products-catagories-area catalog-wrap clearfix" style="flex: 0 0 calc(100% - 570px);   max-width: calc(100% - 570px); ">
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
