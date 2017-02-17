
<?PhP
echo '<h1><a href="?news_id='.news_get_id().'&p=page">'.news_get_title().'</a></h1>';
echo '<hr>';
echo '<p>
	<span class="glyphicon glyphicon-time"></span> 
	'.news_get_date().'</p>
    <hr>';
echo '<img src="'.news_get_image().'" class="img-responsive" style="margin: 0px auto; max-height:250px; max-width:100%; max-heigth:900px;">
<hr>
<p>
'.news_get_resumo().'
</p>
                <a class="btn btn-primary" href="?news_id='.news_get_id().'&p=page">Ler<span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
';
?>