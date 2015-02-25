<?include("./include/config.php");?>
<?include("./include/db.php");?>
<?include("./include/functions.php");?>
<? 

	$db = new db();
	$db->connect();
	
	$action = "";
	$data = "";
	if(isset($_POST['action'])) {
		$action = $_POST['action'];
		$album_id = $_POST["album_id"];
	}	
	
	if($action == "insert") {		
		$file_name = $_FILES['image']['name'];
		$image_tmp = $_FILES['image']['tmp_name'];
		$name = $_POST['name'];
		$album_id = $_POST["album_id"];
		
		$query = "INSERT INTO pictures VALUES('', '".$album_id."', '".$name."', '".date('m-d-y')."', '".$file_name."')";
		if(mysql_query($query)) {
			$result = $db->execute("SELECT MAX(id) as max_id FROM pictures");
			$row = $db->row($result);
			$max_id = $row["max_id"];
			$new_id = $max_id;
			$file_name = "image-".$album_id."-".$new_id.".png";
			$db->execute("UPDATE pictures SET filename = '".$file_name."' WHERE id = '".$new_id."'");
			move_uploaded_file($image_tmp,"pictures/$file_name");
			
			$data['action'] = "insert";
			$data['maxid'] = $max_id;
			$data['new_picture'] = $file_name;
			echo json_encode($data);
		}	
		else
			echo "no insert";
	}
	else if ($action == "delete") {		
		$id = $_POST["id"];
		$filen_name = $_POST["file_name"];
		$query = "DELETE FROM pictures WHERE id='".$id."'";
		if(mysql_query($query)) {
			delete_file("pictures/".$file_name);
			$data = array();
			$data["action"] = "delete";
			echo json_encode($data);
		}	
		else
			echo "no delete";
	}
	else if ($action == "alldelete") {	
		$album_id = $_POST["album_id"];
		$query = "SELECT * FROM pictures WHERE album_id='".$album_id."'";
		$result = $db->execute($query);
		$query = "DELETE FROM pictures WHERE album_id='".$album_id."'";
		if(mysql_query($query)) {
			while($row = $db->row($result)) {
				delete_file("pictures/".$row['filename']);
			}	
			$data = array();
			$data["action"] = "alldelete";
			echo json_encode($data);
		}				
		else 
			echo "no alldelete";
	}
	else if ($action == "update") {
		$id = $_POST["id"];
		$name = $_POST["name"];
		$query = "UPDATE pictures SET name='".$name."' WHERE id='".$id."'";
		if(mysql_query($query)) {
			$data = array();
			$data["action"] = "update";
			echo json_encode($data);
		}	
		else
			echo "no update";		
	}
	else {
		$album_id = $_POST["album_id"];
		$query = "SELECT * FROM pictures WHERE album_id='".$album_id."' ORDER BY id";
		if($result = $db->execute($query)) {
			$data = array();
			$key = 0;
			while($row = $db->row($result)) {
				$data[$key] = array();
				$data[$key]['id'] = $row['id'];
				$data[$key]['album_id'] = $row['album_id'];
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
	// }	
?>


