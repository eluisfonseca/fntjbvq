<?PhP
get_header();
?>
<div id="login">
	<form action="index.php" method="post" enctype="multipart/form-data" name="Login" target="_self">
    <input name="h" type="hidden" value="login">
    <label><?PhP echo I_USER; ?>:</label><br>
    <input name="Utilizador" type="text" size="25" maxlength="50" /><br>
    <label><?PhP echo I_PASSWORD; ?>:</label><br>
    <input name="Palavra" type="password" size="25" maxlength="50" /><br>
    <input name="Entrar" type="submit" value="<?PhP echo I_LOGIN; ?>">
	</form>
</div>
<?PhP
get_footer();
?>
