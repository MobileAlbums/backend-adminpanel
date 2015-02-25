 
<?include("include/config.php");?>
<?include("include/db.php");?>
<?include("./include/functions.php");?>
<?

if(isset($_GET['del'])){
	$db = new db();
	$db->connect();
	
	$delete_id = $_GET['del'];
	$file_name = $_GET['file_name']; 
	$db = new db();
	$db->connect();
	$delete_query = "DELETE FROM albums WHERE id='$delete_id' ";
	
	if(mysql_query($delete_query)){
		delete_file("albums/".$file_name);
		$query = "SELECT * FROM pictures WHERE album_id='$delete_id'";
		$result = $db->execute($query);	
		$query = "DELETE FROM pictures WHERE album_id='$delete_id'";
		if(mysql_query($query)) {
			while($row = $db->row($result)) {
				delete_file("pictures/".$row['filename']);
			}
		}	
		echo "<script>alert('Album Has been Deleted')</script>";
		echo "<script>window.open('menus.php','_self')</script>";
	}
}
?>