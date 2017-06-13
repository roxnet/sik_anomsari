<?php
	include_once "../connt.php";
?>
<div class="col-md-4">
	<div class="row">
		<div class="thumbnail" style="border-radius:0px;">
			 <div class="input-group" style="margin:10px">
				<input type="text" class="form-control" placeholder="Search..." style="border-radius:0px;"/>
				<span class="input-group-btn">
					<button class="btn btn-default" type="button">
					<i class="fa fa-fw fa-search"></i>
				</button>
			  </span>
			</div><!-- /input-group -->
		</div>
	</div>
	<div class="row">
		<div class="thumbnail" style="padding:0px 20px 20px 20px;border-radius:0px;">
				<h4 style="color:#00b33c;"><center>Recent Post</center></h4>
				<?php
				$query=mysqli_query($koneksi,"select * from blog order by date_post desc");
					if(mysqli_num_rows($query)!=0){
						while($data=mysqli_fetch_array($query)){
						echo "
							<hr/ style='margin:5px;'>
							<a href='post.php?id=$data[id_artikel]'>
									$data[tittle]
							</a>
						";
					}}
				?>
		</div>
	</div>
</div>