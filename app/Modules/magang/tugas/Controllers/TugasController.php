<?php namespace App\Modules\magang\tugas\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\magang\tugas\Models\TugasModel;
use Input,View, Request, Form, File;

/**
* Tugas Controller
* @var Tugas
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Divisi Software Development - Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class TugasController extends Controller {
    protected $tugas;

    public function __construct(TugasModel $tugas){
        $this->tugas = $tugas;
    }

        public function getIndex(){
        cekAjax();
        if (Input::has('search')) {
            if(strlen(Input::has('search')) > 0){
                $tugass = $this->tugas
                			->orWhere('nm_siswa', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('nm_project', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('tugas', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('deskripsi', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('tgl_deadline', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('status', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('tgl_selesai', 'LIKE', '%'.Input::get('search').'%')

                ->paginate($_ENV['configurations']['list-limit']);
            }else{
                $tugass = $this->tugas->all();
            }
        }else{
            $tugass = $this->tugas->all();
        }
        return View::make('tugas::index', compact('tugass'));
    }


        public function getCreate(){
        cekAjax();
        return View::make('tugas::create');
    }

    public function postCreate(){
        cekAjax();
        $input = Input::all();
        $validation = \Validator::make($input, TugasModel::$rules);
        if ($validation->passes()){
            $input['user_id'] = \Session::get('user_id');
            $input['role_id'] = \Session::get('role_id');
            echo ($this->tugas->create($input))?1:"Gagal Disimpan";
        }
        else{
            echo 'Input tidak valid';
        }
    }



    //{controller-show}

        public function getEdit($id = false){
        cekAjax();
        $id = ($id == false)?Input::get('id'):'';
        $tugas = $this->tugas->find($id);
        //if (is_null($tugas)){return \Redirect::to('magang/tugas/index');}
        return View::make('tugas::edit', compact('tugas'));
    }
    
    public function postEdit(){
        cekAjax();
        $id = Input::get('id');
        $input = Input::all();
        $validation = \Validator::make($input, TugasModel::$rules);
        
        if ($validation->passes()){
            $tugas = $this->tugas->find($id);
            echo ($tugas->update($input))?4:"Gagal Disimpan";
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
                $this->tugas->find($id)->delete();
            }
            echo 'Data berhasil dihapus';
        }
        else{
            echo ($this->tugas->find($ids)->delete())?9:0;
        }
    }

}
