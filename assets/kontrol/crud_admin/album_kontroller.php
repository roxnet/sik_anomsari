<?php
include_once "../../connt.php";
session_start();

if($_POST["crud"] == "buatalbum"){
	
	$creator = $_POST["creator"];
	$judul = $_POST["nama_album"];
	$keterangan = $_POST["keterangan_albm"];
	$create_at = date("Y-m-d");
	
	$sqlinallbm = mysqli_query($koneksi,"INSERT INTO album(id_creator,judul_album,keterangan_album,created_at,edited_at) VALUES ('$creator','$judul','$keterangan','$create_at','$create_at')");
	$its = mysqli_insert_id($koneksi);
	$take_id = mysqli_query($koneksi, "SELECT id_album FROM album WHERE id_album = $its");
	$far = mysqli_fetch_array($take_id);
	echo $far["id_album"];

}
else if ($_POST["crud"] == "delimgs"){
	$for_dell = $_POST["for_dell"];
	$albm_rejq = $_POST["albm_rejq"];
	
	$path = "../../images/gallery/".$for_dell;
	$path2 = "../../images/gallery/thumb/".$for_dell;
	
	unlink($path);
	unlink($path2);
	
	$dellllll = mysqli_query($koneksi,"DELETE FROM images WHERE name_img = '$for_dell' ");
	
	
          $sql = mysqli_query($koneksi,"SELECT * FROM images WHERE id_album = '$albm_rejq'");
            $ii=0;
            while($img = mysqli_fetch_assoc($sql )){
				$ii++;
				
                    echo '
					<div class="col-md-3" style="margin-top:10px;border:2px solid gray">
						<div>
							<a href="../images/gallery/'.$img["temp_img"].'" target="_blank">
							  <img src="../images/gallery/thumb/'.$img["name_img"].'" alt="'.$img["name_img"].'" width="200">
							</a>
						</div>					
						<div>
						
							<input type="hidden" name="for_dell" value="'.$img["name_img"].'" id="nameimg'.$ii.'"/>
							<input type="hidden" name="albm_rejq" value="'.$img["id_album"].'" />
							<button class="btn btn-danger col-md-3" type="submit" onclick="del_imgs('.$ii.')">Hapus</button>
						</div>
					</div>
						';
                 
               
              }
			  
	echo '
			
		<script>
				function del_imgs(id){
					var for_dell	= $("#nameimg"+id).val();
					var albm_rejq	= $("input[name=albm_rejq]").val();
				console.log(for_dell,albm_rejq);
				$.ajax({
					type	:"POST",
					url		:"../kontrol/crud_admin/album_kontroller.php",
					data	:"crud=delimgs&for_dell="+for_dell+"&albm_rejq="+albm_rejq,
					success	: function(data){
							$("#images_list").html(data); 
					}
				})
				
			}
		</script>
			';
	
}   

else if($_POST["crud"] == "editnama"){
	
	$idalbum = $_POST["idnya"];
	$judulnya = $_POST["judulnya"];
	$keterangannya = $_POST["keterangannya"];
	$NOW=date();
	
	$sqlinallbm = mysqli_query($koneksi,"UPDATE album SET judul_album='$judulnya' ,keterangan_album='$keterangannya' ,edited_at='$NOW' WHERE id_album='$idalbum'");

}
else if($_POST["crud"] == "destroyalbum"){
	
	$idalbum = $_POST["for_dellalbm"];
	
	$ambil = mysqli_query($koneksi,"SELECT * FROM images WHERE id_album = '$idalbum'");
	while ($fotos = mysqli_fetch_assoc($ambil)){
		$path = "../../images/gallery/".$fotos['name_img'];
		$path2 = "../../images/gallery/thumb/".$fotos['temp_img'];
	
		unlink($path);
		unlink($path2);
	}
	
	$buangalbum = mysqli_query($koneksi,"DELETE FROM album WHERE id_album ='$idalbum' ");
	

}
else if($_POST["crud"] == "selecttahun"){
	
	$tahunnya = $_POST["select"];
	
	$allalbum = mysqli_query($koneksi, "SELECT * FROM album ORDER BY id_album DESC");
		if($tahunnya == "all"){
			 while($alb = mysqli_fetch_assoc($allalbum )){
				 
					$deff = mysqli_query($koneksi,"SELECT name_img FROM images WHERE id_album = '".$alb["id_album"]."' LIMIT 1");
					$take_pitch = mysqli_fetch_array($deff);
						echo '
						<div class="col-md-3">
							<div class="panel panel-default">
							  <div class="panel-body" align="center">
								<img src="../images/gallery/thumb/'.$take_pitch["name_img"].'" width="200" >
							  </div>
							  <div class="panel-footer" style="min-height:107px">
								<div style="min-height:65px">'.$alb["judul_album"].'<br/>
								'.$alb["created_at"].'<br/></div>
								<a href="admin_layout.php?edit_album=yes&id_album='.$alb["id_album"].'" class="btn btn-xs btn-success " type="submit" onclick="">Lihat / Edit / Hapus album</a>
								<!--<button class="btn btn-xs btn-danger " type="submit" onclick="">Hapus</button>-->
								
							  </div>
							</div>
						</div>
							';
                 
               
				
			 }

		}  else {
			while($alb = mysqli_fetch_assoc($allalbum )){
				 $thistheyear = date("Y", strtotime($alb["created_at"]));
				 
				 if($thistheyear == $tahunnya){
					$deff = mysqli_query($koneksi,"SELECT name_img FROM images WHERE id_album = '".$alb["id_album"]."' LIMIT 1");
					$take_pitch = mysqli_fetch_array($deff);
						echo '
						<div class="col-md-3">
							<div class="panel panel-default">
							  <div class="panel-body" align="center">
								<img src="../images/gallery/thumb/'.$take_pitch["name_img"].'" width="200" >
							  </div>
							  <div class="panel-footer" style="min-height:107px">
								<div style="min-height:65px">'.$alb["judul_album"].'<br/>
								'.$alb["created_at"].'<br/></div>
								<a href="admin_layout.php?edit_album=yes&id_album='.$alb["id_album"].'" class="btn btn-xs btn-success " type="submit" onclick="">Lihat / Edit / Hapus album</a>
								<!--<button class="btn btn-xs btn-danger " type="submit" onclick="">Hapus</button>-->
								
							  </div>
							</div>
						</div>
							';
                 
               
				}
			 }
		}
}
else if($_POST["crud"] == "cari"){
	
	$namanyaalbum = $_POST["nama"];
		$alalbumslct = mysqli_query($koneksi, "SELECT * FROM album WHERE judul_album = '$namanyaalbum'");
	$cekup = mysqli_num_rows($alalbumslct);
	
	if($cekup == 1 ){
	while($alb = mysqli_fetch_assoc($alalbumslct)){
				 
					$deff = mysqli_query($koneksi,"SELECT name_img FROM images WHERE id_album = '".$alb["id_album"]."' LIMIT 1");
					$take_pitch = mysqli_fetch_array($deff);
						echo '
						<div class="col-md-3">
							<div class="panel panel-default">
							  <div class="panel-body" align="center">
								<img src="../images/gallery/thumb/'.$take_pitch["name_img"].'" width="200" >
							  </div>
							  <div class="panel-footer" style="min-height:107px">
								<div style="min-height:65px">'.$alb["judul_album"].'<br/>
								'.$alb["created_at"].'<br/></div>
								<a href="admin_layout.php?edit_album=yes&id_album='.$alb["id_album"].'" class="btn btn-xs btn-success " type="submit" onclick="">Lihat / Edit / Hapus album</a>
								<!--<button class="btn btn-xs btn-danger " type="submit" onclick="">Hapus</button>-->
								
							  </div>
							</div>
						</div>
							';
                 
               
				
			 }
	}else 
		echo '<h4>Tidak ditemuan album dengan anama '.$namanyaalbum.'</h4>';
	
}

?>