<?php
	include_once "../connt.php";
	//session_start();
	
	$id_f =$_GET['id'];
	$forum = mysqli_query($koneksi,"SELECT * FROM forum WHERE id_forum=$id_f");
	
	while($forums = mysqli_fetch_array($forum)){
		
		echo '<div class="row">
					<div class="col-lg-12">
					<div class="container">

						<div class="jumbotron" style="text-align:center;background-color:#FFFFFF" >
							<h1 class="page-header">'.$forums["judul_forum"].'</h1>
							<p>'.$forums["keterangan"].'</p>
						</div></div>
					</div>
				</div>';
				
	}
?>

<div class="row">
	<div class="col-lg-12">
<div class="content">
	<div class="container">
			<!-- Tab panes -->
			<div class="tab-content">
			 <!--<div class="col-md-2 " style="background-color:;">
						<div class="table-responsive " id="list_forum" ><!-- ......................................memulai tabel responsive 1-->
						<!--	 <table class="table  " style="border:solid #3BD23B 1px;background-color:#FFFFFF"> 
								<tr style="background-color:#3BD23B">
									<td width="">Side</td>
								</tr>
								<tr style="">
									<td width="">Bar</td>
								</tr>
							 </table>
						</div>
					</div>-->
					<div class="col-md-12">
				<div class="row" style="background-color:#2eb82e;border:solid white 1px;padding:10px">
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
							</select>-->
						</div>
						<button class="btn btn-default" type="button" onclick="back()" style="border:solid white 2px"><span class="glyphicon glyphicon glyphicon-arrow-left" aria-hidden="true" ></span> Kembali</button>
						
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_forum" style="border:solid white 2px;"><i class="glyphicon glyphicon-comment" ></i> &nbsp;Ugah Topik Baru</button>

						<div id="modal_alert"></div>

					</div>
					</div>
					
				</div><br/>
				<div class="row" >
					
				<div class="table-responsive" id="list_anggota" style=""><!-- ......................................memulai tabel responsive 1-->
				<table class="table table-hoverid_anggota" style="border:solid #2eb82e 1px;background-color:#FFFFFF">
					<tr style="background-color:#2eb82e;color:#FFFFFF">
						<td width="8%" ></td>
						<td width="40%">Topik bahasan</td>
						<td width="20%" align="center">Comments</td>
						<td width="30%">Created by</td>
					</tr>
					<?php
						$sql = mysqli_query($koneksi, "SELECT * FROM bahasan_forum ORDER BY id_bahasan DESC"); // jika tidak ada filter maka tampilkan semua entri

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
										<td width=""><a href="layout_user.php?bahasan=yes&id='.$row['id_bahasan'].'">'.$row['topic'].'</a></td>
										<td width="" align="center"><h4><span class="label label-success" style="border-radius:90px">
';
																	$banyaknya_comment = mysqli_query($koneksi,"SELECT id_comment FROM comment_forum WHERE id_bahasan = '".$row['id_bahasan']."'");
																	$jumlh= mysqli_num_rows($banyaknya_comment);
																	echo $jumlh;
																	
								echo'													<i class="glyphicon glyphicon-menu-hamburger"></i></h4>														</td>
										<td width="">';
											$panggil_creatornya = mysqli_query($koneksi, "SELECT * FROM anggota WHERE id_anggota = '".$row['id_creator']."'");
											while($crtr = mysqli_fetch_assoc($panggil_creatornya)){
												echo "<div class='col-md-12'><div class='col-md-4'><img src='../images/profil/".$crtr['profil']."' width='50' style='border-radius:5px'></div>";
												echo "<div class='col-md-6'><e style='font-size:15px'> ".$crtr['nickname']."<br/><a style='color:rgba(0,0,0,0.5);font-size:12px'>".date("d F Y", strtotime($row['created_at']))."</a></e></div></div>";
												//echo $crtr['name'];
											}
								echo'</td>
									</tr>
								';$x=1;
								}
								$no++; // mewakili data kedua dan seterusnya
							}if($x!=1) echo '<td colspan="7" align="center"> Tidak ada Topik bahasan untuk forum ini</td>' ;
						}
					?>
				</table>
			</div> <!--............................................................... /.table-responsive 1-->
				</div>
			</div>

		</div> <!-- /.content -->
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
						<input type="hidden" name="creator" value="<?php echo $_SESSION['id_user'] ;?>" >
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
	
	
	
	$("#add_forum").on('click', function (){
		var creator	= $('input[name=creator]').val();
		var forum	= $('input[name=forum]').val();
		var topik	= $('input[name=topik]').val();
		var content	= $('textarea[name=content]').val();
		console.log(creator,forum,topik,content);
		$.ajax({
			type	:"POST",
			url		:"../kontrol/forum/forum.php",
			data	:"crud=addTread&creator="+creator+"&forum="+forum+"&topik="+topik+"&content="+content,
			success	: function(data){
					//$("#keluarga").html(data);
					if(data=='ok'){
						$('#modal_forum').modal('hide'); 
						location.reload();
					}else $(".row").html(data);
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
	
	$(document).ready(function(){
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
		