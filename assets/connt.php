<?php
	$host="localhost";
	$user="root";
	$pass="";
	$dbname="sik";

	$koneksi=mysqli_connect($host,$user,$pass);
	if(!$koneksi){
		die("Belum Terkoneksi...");
	}
	$hasil=mysqli_select_db($koneksi,$dbname);
	if(!$hasil){
		die("Database belum tersedia...");
	}
?>
