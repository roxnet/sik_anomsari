<?php 
session_start();
include_once"../../connt.php";
$id = $_GET['tpfedusrprfl'];
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

    <!-- Fonts from Google Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Mrs+Sheppards&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

	

  </head>

  <body style="overflow-y:hidden">


	<div class="container">
	
	
  <div class="modal-dialog" role="document" >
    <div class="modal-content" style="border-radius:0px">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Atur foto profil </h4>
      </div>
      <div class="modal-body" align="center">
        <div class="row" id="xd">
		<?php
		
		
		$query = mysqli_query($koneksi,"SELECT profil FROM anggota WHERE id_anggota = '$id'");
		$profil = mysqli_fetch_array($query);
		?>
			<div class="" >
				<div id="cropContaineroutput" style="width:300px;height:300px; background-image: url('../../images/profil/<?php echo $profil['profil'];?>');background-size:300px 300px;"></div>
				<input name="profil" type="hidden" id="cropOutput" style="width:50%; padding:5px 4%; margin:20px auto; display:block; border: 1px solid #CCC;" />
				<input name="user" type="hidden" tyle="width:50%; padding:5px 4%; margin:20px auto; display:block; border: 1px solid #CCC;" value="<?php echo $id;?>" />

			</div>		
		
		</div>
      </div>
      <div class="modal-footer">
        <button onclick="batal_simpan()" id="batalsimpanImage" type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		<input type="hidden" name="by" value="<?php echo $_SESSION['id_user']; ?>">
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
				uploadUrl:'../../kontrol/image_control_unit/img_save_to_file.php',
				cropUrl:'../../kontrol/image_control_unit/img_crop_to_file.php', 
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
		var profil			= $('input[name=profil]').val();
		var user		= $('input[name=user]').val();	
		var by			= $('input[name=by]').val();
		
		console.log(user,profil,by);
		
		$.ajax({
			type	:"POST",
			url		:"../../kontrol/image_control_unit/link_profil_to_db.php",
			data  :"do=edit&user="+user+"&profil="+profil+"&by="+by,
			success	: function(data){
					
				//$('#xd').html(data)
				window.location.href = "../admin_layout.php?edit_anggota=yes&id="+data; 
			}
		})
		}
		function batal_simpan(){
		var id			= $('input[name=by]').val();
		console.log(id);
		
		$.ajax({
			type	:"POST",
			url		:"../../kontrol/image_control_unit/link_profil_to_db.php",
			data  :"do=batalprofil&id="+id,
			success	: function(data){
					
				//$('#xd').html(data)
				window.location.href = "../admin_layout.php?edit_anggota=yes&id=<?php echo $id ;?>"; 
			}
		})
		}
	</script>
  </body>
</html>
