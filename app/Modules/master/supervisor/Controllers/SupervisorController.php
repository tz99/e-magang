<?php namespace App\Modules\master\supervisor\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\master\supervisor\Models\SupervisorModel;
use Input,View, Request, Form, File;

/**
* Supervisor Controller
* @var Supervisor
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Divisi Software Development - Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class SupervisorController extends Controller {
    protected $supervisor;

    public function __construct(SupervisorModel $supervisor){
        $this->supervisor = $supervisor;
    }

        public function getIndex(){
        cekAjax();
        if (Input::has('search')) {
            if(strlen(Input::has('search')) > 0){
                $supervisors = $this->supervisor
                			->orWhere('nm_supervisor', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('jabatan', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('telepon', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('email', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('foto', 'LIKE', '%'.Input::get('search').'%')

                ->paginate($_ENV['configurations']['list-limit']);
            }else{
                $supervisors = $this->supervisor->all();
            }
        }else{
            $supervisors = $this->supervisor->all();
        }
        return View::make('supervisor::index', compact('supervisors'));
    }


        public function getCreate(){
        cekAjax();
        return View::make('supervisor::create');
    }

    public function postCreate(){
        cekAjax();
        $input = Input::all();
        $validation = \Validator::make($input, SupervisorModel::$rules);
        if ($validation->passes()){
            $input['user_id'] = \Session::get('user_id');
            $input['role_id'] = \Session::get('role_id');
            echo ($this->supervisor->create($input))?1:"Gagal Disimpan";
        }
        else{
            echo 'Input tidak valid';
        }
    }



    //{controller-show}

        public function getEdit($id = false){
        cekAjax();
        $id = ($id == false)?Input::get('id'):'';
        $supervisor = $this->supervisor->find($id);
        //if (is_null($supervisor)){return \Redirect::to('master/supervisor/index');}
        return View::make('supervisor::edit', compact('supervisor'));
    }
    
    public function postEdit(){
        cekAjax();
        $id = Input::get('id');
        $input = Input::all();
        $validation = \Validator::make($input, SupervisorModel::$rules);
        
        if ($validation->passes()){
            $supervisor = $this->supervisor->find($id);
            echo ($supervisor->update($input))?4:"Gagal Disimpan";
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
                $this->supervisor->find($id)->delete();
            }
            echo 'Data berhasil dihapus';
        }
        else{
            echo ($this->supervisor->find($ids)->delete())?9:0;
        }
    }

}
