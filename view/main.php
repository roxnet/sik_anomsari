<?php
include_once "../connt.php";

$take_post = mysqli_query($koneksi,"SELECT * FROM blog ORDER BY id_artikel DESC LIMIT 6");
$n = mysqli_num_rows($take_post);
$i = 1;
for($j=1;$j <= 6;$j++){
		$id[$j] = null;
		$tittle[$j] = null;
		$preview[$j] = null;
}
while($post = mysqli_fetch_assoc($take_post)){
	$id[$i] =  $post['id_artikel'];
	$tittle[$i] = $post['tittle'];
	//echo $tittle['tittle'];
	$preview[$i] = substr($post["content"],0,350);
	$i++;
}
?>
<!DOCTYPE html>
<html class="full" lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Full Slider - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/full-slider.css" rel="stylesheet">
	
	<style>
	@media screen and (min-width: 480px) {
		
	}
	</style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color:#2eb82e;">
        <div class="container " >
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#" style="color:white">Start Bootstrap</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
                <ul class="nav navbar-nav">
                    <li>
                        <a href="layout_blog.php?home=yes" style="color:white">Blog</a>
                    </li>
                </ul>
				<ul class="nav navbar-right top-nav">
                
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
		<div id="heding" style="height:50px;background-image: url('../images/well.png');height:450px;background-position: center;background-size: 1350px;max-width:100%;background-repeat: no-repeat;">
		<div class="row">
			<div class="col-lg-12" align="center" style="padding-top:170px">
                   <text style="font-size:60px"><b><u>Selamat Datang</u></b></text><br/>
                   <text style="font-size:30px"><b>di website trah Anomsari</b></text>
            </div>
		</div>
		</div>
	</div>


    <!-- Page Content -->
		<div class="container">
        <!-- Wrapper for Slides -->
		<div class="row">
			<div class="col-lg-12">
                <h4 class="page-header" align="center">
                   Postingan terbaru
                </h4>
            </div>
		</div>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
  
    <div class="item active">
					<?php if($tittle[1] != null){
						echo'
						<div class="col-md-4" id="blok3" >
							<div class="panel panel-default" style="height:238px;border:1px solid #2eb82e">
								<div class="panel-heading" style="background-color:#2eb82e;color:white">
									<h4><i class="fa fa-fw fa-compass"></i> '.$tittle[1] .'</h4>
								</div>
								<div class="panel-body" style="height:50%">
									<p>'.$preview[1].'</p>
								</div>
								<div class="panel-footer">
									<a href="layout_blog.php?post=yes&id='.$id[1].'" class="btn btn-default">Read more</a>
								</div>							
							</div>
					</div>	'; }	if($tittle[2] != null){
						echo'				
						<div class="col-md-4" id="blok3">
							<div class="panel panel-default" style="height:238px;border:1px solid #2eb82e">
								<div class="panel-heading" style="background-color:#2eb82e;color:white">
									<h4><i class="fa fa-fw fa-compass"></i> '.$tittle[2] .'</h4>
								</div>
								<div class="panel-body" style="height:50%">
									<p>'.$preview[2].'</p>
								</div>
								<div class="panel-footer">
									<a href="layout_blog.php?post=yes&id='.$id[2].'" class="btn btn-default">Read more</a>
								</div>	
							</div>
						</div>	'; }	if($tittle[3] != null){	
						echo'				
						<div class="col-md-4" id="blok3">
							<div class="panel panel-default" style="height:238px;border:1px solid #2eb82e">
								<div class="panel-heading" style="background-color:#2eb82e;color:white">
									<h4><i class="fa fa-fw fa-compass"></i> '.$tittle[3] .'</h4>
								</div>
								<div class="panel-body" style="height:50%">
									<p>'.$preview[3].'</p>
								</div>
								<div class="panel-footer">
									<a href="layout_blog.php?post=yes&id='.$id[3].'" class="btn btn-default">Read more</a>
								</div>
							</div>
						</div> '; } 
				?>
    </div>
	<?php if($n >= 4){
		echo '
    <div class="item">';
					
				if($tittle[4] != null){
						echo'	
						<div class="col-md-4" id="blok3">
							<div class="panel panel-default" style="height:238px;border:1px solid #2eb82e">
								<div class="panel-heading" style="background-color:#2eb82e;color:white">
									<h4><i class="fa fa-fw fa-compass"></i> '.$tittle[4] .'</h4>
								</div>
								<div class="panel-body" style="height:50%">
									<p>'.$preview[4].'</p>
								</div>
								<div class="panel-footer">
									<a href="layout_blog.php?post=yes&id='.$id[4].'" class="btn btn-default">Read more</a>
								</div>	
							</div>
						</div>'; }	if($tittle[5] != null){
						echo '
						<div class="col-md-4" id="blok3">
							<div class="panel panel-default" style="height:238px;border:1px solid #2eb82e">
								<div class="panel-heading" style="background-color:#2eb82e;color:white">
									<h4><i class="fa fa-fw fa-compass"></i>'.$tittle[5] .'</h4>
								</div>
								<div class="panel-body" style="height:50%">
									<p>'.$preview[5].'</p>
								</div>
								<div class="panel-footer">
									<a href="layout_blog.php?post=yes&id='.$id[5].'" class="btn btn-default">Read more</a>
								</div>	
							</div>
						</div>	'; }	if($tittle[6] != null){
						echo '					
						<div class="col-md-4" id="blok3" >
							<div class="panel panel-default" style="height:238px;border:1px solid #2eb82e">
								<div class="panel-heading" style="background-color:#2eb82e;color:white">
									<h4><i class="fa fa-fw fa-compass"></i>'.$tittle[5] .'</h4>
								</div>
								<div class="panel-body" style="height:50%">
									<p>'.$preview[6].'</p>
								</div>
								<div class="panel-footer">
									<a href="layout_blog.php?post=yes&id='.$id[6].'" class="btn btn-default">Read more</a>
								</div>	
							</div>
						</div>';}
		echo'
    </div>';
	}?>
    
  </div>

  <!-- Controls 
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>-->
  </a>
</div>		
         
		<hr/>
	<!-- Footer -->
    <footer style="background-color:#FFFFFF" align="center">
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
    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>
	
	<>

</body>

</html>
