<link rel="stylesheet" href="<?php echo asset('packages/tugumuda/css/BeatPicker.min.css'); ?>">
<script src="<?php echo asset('packages/tugumuda/js/BeatPicker.min.js'); ?>"></script>
<section class="content-header">
    <h1>
        Edit Requestizin<small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!!url()!!}"> Dashboard</a></li>
        <li><a href="#" id="back"> Request Izin</a></li>
        <li class="active">Edit Request Izin</li>
    </ol>
</section>
<section class="content">
  <div class="box box-primary">
    <?php
      $rpos = strrpos(\Request::path(), '/'); 
      $uri = substr(\Request::path(), 0, $rpos);
    ?>
    <div class="row">
      <div class="col-md-8">
        {!! Form::model($requestizin, array('url' => $uri, 'method' => 'POST', 'class'=>'form-horizontal form-'.\Config::get('claravel::ajax') ,'id'=>'simpan')) !!}
        {!! Form::hidden('id') !!}
        <div class="box-body">
            	<div class="form-group">
					{!! Form::label('tgl_awal_izin', 'Tanggal Awal Izin:', array('class' => 'col-sm-3 control-label')) !!}
					<div class="col-sm-7">
						{!! Form::text('tgl_awal_izin', null, array('class'=> 'form-control', 'data-beatpicker'=>'true', 'data-beatpicker-position'=>'["*","*"]')) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('tgl_akhir_izin', 'Tanggal Akhir Izin:', array('class' => 'col-sm-3 control-label')) !!}
					<div class="col-sm-7">
						{!! Form::text('tgl_akhir_izin', null, array('class'=> 'form-control', 'data-beatpicker'=>'true', 'data-beatpicker-position'=>'["*","*"]')) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('jenis_izin', 'Jenis Izin:', array('class' => 'col-sm-3 control-label')) !!}
					<div class="col-sm-7">
						{!! JenisizinModel::list_jenis_izin('jenis_izin') !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('surat_izin', 'Surat Izin:', array('class' => 'col-sm-3 control-label')) !!}
					<div class="col-sm-7">
						<select class="form-control" name="surat_izin">
                            <option value="0">Ada</option>
                            <option value="1">Tidak Ada</option>
                        </select>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('keterangan_izin', 'Keterangan:', array('class' => 'col-sm-3 control-label')) !!}
					<div class="col-sm-7">
						{!! Form::text('keterangan_izin', null, array('class'=> 'form-control')) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('verifikasi_izin', 'Verifikasi:', array('class' => 'col-sm-3 control-label')) !!}
					<div class="col-sm-7">
						{!! SupervisorModel::list_supervisor('verifikator_izin') !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('verifikator_izin', 'Verifikator:', array('class' => 'col-sm-3 control-label')) !!}
					<div class="col-sm-7">
					   {!! SupervisorModel::list_supervisor('verifikator_izin') !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('waktu_verifikasi_izin', 'Waktu Verifikasi:', array('class' => 'col-sm-3 control-label')) !!}
					<div class="col-sm-7">
						<div class='input-group date' id='datetimepicker1'>
                            <?php foreach ($data as $itemslog) {
                            $log = $itemslog->waktu_verifikasi_izin;
                            $ex_waktu = explode(' ', $log);
                                $date = $ex_waktu[0];
                                $time = $ex_waktu[1];

                                $ex_date = explode('-', $date);
                                    $Y = $ex_date[0];
                                    $m = $ex_date[1];
                                    $d = $ex_date[2];

                                $ex_time = explode(':', $time);
                                    $H = $ex_time[0];
                                    $i = $ex_time[1];

                                if ($H >12) {
                                    $H   = $H-12;
                                    $apm = 'PM'; 
                                }else{
                                    $apm = 'AM';
                                }
                            
                            $waktu = $m."/".$d."/".$Y." ".$H.":".$i." ".$apm;
                            } ?>
                            <input type='text' name="waktu_verifikasi_izin" value="<?php echo $waktu ?>" class="form-control" id="waktu_verifikasi_izin" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
					</div>
				</div>

        </div>
        <div class="box-footer">
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-7">
                    {!! ClaravelHelpers::btnSave() !!}
                    &nbsp;
                    &nbsp;
                    {!! ClaravelHelpers::btnCancelEdit() !!}
                </div>
            </div> 
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</section>
	
<script>
    function refresh_page(){
        <?php
        $index_page = explode('/', \Request::path());
        $jum = count($index_page) -1;
        unset ($index_page[$jum]);
        $index = join('/', $index_page);
        echo 'var index_page=laravel_base + "/'.$index.'";';
        ?>
            $.ajax({
                url : index_page,
                type : 'GET',
                beforeSend: function(){
                    preloader.on();
                },
                success:function(html){
                    preloader.off();
                    $('#utama').html(html);
                }
            });
             
    }
    $(document).ready(function(){
        $('select').select2();
        $('#datetimepicker1').datetimepicker();
        $('#batalkan,#back').on('click',function(e){
            e.preventDefault();
            refresh_page();
        });
        $('#simpan').on('submit',function(e){
            var $this = $(this);
            e.preventDefault();
            bootbox.confirm('Simpan data?',function(a){
                if (a == true){
                    $.ajax({
                        url : $this.attr('action') + '/edit' ,
                        type : 'POST',
                        data : $this.serialize(),
                        beforeSend: function(){
                            preloader.on();
                        },
                        success:function(html){
                            if(html=='4'){
                                notification('Berhasil Disimpan','success');
                                refresh_page();
                            }else{
                                notification(html,'danger');
                            }
                        }
                    });
                }
            });
        });
    });
</script>
