
<?php
  include_once "../connt.php";
  include ('../kontrol/session_cekker.php');
   $sql_user=mysqli_query($koneksi,"SELECT a.*,b.* FROM anggota a 
      INNER JOIN phone_number b ON a.id_anggota=b.id_anggota
      WHERE a.nickname='$nameUser'");
    if(mysqli_num_rows($sql_user)==1);
      $onlyuser=mysqli_fetch_assoc($sql_user);
?>
<div class="form-group">
  <table class="table table-striped">
  <tr>
    <td colspan="3">
      <img src="../images/profil/<?php echo $onlyuser['profil'];?>" width="200">
    </td>
  </tr>
  <tr>
    <td>Nama panggilan</td>
    <td> : </td>
    <td><?php echo $onlyuser['nickname'];?></td>
  <tr>
  <tr>
    <td>Nama lengkap</td>
    <td> : </td>
    <td><?php echo $onlyuser['name'];?></td>
  <tr>
  <tr>
    <td>Jenis kelamin</td>
    <td> : </td>
    <td><?php if ($onlyuser['gender']=='L') echo "LAKI-LAKI";
    else echo "PEREMPUAN"; ?></td>
  <tr>
  <tr>
    <td>Golongan darah</td>
    <td> : </td>
    <td><?php echo $onlyuser['bloodtype'];?></td>
  <tr>
  <tr>
    <td>Tempat/Tanggal lahir</td>
    <td> : </td>
    <td><?php echo $onlyuser['birthplace'];?> / <?php echo $onlyuser['birthdate'];?></td>
  <tr>
  <tr>
    <td>Alamat</td>
    <td> : </td>
    <td><?php echo $onlyuser['address'];?></td>
  <tr>
  <tr>
    <td>Pekerjaan</td>
    <td> : </td>
    <td><?php echo $onlyuser['job'];?></td>
  <tr>
  <tr>
    <td>No telp</td>
    <td> : </td>
    <td><?php echo $onlyuser['phone_number'];?>
  <tr>
  <tr>
    <td>Email</td>
    <td> : </td>
    <td><?php echo $onlyuser['email'];?></td>
  <tr>
  </table>
</div>
