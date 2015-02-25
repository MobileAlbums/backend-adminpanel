<?include("include/config.php");?>
<?include("include/db.php");?>
<?include("./include/functions.php");?>
<?
if(isset($_GET['del'])){

	$delete_id = $_GET['del'];
	$file_name = $_GET['file_name'];
	$db = new db();
	$db->connect();	
	$delete_query = "delete from pictures where id='$delete_id' ";
	
	if(mysql_query($delete_query)){
		delete_file("pictures/".$file_name);
		echo "<script>alert('Picture Has been Deleted')</script>";
		echo "<script>window.open('menus.php','_self')</script>";
	}
}
?>