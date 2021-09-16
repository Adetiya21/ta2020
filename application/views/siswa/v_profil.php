<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.profile').addClass('active');
    });

    
    function check_int(evt) {
      var charCode = ( evt.which ) ? evt.which : event.keyCode;
      return ( charCode >= 48 && charCode <= 57 || charCode == 8 );
    }

    function PreviewImage() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

    oFReader.onload = function (oFREvent) {
      document.getElementById("uploadPreview").src = oFREvent.target.result;
    };
  };
</script>

<div class="pcoded-content">
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="feather icon-user bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>Profil</h5>
                        <span>Lengkapi data diri anda</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="<?= site_url('home') ?>"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?= site_url('home/profil') ?>">Profil</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="pcoded-inner-content">

        <div class="main-body">
            <div class="page-wrapper">

                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Data Profil</h5>
                                    <div class="card-header-right"> <ul class="list-unstyled card-option"> <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li> <li><i class="feather icon-maximize full-card"></i></li> <li><i class="feather icon-minus minimize-card"></i></li> <li><i class="feather icon-refresh-cw reload-card"></i></li> <li><i class="feather icon-trash close-card"></i></li> <li><i class="feather icon-chevron-left open-card-option"></i></li> </ul> </div>                    
                                </div>
                                <div class="card-block">
                                    <!-- <form id="main" method="post" action="https://colorlib.com/" novalidate> -->
                                    <?= $this->session->flashdata('pesan'); ?>
                                    <?= $this->session->flashdata('error'); ?>
                                    <?= form_open('home/edit_profil'); ?>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label >NIS</label>
                                                    <input type="text" class="form-control" placeholder="NIS" name="nis" value="<?= $profil->nis ?>"  required maxlength="13" onkeypress='return check_int(event)' readonly/>
                                                    <span class="help-block"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label >Password</label>
                                                    <input type="password" class="form-control" placeholder="Isi Password Lagi!" name="password" required value="<?= $profil->password ?>" />
                                                    <span class="help-block"></span>
                                                    <br>
                                                </div>
                                                <hr>
                                                <div class="form-group">
                                                    <label >Nama Siswa</label>
                                                    <input type="text" class="form-control" placeholder="Nama Siswa" value="<?= $profil->nama ?>"  name="nama" required/>
                                                    <span class="help-block"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Kelas</label>
                                                     <?php foreach ($kelas->result() as $key) {
                                                            if($profil->id_kelas==$key->id){?>
                                                    <input type="text" value="<?= $key->nama_kelas ?>" class="form-control" readonly>
                                                    <input type="hidden" name="id_kelas" value="<?= $profil->id_kelas ?>">
                                                    <?php }} ?>
                                                    <span class="help-block"></span>
                                                </div>                            
                                            </div>                                              
                                            <div class="col-md-6">
                                            	<div class="form-group">
				                                    <label >Tempat / Tanggal Lahir</label>
				                                    <div class="row">
				                                        <div class="col-md-6">
				                                            <input type="text" class="form-control" placeholder="Tempat" name="tmp_lahir" value="<?= $profil->tmp_lahir ?>" required/>
				                                            <span class="help-block"></span>
				                                        </div>
				                                        <div class="col-md-6">
				                                            <input type="date" name="tgl_lahir" class="form-control" value="<?= $profil->tgl_lahir ?>">
				                                            <span class="help-block"></span>
				                                        </div>
				                                    </div>
				                                </div>
                                                <div class="form-group">
                                                    <label >Jenis Kelamin</label>
                                                    <select name="jenkel" class="form-control">
                                                        <option>Pilih Jenis Kelamin</option>
                                                        <?php if ($profil->jenkel=="Laki-Laki") {
                                                            echo '<option value="Laki-Laki" selected>Laki-Laki</option>';
                                                            echo '<option value="Perempuan">Perempuan</option>';    
                                                        } else { 
                                                            echo '<option value="Laki-Laki">Laki-Laki</option>';
                                                            echo '<option value="Perempuan" selected>Perempuan</option>';
                                                        }?>
                                                    </select>
                                                    <span class="help-block"></span>
                                                </div>   
                                                <div class="form-group">
                                                    <label >Agama</label>
                                                    <select name="agama" class="form-control">
                                                        <option>Pilih Agama</option>
                                                        <?php if ($profil->agama=="Islam") {
                                                            echo '<option value="Islam" selected>Islam</option>';
                                                            echo '<option value="Kristen">Kristen</option>';
                                                            echo '<option value="Katolik">Katolik</option>';
                                                            echo '<option value="Hindu">Hindu</option>';
                                                            echo '<option value="Buddha">Buddha</option>';
                                                            echo '<option value="Kong Hu Cu">Kong Hu Cu</option>';
                                                        } else if ($profil->agama=="Kristen") {
                                                            echo '<option value="Islam">Islam</option>';
                                                            echo '<option value="Kristen" selected>Kristen</option>';
                                                            echo '<option value="Katolik">Katolik</option>';
                                                            echo '<option value="Hindu">Hindu</option>';
                                                            echo '<option value="Buddha">Buddha</option>';
                                                            echo '<option value="Kong Hu Cu">Kong Hu Cu</option>';
                                                        } else if ($profil->agama=="Katolik") {
                                                            echo '<option value="Islam">Islam</option>';
                                                            echo '<option value="Kristen">Kristen</option>';
                                                            echo '<option value="Katolik" selected>Katolik</option>';
                                                            echo '<option value="Hindu">Hindu</option>';
                                                            echo '<option value="Buddha">Buddha</option>';
                                                            echo '<option value="Kong Hu Cu">Kong Hu Cu</option>';
                                                        } else if ($profil->agama=="Hindu") {
                                                            echo '<option value="Islam">Islam</option>';
                                                            echo '<option value="Kristen">Kristen</option>';
                                                            echo '<option value="Katolik">Katolik</option>';
                                                            echo '<option value="Hindu" selected>Hindu</option>';
                                                            echo '<option value="Buddha">Buddha</option>';
                                                            echo '<option value="Kong Hu Cu">Kong Hu Cu</option>';
                                                        } else if ($profil->agama=="Buddha") {
                                                            echo '<option value="Islam">Islam</option>';
                                                            echo '<option value="Kristen">Kristen</option>';
                                                            echo '<option value="Katolik">Katolik</option>';
                                                            echo '<option value="Hindu">Hindu</option>';
                                                            echo '<option value="Buddha" selected>Buddha</option>';
                                                            echo '<option value="Kong Hu Cu">Kong Hu Cu</option>';
                                                        } else if ($profil->agama=="Kong Hu Cu") {
                                                            echo '<option value="Islam">Islam</option>';
                                                            echo '<option value="Kristen">Kristen</option>';
                                                            echo '<option value="Katolik">Katolik</option>';
                                                            echo '<option value="Hindu">Hindu</option>';
                                                            echo '<option value="Buddha">Buddha</option>';
                                                            echo '<option value="Kong Hu Cu" selected>Kong Hu Cu</option>';
                                                        }?>
                                                    </select>
                                                    <span class="help-block"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label >Alamat</label>
                                                    <textarea name="alamat" class="form-control" cols="30" rows="3"><?= $profil->alamat ?></textarea>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group row">
                                            <!-- <label class="col-sm-2"></label> -->
                                            <div class="col-sm-2">
                                                <button class="btn btn-primary m-b-0 btn-round" style="color: #fff"><i class="fa fa-edit"></i> Edit Data</abutton>
                                            </div>
                                        </div>
                                    <!-- </form> -->
                                    <?= form_close(); ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div id="styleSelector">
        </div>
    </div>
</div>