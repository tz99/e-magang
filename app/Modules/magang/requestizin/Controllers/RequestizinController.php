<?php namespace App\Modules\magang\requestizin\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\magang\requestizin\Models\RequestizinModel;
use Input,View, Request, Form, File;

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
        $input = Input::all();
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
        //if (is_null($requestizin)){return \Redirect::to('magang/requestizin/index');}
        return View::make('requestizin::edit', compact('requestizin'));
    }
    
    public function postEdit(){
        cekAjax();
        $id = Input::get('id');
        $input = Input::all();
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
