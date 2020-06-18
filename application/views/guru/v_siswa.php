<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.siswa').addClass('active');
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
					<i class="feather icon-layout bg-c-blue"></i>
					<div class="d-inline">
						<h5>Siswa Mata Pelajaran
                            <?php if ($mapel->id==$this->session->userdata('id_mapel')) {
                                echo $mapel->nama_mapel;
                            } ?>
                        </h5>
						<span>Berikut data para siswa.</span>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="page-header-breadcrumb">
					<ul class=" breadcrumb breadcrumb-title">
						<li class="breadcrumb-item">
							<a href="<?= site_url('guru/home') ?>"><i class="feather icon-home"></i></a>
						</li>
						<li class="breadcrumb-item">
							<a href="<?= site_url('guru/siswa') ?>">Siswa</a>
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
					<div class="card">
						<div class="card-header">
							<h5>Data Siswa</h5>
                            <div class="card-header-right"> <ul class="list-unstyled card-option"> <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li> <li><i class="feather icon-maximize full-card"></i></li> <li><i class="feather icon-minus minimize-card"></i></li> <li><i class="feather icon-refresh-cw reload-card"></i></li> <li><i class="feather icon-trash close-card"></i></li> <li><i class="feather icon-chevron-left open-card-option"></i></li> </ul> </div>
						</div>
						<div class="card-block">
							<div class="dt-responsive table-responsive">
								<table id="compact" class="table table-bordered table-hover nowrap" width="100%">
									<thead>
										<tr><th width="1%">No</th>
										<th>NIS</th>
										<th>Nama Siswa</th>
										<th>Kelas</th>
										<th width="10%">Action</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
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

<!-- DataTables -->
<script src="<?= base_url('assets/') ?>datatables/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/') ?>datatables/js/dataTables.bootstrap.js"></script>

<script src="<?= base_url('assets/') ?>bower_components/datatables.net/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/') ?>bower_components/datatables.net-buttons/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/') ?>assets/pages/data-table/js/jszip.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/') ?>assets/pages/data-table/js/pdfmake.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/') ?>assets/pages/data-table/js/vfs_fonts.js" type="text/javascript"></script>
<script src="<?= base_url('assets/') ?>bower_components/datatables.net-buttons/js/buttons.print.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/') ?>bower_components/datatables.net-buttons/js/buttons.html5.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/') ?>bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/') ?>bower_components/datatables.net-responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/') ?>bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js" type="text/javascript"></script>
<!-- page script -->
<script type="text/javascript">

    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
    {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };

    var table = $('#compact').DataTable({
        oLanguage: {
            sProcessing: "loading..."
        },
        processing: true,
        serverSide: true,
        ajax: {"url": "<?= base_url() ?>guru/siswa/json", "type": "POST"},
        columns: [
        {
            "data": "nis",
            "orderable": false
        },
        {"data": "nis"},
        {"data": "nama"},
        {"data": "nama_kelas",
            render: function(data) { 
                if(data==='Kelas 1') {
                  return '<label class="label label-lg label-inverse-danger" style="width:100%; text-align:center">'+data+'</label>'
                }
                else if(data==='Kelas 2') {
                  return '<label class="label label-lg label-inverse-warning" style="width:100%; text-align:center">'+data+'</label>'
                } 
                else if(data==='Kelas 3') {
                  return '<label class="label label-lg label-inverse-succes" style="width:100%; text-align:center">'+data+'</label>'
                } 
                else if(data==='Kelas 4') {
                  return '<label class="label label-lg label-inverse-primary" style="width:100%; text-align:center">'+data+'</label>'
                }
                else if(data==='Kelas 5') {
                  return '<label class="label label-lg label-inverse-info" style="width:100%; text-align:center">'+data+'</label>'
                }
                else if(data==='Kelas 6') {
                  return '<label class="label label-lg label-inverse" style="width:100%; text-align:center">'+data+'</label>'
                } else {
                    return '<label class="label label-lg label-inverse-default" style="width:100%; text-align:center">'+data+'</label>'
                }

              },
              defaultContent: 'Tidak ada data'
            
        },
        // {"data": "status","orderable": false},
        {"data": "view","orderable": false}
        ],
        order: [[1, 'asc']],
        rowCallback: function(row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        }
    });

    //fun reload
    function reload_table()
    {
        table.ajax.reload(null,false); //reload datatable ajax
    }

    //fun view
    function view(nis)
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $.ajax({
            url : '<?php echo site_url("guru/siswa/view/'+nis+'") ?>',
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="nis"]').val(data.nis);
                $('[name="nama"]').val(data.nama);
                $('[name="kelas"]').val(data.kelas);
                $('[name="tgl_lahir"]').val(data.tgl_lahir);
                $('[name="tmp_lahir"]').val(data.tmp_lahir);
                $('[name="jenkel"]').val(data.jenkel);
                $('[name="agama"]').val(data.agama);
                $('[name="no_telp"]').val(data.no_telp);
                $('[name="alamat"]').val(data.alamat);
                $('[name="id_kelas"]').val(data.id_kelas);
                $('#modal_view').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Preview Data siswa Kelas'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function refreshTokens() {
        var url = "<?= base_url()."welcome/get_tokens" ?>";
        $.get(url, function(theResponse) {
          /* you should do some validation of theResponse here too */
          $('#csrfHash').val(theResponse);;
      });
    }
</script>

<!--modal tambah dan edit -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" id="csrfHash" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                    <div class="modal-body">
                        <div class="row">
	                        <div class="col-md-6">
	                        	<div class="form-group">
		                            <label >NIS</label>
		                            <input type="text" class="form-control" placeholder="NIS" name="nis" required maxlength="13" onkeypress='return check_int(event)'/>
		                            <span class="help-block"></span>
		                        </div>
                                <div class="form-group">
                                    <label >Password</label>
                                    <input type="password" class="form-control" placeholder="Isi Password!" name="password" required />
                                    <span class="help-block"></span>
                                </div>
                                <br><hr>
	                        	<div class="form-group">
		                            <label >Nama Siswa</label>
		                            <input type="text" class="form-control" placeholder="Nama Siswa" name="nama" required/>
		                            <span class="help-block"></span>
		                        </div>
                                <div class="form-group">
                                    <label>Kelas</label>
                                    <select name="id_kelas" class="form-control">
                                        <option>Pilih Kelas</option>
                                        <?php foreach ($kelas->result() as $key) {?>
                                        <option value="<?= $key->id ?>"><?= $key->nama_kelas ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>                              
	                        </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Tempat / Tanggal Lahir</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" placeholder="Tempat" name="tmp_lahir" required/>
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="date" name="tgl_lahir" class="form-control">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <label >Jenis Kelamin</label>
                                    <select name="jenkel" class="form-control">
                                        <option>Pilih Jenis Kelamin</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>  
                                <div class="form-group">
                                    <label >Agama</label>
                                    <select name="agama" class="form-control">
                                        <option>Pilih Agama</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Kong Hu Cu">Kong Hu Cu</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label >Alamat</label>
                                    <textarea name="alamat" class="form-control" cols="30" rows="3"></textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>
		                </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="pull-right">
                    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary"><i class="fa fa-edit "></i> Simpan</button>
                </div>
                <div class="pull-left">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--modal view -->
<div class="modal fade" id="modal_view" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" id="csrfHash" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >NIS</label>
                                    <input type="text" class="form-control" placeholder="NIS" name="nis" required maxlength="13" onkeypress='return check_int(event)' readonly />
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label >Nama Siswa Kelas</label>
                                    <input type="text" class="form-control" placeholder="Nama Siswa" name="nama" required readonly/>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label>Kelas</label>
                                    <!-- <input type="text" class="form-control" placeholder="Nama Siswa" name="nama" required readonly/> -->
                                    <select name="id_kelas" class="form-control" readonly>
                                        <option>Pilih Kelas</option>
                                        <?php foreach ($kelas->result() as $key) {?>
                                        <option value="<?= $key->id ?>"><?= $key->nama_kelas ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>  
                                <div class="form-group">
                                    <label >Tempat / Tanggal Lahir</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" placeholder="Tempat" name="tmp_lahir" required readonly/>
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="date" name="tgl_lahir" class="form-control" readonly>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Jenis Kelamin</label>
                                    <input type="text" class="form-control" placeholder="Jenis Kelamin" name="jenkel" required readonly/>
                                    <span class="help-block"></span>
                                </div> 
                                <div class="form-group">
                                    <label >Agama</label>
                                    <input type="text" class="form-control" placeholder="Agama" name="agama" required readonly/>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label >Alamat</label>
                                    <textarea name="alamat" class="form-control" cols="30" rows="3" readonly></textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="pull-left">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->