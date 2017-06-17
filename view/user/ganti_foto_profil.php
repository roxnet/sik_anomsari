<?php
	include_once "../connt.php";
	include ('../kontrol/session_cekker.php');
?>	

<hr/>

		<a href="image_cONTRol_uNit/ganti_profil.php?id=<?php echo $_SESSION['id_user'];?>" class="btn btn-primary">
                      <i class="glyphicon glyphicon-open"></i>
           Upload Foto </a>
		   
		  <div id="conplace"></div>
<hr/>
	Foto profil : <br/>
	
	<?php
		
		$profiles = mysqli_query($koneksi,"SELECT * FROM image_anggota WHERE id_anggota='".$_SESSION['id_user']."' ORDER BY add_at DESC");
		$ii=0;
		while($img=mysqli_fetch_assoc($profiles)){
			$ii++;
			echo '
					<div class="col-md-4">
						<div class="panel panel-default">
						  <div class="panel-body" align="center">
							<img src="../images/profil/'.$img["link_img"].'"  width="180">
						  </div>
						  <div class="panel-footer" style="min-height:">
							<div style="min-height:px"></div>
							<input type="hidden" name="for_use" value="'.$img["link_img"].'" id="for_use'.$ii.'"/>
							<input type="hidden" name="id_user" value="'.$_SESSION['id_user'].'" />
							<button class="btn btn-success" onclick="change('.$ii.')">Gunakan foto</button>
							
						  </div>
						</div>
					</div>
						';
		}
	
	?>
	
	<script>
	function change(id){
			var for_use	= $('#for_use'+id).val();
			var id_user	= $('input[name=id_user]').val();
		console.log(for_use,id_user);
		$.ajax({
			type	:"POST",
			url		:"../kontrol/user/ubah_profil.php",
			data	:"do=changeprofl&for_use="+for_use+"&id_user="+id_user,
			success	: function(data){
					//
				if(data == "OK") {
					location.reload();
				}else $('#conplace').html(data);
			}
		})
		
	};
	</script>