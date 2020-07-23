<?php error_reporting(0) ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		$('.home').addClass('active');
	});
</script>
<div class="pcoded-content">
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="feather icon-home bg-c-blue"></i>
					<div class="d-inline">
						<h5>Dashboard Guru</h5>
						<span>Selamat Datang <?= $this->session->userdata('nama')?></span>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="page-header-breadcrumb">
					<ul class=" breadcrumb breadcrumb-title">
						<li class="breadcrumb-item">
							<a href="<?= site_url('guru/home') ?>"><i class="feather icon-home"></i></a>
						</li>
						<li class="breadcrumb-item"><a href="<?= site_url('guru/home') ?>">Home</a> </li>
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
						<div class="col-xl-6 col-md-6">
							<div class="card prod-p-card card-yellow">
								<div class="card-body">
									<div class="row align-items-center m-b-30">
										<div class="col">
											<h6 class="m-b-5 text-white">Total Siswa Mapel : <?= $mapel->nama_mapel ?></h6>
											<h3 class="m-b-0 f-w-700 text-white"><?= $nsiswa ?>  <span style="font-size: 0.7em">Siswa/i</span></h3>
										</div>
										<div class="col-auto">
											<i class="fas fa-users text-c-yellow f-18"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-xl-6 col-md-6">
							<div class="card prod-p-card card-blue">
								<div class="card-body">
									<div class="row align-items-center m-b-30">
										<div class="col">
											<h6 class="m-b-5 text-white">Total Guru Mapel : <?= $mapel->nama_mapel ?></h6>
											<h3 class="m-b-0 f-w-700 text-white"><?= $guru ?>   <span style="font-size: 0.7em">Guru</span></h3>
										</div>
										<div class="col-auto">
											<i class="fas fa-users text-c-blue f-18"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-12">
							<div class="card product-progress-card">
								<div class="card-header">
									<h5>Rata-rata nilai siswa mata pelajaran - <?= $mapel->nama_mapel ?> :</h5>
									<div class="card-header-right">
										<ul class="list-unstyled card-option">
											<li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
											<li><i class="feather icon-maximize full-card"></i></li>
											<li><i class="feather icon-minus minimize-card"></i></li>
											<li><i class="feather icon-refresh-cw reload-card"></i></li>
											<li><i class="feather icon-trash close-card"></i></li>
											<li><i class="feather icon-chevron-left open-card-option"></i></li>
										</ul>
									</div>
								</div>

								<div class="card-block">
									<div href="<?= site_url('guru/nilai') ?>" class="row pp-main">
										<div class="col-xl-4 col-md-6">
											<div class="pp-cont">
												<div class="row align-items-center m-b-20">
													<div class="col-auto">
														<i class="fas fa-book f-24 text-mute"></i>
													</div>
													<div class="col text-right">
														<h2 class="m-b-0 text-c-blue">
															<?php $rt = $sw1;
															$jm = $kls1->jrata;
															echo $ratakls1 = $jm/$rt; ?>
														</h2>
													</div>
												</div>
												<div class="row align-items-center m-b-15">
													<div class="col-auto">
														<p class="m-b-0">Total Nilai Rata Siswa Kelas 1</p>
													</div>
													<div class="col text-right">
														<p class="m-b-0 text-c-blue">
															<?= $jm; ?>
															<!-- <i class="fas fa-long-arrow-alt-up m-r-10"></i> -->
															</p>
													</div>
												</div>
												<div class="progress">
													<div class="progress-bar bg-c-blue" style="width:<?= $ratakls1; ?>%"></div>
												</div>
											</div>
										</div>
										<div class="col-xl-4 col-md-6">
											<div class="pp-cont">
												<div class="row align-items-center m-b-20">
													<div class="col-auto">
														<i class="fas fa-book f-24 text-mute"></i>
													</div>
													<div class="col text-right">
														<h2 class="m-b-0 text-c-green">
															<?php $rt2 = $sw2;
															$jm2 = $kls2->jrata;
															echo $ratakls2 = $jm2/$rt2; ?>
														</h2>
													</div>
												</div>
												<div class="row align-items-center m-b-15">
													<div class="col-auto">
														<p class="m-b-0">Total Nilai Rata Siswa Kelas 2</p>
													</div>
													<div class="col text-right">
														<p class="m-b-0 text-c-green">
															<?= $jm2; ?>
															<!-- <i class="fas fa-long-arrow-alt-down m-r-10"></i> -->
														</p>
													</div>
												</div>
												<div class="progress">
													<div class="progress-bar bg-c-green" style="width:<?= $ratakls2; ?>%"></div>
												</div>
											</div>
										</div>
										<div class="col-xl-4 col-md-6">
											<div class="pp-cont">
												<div class="row align-items-center m-b-20">
													<div class="col-auto">
														<i class="fas fa-book f-24 text-mute"></i>
													</div>
													<div class="col text-right">
														<h2 class="m-b-0 text-c-red">
															<?php $rt3 = $sw3;
															$jm3 = $kls3->jrata;
															echo $ratakls3 = $jm3/$rt3;
															?>
														</h2>
													</div>
												</div>
												<div class="row align-items-center m-b-15">
													<div class="col-auto">
														<p class="m-b-0">Total Nilai Rata Siswa Kelas 3</p>
													</div>
													<div class="col text-right">
														<p class="m-b-0 text-c-red">
															<?= $jm3; ?>
															<!-- <i class="fas fa-long-arrow-alt-up m-r-10"></i> -->
															</p>
													</div>
												</div>
												<div class="progress">
													<div class="progress-bar bg-c-yellow" style="width:<?= $ratakls3; ?>%"></div>
												</div>
											</div>
										</div>
										<div class="col-xl-12 col-md-12">
											<hr>
										</div>
										<div class="col-xl-4 col-md-6">
											<div class="" style="padding-left: 15px;">
												<div class="row align-items-center m-b-20">
													<div class="col-auto">
														<i class="fas fa-edit f-24 text-mute"></i>
													</div>
													<div class="col text-right">
														<h2 class="m-b-0 text-c-blue">
															<?php $rt4 = $sw4;
															$jm4 = $kls4->jrata;
															echo $ratakls4 = $jm4/$rt4; ?>
														</h2>
													</div>
												</div>
												<div class="row align-items-center m-b-15">
													<div class="col-auto">
														<p class="m-b-0">Total Nilai Rata Siswa Kelas 6</p>
													</div>
													<div class="col text-right">
														<p class="m-b-0 text-c-blue">
															<?= $jm4; ?>
															<!-- <i class="fas fa-long-arrow-alt-up m-r-10"></i> -->
															</p>
													</div>
												</div>
												<div class="progress">
													<div class="progress-bar bg-c-blue" style="width:<?= $ratakls4; ?>%"></div>
												</div>
											</div>
										</div>
										<div class="col-xl-4 col-md-6">
											<div class="pp-cont">
												<div class="row align-items-center m-b-20">
													<div class="col-auto">
														<i class="fas fa-edit f-24 text-mute"></i>
													</div>
													<div class="col text-right">
														<h2 class="m-b-0 text-c-green">
															<?php $rt5 = $sw5;
															$jm5 = $kls5->jrata;
															echo $ratakls5 = $jm5/$rt5; ?>
														</h2>
													</div>
												</div>
												<div class="row align-items-center m-b-15">
													<div class="col-auto">
														<p class="m-b-0">Total Nilai Rata Siswa Kelas 5</p>
													</div>
													<div class="col text-right">
														<p class="m-b-0 text-c-green">
															<?= $jm5; ?>
															<!-- <i class="fas fa-long-arrow-alt-up m-r-10"></i> -->
															</p>
													</div>
												</div>
												<div class="progress">
													<div class="progress-bar bg-c-red" style="width:<?= $ratakls5; ?>%"></div>
												</div>
											</div>
										</div>
										<div class="col-xl-4 col-md-6">
											<div class="pp-cont">
												<div class="row align-items-center m-b-20">
													<div class="col-auto">
														<i class="fas fa-book f-24 text-mute"></i>
													</div>
													<div class="col text-right">
														<h2 class="m-b-0 text-c-red">
															<?php $rt6 = $sw6;
															$jm6 = $kls6->jrata;
															echo $ratakls6 = $jm6/$rt6;
															?>
														</h2>
													</div>
												</div>
												<div class="row align-items-center m-b-15">
													<div class="col-auto">
														<p class="m-b-0">Total Nilai Rata Siswa Kelas 6</p>
													</div>
													<div class="col text-right">
														<p class="m-b-0 text-c-red">
															<?= $jm6; ?>
															<!-- <i class="fas fa-long-arrow-alt-up m-r-10"></i> -->
															</p>
													</div>
												</div>
												<div class="progress">
													<div class="progress-bar bg-c-yellow" style="width:<?= $ratakls6; ?>%"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<div id="styleSelector">
</div>