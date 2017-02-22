<section class="content-header">
    <h1>
        Buat Supervisor Baru<small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!!url()!!}"> Dashboard</a></li>
        <li><a href="#" id="back"> Supervisor</a></li>
        <li class="active">Buat Supervisor Baru</li>
    </ol>
</section>
<section class="content">
    <div class="box box-primary">
      <div class="row">
        <div class="col-md-12">
            {!! Form::open(array('url' => \Request::path(), 'method' => 'POST', 'enctype'=>'multipart/form-data', 'class'=>'form-horizontal form-'.\Config::get('claravel::ajax'),'id'=>'simpan')) !!}
            <div class="box-body">
                <div class="form-group">
					{!! Form::label('nm_supervisor', 'Nama Supervisor:', array('class' => 'col-sm-2 control-label')) !!}
					<div class="col-sm-7">
						{!! Form::text('nm_supervisor', null, array('class'=> 'form-control')) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('jabatan', 'Jabatan:', array('class' => 'col-sm-2 control-label')) !!}
					<div class="col-sm-7">
						{!! Form::text('jabatan', null, array('class'=> 'form-control')) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('telepon', 'Telp/HP:', array('class' => 'col-sm-2 control-label')) !!}
					<div class="col-sm-7">
						{!! Form::text('telepon', null, array('class'=> 'form-control')) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('email', 'Email:', array('class' => 'col-sm-2 control-label')) !!}
					<div class="col-sm-7">
						{!! Form::email('email', null, array('class'=> 'form-control')) !!}
					</div>
				</div>
                <div class="form-group">
                    {!! Form::label('username', 'Username:', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-7">
                        {!! Form::text('username', null, array('class'=> 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'Password:', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-7">
                        <input type="password" name="password" class="form-control" value="">
                    </div>
                </div>
				<div class="form-group">
					{!! Form::label('foto', 'Foto:', array('class' => 'col-sm-2 control-label')) !!}
					<div class="col-sm-7">
                        <input type="file" id="foto" name="foto" class="form-control">
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
            e.stopImmediatePropagation();
            var formData = new FormData(this);

            bootbox.confirm('Simpan data?',function(a){
                if (a == true){
                    $.ajax({
                        url : $this.attr('action'),
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
                            // if(html=='1'){
                            //     notification('Berhasil Disimpan','success');
                            //     refresh_page();
                            // }else{
                            //     notification(html,'danger');
                            // }
                        }
                    });
                }
            });
        });
    });
</script>
