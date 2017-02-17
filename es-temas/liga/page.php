<html>
<?PhP
get_header();
?>
<link href="es-temas/liga/css/blog-post.css" rel="stylesheet">
</head>

<body>
  
  
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_PT/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

	<?PhP
get_menu();
?>
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
            	<?PhP
              news_get_one($_GET['news_id']);
              echo '<div class="fb-like" data-href="http://fntjbvq.evensimpler.net/?news_id='.$_GET["news_id"].'&amp;p='.$_GET["p"].'" data-width="300px" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>';
?>
              
            </div>
        </div>

        <hr>

        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Company 2013</p>
                </div>
            </div>
        </footer>

    </div>

<script src="es-code/js/jquery-1.10.2.js"></script>
<script src="es-code/js/bootstrap.js"></script>

<?PhP
get_footer();
?>
