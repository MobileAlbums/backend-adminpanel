
<?include("./include/config.php");?>
<?include("./include/db.php");?>
<?include("./include/functions.php");?>
<?include("./include/validation.php");?>
<?include("./include/listing.php");?>
<? $db= new db();$db->connect(); $valid = new validation();?>

<? include("./include_member/header.php");?>
<script src="cssjs/upload.js"></script>
<tr>
<td align="center" coslpan="">
	<table border="0" cellpadding="0" cellspacing="0" width="60%">
		<tr>
			<td align="center"><? $valid->show();?></td>		
		</tr>
	</table>
</td>
</tr>
<tr>
<td with="" align="center" colspan="2">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="" align="center">&nbsp;<? include("./include_member/displayerror.php"); ?></td>
			
		</tr>
	</table>
</td>
</tr>
<tr>
	<td colspan="2">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
			    <td width="20" align="left" valign="top"></td>
				<td width="200" valign="top">
					<? include("navigationcall.php");?>
				</td>
				<td width="100"><? // Seperator --------?> </td>
				<td valign="top">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td class="btitle">Add Album</td>
						</tr>
					</table><br />
					<form method="post" action="album_add.php" enctype="multipart/form-data">
					<table border="0" cellpadding="5" cellspacing="0" width="55%" class="box">
					   	<tr>	
							<td width="35%" class="td">Name</td>
							<td class="td"><input type="text" name="name" class="ip" /><?=REQUIRED?></td>
						</tr>
						<tr>
					  		<td class="td" width="">Select</td>
					  		<td class="td"><input type="file" name="image"  onchange="onFileSelected(event,1)"><?=REQUIRED?></td>
				  		</tr>
						<tr>	
					  		<td class="td" width="">Image</td>				  		
							<td>
								<table style=" width:90%;">
									<tbody>
										<tr><td>
											<div class="span3">
												<img id="img_1" class="img-polaroid" name="img_1" src="" style="width:150px;height:150px;">
											</div>
										</td></tr>										
									</tbody>
								</table>
							</td>
				  		</tr>							
				 		<tr>
					  		<td colspan="2" align="center">
							<input type="submit" name="submit" value="Add" class="ip2" />
							</td>
						</tr>
					</table>
					</form>
				</td>
				<td width="15%" align="left" valign="top"></td>
			</tr>
		</table>
	</td>
</tr>
<? include("./include_member/footer.php");?>

<?php 			
if(isset($_POST['submit'])){

	$db = new db();
	$db->connect();

	if($_POST['name'] != "") 
		$name = $_POST['name'];
	else 
		$name = "New Album";

	$date = date('m-d-y');
	$image_tmp= $_FILES['image']['tmp_name'];
	$file_name = $_FILES["image"]["name"];
		
	if($file_name==''){	
		echo "<script>alert('Any of the fields is empty');</script>";
		echo "<script>location.href='menus.php';</script>";
	}else {	
		$insert_query = "INSERT INTO albums VALUES ('','$name','$date','$file_name')";
		
		if(mysql_query($insert_query)){
			$result = $db->execute("SELECT MAX(id) as max_id FROM albums");
			$row = $db->row($result);
			$max_id = $row["max_id"];
			$new_id = $max_id;
			$file_name = "image-".$new_id.".png";
			$db->execute("UPDATE albums SET filename = '".$file_name."' WHERE id = '".$new_id."'");
			move_uploaded_file($image_tmp,"albums/$file_name");	
			
			echo "<script>alert('post published successfuly')</script>";
			echo "<script>location.href='menus.php';</script>";
		}
	}
}
?>

