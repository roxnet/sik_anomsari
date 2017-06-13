<?php
include_once('../connt.php');

session_start();
$selectUser=mysqli_query($koneksi, "SELECT nickname,profil,level_user AS level FROM anggota where id_anggota='".$_SESSION['id_user']."'");
while($user=mysqli_fetch_assoc($selectUser)){
	$nameUser = $user['nickname'];
	$profil = $user['profil'];
	$level = $user['level'];
}

$pengumuman = mysqli_query($koneksi,"SELECT * FROM pengumuman ORDER BY id_pengumuman DESC LIMIT 5");

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Clean Blog</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Main CSS -->
   <link href="../css/main.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <div id="wrapper">

        <!-- Navigation -->
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
          <div class="container">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        Menu <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="index.html">Start Bootstrap</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a class="menup" href="layout_user.php?blog=yes">Blog</a>
                        </li>
                        <li>
                            <a class="menup" href="layout_user.php?forum=yes">Forum</a>
                        </li>                        
						<li>
                            <a class="menup" href="layout_user.php?anggota=yes">Anggota</a>
                        </li>
						<?php 
							if($level == 'admin'){
						echo '<li>
									<a class="menup" href="admin_layout.php?dashboard=yes">Admin Side <b class="glyphicon glyphicon-log-in"></b></a>
								</li>';								
							}
						?>

                    </ul>
                <ul class="nav navbar-right top-nav">
                    <ul class="nav navbar-nav">
					  <li  class="dropdown">
						<a class="menup"  href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-exclamation-sign"></span> Pengumuman <b class="caret"></b></a>
						<ul class="dropdown-menu">
						<?php while($notice = mysqli_fetch_assoc($pengumuman)){
                         
			echo '            <li>
                                  <a href="#" id="'.$notice['id_pengumuman'].'" class="view" data-toggle="modal" data-target="#modal_lihat_png"><i class="glyphicon glyphicon-info-sign"></i> '.$notice['tittle'].', <i class="pull-right"><u>( '.date("d F Y", strtotime($notice['created_at'])).' )</u></i></a>
                              </li>
                              <li class="divider"></li>	';						
						}?>

                          </ul>
					  </li>
                      <li class="dropdown">
                          <a class="menup" href="#" class="dropdown-toggle" data-toggle="dropdown"><img class="img-rounded " src="../images/profil/<?php echo $profil ;?>" width="30" style="border:2px solid white;"> <u><?php echo $nameUser;?></u> <b class="caret"></b></a>
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
                                  <a href="../kontrol/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                              </li>
                          </ul>
                      </li>
                </ul></ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
          </div>
            <!-- /.container -->
        </nav>

        <!--
        User Profile Sidebar by @keenthemes
        A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
        Licensed under MIT
        -->
        <div class="container">
          <div class="profile">

            <div class="col-md-9">
              <div class="profile-content">
                <?php
                  include_once "../kontrol/navigasi_user.php";
                ?>
              </div>
            </div>
          </div>
        </div>


        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                        <ul class="list-inline text-center">
                            <li>
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <p class="copyright text-muted">Copyright &copy; Your Website 2017</p>
                    </div>
                </div>
            </div>
        </footer>
      </div>
	<!-- Button trigger modal 2-->
<div class="modal fade" id="modal_lihat_png" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="exampleModalLabel">Pengumuman !</h4>
		  </div>
			<div id="paper">
			
			</div>
		 </div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->	
    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="../js/jqBootstrapValidation.js"></script>
    <script src="../js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="../js/clean-blog.min.js"></script>

    <script>
        $(window).load(function() {
        $('.nav li a').click(function(e) {

            $('.nav li').removeClass('active');

            var $parent = $(this).parent();
            if (!$parent.hasClass('active')) {
                $parent.addClass('active');
            }
            e.preventDefault();
        });
    });

    </script>
	<script>
	$(document).ready(function(){		
		$(".view").on('click', function (){
		var id	= $(this).attr("id");
		console.log(id);
		$.ajax({
			method	:"POST",
			url		:"../kontrol/crud_admin/crud_pengumuman.php",
			data	:"crud=view&id="+id,
			success	: function(data){
					$("#paper").html(data);
			}
		})
	});});
	 </script>
</body>

</html>
