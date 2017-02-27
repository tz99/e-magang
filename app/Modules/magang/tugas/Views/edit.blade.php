<link rel="stylesheet" href="<?php echo asset('packages/tugumuda/css/BeatPicker.min.css'); ?>">
<script src="<?php echo asset('packages/tugumuda/js/BeatPicker.min.js'); ?>"></script>
<section class="content-header">
    <h1>
        Edit Tugas<small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!!url()!!}"> Dashboard</a></li>
        <li><a href="#" id="back"> Tugas</a></li>
        <li class="active">Edit Tugas</li>
    </ol>
</section>
<section class="content">
  <div class="box box-primary">
    <?php
      $rpos = strrpos(\Request::path(), '/'); 
      $uri = substr(\Request::path(), 0, $rpos);
    ?>
    <div class="row">
      <div class="col-md-12">
        {!! Form::model($tugas, array('url' => $uri, 'method' => 'POST', 'class'=>'form-horizontal form-'.\Config::get('claravel::ajax') ,'id'=>'simpan')) !!}
        {!! Form::hidden('id') !!}
        <div class="box-body">
            	<div class="form-group">
					{!! Form::label('nm_siswa', 'Nama Siswa:', array('class' => 'col-sm-2 control-label')) !!}
					<div class="col-sm-7">
                        {!! SiswamagangModel::list_nama_siswa('nm_siswa',$tugas->nm_siswa) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('nm_project', 'Project:', array('class' => 'col-sm-2 control-label')) !!}
					<div class="col-sm-7">
						{!! ProjectModel::list_project('nm_project',$tugas->nm_project) !!}
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
						{!! Form::text('deskripsi', null, array('class'=> 'form-control')) !!}
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
						{!! TugasModel::list_status_tugas('status',$tugas->status) !!}
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
