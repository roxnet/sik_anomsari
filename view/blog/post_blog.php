<!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <?php
					include_once "../connt.php";
					$post=$_GET['id'];
					$query=mysqli_query($koneksi,"SELECT a.*, b.name
						FROM blog a
						INNER JOIN anggota b ON a.id_anggota=b.id_anggota where id_artikel='$post' order by date_post desc");
					if(mysqli_num_rows($query)==1){
						while($data=mysqli_fetch_array($query)){
						echo "
								<h2 class='sub-title'>
									$data[tittle]
								</h2>
								<p class='post-meta'>Posted by : <a href='#'>$data[name]</a> $data[date_post]</p>
								<hr/ style='margin-top:-25px;margin-bottom:5px;'>
								<article>
									".$data["content"]."
								</article>
						";
					}}
					?>
                </div>
					<?php
							include_once "../kontrol/blog/widget.php";
					?>
            </div>
            <br />
            <hr / style='border:1px solid black'>
            <br />
            <div class='row'>
            	<div class='col-sm-6' style="background-color:#fff;padding-top:10px" >
            		<div id="grid_komentar">
            		<?php
            			$querycomment=mysqli_query($koneksi,"SELECT a.*,b.name 
            				FROM bkomentar a
            					INNER JOIN anggota b ON a.id_anggota=b.id_anggota
            					WHERE id_artikel=$post
            					ORDER BY date desc");
            			if(mysqli_num_rows($querycomment)!=0){
            				while($comment=mysqli_fetch_assoc($querycomment)){
            					echo "<div style='background-color:rgba(0,0,0,0.1); margin-bottom:10px; padding:5px;'> <label>$comment[name]</label> . $comment[date] <hr / style='margin-top:5px;margin-bottom:5px;border:1px solid black'>
            					$comment[komentar] <br/><br/></div>
            					";
            				}
            			}
            		?>
            		</div>
            		<br />
            		<div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" style='overflow: hidden'>
                        <div class="form-group">
                            <textarea id="text_komentar" class="form-control" rows="2" name="text_komentar"></textarea>
                        </div>
                        <button type="button" id="koment" class="btn btn-lrg btn-primary pull-right"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></button>
                    </form>
                </div>
            	</div>
            </div>
        </div>
    </article>

<script src="../js/jquery.min.js"></script>

   <script type="text/javascript">
   		$(document).ready(function(){
   			$("#koment").click(function(){
				var id_anggota	='<?php if(isset($_SESSION['id_user'])){echo $_SESSION['id_user'];}?>';
				var komentar	= $('textarea[name=text_komentar]').val();
				var id_artikel=<?php echo $post; ?>;
				if(id_anggota==''){
					window.location.href='login.php';
				}
				else {
					$.ajax({
						type	:"POST",
						url		:"../kontrol/blog/komentar.php",
						data	:"koment=add&id_anggota="+id_anggota+"&komentar="+komentar+"&id_artikel="+id_artikel,
						success	: function(data){
								$("#grid_komentar").html(data);
								$('textarea[name=text_komentar]').val('');

						}
					})
				}
			});
   		});
   </script>
	