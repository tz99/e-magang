<section class="content-header">
    <h1>
        Laporan Siswa Magang<small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!!url()!!}"> Dashboard</a></li>
        <li class="active">Laporan Siswa Magang</li>
    </ol>
</section>
<section class="content">
    <div class="box box-primary">
        <!-- Filter Pencarian -->
        <div class="box-header with-border">
            <!-- {!! Form::open(array('url' => \Request::path(), 'method' => 'GET', 'class' => 'form-'.\Config::get('claravel::ajax'),'id' => 'cari' )) !!} -->
            {!! Form::open(array('url' => '/cetak_pdf', 'method' => 'GET','target'=>'blank' )) !!}
            {!!csrf_field()!!}
            <div class="table-responsive">
                <div class="box-body no-padding">
                    <div class="col-sm-3" id="jns">
                        <div class="form-group">
                            <span style="font-weight:bold">Jenis Magang</span>
                            <div style="clear:both;margin-top:5px">
                                {!! JenismagangModel::list_jenis_magang('jenis_magang') !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3" id="jjg">
                        <div class="form-group" >
                            <span style="font-weight:bold">Jenjang Pendidikan</span>
                            <div style="clear:both;margin-top:5px">
                                {!! SiswamagangModel::listJenjang('jenjang_pddk') !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3" id="mulai">
                        <div class="form-group" >
                            <span style="font-weight:bold">Bulan Mulai Magang</span>
                            <div style="clear:both;margin-top:5px">
                                {!! LaporansiswamagangModel::list_bulan('bulan_mulai') !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3" id="selesai">
                        <div class="form-group" >
                            <span style="font-weight:bold">Bulan Selesai Magang</span>
                            <div style="clear:both;margin-top:5px">
                                {!! LaporansiswamagangModel::list_bulan('bulan_selesai') !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2" id="cetak" >
                        <div class="form-group">
                            <span style="font-weight:bold">&nbsp</span>
                            <div style="clear:both;margin-top:5px">
                                <button class="btn btn-default print" type="submit"><span class="glyphicon glyphicon-print"></span>Cetak</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- Filter Pencarian -->
        <?php if ($act==1) { ?>
        {!! Form::open(array('url' => \Request::path().'/delete', 'method' => 'POST', 'class' => 'form-'.\Config::get('claravel::ajax'),'id'=>'data' )) !!}
        <div class="table-responsive">
            <div class="box-body no-padding">
                <table class="table table-striped table-hover table-condensed table-bordered" id='tabel'>
                    <thead class="bg-primary">
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Asal Sekolah</th>
                        <th>Pendidikan</th>
                        <th>Jenis Magang</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                    </tr>
                    </thead>   
                    
                    <tbody>
                    @foreach ($laporansiswamagangs as $laporansiswamagang)
                    <tr>                        
                        <td>{!!$laporansiswamagang->nm_siswa!!}</td>
                        <td>{!!$laporansiswamagang->asal_sekolah!!}</td>
                        <td>{!! SiswamagangModel::get_jenjang($laporansiswamagang->jenjang_pddk) !!}</td>
                        <td>{!! JenismagangModel::get_jenis_magang($laporansiswamagang->nm_magang) !!}</td>
                        <td><?php echo date('d F Y', strtotime($laporansiswamagang->tgl_mulai)); ?></td>
                        <td><?php echo date('d F Y', strtotime($laporansiswamagang->tgl_selesai)); ?></td>

                        
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
              <?php //echo $laporansiswamagangs->appends(array('search' => Input::get('search')))->render(); ?>
            </div>
          </div>
        </div>
        {!! Form::close() !!}
         <?php } ?>
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
        $('#cetak').hide();
        $('#jns').on('change',function(e){
            $('#cetak').fadeIn();
        })
        $('#jjg').on('change',function(e){
            $('#cetak').fadeIn();
        })
        $('#mulai').on('change',function(e){
            $('#cetak').fadeIn();
        })
        $('#selesai').on('change',function(e){
            $('#cetak').fadeIn();
        })
        $('.print').on('click',function(e){
            $('#cetak').hide();
        })
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
                            notification(html,'success');
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
                            notification(html,'success');
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
