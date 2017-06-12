<?php 
include_once"../../connt.php";
$id = $_GET['blggridfraddhdr'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/img/favicon.png">

    <title>croppic</title>

    <!-- Bootstrap core CSS -->
    <link href="../../css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../js/croppic/css/main.css" rel="stylesheet">
    <link href="../../js/croppic/css/croppic.css" rel="stylesheet">

    <!-- Fonts from Google Fonts 
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Mrs+Sheppards&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
-->
	

  </head>

  <body style="overflow-y:hidden">


	<div class="container" align="center" style="padding:50px 50px 50px 100px">
	
	
  <div class="col-md-12" >
    <div class="modal-content" style="border-radius:0px">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Atur Header Postingan </h4>
      </div>
      <div class="modal-body" >
        <div class="row" id="xd">
		<div class="col-md-12" >
		<?php
		
		
		$query = mysqli_query($koneksi,"SELECT * FROM blog WHERE id_artikel = '$id'");
		while($blog = mysqli_fetch_array($query)){
			$id_creator = $blog['id_anggota'];
			$tittle = $blog['tittle'];
			$id_category = $blog['id_category'];
			$content = $blog['content'];
			$head_image = $blog['header'];
			$date_post = $blog['date_post'];
			//$last_update = $blog['id_anggota'];
			$filter = $blog['filter'];
			
			$query2 = mysqli_query($koneksi,"SELECT name FROM anggota WHERE id_anggota = '$id_creator'");
			$creator = mysqli_fetch_array($query2);
			$query3 = mysqli_query($koneksi,"SELECT category FROM bcategory WHERE id_category = '$id_category'");
			$category = mysqli_fetch_array($query3);
		}
		?>
			<div class="col-md-10" >
			<?php //if($head_image != null ){
				//echo '	<div id="cropContaineroutput" style="width:748px;height:200px; background-image:url("'.$head_image.'");background-size:748 200px;"></div>';
			//}else
				echo '<div id="cropContaineroutput" style="width:748px;height:200px; background-image: url("");background-size:300px 300px;"></div>';
			?>
				<input name="header" type="hidden" id="cropOutput" style="width:50%; padding:5px 4%; margin:20px auto; display:block; border: 1px solid #CCC;" />
				<input name="post" type="hidden" tyle="width:50%; padding:5px 4%; margin:20px auto; display:block; border: 1px solid #CCC;" value="<?php echo $id;?>" />
		<?php
		
		echo "<div id='full' align='left' style='display:none'>
				<h2>".$tittle." </h2>
				<p class='post-meta'>Posted by <a href='#'>".$creator['name']."</a> $date_post</p>
				<br/>
				<hr/ style='margin-top:-25px;margin-bottom:5px;'>
				<article>
					".$content."[...]
				</article>
			
				<br/>		
			</div>";
		
		?>		
				
			</div>		
		</div>
		</div>
      </div>
      <div class="modal-footer">
        <button id="seefull" type="button" class="btn btn-default" onclick="showall()">Lihat Postingan</button>
        <button id="minimize" type="button" style="display:none" class="btn btn-default" onclick="minimize()">Sembunyikan Postingan</button>
        <a href="../admin_layout.php?edit_anggota=yes&id=<?php echo $id ;?>" id="batalsimpanImage" type="button" class="btn btn-success" data-dismiss="modal" onclick="simpan()">Lewati>></a>
        <button id="simpanImage" type="button" class="btn btn-primary" style="display:none" onclick="simpan()">Simpan perubahan</button>

		</div>
    </div>
  </div>
	

			<div class="col-lg-4 ">
				<div id="cropContainerPlaceHolder2"></div>
			</div>
		</div>		
	</div>
	

	

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script> 
	<script src=" https://code.jquery.com/jquery-2.1.3.min.js"></script>-->
	
	<script src="../../js/croppic/js/jquery-2.1.3.min.js"></script>
	<script src="../../js/croppic/js/bootstrap.min.js"></script>
	<script src="../../js/croppic/js/jquery.mousewheel.min.js"></script>
   	<script src="../../js/croppic/js/croppic.min.js"></script>
    <script src="../../js/croppic/js/main.js"></script>
    <script>

		
		var croppicContaineroutputOptions = {
				uploadUrl:'../../kontrol/image_control_unit/header_save_to_file.php',
				cropUrl:'../../kontrol/image_control_unit/header_crop_to_file.php', 
				outputUrlId:'cropOutput',
				modal:false,imgEyecandy:false,
				loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
				onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
				onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
				onImgDrag: function(){ console.log('onImgDrag') },
				onImgZoom: function(){ console.log('onImgZoom') },
				onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
				onAfterImgCrop:function(){ console.log('onAfterImgCrop'); $('#simpanImage').css('display',''); $('#batalsimpanImage').css('display','none')},
				onReset:function(){ console.log('onReset') },
				onError:function(errormessage){ console.log('onError:'+errormessage) }
		}
		
		var cropContaineroutput = new Croppic('cropContaineroutput', croppicContaineroutputOptions);

		
	</script>
	<script>
	function simpan(){
		var header			= $('input[name=header]').val();
		var post		= $('input[name=post]').val();	
		
		console.log(post,header);
		
		$.ajax({
			type	:"POST",
			url		:"../../kontrol/image_control_unit/link_header_to_db.php",
			data  :"do=add&post="+post+"&header="+header,
			success	: function(data){
					
				//$('#xd').html(data)
				window.location.href = "../admin_layout.php?post=yes"; 
			}
		})
	};
	function showall(){
		$('#full').css('display',''); 
		$('#seefull').css('display','none'); 
		$('#minimize').css('display',''); 
	};
	function minimize(){
		$('#full').css('display','none'); 
		$('#seefull').css('display',''); 
		$('#minimize').css('display','none');
	}
	</script>
  </body>
</html>
