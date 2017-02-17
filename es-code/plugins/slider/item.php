<div id="slider-<?PhP echo slider_get_id(); ?>" class="item">
<div class="sim">
<span class="spna"></span>
<img class="imga" src="<?PhP echo slider_get_image(); ?>" id="slider-img-<?PhP echo slider_get_id(); ?>" />
</div>
<div class="sct">
<?PhP
echo '<h1>'.slider_get_title().'</h1>';
echo '<p>'.slider_get_content().'</p>';
?>
</div>
</div>
