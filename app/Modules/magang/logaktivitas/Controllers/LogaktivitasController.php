<?php namespace App\Modules\magang\logaktivitas\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\magang\logaktivitas\Models\LogaktivitasModel;
use Input,View, Request, Form, File;

/**
* Logaktivitas Controller
* @var Logaktivitas
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Divisi Software Development - Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class LogaktivitasController extends Controller {
    protected $logaktivitas;

    public function __construct(LogaktivitasModel $logaktivitas){
        $this->logaktivitas = $logaktivitas;
    }

        public function getIndex(){
        cekAjax();
        if (Input::has('search')) {
            if(strlen(Input::has('search')) > 0){
                $logaktivitass = $this->logaktivitas
                			->orWhere('siswa', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('tanggal', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('aktivitas', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('verifikasi', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('verifikator', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('waktu_verifikasi', 'LIKE', '%'.Input::get('search').'%')

                ->paginate($_ENV['configurations']['list-limit']);
            }else{
                $logaktivitass = $this->logaktivitas->all();
            }
        }else{
            $logaktivitass = $this->logaktivitas->all();
        }
        return View::make('logaktivitas::index', compact('logaktivitass'));
    }


        public function getCreate(){
        cekAjax();
        return View::make('logaktivitas::create');
    }

    public function postCreate(){
        cekAjax();
        $input = Input::all();
        $validation = \Validator::make($input, LogaktivitasModel::$rules);
        if ($validation->passes()){
            $input['user_id'] = \Session::get('user_id');
            $input['role_id'] = \Session::get('role_id');
            echo ($this->logaktivitas->create($input))?1:"Gagal Disimpan";
        }
        else{
            echo 'Input tidak valid';
        }
    }



    //{controller-show}

        public function getEdit($id = false){
        cekAjax();
        $id = ($id == false)?Input::get('id'):'';
        $logaktivitas = $this->logaktivitas->find($id);
        //if (is_null($logaktivitas)){return \Redirect::to('magang/logaktivitas/index');}
        return View::make('logaktivitas::edit', compact('logaktivitas'));
    }
    
    public function postEdit(){
        cekAjax();
        $id = Input::get('id');
        $input = Input::all();
        $validation = \Validator::make($input, LogaktivitasModel::$rules);
        
        if ($validation->passes()){
            $logaktivitas = $this->logaktivitas->find($id);
            echo ($logaktivitas->update($input))?4:"Gagal Disimpan";
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
                $this->logaktivitas->find($id)->delete();
            }
            echo 'Data berhasil dihapus';
        }
        else{
            echo ($this->logaktivitas->find($ids)->delete())?9:0;
        }
    }

}
