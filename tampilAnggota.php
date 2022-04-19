<?php
//koneksi ke database mysql,
    include 'koneksi.php';

    $ID	            = "";
	$Nama			= "";
	$Kelas			= "";
	$No_tlp			= "";
	$Alamat			= "";
    $sukses         = "";
    $error          ="";

    if(isset($_GET['op'])){
        $op = $_GET['op'];
    }else{
        $op ="";
    }

    if($op =='delete'){
        $ID = $_GET['ID'];
        $sql1 = "delete from anggota where ID = '$ID' ";
        $q1 = mysqli_query($koneksi, $sql1);
        if($q1){
            $sukses ="Berhasil menghapus data";
        }else{
            $error ="Gagal melakukan penghapusan data";
        }
    }

    if($op == 'edit'){
        $ID         = $_GET['ID'];
        $sql1       = "select * from anggota where ID = '$ID'";
        $q1         = mysqli_query($koneksi, $sql1);
        $r1         = mysqli_fetch_array($q1);
        $ID         = $r1['ID'];
        $Nama       = $r1['Nama'];
        $Kelas      = $r1['Kelas'];
        $No_tlp     = $r1['No_tlp'];
        $Alamat     = $r1['Alamat'];

        if($ID ==''){
            $error = "Data tidak ditemukan";
        }
    }


    if(isset($_POST['submit'])){ //untuk create
        $ID         =$_POST['ID'];
        $Nama       =$_POST['Nama'];
        $Kelas      =$_POST['Kelas'];
        $No_tlp     =$_POST['No_tlp'];
        $Alamat     =$_POST['Alamat'];

        if($ID && $Nama && $Kelas && $No_tlp && $Alamat){
            if($op == 'edit'){ //untuk update
                $aql1 = "update anggota set ID= '$ID', Nama='$Nama', Kelas='$Kelas', No_tlp='$No_tlp', Alamat ='$Alamat' where ID = '$ID'";
                $q1  = mysqli_query($koneksi, $sql1);
                if($q1){
                    $sukses = "data berhasil di update";
                }else{
                    $error ="data gagal di update";
                }
            }else { //untuk insert
                $sql1 = "insert into anggota(ID, Nama, Kelas, No_tlp, Alamat) value ('$ID','$Nama','$Kelas','$No_tlp','$Alamat')";
                $q1 = mysqli_query($koneksi, $sql1);
    
                if($q1){
                    $sukses = "Berhasil menambah data baru";
                }else {
                    $error = "Gagal menambah data";
                }
            }
           
        } else{
            $error = "Silakan masukan semua data";
        }
    }
       

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .mx-auto {
            width : 800px;
        }
        .card {
            margin-top : 10px;
        }
    </style>
</head>
<body>
    <div class="mx-auto">
        <!-- form start -->
        <div class="card">
            <div class="card-header bg-warning">
           Form anggota
            </div>
                <div class="card-body">
                  <!-- alert start -->
                  <?php
                  if($error){
                  ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error?>
                        </div>
                  <?php
                  }
                  ?>
                  <?php
                  if($sukses){
                  ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $sukses?>
                        </div>
                  <?php
                  }
                  ?>
                  <!-- alert end -->

                    <form action="" method="post">
                        <div class="mb-3 row">
                            <label for="ID" class="col-sm-2 col-form-label">ID</label>
                            <div class="col-sm-10">
                            <input type="text"  name="ID" class="form-control" id="ID" value="<?php echo $ID?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="Nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                            <input type="text" name="Nama" class="form-control" id="Nama" value="<?php echo $Nama?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="Kelas" class="col-sm-2 col-form-label">Kelas</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="Kelas" id="Kelas">
                                    <option value="">-pilih kelas-</option>
                                    <option value="RPL" <?php if($Kelas=="RPL") echo"selected"?>>RPL</option>
                                    <option value="MM" <?php if($Kelas=="MM") echo"selected"?>>MM</option>
                                    <option value="DKV" <?php if($Kelas=="DKV") echo"selected"?>>DKV</option>
                                    <option value="TKJ" <?php if($Kelas=="TKJ") echo"selected"?>>TKJ</option>
                                    <option value="ANIMASI" <?php if($Kelas=="ANIMASI") echo"selected"?>>ANIMASI</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="No_tlp" class="col-sm-2 col-form-label">No tlp</label>
                            <div class="col-sm-10">
                            <input type="text"  name="No_tlp" class="form-control" id="No_tlp" value="<?php echo $No_tlp?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="Alamat" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                            <input type="text" name="Alamat" class="form-control" id="Alamat" value="<?php echo $Alamat?>">
                            </div>
                        </div>
                        <div class="col-12">
                            <input type="submit" name="submit" value="Simpan" class="btn btn-primary">
                        </div>
                    </form>
                </div>
        </div>
        <!-- form end -->

        <!-- table start -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
           Data anggota
            </div>
                <div class="card-body">
                  <table class="table">
                      <thead>
                          <tr>
                              <th scope="col">#</th>
                              <th scope="col">ID</th>
                              <th scope="col">Nama</th>
                              <th scope="col">Kelas</th>
                              <th scope="col">No telpon</th>
                              <th scope="col">Alamat</th>
                              <th scope="col">Aksi</th>
                          </tr>
                          <tbody>
                              <?php
                              $sql2 = "select * from anggota order by id desc";
                              $q2   = mysqli_query($koneksi, $sql2);
                              $urut =1;

                              while($data = mysqli_fetch_array($q2)){
                                  $ID       = $data['ID'];
                                  $Nama     = $data['Nama'];
                                  $Kelas    = $data['Kelas'];
                                  $No_tlp   = $data['No_tlp'];
                                  $Alamat   = $data['Alamat'];

                                  ?>
                                <tr>
                                    <th scope="row"><?php echo $urut++ ?></th>
                                    <td scope="row"><?php echo $ID?></td>
                                    <td scope="row"><?php echo $Nama?></td>
                                    <td scope="row"><?php echo $Kelas?></td>
                                    <td scope="row"><?php echo $No_tlp?></td>
                                    <td scope="row"><?php echo $Alamat?></td>
                                    <td scope="row">
                                        <a href="perpusBagol.php?page=tampil_anggota&op=edit&ID=<?php echo $ID?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                        <a href="perpusBagol.php?page=tampil_anggota&op=delete&ID=<?php echo $ID?>" onclick="return confirm('Yakin mau delete data?')"> <button type="button" class="btn btn-danger">Delete</button></a>
                                       
                                    </td>
                                </tr>
                                  <?php
                              }
                              ?>
                          </tbody>
                      </thead>
                  </table>
                </div>
        </div>
        <!-- table end -->
    </div>
</body>
</html>