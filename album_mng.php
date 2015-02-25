<?include("./include/config.php");?>
<?include("./include/db.php");?>
<?include("./include/functions.php");?>
<? 

	$db = new db();
	$db->connect();
	
	$action = "";
	if(isset($_POST['action']))
		$action = $_POST['action'];
	
	if($action == "delete") {
		$id = $_POST["id"];
		$file_name = $_POST["file_name"];
		$query = "DELETE FROM albums WHERE id='".$id."'";
		if(mysql_query($query)) {
			delete_file("albums/".$file_name);
			
			$query = "SELECT * FROM pictures WHERE album_id='$id'";
			$result = $db->execute($query);				
			$query = "DELETE FROM pictures WHERE album_id='$id'";
			if(mysql_query($query)) {
				while($row = $db->row($result)) {
					delete_file("pictures/".$row['filename']);
				}
			}
			$data = array();
			$data["action"] = "delete";
			echo json_encode($data);
		}	
		else echo "no delete";
	}
	else if($action == "insert") {	
		$file_name = $_FILES['image']['name'];		
		$image_tmp = $_FILES['image']['tmp_name'];
		$name = $_POST['name'];
		
		$query = "INSERT INTO albums VALUES('', '".$name."', '".date('m-d-y')."', '".$file_name."')";
		$data = array();
		if(mysql_query($query)) {
			$result = $db->execute("SELECT MAX(id) as max_id FROM albums");
			$row = $db->row($result);
			$max_id = $row["max_id"];
			$new_id = $max_id;
			$file_name = "image-".$new_id.".png";
			$db->execute("UPDATE albums SET filename = '".$file_name."' WHERE id = '".$new_id."'");
			move_uploaded_file($image_tmp,"albums/$file_name");	
			
			$data['action'] = "insert";
			$data['maxid'] = $new_id;
			$data["file_name"] = $file_name;
			echo json_encode($data);			
		}	
		else
			echo "no insert";
	}
	else {
		$query = "SELECT * FROM albums ORDER BY id";
		if($result = $db->execute($query)) {
			$data = array();
			$key = 0;
			while($row = $db->row($result)) {
				$data[$key] = array();
				$data[$key]['id'] = $row['id'];
				$data[$key]['name'] = $row['name'];
				$data[$key]['date'] = $row['date'];
				$data[$key]['filename'] = $row['filename'];
				$key++;
			}	
			echo json_encode($data);
		}	
		else
			echo "error";
	}	
?>


