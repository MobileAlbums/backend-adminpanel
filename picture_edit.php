

<html>
	<head>
		<title>Admin Panel</title>
	
	<!--  <link rel="stylesheet" href="admin_style.css" />-->
	</head>
	
<body>
<?include("./include/config.php");?>
<?include("./include/db.php");?>
<?include("./include/functions.php");?>
<?include("./include/validation.php");?>
<?include("./include/listing.php");?>
<? $db= new db();$db->connect(); $valid = new validation();?>

<?
if(isset($_GET['edit'])){ 

	$edit_id = $_GET['edit'];
	$album_id = $_GET['album_id'];
	
	$db = new db();
	$db->connect();
	$edit_query = "select *from pictures where id='$edit_id'";
	$run_edit = mysql_query($edit_query); 
	
	$edit_row=mysql_fetch_array($run_edit);
	$id = $edit_row['id'];
	$photo_id = $edit_row['album_id'];
	$name = $edit_row['name'];
	$file_name = $edit_row['filename'];
}
?>

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
							<td class="btitle">Edit Picture</td>
						</tr>
					</table><br />
					<form method="post" action="picture_edit.php?edit_form=<?php if(isset($edit_id)) echo $edit_id; ?>&album_id=<?php if(isset($album_id)) echo $album_id; ?>" enctype="multipart/form-data">
					<table border="0" cellpadding="5" cellspacing="0" width="55%" class="box">
					   	<tr>	
							<td width="35%" class="td">Name</td>
							<td class="td"><input type="text" name="name"  value="<?php if(isset($name)) echo $name; ?>" class="ip" /><?=REQUIRED?></td>
						</tr>		
						<tr>
					  		<td class="td" width="">Select</td>
					  		<td class="td"><input type="file" name="image"   onchange="onFileSelected(event,1)"><?=REQUIRED?></td>
				  		</tr>	
					  		<td class="td" width="">Image</td>
					  		<td class="td">
								<table style=" width:90%;">
									<tbody>
										<tr><td>
											<div class="span3">
												<img id="img_1" class="img-polaroid" name="img_1" src="<?php if(isset($file_name)) echo "pictures/".$file_name; ?>" style="width:150px;height:150px;">
											</div>
										</td></tr>										
									</tbody>
								</table>
							</td>
				  		</tr>							
				 		<tr>						
				 		<tr>
					  		<td colspan="2" align="center">
							<input type="submit" name="update" value="Update Now" class="ip2" />
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
	if(isset($_POST['update'])){	
	$update_id = $_GET['edit_form'];
	$album_id = $_GET["album_id"];						
	$db = new db();
	$db->connect();	

	if($_POST['name'] != "") 
		$name = $_POST['name'];
	else 
		$name = "New Picture";									

	$date = date('m-d-y');
	$image_tmp= $_FILES['image']['tmp_name'];
	$file_name = $_FILES["image"]["name"];	
	$file_name = "image-".$album_id."-".$update_id.".png";

		if($file_name==''){
			echo "<script>alert('Input correct')</script>";
			exit();
		}else { 
			$query = "update pictures set name='$name',filename='$file_name' where id='$update_id'";		
			if(mysql_query($query)){ 
				move_uploaded_file($image_tmp,"pictures/$file_name");
				echo "<script>alert('success');</script>";
				echo "<script>window.open('menus.php','_self')</script>";
			}
	
		}
	}



?>