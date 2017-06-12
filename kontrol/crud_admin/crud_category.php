<?php
	include_once "../../connt.php";
	
	if(isset($_POST['crud'])){
		if($_POST['crud']=='add'){
			$category=$_POST['crud_category'];
			$sql=mysqli_query($koneksi,"insert into category (category) values('".$category."')");
			if($sql){
				$query=mysqli_query($koneksi,"select * from category");
				if(mysqli_num_rows($query)!=0){
					while($kategory=mysqli_fetch_array($query)){
						echo "<option>$kategory[category]</option>";
					}
				}
			}
		}
		
		else if($_POST['crud']=='rename'){
			$category=$_POST['crud_category'];
			$id_category=$_POST['id'];
			$sql=mysqli_query($koneksi,"update category set category='".$category."' where id_category=$id_category ");
			if($sql){
				$query=mysqli_query($koneksi,"select * from category");
				if(mysqli_num_rows($query)!=0){
					while($kategory=mysqli_fetch_array($query)){
						echo "<option>$kategory[category]</option>";
					}
				}
			}
		}
		
		else if($_POST['crud']=='delete'){
			$id_category=$_POST['id'];
			$sql=mysqli_query($koneksi,"delete from category where id_category=$id_category ");
			if($sql){
				$query=mysqli_query($koneksi,"select * from category");
				if(mysqli_num_rows($query)!=0){
					while($kategory=mysqli_fetch_array($query)){
						echo "<option>$kategory[category]</option>";
					}
				}
			}
		}
	}
?>