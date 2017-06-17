<?php
include_once('../connt.php');
session_start();

$selectUser=mysqli_query($koneksi, "SELECT nickname,profil,level_user AS level FROM anggota where id_anggota='".$_SESSION['id_user']."'");
while($user=mysqli_fetch_assoc($selectUser)){
    $nameUser = $user['nickname'];
    $profil = $user['profil'];
    $level = $user['level'];
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

    <title>Blog Desa</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="../css/clean-blog.css" rel="stylesheet">

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

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="../index.php">Web Keluarga</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a href="layout_blog.php?home=yes">Blog</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php     ///Ini di hilangin aja pakde
                            if(isset($_SESSION['id_user'])){
                        echo '<li>
                                    <a class="menup" href="layout_user.php?notif=yes">Profile <b class="glyphicon glyphicon-log-in"></b></a>
                                </li>';                             
                        echo  '
                        <li class="dropdown">
                          <a class="menup" href="#" class="dropdown-toggle" data-toggle="dropdown"><img class="img-rounded " src="../images/profil/'.$profil.'" width="30" style="border:2px solid white;"> <u>'.$nameUser.'</u> <b class="caret"></b></a>
                          <ul class="dropdown-menu" style="background-color: black">
                              <li>
                                  <a href="../kontrol/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                              </li>
                          </ul>
                      </li>';
                       }
                        ?>
						
                
                <ul class="nav navbar-nav">
                    <li>
                        <a href="login.php" style="color:white">LOGIN</a>
                    </li>
                </ul>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header">
        <div class="container">
            <div class="row">
                <br>
            </div>
        </div>
    </header>
	<body style="background-color:#F4F4F4">
	<?php
		include_once "../kontrol/navigasi_blog.php";
	?>
	</body>
    <hr>

    <!-- Footer -->
    <footer style="background-color:#FFFFFF">
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
                    <p class="copyright text-muted">Copyright &copy; Blog Desa 2017</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="../js/jqBootstrapValidation.js"></script>
    <script src="../js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="../js/clean-blog.min.js"></script>

</body>

</html>
