<?php namespace App\Modules\laporan\laporansiswamagang\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\laporan\laporansiswamagang\Models\LaporansiswamagangModel;
use Input,View, Request, Form, File;
use DB;

/**
* Laporansiswamagang Controller
* @var Laporansiswamagang
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Divisi Software Development - Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class LaporansiswamagangController extends Controller {
    protected $laporansiswamagang;

    public function __construct(LaporansiswamagangModel $laporansiswamagang){
        $this->laporansiswamagang = $laporansiswamagang;
    }

        public function getIndex(){
        cekAjax();
        if (Input::has('jenis_magang') || Input::has('jenjang_pddk') || Input::has('bulan_mulai') || Input::has('bulan_selesai')) {
            $act=1;
            $jenis = Input::get('jenis_magang');
            $jenjang = Input::get('jenjang_pddk');
            $bulanml = Input::get('bulan_mulai');
            $bulansl = Input::get('bulan_selesai');

            if((strlen(Input::has('jenis_magang')) > 0) && (strlen(Input::has('jenjang_pddk')) > 0 ) && (Input::has('bulan_mulai') > 0) && (Input::has('bulan_selesai') > 0)){
                $laporansiswamagangs = DB::table('ms_siswa_magang')
                        ->Where('nm_magang',  $jenis)
                        ->Where('jenjang_pddk',  $jenjang)
                        ->whereRaw('extract(month from tgl_mulai) >= ?', [$bulanml])
                        ->whereRaw('extract(month from tgl_selesai) <= ?', [$bulansl])
                        ->paginate($_ENV['configurations']['list-limit']);  

            }else if((strlen(Input::has('jenis_magang')) > 0) && (strlen(Input::has('jenjang_pddk')) > 0 ) && (Input::has('bulan_mulai') > 0)){
                $laporansiswamagangs = DB::table('ms_siswa_magang')
                        ->Where('nm_magang',  $jenis)
                        ->Where('jenjang_pddk',  $jenjang)
                        ->whereRaw('extract(month from tgl_mulai) = ?', [$bulanml])
                        ->paginate($_ENV['configurations']['list-limit']);  

            }else if((strlen(Input::has('jenis_magang')) > 0) && (strlen(Input::has('jenjang_pddk')) > 0 ) && (Input::has('bulan_selesai') > 0)){
                $laporansiswamagangs = DB::table('ms_siswa_magang')
                        ->Where('nm_magang',  $jenis)
                        ->Where('jenjang_pddk',  $jenjang)
                        ->whereRaw('extract(month from tgl_selesai) = ?', [$bulansl])
                        ->paginate($_ENV['configurations']['list-limit']);  

            }else if((strlen(Input::has('jenis_magang')) > 0) && (strlen(Input::has('jenjang_pddk')) > 0 )){
                $laporansiswamagangs = DB::table('ms_siswa_magang')
                        ->Where('nm_magang',  $jenis)
                        ->Where('jenjang_pddk',  $jenjang)
                        ->paginate($_ENV['configurations']['list-limit']);    

            }else if((strlen(Input::has('jenis_magang')) > 0) && (Input::has('bulan_mulai') > 0)){
                $laporansiswamagangs = DB::table('ms_siswa_magang')
                        ->Where('nm_magang',  $jenis)
                        ->whereRaw('extract(month from tgl_mulai) = ?', [$bulanml])
                        ->paginate($_ENV['configurations']['list-limit']);    

            }else if((strlen(Input::has('jenis_magang')) > 0) && (Input::has('bulan_selesai') > 0)){
                $laporansiswamagangs = DB::table('ms_siswa_magang')
                        ->Where('nm_magang',  $jenis)
                        ->whereRaw('extract(month from tgl_selesai) = ?', [$bulansl])
                        ->paginate($_ENV['configurations']['list-limit']);    

            }else if((strlen(Input::has('jenjang_pddk')) > 0) && (Input::has('bulan_mulai') > 0)){
                $laporansiswamagangs = DB::table('ms_siswa_magang')
                        ->Where('jenjang_pddk',  $jenjang)
                        ->whereRaw('extract(month from tgl_mulai) = ?', [$bulanml])
                        ->paginate($_ENV['configurations']['list-limit']); 

            }else if((strlen(Input::has('jenjang_pddk')) > 0) && (Input::has('bulan_selesai') > 0)){
                $laporansiswamagangs = DB::table('ms_siswa_magang')
                        ->Where('jenjang_pddk',  $jenjang)
                        ->whereRaw('extract(month from tgl_selesai) = ?', [$bulansl])
                        ->paginate($_ENV['configurations']['list-limit']); 

            }else if(strlen(Input::has('jenis_magang')) > 0){
                $laporansiswamagangs = DB::table('ms_siswa_magang')
                        ->Where('nm_magang',  $jenis)
                        ->paginate($_ENV['configurations']['list-limit']);    

            }else if(strlen(Input::has('jenjang_pddk')) > 0){
                $laporansiswamagangs = DB::table('ms_siswa_magang')
                        ->Where('jenjang_pddk',  $jenjang)
                        ->paginate($_ENV['configurations']['list-limit']); 

            }else if(strlen(Input::has('bulan_mulai')) > 0){
                $laporansiswamagangs = DB::table('ms_siswa_magang')
                        ->whereRaw('extract(month from tgl_mulai) = ?', [$bulanml])
                        ->paginate($_ENV['configurations']['list-limit']);                        
            }else if(strlen(Input::has('bulan_selesai')) > 0){
                $laporansiswamagangs = DB::table('ms_siswa_magang')
                        ->whereRaw('extract(month from tgl_selesai) = ?', [$bulansl])
                        ->paginate($_ENV['configurations']['list-limit']);                        
            }
              
            else{
                $act=0;
            $laporansiswamagangs = DB::table('ms_siswa_magang')->get();
            }
        }else{
            $act=0;
            $laporansiswamagangs = DB::table('ms_siswa_magang')->get();
        }
       
        return View::make('laporansiswamagang::index', compact('laporansiswamagangs','act'));
    }


    

    //{controller-show}

    
	
    
}
