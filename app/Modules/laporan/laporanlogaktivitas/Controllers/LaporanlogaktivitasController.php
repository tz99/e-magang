<?php namespace App\Modules\laporan\laporanlogaktivitas\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\laporan\laporanlogaktivitas\Models\LaporanlogaktivitasModel;
use Input,View, Request, Form, File;
use DB;
/**
* Laporanlogaktivitas Controller
* @var Laporanlogaktivitas
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Divisi Software Development - Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class LaporanlogaktivitasController extends Controller {
    protected $laporanlogaktivitas;

    public function __construct(LaporanlogaktivitasModel $laporanlogaktivitas){
        $this->laporanlogaktivitas = $laporanlogaktivitas;
    }

        public function getIndex(){
        cekAjax();

        if (Input::has('siswa')) {
            $sts=1;
            $siswa = Input::get('siswa');
            if(strlen(Input::has('siswa')) > 0){
                $laporanlogaktivitass = DB::table('mg_log_aktivitas')
                        ->Where('siswa',  $siswa)
                        ->paginate($_ENV['configurations']['list-limit']);
            }
            else{
                $laporanlogaktivitass = DB::table('mg_log_aktivitas')->get();
                //->whereRaw('extract(month from tanggal) = ?', [$bulan])
            }
        }else{
            $sts=0;
            $laporanlogaktivitass = DB::table('mg_log_aktivitas')->get();
        }

        return View::make('laporanlogaktivitas::index', compact('laporanlogaktivitass','sts'));
    }

    public function show_pdf(){
        $siswa = Input::get('siswa');
        return View::make('laporanlogaktivitas::pdf', compact('siswa'));
    }
}
