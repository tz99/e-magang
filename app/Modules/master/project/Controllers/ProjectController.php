<?php namespace App\Modules\master\project\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\master\project\Models\ProjectModel;
use Input,View, Request, Form, File;

/**
* Project Controller
* @var Project
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Divisi Software Development - Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class ProjectController extends Controller {
    protected $project;

    public function __construct(ProjectModel $project){
        $this->project = $project;
    }

        public function getIndex(){
        cekAjax();
        if (Input::has('search')) {
            if(strlen(Input::has('search')) > 0){
                $projects = $this->project
                			->orWhere('nm_project', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('deskripsi', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('status', 'LIKE', '%'.Input::get('search').'%')

                ->paginate($_ENV['configurations']['list-limit']);
            }else{
                $projects = $this->project->all();
            }
        }else{
            $projects = $this->project->all();
        }
        return View::make('project::index', compact('projects'));
    }


        public function getCreate(){
        cekAjax();
        return View::make('project::create');
    }

    public function postCreate(){
        cekAjax();
        $input = Input::all();
        $validation = \Validator::make($input, ProjectModel::$rules);
        if ($validation->passes()){
            $input['user_id'] = \Session::get('user_id');
            $input['role_id'] = \Session::get('role_id');
            echo ($this->project->create($input))?1:"Gagal Disimpan";
        }
        else{
            echo 'Input tidak valid';
        }
    }



    //{controller-show}

        public function getEdit($id = false){
        cekAjax();
        $id = ($id == false)?Input::get('id'):'';
        $project = $this->project->find($id);
        //if (is_null($project)){return \Redirect::to('master/project/index');}
        return View::make('project::edit', compact('project'));
    }
    
    public function postEdit(){
        cekAjax();
        $id = Input::get('id');
        $input = Input::all();
        $validation = \Validator::make($input, ProjectModel::$rules);
        
        if ($validation->passes()){
            $project = $this->project->find($id);
            echo ($project->update($input))?4:"Gagal Disimpan";
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
                $this->project->find($id)->delete();
            }
            echo 'Data berhasil dihapus';
        }
        else{
            echo ($this->project->find($ids)->delete())?9:0;
        }
    }

}
