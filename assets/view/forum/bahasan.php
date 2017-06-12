<?php
	include_once "../connt.php";
	
	$id_b =$_GET['id'];
	$forum = mysqli_query($koneksi,"SELECT * FROM bahasan_forum WHERE id_bahasan=$id_b");
	while($bahasan = mysqli_fetch_array($forum)){
		$creator_forumnya = mysqli_query($koneksi,"SELECT * FROM anggota WHERE id_anggota='".$bahasan['id_creator']."'");
			while($cf_nya = mysqli_fetch_assoc($creator_forumnya)){
				$nama_creator = $cf_nya['nickname'];
				$profil_creator = $cf_nya['profil'];
			}
		echo '<div class="container">
				<div class="container">
				<div class="row">
					<div class="col-lg-11">
						<div class=" col-md-offset-2">
							<div class="panel panel-success" style="border-radius:0px;border:solid :#2eb82e 1px">
								<div class="panel-heading" style="border-radius:0px;background-color:#2eb82e;text-color:white">

											<img class="image img-circle" src="../images/profil/'.$profil_creator.'" width="60px">
			
											<span class="pull-right" style="color:rgba(232,232,232,0.7);font-size:17px"><span class="glyphicon glyphicon-time "></span> '.date("d F Y", strtotime($bahasan['created_at'])).'</span>
											<span>
												<b style="font-size:20px;color:white">'.$nama_creator.'</b><br/>
											</span>

								</div>
								<div class="panel-body" id="bahasan_showing">
									<h2 class="page-header">'.$bahasan['topic'].'</h2>
									<p>'.$bahasan['content'].'</p>
									<br/>
										<button class="btn btn-default" type="button" onclick="back()" style="border:solid green 2px"><span class="glyphicon glyphicon glyphicon-arrow-left" aria-hidden="true" ></span> Kembali</button>
										<button id="minup" class="btn btn-primary btn-sm" value="hide/show" style=";border:solid gray 2px">
											<b style="font-size:12px">komentar bar</b>
										</button>';
									if($bahasan['id_creator'] == $_SESSION['id_user']){
				echo'						<button id="edit_ahasan" class="btl btn-primary pull-right" style="border-radius:40px" onclick="showHide()"><span class="glyphicon glyphicon-edit"></span></button>';
										
									}	
		echo'					</div>
								<div class="panel-body" id="bahasan_edit" style="display:none">     <!--//////////////////-->
								<div class="col-md-12">
									  <div class="form-group col-md-12">
										<label for="inputEmail3" class="col-sm-4 control-label">Topik</label>
										<input type="hidden" class="form-control" name="id_bahasan" value="'.$bahasan['id_bahasan'].'">
										<input type="text" class="form-control" name="topik_bahasan" value="'.$bahasan['topic'].'">
									  </div>
									  <div class="form-group col-md-12">
										<label for="inputEmail3" class="col-sm-2 control-label" >Content</label>
										<textarea class="form-control" name="content_bahasan">'.$bahasan['content'].'</textarea>
									  </div>
									
									<div class="pull-right">
										<button class="btn btn-default" id="batal_edit" onclick="hideShow()">Batal</button>
										<button class="btn btn-primary" id="ok_edit">Simpan</button>
									</div>
								</div>			
							</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row" id="fcmt" style="display: none;">
					<div class="col-md-11">
						<div class=" col-md-offset-2">
							<div class="panel panel-success" style="border-radius:0px;border:solid :#3BD23B 1px">
								<div class="row">
								<form id="fcommm">
									<div class="form-group col-md-11"><br/>
									 <div class="form-group col-md-11">
										<input type="hidden" name="bahasannya" value="'.$id_b.'" />
										<input type="hidden" name="creatornya" value="'.$_SESSION['id_user'].'" />
										<textarea class="form-control" name="fcomment"></textarea>
									 </div>
									 <div class="form-group col-md-1">
										<button type="button" class="btn btn-md btn-primary sendfcmt">Send</button>									 
									 </div>
									</div>
								</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--<div class="row">
					<div class="col-md-11">
						<div class=" col-md-offset-2">
							<div class="panel" style="border-radius:0px;border:solid :#3BD23B 1px">
								<div class="row">
								
									
								</div>
							</div>
						</div>
					</div>
				</div>-->
				<div class="row" >
					<div class="col-md-11">
						<div class=" col-md-offset-2">
							<div class="panel panel-success" style="border-radius:0px;border:solid :#3BD23B 1px;min-height:520px">
								
								<div class="col-md-12" style="padding:5px 5px 5px 40px"><br/>Daftar Komentar<hr/>
										<div class="" style=" overflow:hidden;">
											<div style="width: 90%;float:left;height: 400px;overflow-y: auto;overflow-x: hidden;border-radius:5px;padding:5px">
												<div id="daftarg">
													<div id="realtime_komentar" class="row"></div>';
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
	echo'										</div>
											</div>
										</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
				
				
				
			 </div>';
				
	}
?>

<!--<div class="row">
	<div class="col-lg-12">
<div class="content">
	<div class="container">
			<!-- Tab panes
			<div class="tab-content">
			 <div class="col-md-2 " style="background-color:;">
						<div class="table-responsive " id="list_forum" ><!-- ......................................memulai tabel responsive 1
							 <table class="table  " style="border:solid #3BD23B 1px"> 
								<tr style="background-color:#3BD23B">
									<td width="">Side</td>
								</tr>
								<tr style="">
									<td width="">Bar</td>
								</tr>
							 </table>
						</div>
					</div>
					<div class="col-md-9">
				<div class="row" style="background-color:#3BD23B;border:solid white 1px;padding:10px">
					<div class="" >
						<div class="form-inline" >
						<div class="form-group">
							<!--<select class="form-control" name="keluarga" id="keluarga">
								<option value="all">Semua Keluarga</option>
							  <?php
								$query=mysqli_query($koneksi,"select * from bahasan");
								if(mysqli_num_rows($query)!=0){
									while($kategory=mysqli_fetch_array($query)){
										echo "<option value='$kategory[id_keluarga]'>$kategory[nama_keluarga]</option>";
									}
								}
								else echo "<option>-</option>";
							?>
							</select>
						</div>
						<button class="btn btn-default" type="button" onclick="back()" style="border:solid white 2px"><span class="glyphicon glyphicon glyphicon-arrow-left" aria-hidden="true" ></span> Kembali</button>
						
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_forum" style="border:solid white 2px;"><i class="glyphicon glyphicon-comment" ></i> &nbsp;Ugah Topik Baru</button>

						<div id="modal_alert"></div>

					</div>
					</div>
					
				</div><br/>
				<div class="row" >
					
				<div class="table-responsive" id="list_anggota"><!-- ......................................memulai tabel responsive 1
				<table class="table table-striped table-hoverid_anggota" style="border:solid #3BD23B 1px">
					<tr style="background-color:#3BD23B">
						<td width="8%" ></td>
						<td width="40%">Topik bahasan</td>
						<td width="25%" align="center">Comments</td>
						<td width="25%">Created by</td>
					</tr>
					<?php
						$sql = mysqli_query($koneksi, "SELECT * FROM bahasan "); // jika tidak ada filter maka tampilkan semua entri

						if(mysqli_num_rows($sql) == 0){ 
							echo '<tr><td colspan="4"><center>Data Tidak Ada.</center></td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
						}
						else{ // jika terdapat entri maka tampilkan datanya
							$no = 1; $x=0;// mewakili data dari nomor 1
							while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
								if($row['id_forum']==$id_f){
								echo '
									<tr>
										<td>'.$no.'</td>
										<td width="">'.$row['topic'].'</a></td>
										<td width="" align="center"><h4><span class="label label-success" style="border-radius:90px">10 <i class="glyphicon glyphicon-menu-hamburger"></i></h4></td>
										<td width="">'.$row['id_creator'].'</td>
									</tr>
								';$x=1;
								}
								$no++; // mewakili data kedua dan seterusnya
							}if($x!=1) echo '<td colspan="7" align="center"> Tidak ada Topik bahasan untuk forum ini</td>' ;
						}
					?>
				</table>
			</div> <!--............................................................... /.table-responsive 1
				</div>
			</div>

		</div> <!-- /.content 
	</div>
	</div>
</div><!-- /.row -->



<!-- Button trigger modal -->
<div class="modal fade" id="modal_forum" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="exampleModalLabel">Ugah Topik Baru</h4>
		  </div>
			<div class="row">
			<div class="modal-body">
				<form>
				  <div class="form col-md-12">
					<form>
						<input type="hidden" name="creator">
						<input type="hidden" name="forum" value="<?php echo $id_f ;?>">
					  <div class="form-group col-md-12">
						<label for="inputEmail3" class="col-sm-4 control-label">Topik</label>
						<input type="text" class="form-control" name="topik">
					  </div>
					  <div class="form-group col-md-12">
						<label for="inputEmail3" class="col-sm-2 control-label">content</label>
						<textarea class="form-control" name="content"></textarea>
					  </div>
				  </div>
			</div>
					  <div class="form-group col-md-12 col-md-offset-7">
						<button id="add_forum" type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_keluarga"><i class="fa fa-fw fa-plus"></i> Ok</button>			  
						<button id="closed" type="button" class="btn btn-danger" data-toggle="modal"  data-dismiss="modal">Batal</button>
					  </div>
					</form>
			  
			</form>
		  </div>
		 </div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Button trigger modal 2
<div class="modal fade bs-example-modal-lg" id="modal_lihat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog " role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h3 class="modal-title" id="exampleModalLabel">Anggota &raquo; Lihat</h3>
		  </div>
		<div class="cont"></div>
		  
		</div> 
	</div> 
</div> -->

<!-- Button trigger modal 3
<div class="modal fade bs-example-modal-lg" id="modal_del" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog " role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="exampleModalLabel">Anggota &raquo; hapus ?</h4>
		  </div>
		  
		<div class="vdel"></div>
		
		</div> 
	</div> 
</div> -->


<script src="../js/jquery.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
        jQuery('#minup').on('click', function(event) {        
             jQuery('#fcmt').toggle('hide');
        });
    });
	

$(document).ready(function(){
	/*$('#keluarga').change(function(){
		var x = document.getElementById("keluarga"); 
		var select = x.options[x.selectedIndex].value;
		console.log(select);
           $.ajax({  
			url:"crud_admin/daftar_anggota.php",
			method:"POST",
			data:"select="+select,   
			success:function(data){
			$("#list_anggota").html(data);
				}
					    
           }); 	
	});*/
	
	///This for FCOMMENT SEND
	
	$(".sendfcmt").on('click', function (){
		var bahasannya	= $('input[name=bahasannya]').val();
		var creatornya	= $('input[name=creatornya]').val();
		var fcomment	= $('textarea[name=fcomment]').val();
		console.log(bahasannya,creatornya,fcomment);
		$.ajax({
			type	:"POST",
			url		:"../kontrol/forum/forum.php",
			data	:"crud=fcomntsn&bahasannya="+bahasannya+"&creatornya="+creatornya+"&fcomment="+fcomment,
			success	: function(data){
					//$("#keluarga").html(data);
					$('#realtime_komentar').html(data); 
					$('#fcommm')[0].reset();
					$('#fcmt').toggle('hide');
						
					//$("#modal_alert").html("<div class='alert alert-success' role='alert'>Keluarga Berhasil Ditambah</div>");
			}
		})
	});
	
	$(".view").on('click', function (){
		var id	= $(this).attr("id");
		console.log(id);
		$.ajax({
			method	:"POST",
			url		:"../kontrol/crud_admin/crud_anggota.php",
			data	:"do=view&id="+id,
			success	: function(data){
					$(".cont").html(data);
			}
		})
	});
	
	$(".del").on('click', function (){
		var id	= $(this).attr("id");
		console.log(id);
		$.ajax({
			method	:"POST",
			url		:"../kontrol/crud_admin/crud_anggota.php",
			data	:"do=view&del=ok&id="+id,
			success	: function(data){
					$(".vdel").html(data);
			}
		})
	});
	
});
	function back(){
		window.history.back();
	};
	function rename(id){
		var rename_keluarga	= $('input[name='+id+']').val();
		$.ajax({
			type	:"POST",
			url		:"../kontrol/crud_admin/crud_keluarga.php",
			data	:"crud=rename&crud_keluarga="+rename_keluarga+"&id="+id,
			success	: function(data){
					$("#keluarga").html(data);
					 $('#modal_keluarga').modal('toggle');
					$("#modal_alert").html("<div class='alert alert-success' role='alert'>Keluarga Berhasil Dirubah</div>");
			}
		})
	};
	
function del(id){
		$.ajax({
			type	:"POST",
			url		:"../kontrol/crud_admin/crud_keluarga.php",
			data	:"crud=delete&id="+id,
			success	: function(data){
					$("#keluarga").html(data);
					location.reload();
					$("#modal_alert").html("<div class='alert alert-success' role='alert'>Keluarga Berhasil dihapus</div>");
			}
		})
	};
function showHide(){
	$('#bahasan_showing').css('display','none');
	$('#bahasan_edit').css('display','');
	
}	;
function hideShow(){
	$('#bahasan_showing').css('display','');
	$('#bahasan_edit').css('display','none');
	
}	;
	$(document).ready(function(){
			$("#ok_edit").on('click', function (){
		var id_bahasan	= $('input[name=id_bahasan]').val();
		var topik	= $('input[name=topik_bahasan]').val();
		var content	= $('textarea[name=content_bahasan]').val();
		console.log(id_bahasan,topik,content);
		$.ajax({
			type	:"POST",
			url		:"../kontrol/crud_admin/crud_forum.php",
			data	:"crud=aditeTread&id_bahasan="+id_bahasan+"&topik="+topik+"&content="+content,
			success	: function(data){
					//$("#keluarga").html(data);
					if(data=='ok'){
						location.reload();
					}else location.reload();
					//$("#modal_alert").html("<div class='alert alert-success' role='alert'>Keluarga Berhasil Ditambah</div>");
			}
		})
	});
		
		
		$('#add_form').on("submit", function(event){  
		event.preventDefault();  
	   
	  
	   $.ajax({  
			url:"../kontrol/crud_admin/crud_keluarga.php",  
			method:"POST",  
			data:$('#add_form').serialize(), 
			success:function(data){  
			 //$('#add_form')[0].reset();  
			 $('#modal_anggota').modal('hide'); 
			 //  window.location.href = "";
			}  
		   });  
		 
		 });
	});
	
	
	

</script>
		