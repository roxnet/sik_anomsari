<?php
include_once "../connt.php";
/*
  @author: Shahrukh Khan
  @website: http://www.thesoftwareguy.in
  @facebook fanpage: https://www.facebook.com/Thesoftwareguy7
 */
error_reporting(E_ALL & ~E_NOTICE);
@ini_set('post_max_size', '64M');
@ini_set('upload_max_filesize', '64M');

/* * *********************************************** */

	$album_id = $_POST["idalbm"];



// include resized library
  require_once('../php-image-magician/php_image_magician.php');
  $msg = "";
  $valid_image_check = array("image/gif", "image/jpeg", "image/jpg", "image/png", "image/bmp");
  if (count($_FILES["user_files"]) > 0) {
    $folderName = "../images/gallery/";
    for ($i = 0; $i < count($_FILES["user_files"]["name"]); $i++) {

      if ($_FILES["user_files"]["name"][$i] <> "") {

        $image_mime = strtolower(image_type_to_mime_type(exif_imagetype($_FILES["user_files"]["tmp_name"][$i])));
        // if valid image type then upload
        if (in_array($image_mime, $valid_image_check)) {

          $ext = explode("/", strtolower($image_mime));
          $ext = strtolower(end($ext));
          $filename = rand(10000, 990000) . '_' . time() . '.' . $ext;
          $filepath = $folderName . $filename;

          if (!move_uploaded_file($_FILES["user_files"]["tmp_name"][$i], $filepath)) {
            $emsg .= "Failed to upload <strong>" . $_FILES["user_files"]["name"][$i] . "</strong>. <br>";
            $counter++;
          } else {
            $smsg .= "<strong>" . $_FILES["user_files"]["name"][$i] . "</strong> uploaded successfully. <br>";

            $magicianObj = new imageLib($filepath);
            $magicianObj->resizeImage(250, 250);
            $magicianObj->saveImage($folderName . 'thumb/' . $filename, 100);

            /*             * ****** insert into database starts ******** */
				
					$img_todb = mysqli_query($koneksi,"INSERT INTO images(id_album,name_img,temp_img) VALUES('$album_id','$filename','$filename')");
				
            /*             * ****** insert into database ends ******** */
          }
        } else {
          $emsg .= "<strong>" . $_FILES["user_files"]["name"][$i] . "</strong> not a valid image. <br>";
        }
      }
    }

		echo '
			<cdript>
				
			</scripnt>
		';
	
	
    $msg .= (strlen($smsg) > 0) ? successMessage($smsg) : "";
    $msg .= (strlen($emsg) > 0) ? errorMessage($emsg) : "";
  } 

?>
<!DOCTYPE html>
<html>
  <head>
    
    <style>
      .files{height: 30px; margin: 10px 10px 0 0;width: 250px; }
      .add{ font-size: 14px; color: #EB028F; border: none; }
      .rem a{ font-size: 14px; color: #f00; border: none; }
      .submit{width: 110px; height: 30px; background: #6D37B0; color: #fff;text-align: center;}
	  
	  .btn-file {
			position: relative;
			overflow: hidden;
		}
		.btn-file input[type=file] {
			position: absolute;
			top: 0;
			right: 0;
			min-width: 100%;
			min-height: 100%;
			font-size: 100px;
			text-align: right;
			filter: alpha(opacity=0);
			opacity: 0;
			outline: none;
			background: white;
			cursor: inherit;
			display: block;
		}
    </style>
    
  </head>
  <body>
  <div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Buat Album</h1>
	</div>
  </div>
   <div id="container">
      <div id="body">
        <article>
			   <!--form name="f1" action="base.php" method="post" enctype="multipart/form-data">-->
			  <?php if($album_id == null){
				   echo'
			   <div id="bording">
			   
					<a href="admin_layout.php?gallery=yes" class="btn btn-default" type="button" ><span class="glyphicon glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Kembali ke galeri</a>
					<hr/>   
			   
						<input type="hidden" name="creator_id" value="'.$_SESSION['id_user'].'">
				<div class="form-group col-md-10">
					<div class="col-md-10">
						<label for="exampleInputPassword1">Judul album</label>
					</div>
					<div class="col-md-5">
						<input type="text" name="albm_judul" class="form-control" id="albumname" placeholder="masukkan judul album">
					</div>
				 </div>				
				<div class="form-group col-md-10">
					<div class="col-md-10">
						<label for="exampleInputPassword1">Keterangan seputar album</label>
					</div>
					<div class="col-md-5">
						<textarea name="ket_albm" id="album_ket" class="form-control" rows="2"></textarea>
					</div>
				 </div>
				 <div class="form-group col-md-10">
					<div class="col-md-10">
					<form name="f1" action="" method="post" enctype="multipart/form-data">
						<input type="hidden" name="idalbm" id="cekto">  
						<span class="btn btn-default btn-file" id="takeoff" onclick="createAlbm()">
							Buat album & tambahkan foto
							<input class="files" name="user_files[]" type="file" onchange="f1.submit()" multiple="multiple" >
						</span>
					</form>
					</div>
				 </div>
                <!--<div><input type="submit" class="submit" name="sub1" value="Upload Images" /> </div>
				</form>-->
				</div>  <!--bording end -->
				
				';
			  }
			?>
				
				</div>
          <div class="height10"></div>
          <?php
		  
		  if($album_id != null){
          // fetch all records
		  $takealbm = mysqli_query($koneksi,"SELECT * FROM album WHERE id_album = '$album_id'");
		  $the_album = mysqli_fetch_array($takealbm);
		  
	echo '<div class="container">
			<h3><b>Album '.$the_album["judul_album"].'</b></h3>
			<h5>Keteranga :
							'.$the_album["keterangan_album"].'			</h5><hr/>
							
			
					
			<div class="row" >
				<div class="col-md-11" id="images_list">';
          $sql = mysqli_query($koneksi,"SELECT * FROM images WHERE id_album = '$album_id'");
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
			  
	echo '		</div>
			</div>
							<hr/>	
					<div>'.date("d F Y", strtotime($the_album["created_at"])).'</div>
			<div class="col-md-11">
					<dic class="pull-right"> 
								<a href="admin_layout.php?gallery=yes" class="btn btn-primary " type="submit">Simpan album</a> |
								<a href="admin_layout.php?edit_album=yes&id_album='.$album_id.'" class="btn btn-success " type="submit">Edit album</a> |
								<button class="btn btn-danger " type="" onclick="del_albm()">Hapus album</button>
								<input type="hidden" id="idalnmnya" value="'.$album_id.'">
					</div>
			</div>
		</div>';
		
		  }
              ?>
          <div class="height10"></div>
        </article>
      </div>
    </div>

  </body>

	
	<script>
	function createAlbm(){  
		var creator = $('input[name=creator_id]').val();
		var nama_album	= $('input[name=albm_judul]').val();
		var keterangan_albm	= $('textarea[name=ket_albm]').val();
		console.log(creator,nama_album,keterangan_albm);
		$.ajax({
			type	:"POST",
			url		:"../kontrol/crud_admin/album_kontroller.php",
			data	:"crud=buatalbum&creator="+creator+"&nama_album="+nama_album+"&keterangan_albm="+keterangan_albm,
			success	: function(data){
					//$("#keluarga").html(data);
					$('#cekto').val(data); 
					//$('#fcommm')[0].reset();
					//$('#bording').css('display','none');
					//window.location.replace("admin_layout.php?edit_album=yes&id_album=15");	
					//$("#modal_alert").html("<div class='alert alert-success' role='alert'>Keluarga Berhasil Ditambah</div>");
					
			}
		})
	}; 
	function del_imgs(id){
			var for_dell	= $('#nameimg'+id).val();
			var albm_rejq	= $('input[name=albm_rejq]').val();
		console.log(for_dell,albm_rejq);
		$.ajax({
			type	:"POST",
			url		:"../kontrol/crud_admin/album_kontroller.php",
			data	:"crud=delimgs&for_dell="+for_dell+"&albm_rejq="+albm_rejq,
			success	: function(data){
					$('#images_list').html(data); 
			}
		})
		
	};
	function del_albm(){
			var for_dellalbm= $('#idalnmnya').val();
		console.log(for_dellalbm);
		$.ajax({
			type	:"POST",
			url		:"../kontrol/crud_admin/album_kontroller.php",
			data	:"crud=destroyalbum&for_dellalbm="+for_dellalbm,
			success	: function(data){
					window.location.replace('admin_layout.php?gallery=yes');
			}
		})
		
	}; 
	</script>

<?php

function errorMessage($str) {
  return '<div style="width:50%; margin:0 auto; border:2px solid #F00;padding:2px; color:#000; margin-top:10px; text-align:center;">' . $str . '</div>';
}

function successMessage($str) {
  return '<div style="width:50%; margin:0 auto; border:2px solid #06C;padding:2px; color:#000; margin-top:10px; text-align:center;">' . $str . '</div>';
}
?>
