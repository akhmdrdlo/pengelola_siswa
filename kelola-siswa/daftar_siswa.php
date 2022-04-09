<?php 
session_start();

if(!$_SESSION['id']){
  echo "<script>window.alert('Anda Harus Login!!'); window.location.href='../login/login.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/icon/css/all.css">

    <title>HALAMAN PENDAFTARAN</title>
  </head>
  <body>

    <div class="container" style="margin-top: 50px">
      <div class="row">
      <div class="col-md-2">
        <ul class="list-group">
          <li class="list-group-item bg-secondary text-white">MAIN MENU</li>
          <a href="../dashboard/index.php" class="list-group-item active" ><i class="fas fa-home"></i> Dashboard</a>
          <a href="../dashboard/profil.php" class="list-group-item " style="color: #212529;"><i class="fas fa-user-tie"></i> Profile</a>
          <a href="#" data-toggle="modal" data-target="#logout" class="list-group-item" style="color: #212529;"><i class="fas fa-sign-out-alt"></i> Logout</a>
          <ul class="list-group mt-3">
            <button onclick="darkMode()" class="btn btn-md btn-secondary">Ubah Mode</button>
          </ul>
        </ul>
      </div>
        <div class="col-md-10">
          <div class="card">
            <div class="card-body">
              <h4>PENDAFTARAN SISWA BARU</h4>
              <hr>
                <div class="form-group">
                  <label>NISN</label>
                  <input type="text" class="form-control" id="nisn" placeholder="Masukkan NISN Siswa">
                </div>

                <div class="form-group">
                  <label>Nama Lengkap</label>
                  <input type="text" class="form-control" id="nama_siswa" placeholder="Masukkan Nama Lengkap Siswa">
                </div>

                <div class="form-group">
                  <label>Alamat Rumah</label>
                  <input type="text" class="form-control" id="alamat" placeholder="Masukkan Alamat Rumah Siswa">
                </div>

                <div class="form-group">
                  <label>Asal Sekolah</label>
                  <input type="Asal Sekolah" class="form-control" id="asal_sekolah" placeholder="Masukkan Asal Sekolah Siswa">
                </div>
                
                <button class="btn btn-daftar btn-block btn-success"><i class="fas fa-user-plus"></i> DAFTAR</button>
                <button id="reset" class="btn btn-block btn-warning"><i class="fas fa-undo"></i> RESET</button>
              
            </div>
            <!-- Modal logout -->
              <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabelLogout">Upss!!</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <p>Apa kamu yakin ingin Logout, <?php echo $_SESSION['nama'];?>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                        <a href="../fungsi/logout.php" class="btn btn-danger">Logout</a>
                    </div>
                  </div>
                </div>
              </div>

          </div>

        </div>
      </div>
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js" ></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function(){
            $(".btn-daftar").click(function(){

                var nisn = $("#nisn").val();
                var nama_siswa = $("#nama_siswa").val();
                var alamat = $("#alamat").val();
                var asal_sekolah = $("#asal_sekolah").val();

                if(nisn.length == ""){
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Tolong Masukkan NISN Siswa Dahulu!'
                    });
                } else if(nama_siswa.length == ""){
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Tolong Masukkan Nama Siswa Dahulu!'
                    });
                } else if(alamat.length == ""){
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Tolong Masukkan Alamat Siswa Dahulu!'
                    });
                } else if(asal_sekolah.length == ""){
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Tolong Masukkan Asal Sekolah Siswa Dahulu!'
                    });
                }  
                else {
                    $.ajax({

                        url: "../fungsi/proses_siswa/proses_daftar.php",
                        type: "POST",
                        data: {
                            "nisn": nisn,
                            "nama_siswa": nama_siswa,
                            "alamat": alamat,
                            "asal_sekolah": asal_sekolah
                        },

                        success:function(response){

                            if (response == "success") {

                                Swal.fire({
                                    type: 'success',
                                    title:'Pendaftaran Siswa Berhasil!',
                                    text: 'Silahkan Kembali ke Halaman Sebelumnya'
                                })
                            .then (function() {
                                window.location.href = "../dashboard/index.php";
                            });

                            $("#nisn").val('');
                            $("#nama_siswa").val('');
                            $("#alamat").val('');
                            $('#asal_sekolah').val('');

                            } else {

                                Swal.fire({
                                    type: 'error',
                                    title: 'Pendaftaran Gagal!',
                                    text: 'Silahkan Coba Lagi!'
                                });

                            }
                            console.log(response);
                        },
                        error:function(response){
                            Swal.fire({
                                type: 'error',
                                title: 'Ooops!',
                                text: 'Server Error!'
                            });
                        }
                    })
                }
            });
        });

        $(document).ready(function(){
          $("#reset").click(function(){
            $("#nisn").val('');
            $("#nama_siswa").val('');
            $("#alamat").val('');
            $('#asal_sekolah').val('');
          });
        });
        function darkMode() {
          var element = document.body;
          element.classList.toggle("mode");
        }
</script>
</body>
</html>