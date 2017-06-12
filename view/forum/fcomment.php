<?php
	include_once "../../connt.php";
	$id_b = $_POST['id_bahasan'];
	
	$fcomment = mysqli_query($koneksi, "SELECT * FROM comment_forum WHERE id_bahasan='$id_b' ORDER BY id_comment DESC");
								$count=mysqli_num_rows($fcomment);
								   if($count==0){
									   echo ' <b>Tidak ada komentar</b>';
								   }else {
									while($fcomt=mysqli_fetch_assoc($fcomment)){
										
										echo '<div id="listfct" class="row alert alert-success ">
												  <div class="col-md-12">
													<div class="col-md-8" style="background-color:white;border-radius:20px">'.$fcomt['comment'].'</div>
													<div class="col-md-2">&nbsp;&nbsp;';
													$panggil_komentatornya=mysqli_query($koneksi,"SELECT * FROM anggota WHERE id_anggota = '".$fcomt['id_creator']."'");
													while($kmttr= mysqli_fetch_assoc($panggil_komentatornya)){
														$kttrnya = $kmttr['nickname'];
										echo'			<img class="image img-circle" src="../images/profil/'.$kmttr['profil'].'" width="60px"></div>';
													}
										echo'		<div >
														<span >'.$kttrnya.' </span><br/>
														<span class="" style="color:rgba(0,0,0,0.5);font-size:12px"><span class="glyphicon glyphicon-time "></span> '.date("d F Y", strtotime($fcomt['created_at'])).'</span>
													</div>
												  </div>
											  </div>
										';
										
									}
								   }

?>