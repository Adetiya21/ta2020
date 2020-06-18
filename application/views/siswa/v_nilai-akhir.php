<link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>bower_components/jquery.steps/css/jquery.steps.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>assets/css/style.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.nilai').addClass('active');
  	});


    function check_int(evt) {
      var charCode = ( evt.which ) ? evt.which : event.keyCode;
      return ( charCode >= 48 && charCode <= 57 || charCode == 8 );
    }
</script>

<div class="pcoded-content">
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="feather icon-file-text bg-c-blue"></i>
					<!-- <i class="fa fa-file-text-o bg-c-blue"></i> -->
					<div class="d-inline">
						<h5>Data Nilai AkhirSiswa</h5>
						<span>Berikut data nilai siswa</span>
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
							<a href="<?= site_url('nilai') ?>">Nilai Siswa</a>
						</li>
						<li class="breadcrumb-item">
							<a href="<?= site_url('nilai/nilai_akhir') ?>">Nilai Akhir Siswa</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="pcoded-inner-content"  style="margin-top: -20px;margin-bottom: -20px">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<button class="btn btn-danger btn-round" onclick="ExportPdf()"><span class="fa fa-print"></span> Cetak Berkas</button>
				</div>
			</div>
		</div>
	</div>
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<div id="myCanvas" class="card" >
						<div class="card-header" align="center" style="margin-top: 40px;">
							<!-- <h5>Data Nilai Siswa</h5>
							<div class="card-header-right"> <ul class="list-unstyled card-option"> <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li> <li><i class="feather icon-maximize full-card"></i></li> <li><i class="feather icon-minus minimize-card"></i></li> <li><i class="feather icon-refresh-cw reload-card"></i></li> <li><i class="feather icon-trash close-card"></i></li> <li><i class="feather icon-chevron-left open-card-option"></i></li> </ul> </div> -->
							<h4 style="font-weight: bold;margin-bottom: 30px">DAFTAR NILAI AKHIR SISWA</h4>
							
							<hr style="height: 2px; background: #333;">
						</div>
						<div class="card-block" style="padding-left: 50px;padding-right: 50px;padding-top: 30px;margin-top: -30PX;">
							<h4 class="sub-title" style="margin-bottom: 0;">SISWA</h4>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label" style="margin-bottom: -30px; font-size:0.9em;">Nama</label>
									<label class="col-sm-8 col-form-label" style="margin-bottom: -30px; font-size:0.9em;">: <b style="font-weight: bold;"><?= $profil->nama ?></b></label>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label" style="margin-bottom: -30px; font-size:0.9em;">Kelas</label>
									<?php foreach ($kelas->result() as $key) { if ($profil->id_kelas == $key->id) { ?>
									<label class="col-sm-8 col-form-label" style="margin-bottom: -30px; font-size:0.9em;">: <b style="font-weight: bold;"><?= $key->nama_kelas ?></b></label>
									<?php }} ?>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label" style="font-size:0.9em;">Tempat / Tanggal Lahir</label>
									<label class="col-sm-8 col-form-label" style="font-size:0.9em;">: <b style="font-weight: bold;"><?= $profil->tmp_lahir.' / '.date('d-m-Y', strtotime($profil->tgl_lahir)); ?></b></label>
								</div>

							<h4 style="margin-bottom: 0;" class="sub-title">PENILAIAN</h4>
								<?php $jumlah = 0;
								 foreach ($mapel->result() as $key) { ?>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label" style="margin-bottom: -20px; font-size:0.9em;"><?= $key->nama_mapel; ?></label>
									<?php     
									foreach ($nilai->result() as $key1) { if ($key->id == $key1->id_mapel) {
										$jumlah += (int)$key1->rata;
									?>
									<label class="col-sm-8 col-form-label" style="margin-bottom: -20px; font-size:0.9em;" id="nilai"><b style="font-weight: bold;"><?= $key1->rata ?></b></label>
									<?php }} ?>
									
								</div>
								<?php } ?>
								
							<h4 class="sub-title" style="margin-top:40px">NILAI RATA-RATA</h4>
								<!-- <label class="col-form-label">Objek sewa akan digunakan oleh <b style="font-weight: bold">$profil->nama</b> untuk keperluan berdagang :</label> -->
								<h3 id="jumlahrata"> Nilai Rata-Rata : <?= $jumlah/8; ?></h3>
								
							<hr>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="styleSelector">
		</div>
	</div>
</div>
<script src="https://kendo.cdn.telerik.com/2017.2.621/js/jquery.min.js"></script>
<script src="https://kendo.cdn.telerik.com/2017.2.621/js/jszip.min.js"></script>
<script src="https://kendo.cdn.telerik.com/2017.2.621/js/kendo.all.min.js"></script>

<script type="text/javascript">
    function ExportPdf(){ 
	kendo.drawing
	    .drawDOM("#myCanvas", 
	    { 
	        paperSize: "A4",
	        margin: { left:"1cm", right:"1cm" ,top: "0", bottom: "0.2cm" },
	        scale: 0.61,
	        height: 800
	    })
	        .then(function(group){
	        kendo.drawing.pdf.saveAs(group, "Daftar Nilai <?= $this->session->userdata('nama')?>.pdf")
	    });
	}
</script>