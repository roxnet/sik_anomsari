<?php
	include_once "../../connt.php";
	
	if(isset($_POST['crud'])){
		if($_POST['crud']=='add'){
			$keluarga=$_POST['crud_keluarga'];
			$sql=mysqli_query($koneksi,"insert into keluarga (nama_keluarga) values('".$keluarga."')");
			if($sql){
				$query=mysqli_query($koneksi,"select * from keluarga");
				if(mysqli_num_rows($query)!=0){
					while($kategory=mysqli_fetch_array($query)){
						echo "<option>$kategory[nama_keluarga]</option>";
					}
				}
			}
		}
		
		else if($_POST['crud']=='rename'){
			$keluarga=$_POST['crud_keluarga'];
			$id_keluarga=$_POST['id'];
			$sql=mysqli_query($koneksi,"update keluarga set nama_keluarga='".$keluarga."' where id_keluarga=$id_keluarga ");
			if($sql){
				$query=mysqli_query($koneksi,"select * from keluarga");
				if(mysqli_num_rows($query)!=0){
					while($kategory=mysqli_fetch_array($query)){
						echo "<option>$kategory[nama_keluarga]</option>";
					}
				}
			}
		}
		
		else if($_POST['crud']=='delete'){
			$id_keluarga=$_POST['id'];
			$sql=mysqli_query($koneksi,"delete from keluarga where id_keluarga=$id_keluarga ");
			if($sql){
				$query=mysqli_query($koneksi,"select * from keluarga");
				if(mysqli_num_rows($query)!=0){
					while($kategory=mysqli_fetch_array($query)){
						echo "<option>$kategory[nama_keluarga]</option>";
					}
				}
			}
		}
	}
?>