<!-- Product Catagories Area Start -->
<div class="products-catagories-area clearfix">
<?

foreach ($catalog as $value) {
  echo "<a href='/form_advert/$value[catalog_id]/$value[catalog_parent]'>$value[catalog_prefix_name]</a><br />";
}


/*<script>
$('select').niceSelect('destroy');
</script>*/

?>
