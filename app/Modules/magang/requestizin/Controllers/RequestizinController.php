<?php namespace App\Modules\magang\requestizin\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\magang\requestizin\Models\RequestizinModel;
use Input,View, Request, Form, File;
use DB;
/**
* Requestizin Controller
* @var Requestizin
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Divisi Software Development - Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class RequestizinController extends Controller {
    protected $requestizin;

    public function __construct(RequestizinModel $requestizin){
        $this->requestizin = $requestizin;
    }

        public function getIndex(){
        cekAjax();
        if (Input::has('search')) {
            if(strlen(Input::has('search')) > 0){
                $requestizins = $this->requestizin
                			->orWhere('tgl_awal_izin', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('tgl_akhir_izin', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('jenis_izin', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('surat_izin', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('keterangan_izin', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('verifikasi_izin', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('verifikator_izin', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('waktu_verifikasi_izin', 'LIKE', '%'.Input::get('search').'%')

                ->paginate($_ENV['configurations']['list-limit']);
            }else{
                $requestizins = $this->requestizin->all();
            }
        }else{
            $requestizins = $this->requestizin->all();
        }
        return View::make('requestizin::index', compact('requestizins'));
    }


        public function getCreate(){
        cekAjax();
        return View::make('requestizin::create');
    }

    public function postCreate(){
        cekAjax();

        $get_waktu = Input::get('waktu_verifikasi_izin');
        if (!empty($get_waktu)) {
            $ex_waktu = explode(' ', $get_waktu);
                $date = $ex_waktu[0];
                $time = $ex_waktu[1];
                $apm  = $ex_waktu[2];

                $ex_date = explode('/', $date);
                    $d = $ex_date[1];
                    $m = $ex_date[0];
                    $Y = $ex_date[2];

                $ex_time = explode(':', $time);
                    $H = $ex_time[0];
                    $i = $ex_time[1];

                if ($apm == 'PM') {
                    $H = $H+12;
                }
            
            $waktu = "$Y-$m-$d $H:$i";    
        }else{
            $waktu='';
        }
        if (empty(Input::get('verifikasi_izin'))) {
            $ver=0;
        }else{
            $ver=1;
        }

        $input = array(
            'tgl_awal_izin' => input::get('tgl_awal_izin'),
            'tgl_akhir_izin' => input::get('tgl_akhir_izin'),
            'jenis_izin' => input::get('jenis_izin'),
            'surat_izin' => input::get('surat_izin'),
            'keterangan_izin' => input::get('keterangan_izin'),
            'verifikasi_izin' => input::get('verifikasi_izin'),
            'verifikator_izin' => input::get('verifikator_izin'),
            'waktu_verifikasi_izin' => $waktu
        );
        $validation = \Validator::make($input, RequestizinModel::$rules);
        if ($validation->passes()){
            $input['user_id'] = \Session::get('user_id');
            $input['role_id'] = \Session::get('role_id');
            echo ($this->requestizin->create($input))?1:"Gagal Disimpan";
        }
        else{
            echo 'Input tidak valid';
        }
    }



    //{controller-show}

        public function getEdit($id = false){
        cekAjax();
        $id = ($id == false)?Input::get('id'):'';
        $requestizin = $this->requestizin->find($id);
        $data = DB::table('mg_request_izin')
                    ->where('id',  $requestizin->id)
                    ->get();
        //if (is_null($requestizin)){return \Redirect::to('magang/requestizin/index');}
        return View::make('requestizin::edit', compact('requestizin','data'));
    }
    
    public function postEdit(){
        cekAjax();
        $id = Input::get('id');

        $get_waktu = Input::get('waktu_verifikasi_izin');
        if (!empty($get_waktu)) {
            $ex_waktu = explode(' ', $get_waktu);
                $date = $ex_waktu[0];
                $time = $ex_waktu[1];
                $apm  = $ex_waktu[2];

                $ex_date = explode('/', $date);
                    $d = $ex_date[1];
                    $m = $ex_date[0];
                    $Y = $ex_date[2];

                $ex_time = explode(':', $time);
                    $H = $ex_time[0];
                    $i = $ex_time[1];

                if ($apm == 'PM') {
                    $H = $H+12;
                }
            
            $waktu = "$Y-$m-$d $H:$i";    
        }else{
            $waktu='';
        }
        if (empty(Input::get('verifikasi_izin'))) {
            $ver=0;
        }else{
            $ver=1;
        }

        $input = array(
            'tgl_awal_izin' => $waktu,
            'tgl_akhir_izin' => $waktu,
            'jenis_izin' => input::get('jenis_izin'),
            'surat_izin' => input::get('surat_izin'),
            'keterangan_izin' => input::get('keterangan_izin'),
            'verifikasi_izin' => input::get('verifikasi_izin'),
            'verifikator_izin' => input::get('verifikasi_izin'),
            'waktu_verifikasi_izin' => $get_waktu
        );
        $validation = \Validator::make($input, RequestizinModel::$rules);
        
        if ($validation->passes()){
            $requestizin = $this->requestizin->find($id);
            echo ($requestizin->update($input))?4:"Gagal Disimpan";
        }
        else{
            echo 'Input tidak valid';
        }
    }


	
        public function postDelete(){
        cekAjax();
        $ids = Input::get('id');
        if (is_array($ids)){
            foreach($ids as $id){
                $this->requestizin->find($id)->delete();
            }
            echo 'Data berhasil dihapus';
        }
        else{
            echo ($this->requestizin->find($ids)->delete())?9:0;
        }
    }

}
