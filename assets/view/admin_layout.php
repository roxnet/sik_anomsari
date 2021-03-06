<?php
    include_once("../connt.php");
	session_start();
	
	$admin = mysqli_query($koneksi, "SELECT * FROM anggota WHERE id_anggota = '".$_SESSION['id_user']."' ");
	while($by_admin = mysqli_fetch_assoc($admin)){
		$name = $by_admin['nickname'];
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/sb-admin.css" rel="stylesheet">

	<!-- Morris Charts CSS -->
    <link href="../css/morris.css" rel="stylesheet">
	
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
                       
                                    <?php
                                        $chat=mysqli_query($koneksi,"
                                            SELECT a.id_anggota,a.id_anggota1,a.pesan as pesan,a.date as date,b.name as name
                                            FROM private_message a, anggota b
                                            WHERE a.id_anggota1=b.id_anggota
                                            ");
                                        if(mysqli_num_rows($chat)!=0){
                                          while($data=mysqli_fetch_array($chat))  {
                                            echo '
                                             <li class="message-preview">
                                                <a href="admin_layout.php?private_chat=yes">
                                                    <div class="media">
                                                <span class="pull-left">
                                                    <img class="media-object" src="http://placehold.it/50x50" alt="">
                                                </span>
                                                <div class="media-body">
                                                    <h5 class="media-heading"><strong>'.$data['name'].'</strong>
                                                    </h5>
                                                    <p class="small text-muted"><i class="fa fa-clock-o"></i>'.$data['date'].'</p>
                                                    <p>'.$data['pesan'].'</p>
                                                </div>
                                               </div>
                                                                        </a>
                                                                    </li>
                                            ';
                                          }
                                      }
                                    ?>

                                   
                             
                        
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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $name;?><b class="caret"></b></a>
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
                            <a href="layout_user.php?home=yes"><i class="glyphicon glyphicon-log-out"></i> User Side</a>
                        </li>
						<li class="divider"></li>
                        <li>
                            <a href="../kontrol/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
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
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"> <i class="fa fa-fw fa-file"></i> Blog <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
							<li>
								<a href="admin_layout.php?post=yes" style="color:gray;" class="blogss"> <i class="glyphicon glyphicon-pencil"></i> Buat Post</a>
							</li>							
							<li>
								<a href="" style="color:gray;" class="blogss"> <i class="glyphicon glyphicon-folder-open"></i> Semua Post</a>
							</li>							
							<li>							
								<a href="" style="color:gray;" class="blogss"> <i class="glyphicon glyphicon-list"></i> Semua Komentar</a>
							</li>
                        </ul>
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
					<li>
						<a  href="admin_layout.php?pengumuman=yes" id="pengumuman" > <i class="glyphicon glyphicon-send"></i> Pengumuman </a>
					</li>
				</ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">
			<div class="container-fluid" >
			<?php
			
				include_once "../kontrol/navigasi_admin.php";
				
			?>
			</div>
            <!-- /.container-fluid -->
			
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
	


</body>

</html>
