<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Share Plants</title>

    <!-- Favicon  -->
    <link rel="icon" href="/templates/default/img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="/templates/default/css/core-style.css">
    <link rel="stylesheet" href="/templates/default/css/style.css">

</head>

<body>
  <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
  <script src="/templates/default/js/jquery/jquery-2.2.4.min.js"></script>
  <!-- Popper js -->
  <script src="/templates/default/js/popper.min.js"></script>
  <!-- Bootstrap js -->
  <script src="/templates/default/js/bootstrap.min.js"></script>
  <!-- Plugins js -->
  <script src="/templates/default/js/plugins.js"></script>
      <script src="https://cdn.rawgit.com/RobinHerbots/Inputmask/3.2.7/dist/min/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
  <script src="/templates/default/js/jquery.inputmask-multi.js?ASDSAD"></script>
  <!-- Search Wrapper Area Start -->
  <div class="search-wrapper section-padding-100">
      <div class="search-close">
          <i class="fa fa-close" aria-hidden="true"></i>
      </div>
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <div class="search-content">
                      <form action="#" method="get">
                          <input type="search" name="search" id="search" placeholder="Type your keyword...">
                          <button type="submit"><img src="img/core-img/search.png" alt=""></button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Search Wrapper Area End -->

  <!-- ##### Main Content Wrapper Start ##### -->
  <div class="main-content-wrapper d-flex clearfix">

      <!-- Mobile Nav (max width 767px)-->
      <div class="mobile-nav">
          <!-- Navbar Brand -->
          <div class="amado-navbar-brand">
              <a href="/"><img src="/templates/default/img/logo.png" alt=""></a>
          </div>
          <!-- Navbar Toggler -->
          <div class="amado-navbar-toggler">
              <span></span><span></span><span></span>
          </div>
      </div>

      <!-- Header Area Start -->
      <header class="header-area clearfix">
          <!-- Close Icon -->
          <div class="nav-close">
              <i class="fa fa-close" aria-hidden="true"></i>
          </div>
          <!-- Logo -->
          <div class="logo">
              <a href="/"><img src="/templates/default/img/logo.png" alt=""></a>
          </div>
          <!-- City -->
         <!--<div class="product-topbar d-xl-flex align-items-end justify-content-between">
              <div class="product-sorting d-flex">
                  <div class="sort-by-date d-flex align-items-center mr-15">
                      <p class="city">Город</p>
                      <form action="#" method="get">
                          <select name="select" id="sortBydate">
                              <option class="city-option" value="value"> Санкт-Петербург</option>
                              <option class="city-option" value="value"> Екатеринбург</option>
                              <option class="city-option" value="value"> Владивосток</option>
                          </select>
                      </form>
                  </div>
              </div>
          </div> -->
          <!-- Search -->
          <!-- <div class="cart-fav-search mb-20">
              <a href="#" class="search-nav"><img src="/templates/default/img/search.png" alt=""> Search</a>
          </div> -->
          <!-- Button Add -->
          <? if($user){
            echo '
          <div class="amado-btn-group mt-30 mb-30">
              <a href="/form_advert/" class="btn amado-btn mb-15">Добавить</a>
          </div>
          ';
          }
          ?>
          <!-- Header Nav -->
          <nav class="amado-nav">
              <ul>
                  <li class="header-nav-main header-nav-item"><a href="/">Главная</a></li>
                  <li class="header-nav-item"><a href="/catalog/2">Растения</a></li>
                  <li class="header-nav-item"><a href="/catalog/3">Услуги</a></li>
                  <li class="header-nav-item"><a href="/catalog/4">Предметы</a></li>
<!--                   <li class="header-nav-contacts"><a href="/info/about_us/">О нас</a></li> -->
                  <li class="header-nav-contacts header-nav-item"><a href="/feedback/">Контакты</a></li>
              </ul>
          </nav>
          <? if($user){
            echo

            '  <!-- Button Group -->

              <div class="amado-btn-group mt-30 mb-100">
                  <a href="/cabinet/" class="btn amado-btn mb-20 my_reg-btn">Личн. Кабинет</a>
              </div>
              ';

                }
            else {

              ?>
          <!-- Button Group -->
          <div class="amado-btn-group mt-100 mb-100">
              <a href="/register/" class="btn amado-btn mb-20 my_reg-btn">Регистрация</a>
              <a href="/auth/" class="btn amado-btn">Авторизация</a>
          </div>
            <? } ?>
          <!-- Social Button -->
          <div class="social-info d-flex justify-content-between">
              <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
              <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
              <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
              <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
          </div>
      </header>
      <!-- Header Area End -->
