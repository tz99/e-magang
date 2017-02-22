<?php namespace App\Modules\master\siswamagang\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\master\siswamagang\Models\SiswamagangModel;
use Input,View, Request, Form, File;

/**
* Siswamagang Controller
* @var Siswamagang
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Divisi Software Development - Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class SiswamagangController extends Controller {
    protected $siswamagang;

    public function __construct(SiswamagangModel $siswamagang){
        $this->siswamagang = $siswamagang;
    }

        public function getIndex(){
        cekAjax();
        if (Input::has('search')) {
            if(strlen(Input::has('search')) > 0){
                $siswamagangs = $this->siswamagang
                			->orWhere('no_induk', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('nm_siswa', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('asal_sekolah', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('jenjang_pddk', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('alamat', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('no_telp', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('email', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('tgl_mulai', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('tgl_selesai', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('nm_magang', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('nm_supervisior', 'LIKE', '%'.Input::get('search').'%')

                ->paginate($_ENV['configurations']['list-limit']);
            }else{
                $siswamagangs = $this->siswamagang->all();
            }
        }else{
            $siswamagangs = $this->siswamagang->all();
        }
        return View::make('siswamagang::index', compact('siswamagangs'));
    }


        public function getCreate(){
        cekAjax();
        return View::make('siswamagang::create');
    }

    public function postCreate(){
        cekAjax();
        $input = Input::all();
        $validation = \Validator::make($input, SiswamagangModel::$rules);
        if ($validation->passes()){
            $input['user_id'] = \Session::get('user_id');
            $input['role_id'] = \Session::get('role_id');
            echo ($this->siswamagang->create($input))?1:"Gagal Disimpan";
        }
        else{
            echo 'Input tidak valid';
        }
    }



    //{controller-show}

        public function getEdit($id = false){
        cekAjax();
        $id = ($id == false)?Input::get('id'):'';
        $siswamagang = $this->siswamagang->find($id);
        //if (is_null($siswamagang)){return \Redirect::to('master/siswamagang/index');}
        return View::make('siswamagang::edit', compact('siswamagang'));
    }
    
    public function postEdit(){
        cekAjax();
        $id = Input::get('id');
        $input = Input::all();
        $validation = \Validator::make($input, SiswamagangModel::$rules);
        
        if ($validation->passes()){
            $siswamagang = $this->siswamagang->find($id);
            echo ($siswamagang->update($input))?4:"Gagal Disimpan";
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
                $this->siswamagang->find($id)->delete();
            }
            echo 'Data berhasil dihapus';
        }
        else{
            echo ($this->siswamagang->find($ids)->delete())?9:0;
        }
    }

}
