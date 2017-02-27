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
        if (Input::has('search')) {
            if(strlen(Input::has('search')) > 0){
                $laporanlogaktivitass = $this->laporanlogaktivitas
                			->orWhere('f', 'LIKE', '%'.Input::get('search').'%')

                ->paginate($_ENV['configurations']['list-limit']);
            }else{
                $data = DB::table('mg_log_aktivitas')->get();
            }
        }else{
            $data = DB::table('mg_log_aktivitas')->get();
        }
        return View::make('laporanlogaktivitas::index', compact('data'));
    }


        public function getCreate(){
        cekAjax();
        return View::make('laporanlogaktivitas::create');
    }

    public function postCreate(){
        cekAjax();
        $input = Input::all();
        $validation = \Validator::make($input, LaporanlogaktivitasModel::$rules);
        if ($validation->passes()){
            $input['user_id'] = \Session::get('user_id');
            $input['role_id'] = \Session::get('role_id');
            echo ($this->laporanlogaktivitas->create($input))?1:"Gagal Disimpan";
        }
        else{
            echo 'Input tidak valid';
        }
    }



    //{controller-show}

        public function getEdit($id = false){
        cekAjax();
        $id = ($id == false)?Input::get('id'):'';
        $laporanlogaktivitas = $this->laporanlogaktivitas->find($id);
        //if (is_null($laporanlogaktivitas)){return \Redirect::to('laporan/laporanlogaktivitas/index');}
        return View::make('laporanlogaktivitas::edit', compact('laporanlogaktivitas'));
    }
    
    public function postEdit(){
        cekAjax();
        $id = Input::get('id');
        $input = Input::all();
        $validation = \Validator::make($input, LaporanlogaktivitasModel::$rules);
        
        if ($validation->passes()){
            $laporanlogaktivitas = $this->laporanlogaktivitas->find($id);
            echo ($laporanlogaktivitas->update($input))?4:"Gagal Disimpan";
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
                $this->laporanlogaktivitas->find($id)->delete();
            }
            echo 'Data berhasil dihapus';
        }
        else{
            echo ($this->laporanlogaktivitas->find($ids)->delete())?9:0;
        }
    }

}
