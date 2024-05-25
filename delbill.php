<?php session_start(); ?>

<form action="delbillexec.php" method="post">
<h4>Are you sure you want to delete this record? <br /></h4>
<input type="hidden" name="id" value="<?php echo $_REQUEST['id']; ?>" />
<input type="submit" nsme="ok" value="Delete">
</form>