<section class="content-header">
    <h1>
        Request Izin<small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!!url()!!}"> Dashboard</a></li>
        <li class="active">Request Izin</li>
    </ol>
</section>
<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            {!! ClaravelHelpers::btnCreate() !!}
            <div class="box-tools pull-right">
                {!! Form::open(array('url' => \Request::path(), 'method' => 'GET', 'class' => 'form-'.\Config::get('claravel::ajax'),'id' => 'cari' )) !!}
                {!!csrf_field()!!}
                <div class="input-group" style="width: 200px;">
                    <input type="text" class="form-control" name="search" value="{!! \Input::get('search')!!}">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span> Search</button>
                    </span>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        {!! Form::open(array('url' => \Request::path().'/delete', 'method' => 'POST', 'class' => 'form-'.\Config::get('claravel::ajax'),'id'=>'data' )) !!}
        <div class="table-responsive">
            <div class="box-body no-padding">
                <table class="table table-striped table-hover table-condensed table-bordered" id='tabel'>
                    <thead class="bg-primary">
                    <tr>
                        <th><input type="checkbox" name="checkall" id="checkall" class="checkall" value="1" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Pilih Semua"></th>
                    <th>Tanggal Awal Izin</th>
					<th>Tanggal Akhir Izin</th>
					<th>Jenis Izin</th>
					<th>Surat Izin</th>
					<th>Keterangan</th>
					<th>Verifikasi</th>
					<th>Verifikator</th>
					<th>Waktu Verifikasi</th>

                        <th>Act.</th>
                    </tr>
                    </thead>   
                    
                    <tbody>
                    @foreach ($requestizins as $requestizin)
                    <tr>
                        <td><center>{!! ClaravelHelpers::ckDelete($requestizin->id); !!}</center></td>
                    <td>{!!$requestizin->tgl_awal_izin!!}</td>
					<td>{!!$requestizin->tgl_akhir_izin!!}</td>
					<td>{!! JenisizinModel::get_jenis_izin($requestizin->jenis_izin) !!}</td>
					<td>
                        <?php  
                        if ($requestizin->surat_izin == 1){?>
                            <span class="label label-danger" style="font-size:90%">Tidak Ada</span><?php
                        }else{?>
                            <span class="label label-success" style="font-size:90%">Ada</span><?php
                        }?>
                    </td>
					<td>{!!$requestizin->keterangan_izin!!}</td>
					<td>
                        <?php  
                        if ($requestizin->verifikasi_izin == 1){?>
                            <span class="label label-danger" style="font-size:90%">Belum Verifikasi</span><?php
                        }else{?>
                            <span class="label label-success" style="font-size:90%">Sudah Verifikasi</span><?php
                        }?>
                    </td>
					<td>{!! SupervisorModel::get_supervisor($requestizin->verifikator_izin) !!}</td>
					<td>
                        <?php echo date('d F Y (H:i)', strtotime($requestizin->waktu_verifikasi_izin)); ?>
                    </td>

                        <td>
                        {!! ClaravelHelpers::btnEdit($requestizin->id) !!}
                        &nbsp;
                        {!! ClaravelHelpers::btnDelete($requestizin->id) !!}
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box-footer clearfix">
          <div class="row">
            <div class="col-sm-6">
              {!! ClaravelHelpers::btnDeleteAll() !!}
            </div>
            <div class="col-sm-6">
              <?php echo $requestizins->appends(array('search' => Input::get('search')))->render(); ?>
            </div>
          </div>
        </div>
        {!! Form::close() !!}
    </div>
</section>         

<script>
    function refresh_page(){
        <?php
        echo 'var index_page=laravel_base + "/'.\Request::path().'";';
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
        $('.pagination').addClass('pagination-sm no-margin pull-right');
        $('.checkme,.checkall').on('change',function(){
            if($(this).is(':checked'))
                $('#deleteall').fadeIn(300);
            else
                $('#deleteall').fadeOut(300);
        });

        $('#buat').on('click',function(e){
            e.preventDefault();
            $.ajax({
                url : $(this).attr('href'),
                //url : laravel_base + '/' + $(this).attr('href'),
                type : 'get',
                beforeSend: function(){
                    preloader.on();
                },
                success:function(html){
                    preloader.off();
                    $('#utama').html(html);
                }
            });
        });

        <?php
        echo 'var index_page=laravel_base + "/'.\Request::path().'";';
        ?>

        $('#tabel').on('click','#hapus',function(e){
            e.preventDefault();
            var $this =$(this);
            bootbox.confirm('Hapus?',function(a){
                if(a == true){
                    $.ajax({
                        url : index_page + '/delete',
                        type : 'post',
                        data: {'id' : $this.attr('recid'), '_token' : '{!!csrf_token()!!}'},
                        beforeSend: function(){
                            preloader.on();
                        },
                        success:function(html){
                            preloader.off();
                            if(html=='9')
                            {
                                notification('Data Berhasil Dihapus','success');    
                            }
                            else
                            {
                                notification(html,'error');
                            }
                            $this.closest('tr').fadeOut(300,function(){
                                $(this).remove();
                            });
                        }
                    });
                }
            });
        });
        $('#tabel').on('click','#edit',function(e){
            e.preventDefault();
            var $this =$(this);
            bootbox.confirm('Edit?',function(a){
                if(a == true){
                    $.ajax({
                        url : index_page + '/edit',
                        type : 'get',
                        data:'id=' + $this.attr('recid'),
                        beforeSend: function(){
                            preloader.on();
                        },
                        success:function(html){
                            preloader.off();
                            $('#utama').html(html);
                        }
                    });
                }
            });
        });
        $('#cari').on('submit',function(e){
            e.preventDefault();
            $.ajax({
                url : $(this).attr('action'),
                data:$(this).serialize(),
                type : 'get',
                beforeSend: function(){
                    preloader.on();
                },
                success:function(html){
                    preloader.off();
                    $('#utama').html(html);
                }
            });
        });
        $('#data').on('submit',function(e){
            e.preventDefault();
            var iki = $(this);
            bootbox.confirm('Hapus?',function(r){
                if(r){
                    $.ajax({
                        url : iki.attr('action') + '/delete',
                        type : 'post',
                        data:iki.serialize(),
                        beforeSend: function(){
                            preloader.on();
                        },
                        success:function(html){
                            preloader.off();
                            if(html=='9')
                            {
                                notification('Data Berhasil Dihapus','success');    
                            }
                            else
                            {
                                notification(html,'error');
                            }
                            iki.find('input[type=checkbox]').each(function (t){
                                if($(this).is(':checked')){
                                    $(this).closest('tr').fadeOut(100)                                        
                                }
                            });
                            $('#deleteall').fadeOut(300);
                        }
                    });
                }
            });            
        });
    });
</script>
