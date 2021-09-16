<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.nilai').addClass('active');
      $('.nilai-<?= $kls->id ?>').addClass('active');
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
                        <h5>Penilaian Mata Pelajaran
                            <?= $kls->nama_kelas; ?>
                        </h5>
                        <span>Berikut data nilai-nilai mapel : <?php if ($mapel->id==$this->session->userdata('id_mapel')) {
                                echo $mapel->nama_mapel;
                            } ?></span>
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
							<a href="<?= site_url('guru/nilai/kelas/'.$kls->id) ?>">Nilai</a>
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
							<h5>Data Nilai Siswa</h5>
                            <div class="card-header-right"> <ul class="list-unstyled card-option"> <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li> <li><i class="feather icon-maximize full-card"></i></li> <li><i class="feather icon-minus minimize-card"></i></li> <li><i class="feather icon-refresh-cw reload-card"></i></li> <li><i class="feather icon-trash close-card"></i></li> <li><i class="feather icon-chevron-left open-card-option"></i></li> </ul> </div>
						</div>
						<div style="position: absolute;right: 20px; top: 15px;">
							<a href="<?= site_url('guru/nilai/cetak/'.$kl1) ?>" class="btn btn-danger btn-round"><span class="fa fa-print"></span> Preview Cetak</a>	
						</div>
						
						<div class="card-block">
							<div class="dt-responsive">
								<table id="compact" class="table table-responsive table-bordered table-hover nowrap" width="100%">
									<thead>
										<tr><th width="1%" rowspan="2" style="vertical-align: middle;">No</th>
										<th rowspan="2" style="vertical-align: middle;">NIS</th>
										<th rowspan="2" style="vertical-align: middle;">Nama</th>
										<th rowspan="2" style="vertical-align: middle;">Kelas</th>
										<th colspan="5" style="text-align: center">Nilai</th>
										<th rowspan="2" style="vertical-align: middle;">Total</th>
                                        <th rowspan="2" style="vertical-align: middle;">Rata-Rata</th>
                                        <th rowspan="2" style="vertical-align: middle;" width="10%">Action</th>
										</tr>
										<tr><th>Harian 1</th>
										<th>Harian 2</th>
										<th>Harian 3</th>
										<th>UTS</th>
										<th>UAS</th></tr>
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
        ajax: {"url": "<?= base_url() ?>guru/nilai/json/<?= $kl1 ?>", "type": "POST"},
        columns: [
        {
            "data": "id_nilai",
            "orderable": false
        },
        {"data": "nis"},
        {"data": "nama"},
        {"data": "nama_kelas",
            render: function(data) { 
                return '<label class="label label-lg label-inverse-danger" style="width:100%; text-align:center">'+data+'</label>'
              },
              defaultContent: 'Tidak ada data'
            
        },
        {"data": "h1"},
        {"data": "h2"},
        {"data": "h3"},
        {"data": "uts"},
        {"data": "uas"},
        {"data": "total"},
        {"data": "rata"},
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

    //fun edit
    function edit(id)
    {
        save_method = 'update';
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string
	    $.ajax({
	        url : '<?php echo site_url("guru/nilai/edit/'+id+'") ?>',
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {

	            $('[name="id"]').val(data.id);
	            $('[name="nis"]').val(data.nis);
	            $('[name="nama"]').val(data.nama);
                $('[name="nama_kelas"]').val(data.kelas);
                $('[name="h1"]').val(data.h1);
                $('[name="h2"]').val(data.h2);
                $('[name="h3"]').val(data.h3);
                $('[name="uts"]').val(data.uts);
                $('[name="uas"]').val(data.uas);
                $('[name="total"]').val(data.total);
                $('[name="rata"]').val(data.rata);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
	            $('.modal-title').text('Edit Data Nilai Siswa'); // Set title to Bootstrap modal title
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error get data from ajax');
	        }
	    });
	}

    //fun simpan
    function save()
    {
        refreshTokens();
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('guru/nilai/tambah')?>";
    } else {
        url = "<?php echo site_url('guru/nilai/update')?>";
    }



    // ajax adding data to database
    var formData = new FormData($('#form')[0]);
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",

        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table();
            } else
            {
                for (var i = 0; i < data.inputerror.length; i++)
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
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
                            <input type="hidden" name="id">
	                        <div class="col-md-6">
	                        	<div class="form-group">
		                            <label>NIS</label>
		                            <input type="text" class="form-control" placeholder="NIS" name="nis" required maxlength="13" onkeypress='return check_int(event)' readonly/>
		                            <span class="help-block"></span>
		                        </div>
                                <div class="form-group">
		                            <label>Nama Siswa</label>
		                            
		                            <input type="text" class="form-control" placeholder="Nama Siswa" name="nama" required readonly />
		                            <span class="help-block"></span>
		                        </div>
                                <div class="form-group">
		                            <label>Kelas</label>
		                            <input type="text" class="form-control" placeholder="Kelas" name="nama_kelas" required readonly />
		                            <span class="help-block"></span>
		                        </div>
                                <div class="form-group">
                                    <label >Total</label>
                                    <input type="text" name="total" placeholder="Nilai" class="form-control" onkeypress='return check_int(event)' maxlength="3" id="total" required max readonly>
                                    <span class="help-block"></span>
                                </div>
                                                                    
	                        </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label >Harian 1</label>
                                            <input type="text" class="form-control" placeholder="Nilai" name="h1" onkeypress='return check_int(event)' maxlength="3" id="h1" onchange="changeValue(this.value)" required/>
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label >Harian 2</label>
                                            <input type="text" name="h2"  placeholder="Nilai" class="form-control" onkeypress='return check_int(event)' maxlength="3" id="h2" onchange="changeValue(this.value)" required>
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label >Harian 3</label>
                                            <input type="text" class="form-control" placeholder="Nilai" name="h3" onkeypress='return check_int(event)' maxlength="3" id="h3" onchange="changeValue(this.value)" required/>
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label >UTS</label>
                                            <input type="text" name="uts" placeholder="Nilai" class="form-control" onkeypress='return check_int(event)' maxlength="3" id="uts" onchange="changeValue(this.value)" required max>
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label >UAS</label>
                                            <input type="text" class="form-control" placeholder="Nilai" name="uas" onkeypress='return check_int(event)' maxlength="3" id="uas" onchange="changeValue(this.value)" required/>
                                            <span class="help-block"></span>
                                        </div>
                                        <hr>
                                        <div class="col-md-12 form-group">
                                            <label >Rata</label>
                                            <input type="text" class="form-control" placeholder="Nilai" name="rata" onkeypress='return check_int(event)' maxlength="3" id="rata" required readonly/>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
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

<script type="text/javascript">
    function changeValue(item) {
        var h1 = parseInt($("#h1").val());
        var h2 = parseInt($("#h2").val());
        var h3 = parseInt($("#h3").val());
        var uts = parseInt($("#uts").val());
        var uas = parseInt($("#uas").val());
        
        var tot = h1+h2+h3+uts+uas;
        var rat = (h1+h2+h3+uts+uas)/5;
        $("#total").val(tot);
        $("#rata").val(rat);
    }
</script>