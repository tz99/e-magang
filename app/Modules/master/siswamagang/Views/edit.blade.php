<link rel="stylesheet" href="<?php echo asset('packages/tugumuda/css/BeatPicker.min.css'); ?>">
<script src="<?php echo asset('packages/tugumuda/js/BeatPicker.min.js'); ?>"></script>
<section class="content-header">
    <h1>
        Edit Siswa Magang<small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!!url()!!}"> Dashboard</a></li>
        <li><a href="#" id="back"> Siswa Magang</a></li>
        <li class="active">Edit Siswa Magang</li>
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
        {!! Form::model($siswamagang, array('url' => $uri, 'method' => 'POST', 'enctype'=>'multipart/form-data', 'class'=>'form-horizontal form-'.\Config::get('claravel::ajax') ,'id'=>'simpan')) !!}
        {!! Form::hidden('id') !!}
        <div class="box-body">
            	<div class="form-group">
					{!! Form::label('no_induk', 'Nomor Induk:', array('class' => 'col-sm-3 control-label')) !!}
					<div class="col-sm-7">
						{!! Form::text('no_induk', null, array('class'=> 'form-control')) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('nm_siswa', 'Nama Siswa:', array('class' => 'col-sm-3 control-label')) !!}
					<div class="col-sm-7">
						{!! Form::text('nm_siswa', null, array('class'=> 'form-control')) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('asal_sekolah', 'Asal Sekolah:', array('class' => 'col-sm-3 control-label')) !!}
					<div class="col-sm-7">
						{!! Form::text('asal_sekolah', null, array('class'=> 'form-control')) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('jenjang_pddk', 'Jenjang Pendidikan:', array('class' => 'col-sm-3 control-label')) !!}
					<div class="col-sm-7">
						{!! SiswamagangModel::listJenjang('jenjang_pddk',$siswamagang->jenjang_pddk) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('alamat', 'Alamat:', array('class' => 'col-sm-3 control-label')) !!}
					<div class="col-sm-7">
						{!! Form::text('alamat', null, array('class'=> 'form-control')) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('no_telp', 'Nomor Telepon:', array('class' => 'col-sm-3 control-label')) !!}
					<div class="col-sm-7">
						{!! Form::text('no_telp', null, array('class'=> 'form-control')) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('email', 'Email:', array('class' => 'col-sm-3 control-label')) !!}
					<div class="col-sm-7">
						{!! Form::text('email', null, array('class'=> 'form-control')) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('tgl_mulai', 'Tanggal Mulai:', array('class' => 'col-sm-3 control-label')) !!}
					<div class="col-sm-7">
						{!! Form::text('tgl_mulai', null, array('class'=> 'form-control', 'data-beatpicker'=>'true', 'data-beatpicker-position'=>'["*","*"]')) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('tgl_selesai', 'Tanggal Selesai:', array('class' => 'col-sm-3 control-label')) !!}
					<div class="col-sm-7">
						{!! Form::text('tgl_selesai', null, array('class'=> 'form-control', 'data-beatpicker'=>'true', 'data-beatpicker-position'=>'["*","*"]')) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('nm_magang', 'Jenis Magang:', array('class' => 'col-sm-3 control-label')) !!}
					<div class="col-sm-7">
						{!! JenismagangModel::list_jenis_magang('nm_magang',$siswamagang->nm_magang) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('nm_supervisior', 'Supervisior:', array('class' => 'col-sm-3 control-label')) !!}
					<div class="col-sm-7">
						 {!! SupervisorModel::list_supervisor('nm_supervisior',$siswamagang->nm_supervisior) !!}
					</div>
				</div>
                <div class="form-group">
                    {!! Form::label('foto', 'Foto:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        <input type="file" name="foto" id="foto" class="form-control">
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
            e.stopImmediatePropagation();
            var formData = new FormData(this);

            bootbox.confirm('Simpan data?',function(a){
                if (a == true){
                    $.ajax({
                        url : $this.attr('action') + '/edit' ,
                        type : 'POST',
                        data : formData,
                        contentType : false,
                        processData : false,
                        beforeSend: function(){
                            preloader.on();
                        },
                        success:function(html){
                            notification(html,'success');
                            refresh_page();
                            /*if(html=='4'){
                                notification('Berhasil Disimpan','success');
                                refresh_page();
                            }else{
                                notification(html,'danger');
                            }*/
                        }
                    });
                }
            });
        });
    });
</script>
