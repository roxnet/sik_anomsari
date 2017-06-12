<?php
	include_once "../../connt.php";
	
	if(isset($_POST['crud'])){



		if($_POST['crud']=='addTread'){
			$id_forum = $_POST['forum'];
			$topic = mysqli_real_escape_string($koneksi,$_POST['topik']);
			$content = mysqli_real_escape_string($koneksi,$_POST['content']);
			$creator = mysqli_real_escape_string($koneksi,$_POST['creator']); 
			$create = date("Y-m-d");
			$image = "Emty";
			
			$sql = mysqli_query($koneksi, "INSERT INTO bahasan_forum(id_forum, topic, content, image, id_creator, created_at) 
												VALUES('$id_forum', '$topic', '$content', '$image', '$creator', '$create')");
			if($sql){
				echo"ok";
			}else echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$create";
		}
		if($_POST['crud']=='fcomntsn'){
			$id_bahasan = $_POST['bahasannya'];
			$creator = mysqli_real_escape_string($koneksi,$_POST['creatornya']); 
			$comment = mysqli_real_escape_string($koneksi,$_POST['fcomment']);
			$create = date("Y-m-d");
			
			$sql = mysqli_query($koneksi, "INSERT INTO comment_forum(id_bahasan, id_creator, comment, created_at) 
												VALUES('$id_bahasan', '$creator', '$comment', '$create')");
			if($sql){
				$last_id = mysqli_insert_id($koneksi);
				$fcomment = mysqli_query($koneksi, "SELECT * FROM comment_forum WHERE id_bahasan='$id_bahasan' AND id_comment ='$last_id' ");
								   
									while($fcomt=mysqli_fetch_assoc($fcomment)){
										$coment_tor = mysqli_query($koneksi, "SELECT * FROM anggota WHERE id_anggota = '".$fcomt['id_creator']."'");
										$show_comentor = mysqli_fetch_array($coment_tor);
										echo '&nbsp;&nbsp;&nbsp;&nbsp;<div id="listfct" class="row alert alert-success ">
												  <div class="col-md-12">
													<div class="col-md-8" style="background-color:white;border-radius:20px">'.$fcomt['comment'].'</div>
													<div class="col-md-2">&nbsp;&nbsp;<img class="image img-circle" src="../images/profil/'.$show_comentor['profil'].'" width="60px"></div>
													<div >
														<span >'.$show_comentor['nickname'].'</span>
														<span class="" style="color:rgba(0,0,0,0.5);font-size:12px"><span class="glyphicon glyphicon-time "></span> '.date("d F Y", strtotime($fcomt['created_at'])).'</span>
													</div>
												  </div>
											  </div>
										';
										
									}
			}else echo "<h1>Failed!!</h1>";
		}
	}
		
?>