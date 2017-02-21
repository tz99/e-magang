<?php namespace App\Modules\master\pengumuman\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\master\pengumuman\Models\PengumumanModel;
use Input,View, Request, Form, File;

/**
* Pengumuman Controller
* @var Pengumuman
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Divisi Software Development - Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class PengumumanController extends Controller {
    protected $pengumuman;

    public function __construct(PengumumanModel $pengumuman){
        $this->pengumuman = $pengumuman;
    }

        public function getIndex(){
        cekAjax();
        if (Input::has('search')) {
            if(strlen(Input::has('search')) > 0){
                $pengumumans = $this->pengumuman
                			->orWhere('isi_pengumuman', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('pub_pengumuman', 'LIKE', '%'.Input::get('search').'%')

                ->paginate($_ENV['configurations']['list-limit']);
            }else{
                $pengumumans = $this->pengumuman->all();
            }
        }else{
            $pengumumans = $this->pengumuman->all();
        }
        return View::make('pengumuman::index', compact('pengumumans'));
    }


        public function getCreate(){
        cekAjax();
        return View::make('pengumuman::create');
    }

    public function postCreate(){
        cekAjax();
        $input = Input::all();
        $validation = \Validator::make($input, PengumumanModel::$rules);
        if ($validation->passes()){
            $input['user_id'] = \Session::get('user_id');
            $input['role_id'] = \Session::get('role_id');
            echo ($this->pengumuman->create($input))?1:"Gagal Disimpan";
        }
        else{
            echo 'Input tidak valid';
        }
    }



    //{controller-show}

        public function getEdit($id = false){
        cekAjax();
        $id = ($id == false)?Input::get('id'):'';
        $pengumuman = $this->pengumuman->find($id);
        //if (is_null($pengumuman)){return \Redirect::to('master/pengumuman/index');}
        return View::make('pengumuman::edit', compact('pengumuman'));
    }
    
    public function postEdit(){
        cekAjax();
        $id = Input::get('id');
        $input = Input::all();
        $validation = \Validator::make($input, PengumumanModel::$rules);
        
        if ($validation->passes()){
            $pengumuman = $this->pengumuman->find($id);
            echo ($pengumuman->update($input))?4:"Gagal Disimpan";
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
                $this->pengumuman->find($id)->delete();
            }
            echo 'Data berhasil dihapus';
        }
        else{
            echo ($this->pengumuman->find($ids)->delete())?9:0;
        }
    }

}
