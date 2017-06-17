<?php 
	include_once "../connt.php";
	include ('../kontrol/session_cekker.php');
	
?>

    <!-- Main Content -->
        <div class="row">
            <div class="col-lg-10 col-lg-offset-0">
			
			<?php
					$pengumumans = mysqli_query($koneksi,"SELECT * FROM pengumuman ORDER BY id_pengumuman DESC LIMIT 2");
					
					while($notf = mysqli_fetch_assoc($pengumumans)){
						echo'
							<div class="notice"><i class="fa fa-exclamation-triangle"></i> Pengumuman Baru <i class="pull-right"><span class="glyphicon glyphicon-time "></span> '.date("d F Y", strtotime($notf['created_at'])).'</span></i></p>

							  <hr class="style1">
							   <a href="#" id="'.$notf['id_pengumuman'].'" class="view" data-toggle="modal" data-target="#modal_lihat_png">
									<h2>'.$notf['tittle'].'</h2>
								</a>
							</div>						
						';
					}
			
			?>
	

			<?php
					$blog = mysqli_query($koneksi,"SELECT * FROM blog ORDER BY id_artikel DESC LIMIT 2");
					
					while($artikel = mysqli_fetch_assoc($blog)){
							echo'
								<div class="notice"><i class="fa fa-tags"></i> Blog Baru <i class="pull-right"><span class="glyphicon glyphicon-time "></span> '.date("d F Y", strtotime($artikel['date_post'])).'</span></i></p>
								  <hr class="style1">
								  <a href="layout_blog.php?post=yes&id='.$artikel['id_artikel'].'">
									<h2>'.$artikel['tittle'].'</h2>
								  </a>
								</div>						
							
							';
					}
			?>

			<?php
					$galeri = mysqli_query($koneksi,"SELECT * FROM album ORDER BY id_album DESC LIMIT 2");
					
					while($album = mysqli_fetch_assoc($galeri)){
							echo'
								<div class="notice"><i class="fa fa-picture-o"></i> Album Baru <i class="pull-right"><span class="glyphicon glyphicon-time "></span> '.date("d F Y", strtotime($album['created_at'])).'</span></i></p>
								  <hr class="style1">
								  <a href="layout_user.php?lihat_album=yes&id_album='.$album["id_album"].'" class=" " >
										<h2>'.$album['judul_album'].'</h2>
								  </a>
								</div>
							';
					}
					
			?>


            </div>
        </div>
