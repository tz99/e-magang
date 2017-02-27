<!-- input type date -->
<link rel="stylesheet" href="<?php echo asset('packages/tugumuda/css/BeatPicker.min.css'); ?>">
<script src="<?php echo asset('packages/tugumuda/js/BeatPicker.min.js'); ?>"></script>
<section class="content-header">
    <h1>
        Buat Log Aktivitas<small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!!url()!!}"> Dashboard</a></li>
        <li><a href="#" id="back"> Log Aktivitas</a></li>
        <li class="active">Buat Log Aktivitas Baru</li>
    </ol>
</section>
<section class="content">
    <div class="box box-primary">
      <div class="row">
        <div class="col-md-12">
            {!! Form::open(array('url' => \Request::path(), 'method' => 'POST', 'class'=>'form-horizontal form-'.\Config::get('claravel::ajax'),'id'=>'simpan')) !!}
            <div class="box-body">
                <div class="form-group">
					{!! Form::label('siswa', 'Siswa:', array('class' => 'col-sm-2 control-label')) !!}
					<div class="col-sm-7">
                        {!! SiswamagangModel::list_nama_siswa('siswa') !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('tanggal', 'Tanggal:', array('class' => 'col-sm-2 control-label')) !!}
					<div class="col-sm-7">
                        {!! Form::text('tanggal', null, array('class'=> 'form-control', 'data-beatpicker'=>'true', 'data-beatpicker-position'=>'["*","*"]')) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('aktivitas', 'Aktivitas:', array('class' => 'col-sm-2 control-label')) !!}
					<div class="col-sm-7">
						{!! Form::text('aktivitas', null, array('class'=> 'form-control')) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('verifikasi', 'Verifikasi:', array('class' => 'col-sm-2 control-label')) !!}
					<div class="col-sm-7" style="padding-top:8px">
                        <input type="checkbox" name="verifikasi" value="1">
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('verifikator', 'Verifikator:', array('class' => 'col-sm-2 control-label')) !!}
					<div class="col-sm-7">
                        {!! SupervisorModel::list_supervisor('verifikator') !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('waktu_verifikasi', 'Waktu verifikasi:', array('class' => 'col-sm-2 control-label')) !!}
					<div class="col-sm-7">
                        <div class='input-group date' id='datetimepicker1'>
                            <input type='text' name="waktu_verifikasi" class="form-control" />
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
                        {!! ClaravelHelpers::btnCancel() !!}
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
                        url : $this.attr('action'),
                        type : 'POST',
                        data : $this.serialize(),
                        beforeSend: function(){
                            preloader.on();
                        },
                        success:function(html){
                            if(html=='1'){
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
