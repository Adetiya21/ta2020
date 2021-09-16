<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.guru').addClass('active');
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
						<h5>Guru</h5>
						<span>Berikut data para guru kelas.</span>
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
							<a href="<?= site_url('guru/guru') ?>">Guru Kelas</a>
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
							<h5>Data Guru Kelas</h5>
                            <div class="card-header-right"> <ul class="list-unstyled card-option"> <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li> <li><i class="feather icon-maximize full-card"></i></li> <li><i class="feather icon-minus minimize-card"></i></li> <li><i class="feather icon-refresh-cw reload-card"></i></li> <li><i class="feather icon-trash close-card"></i></li> <li><i class="feather icon-chevron-left open-card-option"></i></li> </ul> </div>
						</div>						
						<div class="card-block">
							<div class="dt-responsive table-responsive">
								<table id="compact" class="table table-bordered table-hover nowrap" width="100%">
									<thead>
										<tr><th width="1%">No</th>
										<th>NIP</th>
										<th>Nama Guru</th>
										<th>Mata Pelajaran</th>
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
        ajax: {"url": "<?= base_url() ?>guru/guru/json", "type": "POST"},
        columns: [
        {
            "data": "nip",
            "orderable": false
        },
        {"data": "nip"},
        {"data": "nama"},
        {"data": "nama_mapel"},
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
    function view(nip)
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $.ajax({
            url : '<?php echo site_url("guru/guru/view/'+nip+'") ?>',
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="nip"]').val(data.nip);
                $('[name="nama"]').val(data.nama);
                $('[name="jenkel"]').val(data.jenkel);
                $('[name="agama"]').val(data.agama);
                $('[name="no_telp"]').val(data.no_telp);
                $('[name="alamat"]').val(data.alamat);
                $('[name="id_kelas"]').val(data.id_kelas);
                $('[name="id_mapel"]').val(data.id_mapel);
                $('#modal_view').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Preview Data guru Kelas'); // Set title to Bootstrap modal title
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
                                    <label >NIP</label>
                                    <input type="text" class="form-control" placeholder="NIP" name="nip" required maxlength="13" onkeypress='return check_int(event)' readonly />
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label >Nama guru Kelas</label>
                                    <input type="text" class="form-control" placeholder="Nama guru" name="nama" required readonly/>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label>Mapel</label>
                                    <select name="id_mapel" class="form-control" readonly>
                                        <option>Pilih mapel</option>
                                        <?php foreach ($mapel->result() as $key) {?>
                                        <option value="<?= $key->id ?>"><?= $key->nama_mapel ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="help-block"></span>
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
                                    <label >No. Telp</label>
                                    <input type="text" class="form-control" placeholder="No.Telp" name="no_telp" required maxlength="13" onkeypress='return check_int(event)' readonly/>
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