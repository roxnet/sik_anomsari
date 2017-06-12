<?php 
	include_once "../../connt.php";
	session_start();
		include ('../kontrol/session_cekker.php');
	$_SESSION['profl'] = uniqid();
	
	 
	$pdf=$_SESSION['idpendaftarnya'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Image Picker</title>
	
	<!-- Only for demo -->
	<link rel="stylesheet" href="../../assets/css/demo.css">
	

	<!-- Bootstrap
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">-->
	<!-- Bootstrap Core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../../assets/css/imgPicker.css">
	<script src="../../assets/js/jquery-1.11.0.min.js"></script>
	
	<!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.min.js"></script>
	<script src="../../assets/js/imgPicker.js"></script>
	
	<!-- Bootstrap
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>-->

</head>
<body style='background:url("1.jpg")'>
 <div id="wrapper" >

       

        <div id="page-wrapper" >
			
										<!-- Modal -->
											<div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
											  <div style="margin-top:-40px;height:100%;width:100%;">
											  <div class="modal-dialog" >
												<div class="modal-content" style="margin-top:70px;">
												
												  <div class="modal-header" >
													<h3 class="modal-title" id="myModalLabel">Foto profil</h3>
												  </div>
												  <div class="modal-body">
						  
				<div id="container" align="center">

					<p><img src="../../images/profil/default_avatar.png" class="avatar" width="300" height="300"></p>
					<input type="hidden" name="proff" id="pprof" >
					<input type="hidden" name="pendaftar" value="<?php echo $pdf; ?>">

				</div>
													<div class="modal-footer">
														
					<button type="button" class="edit_avatar btn btn-info" data-toggle="modal" data-target="#myModal">Ubah foto profil</button>
					<button type="button" class="btn btn-success cleare" id="saves">Lewati >></button>
																		
													</div>
													</div><!-- /.modal-content -->
												  </div><!-- /.modal-dialog -->
												</div><!-- /.modal -->


					</div>
				</div>
	<!-- Modal --------------------------------------------------------p2-->
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
						<div class="modal-content">
						  <div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Upload dan atur ukuran foto</h4>
						  </div>
						  <div class="modal-body" style="min-height:420px;width:400px">
							<div class="row">
								<div class="col-md-12 col-md-offset-3">
									<div id="cropper"></div>
								</div>
							</div>
						  </div>
						  
							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
							</div>
						  
						</div><!-- /.modal-content -->
					  </div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
					
					
					
								<!-- Modal   Konfirmasi -->
			<div class="modal fade" id="daftarOk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-top:-30px">
			  <div style="width:100%">
			  <div class="modal-dialog modal-lg" role="document" >
				<div class="modal-content" style="border-radius:0px;">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><div class="alert alert-success">Berhasil mendaftar</div></h4>
				  </div>
				   <div class="modal-body">
						<div><h4>Pendaftaran anda telah berhasil dikirim,<br/> anda akan mendapatkan konfirmasi lewat E-Mail yang telah anda daftarkan,<br/> jika telah mendapat persetujuan pengurus.</h4></div>
				  </div>
				  <div class="modal-footer" >
					<div style="margin-bottom:20px">
					<div id="konfirmasi_daftar"></div>
					
						<a href="../main.html" class="btn btn-default" >OK</a>
						</form>		
					</div>
				  </div>
				</div>
			  </div>
			  </div>
			</div>
	
	</div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

	<script>
	
		$(function() {
			// Avatar
			$('.edit_avatar').imgPicker({
				el: '.avatar',
				type: 'avatar',
				minWidth: 400,
				minHeight: 400,
				title: 'Change your avatar',
				// Inline cropper, inside Bootstrap modal
				inline: '#cropper',
				// Success callback
				complete: function() {
					// Hide modal
					$('#myModal').modal('hide');
					$('#pprof').val("avatar<?php 	echo $_SESSION['profl'] ;?>.jpg");

					$('.cleare').text('simpan');
				}
			});
		});
	</script>
	<script type="text/javascript">
		$(window).load(function(){			
			$('#profile').modal('show');
			$('#pprof').val('default_avatar.png');
		});
		
	</script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('.cleare').on("click", function (){
		var pndaftar	= $("input[name=pendaftar]").val();
		var proffl		= $("input[name=proff]").val();
		
			console.log(pndaftar,proffl);
					
					$.ajax({
						type	:"POST",
						url		:"../../kontrol/proff.php",
						data  :"do=profile&pndaftar="+pndaftar+"&proffl="+proffl,
						success	: function(data){
							 //window.location.href = "http://localhost/sik_new/view/main.html"; 
							 //if(data == "ok"){
								 //$('#myModalprofil').modal('show');
								 
									$('#daftarOk').modal('show');
								// window.location.href = "../login.php"; 
								 
								//}
								//else {
									//$("#konfirmasi_daftar").html(data);
									//$('#myModalprofil').text(data);
								//}
						}
					});
		});
	});
	</script>
</body>
</html>