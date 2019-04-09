

<div class="shop_sidebar_area filters-wrap">

    <!-- ##### Single Widget ##### -->
    <div class="widget catagory mb-50">
        <!-- Widget Title -->

        <!--  Catagories  -->
        <div class="catagories-menu">
            <ul>
        <?
        $count = count($breadCrumbs);
        $padding_left=0;
        for ($i=0; $i < $count; $i++) {
          echo "<li class='active'> <a href='/catalog/".$breadCrumbs[$i]['catalog_id']."' style='padding-left:".$padding_left."px'>".$breadCrumbs[$i]['catalog_name']."</a></li>";
          $padding_left+=20;
        }

        foreach ($catalog_tree as $value) {
          echo "<li><a href='/catalog/$value[catalog_id]_$value[catalog_slug]' style='padding-left:".$padding_left."px'>$value[catalog_prefix_name]</a></li>";
        }

        ?>
            </ul>
        </div>
    </div>
<hr>


    <?php
      echo '<form action="#" method="get">';
          foreach ($params as $group) {
            // echo '<h3>'.$group[0]['param_group_name'].'</h3><div style="border:1px solid">';
            foreach ($group as $param) {
                if($param['param_type_id']==1){
                  echo '
                  <div class="col-12 widget price mb-50">
                  <h6 class="widget-title mb-30">'.$param['param_name'] . '</h6>
                  <div class="widget-desc">
                      <div class="slider-range">
                          <div data-input-min-id="params_min_'.$param['param_id'].'" data-input-max-id="params_max_'.$param['param_id'].'" data-min="'.$param['param_min_value'].'" data-max="'.$param['param_max_value'].'" data-unit="" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="'.$param['param_min_value'].'" data-value-max="'.$param['param_max_value'].'" data-label-result="">
                              <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                              <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                              <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                          </div>
                          <div class="range-price">'.$param['param_min_value'].' - '.$param['param_max_value'].' </div>
                      </div>
                  </div>
                    <input id="params_min_'.$param['param_id'].'" type="hidden" name="params_values['.$param['param_id'].'][min]">
                    <input id="params_max_'.$param['param_id'].'" type="hidden" name="params_values['.$param['param_id'].'][max]">

                  </div>';


                }else if($param['param_type_id']==2){
                  echo '
                  <div class="col-12">'.$param['param_name'] . '
                    <input class="form-control" id="company" maxlength="'.$param['param_max_value'].'" type="text" placeholder="'.$param['param_name'].'" name="params_values['.$param['param_id'].']">
                  </div>';

                }else if($param['param_type_id']==3){
                  $count = count($param['options']);
                  echo '<br />';
                  for ($i = 0; $i < $count; $i++) {
                    echo '<input type="radio" name="params_values['.$param['param_id'].']" value="'.$param['options'][$i]['param_option_id'] .'"> '.$param['options'][$i]['param_option_name'] ;
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
                  <option value="">      </option>';
                  $count = count($param['options']);
                  for ($i = 0; $i < $count; $i++) {
                    echo '<option value="'.$param['options'][$i]['param_option_id'] .'"> '.$param['options'][$i]['param_option_name'] . '</option>';
                  }
                  echo '</select></div>
                  ';
                }else if($param['param_type_id']==6){
                  echo '
                  <div class="widget color mb-50">
                      <!-- Widget Title -->
                      <h6 class="widget-title mb-30">'.$param['param_name'] . '</h6>

                      <div class="widget-desc">
                          <ul class="d-flex">';
                  $count = count($param['options']);
                  for ($i = 0; $i < $count; $i++) {
                    echo '

                    <li><a href="#" class="color_" data-id="color_'.$param['options'][$i]['param_option_id'] .'" style=" background:'.$param['options'][$i]['param_option_altername'] .'">
                    <input class="color_checkbox" id="color_'.$param['options'][$i]['param_option_id'] .'"  type="checkbox" name="params_values['.$param['param_id'].']['.$param['options'][$i]['param_option_id'] .']" value="'.$param['options'][$i]['param_option_id'] .'">
                    </a></li>';
                  }
                  echo '            </ul>
                          </div>
                      </div>';
                }

            }
    //echo '</div>';
          }
          echo '<input type="submit" class="btn filter-input" value="Применить">
          </form>';
        ?>


    </div>
