<!doctype html>
<html>
<head>
<?PhP
echo charset();
echo title(TRUE, ' - ');
head();
?>
</head>

<body>
<div id="header">
<h1><?PhP echo I_ADMIN_PANEL; ?></h1>
<h2><?PhP echo config(3); ?></h2>
</div>
<?PhP
if(isset($_SESSION["S01"])){
	?>
	<nav>
	<ul>
		<li><a href="index.php" target="_self">Inicio</a></li>
	    <li><a href="?c=menus" target="_self">Menu</a></li>
	    <li><a href="?c=paginas" target="_self">Paginas</a></li>
        <?PhP 
			list_plugins();
		?>
        <li><a href="<?PhP echo SITE_ROOT ."/index.php"; ?>" target="_self"><?PhP echo I_WEBSITE; ?></a></li>
	    <li><a href="?out=1" target="_self"><?PhP echo I_OUT; ?></a></li>
	</ul>
	</nav>
	<?PhP
}
?>