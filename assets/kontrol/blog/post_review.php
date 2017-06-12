<?php
	include_once "../connt.php";
	$query=mysqli_query($koneksi,"select * from blog order by date_post desc");
	if(mysqli_num_rows($query)!=0){
		while($data=mysqli_fetch_array($query)){
		echo "
			<a href='layout_blog.php?post=yes&id=$data[id_artikel]'>
				<h2 class='sub-title'>
					$data[tittle]
				</h2>
			</a>
				<p class='post-meta'>Posted by <a href='#'>$data[id_anggota]</a> $data[date_post]</p>
				<hr/ style='margin-top:-25px;margin-bottom:5px;'>
				<article>
					".substr($data["content"],0,350)."[...]
				<div class='thumbnail pull-right'>
                        <a href='layout_blog.php?post=yes&id=$data[id_artikel]'>Read more &rarr;</a>
                </div>
				</article>
			
			<br/>
		";
	}}
	else {echo "<h3 class='post-subtitle'>
					<center>Not Posted</center>
				</h3>";
		}
?>