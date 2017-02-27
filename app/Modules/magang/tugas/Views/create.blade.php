<link rel="stylesheet" href="<?php echo asset('packages/tugumuda/css/BeatPicker.min.css'); ?>">
<script src="<?php echo asset('packages/tugumuda/js/BeatPicker.min.js'); ?>"></script>
<section class="content-header">
    <h1>
        Buat Tugas Baru<small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!!url()!!}"> Dashboard</a></li>
        <li><a href="#" id="back"> Tugas</a></li>
        <li class="active">Buat Tugas Baru</li>
    </ol>
</section>
<section class="content">
    <div class="box box-primary">
      <div class="row">
        <div class="col-md-12">
            {!! Form::open(array('url' => \Request::path(), 'method' => 'POST', 'class'=>'form-horizontal form-'.\Config::get('claravel::ajax'),'id'=>'simpan')) !!}
            <div class="box-body">
                <div class="form-group">
					{!! Form::label('nm_siswa', 'Nama Siswa:', array('class' => 'col-sm-2 control-label')) !!}
					<div class="col-sm-7">
						{!! SiswamagangModel::list_nama_siswa('nm_siswa') !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('nm_project', 'Project:', array('class' => 'col-sm-2 control-label')) !!}
					<div class="col-sm-7">
						{!! ProjectModel::list_project('nm_project') !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('tugas', 'Tugas:', array('class' => 'col-sm-2 control-label')) !!}
					<div class="col-sm-7">
						{!! Form::text('tugas', null, array('class'=> 'form-control')) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('deskripsi', 'Deskripsi Tugas:', array('class' => 'col-sm-2 control-label')) !!}
					<div class="col-sm-7">
                        <textarea name="deskripsi" class="form-control"></textarea>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('tgl_deadline', 'Tanggal Deadline:', array('class' => 'col-sm-2 control-label')) !!}
					<div class="col-sm-7">
						{!! Form::text('tgl_deadline', null, array('class'=> 'form-control', 'data-beatpicker'=>'true', 'data-beatpicker-position'=>'["*","*"]')) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('status', 'Status Tugas:', array('class' => 'col-sm-2 control-label')) !!}
					<div class="col-sm-7">
						{!! TugasModel::list_status_tugas('status') !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('tgl_selesai', 'Tanggal Selesai:', array('class' => 'col-sm-2 control-label')) !!}
					<div class="col-sm-7">
						{!! Form::text('tgl_selesai', null, array('class'=> 'form-control', 'data-beatpicker'=>'true', 'data-beatpicker-position'=>'["*","*"]')) !!}
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
