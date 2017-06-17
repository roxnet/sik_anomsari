<?php
include_once "../../connt.php";
session_start();


if($_POST["crud"] == "selecttahun"){
	
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
								'.date("d F Y", strtotime($alb["created_at"])).'<br/></div>
								<a href="layout_user.php?lihat_album=yes&id_album='.$alb["id_album"].'" class="btn btn-xs btn-success " type="submit" onclick="">Lihat Album</a>
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
								'.date("d F Y", strtotime($alb["created_at"])).'<br/></div>
								<a href="layout_user.php?lihat_album=yes&id_album='.$alb["id_album"].'" class="btn btn-xs btn-success " type="submit" onclick="">Lihat Album</a>
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
								'.date("d F Y", strtotime($alb["created_at"])).'<br/></div>
								<a href="layout_user.php?lihat_album=yes&id_album='.$alb["id_album"].'" class="btn btn-xs btn-success " type="submit" onclick="">Lihat Album</a>
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