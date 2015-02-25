<?include("./include/config.php");?>
<?include("./include/db.php");?>
<?include("./include/functions.php");?>
<?include("./include/validation.php");?>
<?include("./include/listing.php");?>

<? $db= new db();$db->connect(); 
   $valid = new validation();
?>
<? if(isset($_GET["_task"]) && $_GET["_task"]=="D"){
	$tb = $_GET["t"];
	$id = $_GET["id"];
	$sid = $_GET["sid"];print_r($_GET);exit;
	if($tb=="main"){	
		//$db->execute("DELETE FROM ".TBL_SUBMENUS." WHERE menuid='".$id."'");
		//$db->execute("DELETE FROM ".TBL_MENUS." WHERE id='".$id."'");
	}else{
		//$db->execute("DELETE FROM ".TBL_SUBMENUS." WHERE menuid='".$id."' and id='".$sid."'");
	}
}
?>
<? include("include_member/header.php");?>
<tr>
<td align="center" coslpan="2">
	<table border="0" cellpadding="0" cellspacing="0" width="70%">
		<tr>
			<td align="center"><? $valid->show();?></td>
		</tr>
	</table>
</td>
</tr>
<tr>
<td align="center" colspan="2">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="center">
			<? 
				include("include_member/displayerror.php"); 
			?>
			</td>
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
					<? 
						$result = $db->execute("SELECT * FROM albums ORDER BY 1 DESC");
						include("navigationcall.php");
					?>
				</td>
				<td width="10"><? // Seperator --------?> </td>
				<td valign="top">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td class="btitle">Albums &amp; Pictures</td>
						</tr>
					</table><br />
					<table border="0" class="box1" width="100%" cellpadding="0" cellspacing="1" align="center">
						<tr class="th" height="22">
							<td align="center"  width="5%"></td>
							<td align="center"  width="5%">No</td>
							<td align="center"  width="15%">Created Date</td>
							<td align="center"  width="25%">Name</td>
							<td align="center"  width="20%">Album</td>
							<td align="center"  width="10%">Add Picture</td>
							<td align="center"  width="10%">Edit</td>
							<td align="center"  width="10%">Delete</td>
						</tr>
						<?  $subcount=0;
							$treecount=0;
							$style="tr1";						
							//$rs_menu=$db->execute("SELECT id, name, link FROM ".TBL_MENUS." ORDER BY id");
							$album_number=0;			
							while($res = $db->row($result)){			
								$album_number++;
								//$row_menu=$db->row($rs_menu);
						?>
						<tr class="<?=$style?>">
							<td align="center" class="th"><img src=<?=IMGPLUS?> name="img<?=$treecount?>" onclick="DISPLAULISTING('<?=$treecount?>')"/></td>
							<td align="center"><?=$album_number?></td>
							<td align="center" ><label for="main_<?//=$row_menu["id"]?>"><?=$res["date"]?></label></td>
							<td align="center" ><?=$res["name"]?></td>
							<td align="center" ><img src="albums/<?php echo $res["filename"]; ?>" width="200" height="150"></td>
							<td align="center"><a href="picture_add.php?add=<?php echo $res["id"]; ?>"><img src="images/plus.jpg"/></a></td>
							<td align="center"><a href="album_edit.php?edit=<?php echo $res["id"]; ?>"><img src="images/change.png"/></a></td>	
							<td align="center"><a href="album_delete.php?del=<?php echo $res["id"]; ?>&file_name=<?php echo $res["filename"]; ?>"><img src<?=IPDELETE?></a></td>
						</tr>
						<tr>
							<td colspan="8">
							<div id="tree_<?=$treecount?>" style="visibility: hidden; display:none">
								<table border="0" cellspacing="1" cellpadding="1" width="100%" align="center" class="box2">
								<tr class="th" height="22">
									<th align="center"  class="th1" width="5%"></th>
									<th align="center"  class="th1" width="5%">no</th>
									<th align="center"  class="th1" width="20%">Album name</th>
									<th align="center"  class="th1" width="15%">Added Date</th>
									<th align="center"  class="th1" width="20%">picture name</th>
									<th align="center"  class="th1" width="15%">picture</th>
									<th align="center"  class="th1" width="10%">edit</th>
									<th align="center"  class="th1" width="10%">delete</th>
								</tr>
						<?	$style1="tr1";
							$pictures=$db->execute("SELECT albums.name as aname, pictures.id, pictures.album_id, pictures.name as pname, pictures.date, pictures.filename FROM albums LEFT JOIN pictures ON albums.id=pictures.album_id WHERE pictures.album_id='".$res["id"]."'");
							
							$picture_number=0;		
							while($picture_row=$db->row($pictures)){		
								$picture_number++;
							?>
								 <tr class="<?=$style1?>">
									 <td  class="th"></td>
									 <td align="center"><?echo $picture_number?></td>
									 <td align="center" ><?echo $picture_row["aname"]?></td>
									 <td align="center" ><?echo $picture_row["date"]?></td>
									 <td align="center" ><?echo $picture_row["pname"]?></td>		
									 <td align="center"><img src="pictures/<?php echo $picture_row["filename"]; ?>" width="150" height="50"></td>	
									 <td align="center"><a href="picture_edit.php?edit=<?php echo $picture_row["id"]."&album_id=".$res["id"]; ?>"><img src="images/change.png"></a></td>
									 <td align="center"><a href="picture_delete.php?del=<?php echo $picture_row["id"]; ?>&file_name=<?php echo $picture_row["filename"]; ?>"><img src<?=IPDELETE?></a></td>
								</tr>
								<? $style1=="tr1" ? $style1="tr2" : $style1="tr1"; $subcount++;
								}?>
								</table>
							</div>
						<?
							$subcount=0;$treecount++;$style=="tr1" ? $style="tr2" : $style="tr1";
						}?>	
						</td>
						</tr>
						</table>
				</td>
				<td width="20" align="left" valign="top"></td>
			</tr>
		</table>
	</td>
</tr>
<script language="javascript">
	function DISPLAULISTING(tn){
			dv = document.getElementById("tree_"+tn);
				if(dv.style.visibility=="hidden"){
						dv.style.visibility="visible";
						dv.style.display="block";
						document.images['img'+tn].src="images/btn_mins.gif"; 
					}
				else{
						dv.style.visibility="hidden";
						dv.style.display="none";
						document.images['img'+tn].src="images/btn_plus.gif"; 
				}
					
		}
		
	function SELECTALL(st,en){
		aleret(st);
		for(x=st;x<=en;x++){
			document.frmedit.x.checked=true;
		}
	}
</script>
<? include("./include_member/footer.php");?>