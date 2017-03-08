<?php namespace App\Modules\magang\plottingpembimbing\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\magang\plottingpembimbing\Models\PlottingpembimbingModel;
use Input,View, Request, Form, File;
use Auth;
use DB;
use App\User;
/**
* Siswamagang Controller
* @var Siswamagang
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Divisi Software Development - Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class PlottingpembimbingController extends Controller {
    protected $siswamagang;

    public function __construct(PlottingpembimbingModel $siswamagang){
        $this->siswamagang = $siswamagang;
    }

        public function getIndex(){
        cekAjax();
        if (Input::has('search')) {
            if(strlen(Input::has('search')) > 0){
                $siswamagangs = $this->siswamagang
                            ->orWhere('no_induk', 'LIKE', '%'.Input::get('search').'%')
            ->orWhere('nm_siswa', 'LIKE', '%'.Input::get('search').'%')
            ->orWhere('jenjang_pddk', 'LIKE', '%'.Input::get('search').'%')
            ->orWhere('nm_magang', 'LIKE', '%'.Input::get('search').'%')
            ->orWhere('nm_supervisior', 'LIKE', '%'.Input::get('search').'%')

                ->paginate($_ENV['configurations']['list-limit']);
            }else{
                $siswamagangs = $this->siswamagang->all();
            }
        }else{
            $siswamagangs = $this->siswamagang->all();
        }
        return View::make('plottingpembimbing::index', compact('siswamagangs'));
    }

    public function getEdit($id = false){
        cekAjax();
        $id = ($id == false)?Input::get('id'):'';
        $siswamagang = $this->siswamagang->find($id);
        return View::make('plottingpembimbing::edit', compact('siswamagang'));
    }
    
    public function postEdit(){
        cekAjax();
        $id = Input::get('id');
        $password_in = Input::get('password');
        $data = $this->siswamagang->find($id);
        $input = array(
            'nm_supervisior' => Input::get('nm_supervisior')
        );
        $validation = \Validator::make($input, PlottingpembimbingModel::$rules);
        if ($validation->passes()){
            $siswamagang = $this->siswamagang->find($id);
            echo ($siswamagang->update($input))?4:"Gagal Disimpan";
        }
        else{
            echo 'Input tidak valid';
        }
    }    
}