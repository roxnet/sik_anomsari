<!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <?php
					include_once "../connt.php";
					$post=$_GET['id'];
					$query=mysqli_query($koneksi,"select * from blog where id_artikel='$post' order by date_post desc");
					if(mysqli_num_rows($query)==1){
						while($data=mysqli_fetch_array($query)){
						echo "
								<h2 class='sub-title'>
									$data[tittle]
								</h2>
								<p class='post-meta'>Posted by $data[id_anggota] $data[date_post]</p>
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
        </div>
    </article>
	