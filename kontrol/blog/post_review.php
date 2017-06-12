<?php
	include_once "../connt.php";
	if (isset($_GET['user'])){
		$query=mysqli_query($koneksi,"SELECT a.*,b.name name
		FROM blog a
		INNER JOIN anggota b ON a.id_anggota=b.id_anggota where filter='anggota' order by date_post desc");
	}
	else {
		$query=mysqli_query($koneksi,"SELECT a.*,b.name name
		FROM blog a
		INNER JOIN anggota b ON a.id_anggota=b.id_anggota where filter='semua' order by date_post desc");
	}
	if(mysqli_num_rows($query)!=0){
		while($data=mysqli_fetch_array($query)){
		echo "
			<a href='layout_blog.php?post=yes&id=$data[id_artikel]'>
				<h2 class='sub-title'>
					$data[tittle]
				</h2>
			</a>
				<p class='post-meta'>Posted by : <a href='#'>$data[name]</a> $data[date_post]</p>
				<hr/ style='margin-top:-25px;margin-bottom:5px;'>
				<article>
					".substr($data["content"],0,350)."[...]
					<ul class='pager pull-right' style='margin-top:-10px'>
                    	<li >
                        	<a href='layout_blog.php?post=yes&id=$data[id_artikel]'>
                        	Read more &rarr;</a>
                     	</li>
                	</ul>

				</article>
			
			<br/>
		";
	}}
	else {echo "<h3 class='post-subtitle'>
					<center>Not Posted</center>
				</h3>";
		}
?>
