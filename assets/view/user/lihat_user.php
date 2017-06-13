<div class="modal-body">
  <table class="table table-hover">
  <!--<tr>
    <td>Keluarga</td>
    <td>:</td>
  <tr>-->
  <tr>
    <td colspan="2" align="">
      <img src="../images/profil/avatar.jpg" width="250">
    </td>
  </tr>
  <tr>
    <td>Nama panggilan</td>
    <td>: '.$rows["nickname"].'</td>
  <tr>
  <tr>
    <td>Nama lengkap</td>
    <td>: '.$rows["name"].'</td>
  <tr>
  <tr>
    <td>Jenis kelamin</td>
    <td>:';
    if ($rows["gender"]=="L"){
      echo 'Laki-laki';
    }else echo 'Perempuan';

echo        '</td>
  <tr>
  <tr>
    <td>Golongan darah</td>
    <td>: '.$rows["bloodtype"].'</td>
  <tr>
  <tr>
    <td>Tempat/Tanggal lahir</td>
    <td>: '.$rows["birthplace"].' / '.$rows["birthdate"].'</td>
  <tr>
  <tr>
    <td colspan="2"><br/></td>
  <tr>
  <tr>
    <td>Alamat</td>
    <td>: '.$rows["adress"].'</td>
  <tr>
  <tr>
    <td>Pekerjaan</td>
    <td>: '.$rows["job"].'</td>
  <tr>
  <tr>
    <td>No telp</td>
    <td>: ';
    $set2 = mysqli_query($koneksi, "SELECT * FROM phone_number WHERE id_anggota = $id");
    while($rowp= mysqli_fetch_assoc($set2)){
      echo $rowp["phone_number"];
    }
echo  '         </td>
  <tr>
  <tr>
    <td>Email</td>
    <td>: '.$rows["email"].'</td>
  <tr>
  </table>
</div>
