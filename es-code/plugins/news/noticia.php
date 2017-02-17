<?PhP 
	echo '<h1>'.news_get_title().'</h1>';
	echo ' <hr>
                <p>
                    <span class="glyphicon glyphicon-time"></span> Data de Publicação '.news_get_date().'</p>';
	echo '<img src="'.news_get_image().'" class="img-responsive" style="margin: 0px auto; max-height:300px; width:auto; max-width:900px;">';
	echo '<hr>';
    echo '<p class="lead">'.news_get_resumo().'</p>';
	echo '<p>'.news_get_text().'</p>';
	echo '<hr>';
?>
