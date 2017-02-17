
<?PhP
get_header();
?>
<link href="es-temas/liga/css/blog-home.css" rel="stylesheet">
</head>
<body id="mundo">

<?PhP
get_menu();
?>

   <div class="container">
<div class="row">
            <div class="col-lg-12">
              <?PhP
                newsall();
      
              ?>

                <!-- pager 
                <ul class="pager">
                    <li class="previous"><a href="#">&larr; Older</a>
                    </li>
                    <li class="next"><a href="#">Newer &rarr;</a>
                    </li>
                </ul>-->

            </div>
<!-- /well
            <div class="col-lg-4">

                <div class="well">
                    <h4>Blog Search</h4>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                </div> 
                
                <div class="well">
                    <h4>Popular Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#dinosaurs">Dinosaurs</a>
                                </li>
                                <li><a href="#spaceships">Spaceships</a>
                                </li>
                                <li><a href="#fried-foods">Fried Foods</a>
                                </li>
                                <li><a href="#wild-animals">Wild Animals</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#alien-abductions">Alien Abductions</a>
                                </li>
                                <li><a href="#business-casual">Business Casual</a>
                                </li>
                                <li><a href="#robots">Robots</a>
                                </li>
                                <li><a href="#fireworks">Fireworks</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> 
                                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Bootstrap's default wells work great for side widgets! What is a widget anyways...?</p>
                </div>
               
            </div> /well -->
        </div>
</div>

<script src="es-code/js/jquery-1.10.2.js"></script>
    <script src="es-code/js/bootstrap.js"></script>
<?PhP
get_footer();
?>