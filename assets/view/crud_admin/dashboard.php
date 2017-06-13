<?php 
	include "../connt.php";		
?>

<!-- Morris Charts -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Dashboard</h1>
	</div>
</div>
                <!-- /.row -->
				<div class="row">
					<div class="col-lg-2" ><a href="admin_layout.php?pendaftar=yes" style="text-decoration:none">
						<div class="panel panel-red" style="border-radius:13px" >
                           
                            <div class="panel-heading" style="border-radius:10px;text-align:center;font-size: 2em;">
                               <i class="glyphicon glyphicon-user"></i>   
									<?php $pedf = mysqli_query($koneksi, "SELECT * FROM pendaftar"); 
										echo $count=mysqli_num_rows($pedf) ;
									?>
							   <h3 class="panel-title"> Pendaftar</h3>
                            </div>
                        </div>
					</div></a>
				</div>
				</div>
				<!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Data Pengunjung</h3>
                            </div>
                            <div class="panel-body">
                                <div id="morris-line-chart" style="height:250px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
				

<!-- jQuery -->
    <script src="../js/jquery.min.js"></script>

<!-- Morris Charts JavaScript -->
    <script src="../js/morris/raphael.min.js"></script>
    <script src="../js/morris/morris.min.js"></script>
    <script src="../js/morris/morris-data.js"></script>