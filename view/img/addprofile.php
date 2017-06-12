<?php 
	include_once "../../connt.php";
	session_start();
		include ('../kontrol/session_cekker.php');
	$_SESSION['profl'] = uniqid();
	
	 
	$angtny=$_SESSION['anggotanya'];
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
	<!-- Custom CSS -->
    <link href="../../css/sb-admin.css" rel="stylesheet">

	<!-- Morris Charts CSS -->
    <link href="../../css/morris.css" rel="stylesheet">
	
	<!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.min.js"></script>
	<script src="../../assets/js/imgPicker.js"></script>
	
	<!-- Bootstrap
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>-->

</head>
<body>
 <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">Admin Room</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-footer">
                            <a href="#">Read All New Messages</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">View All</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href=""><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="admin_layout.php?dashboard=yes" class="active"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
					<li>
                        <a href="admin_layout.php?post=yes"><i class="fa fa-fw fa-file"></i> Post</a>
                    </li>
					<li>
                        <a href="admin_layout.php?forum=yes"><i class="glyphicon glyphicon-comment"></i> Forum</a>
                    </li>
					<li>
                        <a href="admin_layout.php?anggota=yes"><i class="fa fa-fw fa-list"></i> Anggota</a>
                    </li>
					<li>
                        <a href="admin_layout.php?gallery=yes"> <span class="glyphicon fa-fw glyphicon-picture" aria-hidden="true"></span> Gallery</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">
			
										<!-- Modal -->
											<div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											  	<div style="margin-top:-40px;height:100%;width:100%;">

											  <div class="modal-dialog" >
												<div class="modal-content"style="margin-top:70px;" >
												  <div class="modal-header">
													<h3 class="modal-title" id="myModalLabel">Foto profil</h3>
												  </div>
												  <div class="modal-body">
						  
				<div id="container" align="center">

					<p><img src="../../assets/img/default_avatar.png" class="avatar" width="300" height="300"></p>
					<input type="hidden" id="pprof" name="proff" value="">
					<input name="anggotanya" type="hidden" value="<?php echo $angtny ; ?>">

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
	<!-- Modal -----------------------------------------------------p2-->
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
		var anggotanya	= $("input[name=anggotanya]").val();
		var proffl		= $("input[name=proff]").val();
		
			console.log(anggotanya,proffl);
					
					$.ajax({
						type	:"POST",
						url		:"../../kontrol/proff.php",
						data  :"do=profileAnggota&anggotanya="+anggotanya+"&proffl="+proffl,
						success	: function(data){
							 //window.location.href = "http://localhost/sik_new/view/main.html"; 
							 //if(data == "ok"){
								 //$('#myModalprofil').modal('show');
								 
									//$('#myModalprofil').modal('show');
								 window.location.href = "../admin_layout.php?anggota=yes"; 
								 
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