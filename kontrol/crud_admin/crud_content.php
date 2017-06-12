<?php
	include_once "../../connt.php";
	
	if(isset($_POST['crud'])){
		if($_POST['crud']=='add'){
			$id_anggota=$_POST['id_anggota'];
			$judul=$_POST['judul'];
			$category=$_POST['category'];
			$content=addslashes($_POST['content']);
			$filter=$_POST['filter'];
			if ($category=='-')
				$category='Uncategory';
			$date=date("Y-m-d H:i:s");
			$sql=mysqli_query($koneksi,"insert into blog (id_anggota,tittle,id_category,content,filter,date_post) 
										values('".$id_anggota."','".$judul."','".$category."','".$content."','".$filter."','".$date."')") or die (mysqli_error($koneksi));
					if($sql){
						echo "<div class='alert alert-info' role='alert'>Content Berhasil di Posting</div>";
							}
					else die("<div class='alert alert-danger' role='alert'>Gagal Posting Content</div>");
		}
		else if($_POST['crud']=='edit'){
			$id_artikel=$_POST['id_artikel'];
			$id_anggota=$_POST['id_anggota'];
			$judul=$_POST['judul'];
			$category=$_POST['category'];
			$content=addslashes($_POST['content']);
			$filter=$_POST['filter'];
			if ($category=='-')
				$category='Uncategory';
			$date=date("Y-m-d H:i:s");
			$sql=mysqli_query($koneksi,"update blog set id_anggota='".$id_anggota."' ,tittle='".$judul."',id_category='".$category."',content='".$content."',filter='".$filter."',last_update='".$date."' 
										where id_artikel='".$id_artikel."'");
					if($sql){
						echo "<div class='alert alert-info' role='alert'>Content Berhasil di Posting</div>";
							}
					else die("<div class='alert alert-danger' role='alert'>Gagal Posting</div>");
		}
		else if($_POST['crud']=='delete'){
			$id_delete=$_POST['delete'];
			$sql=mysqli_query($koneksi,"delete from blog where id_artikel='$id_delete'");
					if($sql){
						echo "<div class='alert alert-info' role='alert'>Content Berhasil di Dihapus</div>";
							}
					else die("<div class='alert alert-danger' role='alert'>Gagal Hapus Content</div>");
		}
	}
	
?>