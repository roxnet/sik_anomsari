<?php
	include_once "../../connt.php";
	
if(isset($_POST['crud'])){
	
	if($_POST['crud'] == 'sendNew'){
		$creator = mysqli_real_escape_string($koneksi,$_POST['creator']);
		$tittle = mysqli_real_escape_string($koneksi,$_POST['tittle']);
		$content = mysqli_real_escape_string($koneksi,$_POST['content']);
		
		$created_at = date("Y-m-d");
		
		$Send = mysqli_query($koneksi,"INSERT INTO pengumuman (id_creator, tittle, content, image, created_at, edited_at) VALUES('$creator','$tittle','$content','','$created_at','')");
		echo "ok";
	}
	else if($_POST['crud'] == 'view'){
		$id_pngmmn = $_POST['id'];
		
		$take_pengumuman = mysqli_query($koneksi,"SELECT * FROM pengumuman WHERE id_pengumuman = '$id_pngmmn'");
		
		while($notice = mysqli_fetch_assoc($take_pengumuman)){
					$creator1 = mysqli_query($koneksi,"SELECT name FROM anggota WHERE id_anggota = '".$notice['id_creator']."'");
							$ct1 = mysqli_fetch_array($creator1);
	echo '
			<div class="modal-body" style="">
			<div class="row">
				<div class="col-md-12">
				<span class="pull-right"><i class="glyphicon glyphicon-user"></i>'.$ct1['name'].'<br/>
				<i class="glyphicon glyphicon-time"></i> '.date("d F Y", strtotime($notice['created_at'])).'</span>
					<h3>'.$notice['tittle'].' <hr/><h3>
				</div>
				<div class="col-md-12">
					<p>'.$notice['content'].'</p>
					
				</div>
			</div></div>
			
			
			<div class="modal-footer" >
				<button id="closed" type="button" class="btn btn-default" data-toggle="modal"  data-dismiss="modal">Close</button>

			</div>
	';			
		}

	}
	else if($_POST['crud'] == 'edit'){
			$id_pngmmn = $_POST['id'];
		
			$take_pengumuman = mysqli_query($koneksi,"SELECT * FROM pengumuman WHERE id_pengumuman = '$id_pngmmn'");
			
			while($notice = mysqli_fetch_assoc($take_pengumuman)){
						$creator1 = mysqli_query($koneksi,"SELECT name FROM anggota WHERE id_anggota = '".$notice['id_creator']."'");
								$ct1 = mysqli_fetch_array($creator1);
						$data = array(
								"id_p" => $notice['id_pengumuman'],
								"tittle" => $notice['tittle'],
								"content" => $notice['content'],
								"creator" => $ct1['name']
							);
					echo json_encode($data);
			}
	}
		else if($_POST['crud'] == 'sendedit'){
			$id_p = $_POST['id_p'];
			$tittle = mysqli_real_escape_string($koneksi,$_POST['tittle']);
			$content = mysqli_real_escape_string($koneksi,$_POST['content']);
			
			$edited_at = date("Y-m-d");
			
			$Send_update = mysqli_query($koneksi,"UPDATE pengumuman SET tittle='$tittle', content='$content', edited_at='$edited_at' WHERE id_pengumuman = '$id_p'");
			echo "ok";
		}
	else if($_POST['crud'] == 'delll'){
		$id_pngmmn = $_POST['id'];
		
		$take_pengumuman = mysqli_query($koneksi,"SELECT * FROM pengumuman WHERE id_pengumuman = '$id_pngmmn'");
		
		while($notice = mysqli_fetch_assoc($take_pengumuman)){
					$creator1 = mysqli_query($koneksi,"SELECT name FROM anggota WHERE id_anggota = '".$notice['id_creator']."'");
							$ct1 = mysqli_fetch_array($creator1);
	echo '
			<div class="modal-body" style="">
			<div class="row">
				<div class="col-md-12">
				<span class="pull-right"><i class="glyphicon glyphicon-user"></i>'.$ct1['name'].'<br/>
				<i class="glyphicon glyphicon-time"></i> '.date("d F Y", strtotime($notice['created_at'])).'</span>
					<h3>'.$notice['tittle'].' <hr/><h3>
				</div>
				<div class="col-md-12">
					<p>'.$notice['content'].'</p>
					
				</div>
			</div></div>
			
			
			<div class="modal-footer" >
				<button id="closed" type="button" class="btn btn-default" data-toggle="modal"  data-dismiss="modal">Close</button>
				<button id="'.$notice['id_pengumuman'].'" type="button" class="btn btn-danger delit" >Hapus</button>

			</div>
			<script>
				$(".delit").on("click", function (){
					var id	= $(this).attr("id");
					console.log(id);
					$.ajax({
						method	:"POST",
						url		:"../kontrol/crud_admin/crud_pengumuman.php",
						data	:"crud=destroyit&id="+id,
						success	: function(){
								location.reload();
						}
					})
				});
			</script>
	';			
		}

	}
		else if($_POST['crud'] == 'destroyit'){
			$id_p=$_POST['id'];
			$sql=mysqli_query($koneksi,"DELETE FROM pengumuman WHERE id_pengumuman=$id_p ");
			if($sql){
				echo "destroy sukses";
			}
		}
}

?>