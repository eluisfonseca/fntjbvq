<div class="box">
	<div class="boxInner">
	<?PhP
		echo '<a href="?productID='.catalogo_get_id().'&p=citem">';
		echo '<img src="'.catalogo_get_main_img().'" />';
		echo '<div class="titleBox">'.catalogo_get_name().'</div>';
		echo '</a>';
	?>
	</div>
</div>
