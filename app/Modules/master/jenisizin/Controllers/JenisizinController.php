<?php namespace App\Modules\master\jenisizin\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\master\jenisizin\Models\JenisizinModel;
use Input,View, Request, Form, File;

/**
* Jenisizin Controller
* @var Jenisizin
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Divisi Software Development - Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class JenisizinController extends Controller {
    protected $jenisizin;

    public function __construct(JenisizinModel $jenisizin){
        $this->jenisizin = $jenisizin;
    }

        public function getIndex(){
        cekAjax();
        if (Input::has('search')) {
            if(strlen(Input::has('search')) > 0){
                $jenisizins = $this->jenisizin
                			->orWhere('nm_izin', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('ket_izin', 'LIKE', '%'.Input::get('search').'%')

                ->paginate($_ENV['configurations']['list-limit']);
            }else{
                $jenisizins = $this->jenisizin->all();
            }
        }else{
            $jenisizins = $this->jenisizin->all();
        }
        return View::make('jenisizin::index', compact('jenisizins'));
    }


        public function getCreate(){
        cekAjax();
        return View::make('jenisizin::create');
    }

    public function postCreate(){
        cekAjax();
        $input = Input::all();
        $validation = \Validator::make($input, JenisizinModel::$rules);
        if ($validation->passes()){
            $input['user_id'] = \Session::get('user_id');
            $input['role_id'] = \Session::get('role_id');
            echo ($this->jenisizin->create($input))?1:"Gagal Disimpan";
        }
        else{
            echo 'Input tidak valid';
        }
    }



    //{controller-show}

        public function getEdit($id = false){
        cekAjax();
        $id = ($id == false)?Input::get('id'):'';
        $jenisizin = $this->jenisizin->find($id);
        //if (is_null($jenisizin)){return \Redirect::to('master/jenisizin/index');}
        return View::make('jenisizin::edit', compact('jenisizin'));
    }
    
    public function postEdit(){
        cekAjax();
        $id = Input::get('id');
        $input = Input::all();
        $validation = \Validator::make($input, JenisizinModel::$rules);
        
        if ($validation->passes()){
            $jenisizin = $this->jenisizin->find($id);
            echo ($jenisizin->update($input))?4:"Gagal Disimpan";
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
                $this->jenisizin->find($id)->delete();
            }
            echo 'Data berhasil dihapus';
        }
        else{
            echo ($this->jenisizin->find($ids)->delete())?9:0;
        }
    }

}
