<?php 
		
?>

<!-- Morris Charts -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">CHAT PRIVATE</h1>
	</div>
</div>
                <!-- /.row -->
				<div class="row">
					<div class="col-lg-3" >
						<div class="panel panel-red" >
                            <div class="panel-heading" style="text-align: center;">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> User Online</h3>
                            </div>
                            <div class="panel-body">
                                <div style="height:250px;">
                                <?php
                                	$chat1=mysqli_query($koneksi,"
                                		SELECT id_anggota,name,status
										FROM anggota 
										
                                		");
                                	if(mysqli_num_rows($chat1)!=0){
                                		echo "<div style='color:blue;'>";
                                		echo "<center><label>(ONLINE)</label></center>";
                                		while($data_chat=mysqli_fetch_array($chat1)){
                                			if($data_chat['status']=='online'){
                                			echo "<a href='pesan(".$data_chat['id_anggota'].")'> <span class='glyphicon glyphicon-user' aria-hidden='true'> ".$data_chat['name']."</span></a><br/>";
                                			}
                                			else break;
                                		}
                                		echo "</div>";
										echo "<div style='color:black;'>";
                                		echo "<br /><center><label style='text-align:center;'>(OFFLINE)</label></center>"; 
                                		while($chat_data1=mysqli_fetch_array($chat1)){
                                			
                                			echo "<span class='glyphicon glyphicon-user' aria-hidden='true'> ".$chat_data1['name']."</span> <br/>";
                                		}
                                		echo "</div>";
                                	}
                                ?>	
                                </div>
                            </div>
                        </div>
					
					</div>
				
                    <div class="col-lg-7">
                        <div class="panel panel-red">
                            <div class="panel-heading" style="text-align: center;">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Data Pengunjung</h3>
                            </div>
                            <div class="panel-body">
                                <div id="pesan" style="height:250px;border:1px solid black;">
                                	<?php
									    $pesan_query=mysqli_query($koneksi,"
											SELECT id_anggota as pengirim,id_anggota1 as penerima,pesan
											FROM private_message
											where (id_anggota=6 OR id_anggota=7) 
											AND (id_anggota1=6 OR id_anggota1=7)
											");
										if(mysqli_num_rows($pesan_query)!=0){
											while($pesan_chat=mysqli_fetch_array($pesan_query)){
												if($pesan_chat['penerima']==6)
												echo"<label style='text-align:left'>".$pesan_chat['pesan']."</label><br />";
											else if($pesan_chat['penerima']==7)
												echo"<label style='float:right'>".$pesan_chat['pesan']."</label><br />";
											}
										}
                                	?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				

<!-- jQuery -->
    <script src="../js/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
	
	function pesan(id//,sid
		){
		
           $.ajax({  
			url		:"../kontrol/anggota/private_message",
			type	:"POST",
			data 	:"id="+id+"&sid="+sid,   
			success:function(data){
					$("#pesan").html(data);
				}
					    
           }); 	
	});
	</script>