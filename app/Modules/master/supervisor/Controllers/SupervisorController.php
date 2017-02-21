<?php namespace App\Modules\master\supervisor\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\master\supervisor\Models\SupervisorModel;
use Input,View, Request, Form, File;
use Auth;
use DB;
use App\User;

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
        $input_users = new User();
        $input_users->name = Input::get('nm_supervisor');
        $input_users->username = Input::get('username');
        $input_users->password = \Hash::make(Input::get('password'));
        $input_users->email = Input::get('email');
        $input_users->remember_token = Input::get('_token');
        $input_users->save();

        $input = array(
            'nm_supervisor' => Input::get('nm_supervisor'),
            'jabatan' => Input::get('jabatan'),
            'telepon' => Input::get('telepon'),
            'email' => Input::get('email')
        );
        
        $image = Input::get('foto');
        unset($input['foto']);
        unset($input['_token']);
        $validation = \Validator::make($input, SupervisorModel::$rules);
        if ($validation->passes()){
            $input['user_id'] = \Session::get('user_id');
            $input['role_id'] = \Session::get('role_id');

            $create = $this->supervisor->create($input);
            if($create){
                if (Input::hasFile('foto')){
                    $img             = \Input::file('foto');
                    $destinationPath = base_path().'/packages/upload/supervisor/';
                    $ext             = $img->getClientOriginalExtension();
                    if(strtolower($ext) == 'jpg' || strtolower($ext) == 'png' || strtolower($ext) == 'jpeg'){
                        $filename        = uniqid().'_'.time().'.'.$ext;
                        $uploadSuccess   = $img->move($destinationPath, $filename);
                        if($uploadSuccess){
                            chmod($destinationPath.$filename, 0777);
                            $gambar['foto'] = $filename;
                            $supervisor = $this->supervisor->find($create->id);
                            echo ($supervisor->update($gambar))?'Data berhasil disimpan':'0';

                        } else {
                            echo 'Gagal menyimpan gambar';
                        }
                    } else {
                        echo 'File yang diijinkan harus berekstensi jpg dan png';
                    }
                }else{
                    echo "Kesalahan file foto";
                }
            } else {
                echo 'Gagal menyimpan data';
            }
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
        $users = DB::table('users')
                    ->where('email',  $supervisor->email)
                    ->get();
        //if (is_null($supervisor)){return \Redirect::to('master/supervisor/index');}
        return View::make('supervisor::edit', compact('supervisor','users'));
    }
    
    public function postEdit(){
        cekAjax();
        $id = Input::get('id');
        $password_in = Input::get('password');
        $data = $this->supervisor->find($id);

        if ($password_in=='') {
            DB::table('users')->where('email',  $data->email)->update(array('name' => Input::get('nm_supervisor'),'username' => Input::get('username'),'email' =>  Input::get('email')));    
        }else{
            DB::table('users')
            ->where('email',  $data->email)->update(array('name' => Input::get('nm_supervisor'),'username' => Input::get('username'), 'password' => bcrypt(Input::get('password')),'email' =>  Input::get('email')));    
        }
        
        $input = array(
            'nm_supervisor' => Input::get('nm_supervisor'),
            'jabatan' => Input::get('jabatan'),
            'telepon' => Input::get('telepon'),
            'email' => Input::get('email')
        );
        
        unset($input['foto']);
        unset($input['_token']);
        $validation = \Validator::make($input, SupervisorModel::$rules);
        
        if ($validation->passes()){
            if (Input::hasFile('foto')){
                $img             = \Input::file('foto');
                $destinationPath = base_path().'/packages/upload/supervisor/';
                $ext             = $img->getClientOriginalExtension();
                if(strtolower($ext) == 'jpg' || strtolower($ext) == 'png' || strtolower($ext) == 'jpeg'){
                    $filename        = uniqid().'_'.time().'.'.$ext;
                    $uploadSuccess   = $img->move($destinationPath, $filename);

                    if($uploadSuccess){
                        chmod($destinationPath.$filename, 0777);
                        $data = $this->supervisor->find($id);

                        $old_image = public_path().'/packages/upload/supervisor/'.$data->foto;
                        $old_image = str_replace('public/', '', $old_image);

                        if($data->foto != ''){
                            if(\File::exists($old_image)) {
                                \File::delete($old_image);
                            }
                        }
                        $supervisor = $this->supervisor->find($id);
                        $input['foto'] = $filename;
                        echo ($supervisor->update($input))?'Data berhasil disimpan':'0';
                        // echo $old_image;
                    } else {
                        echo 'Gagal menyimpan gambar';
                    }
                } else {
                    echo 'File yang diijinkan harus berekstensi jpg dan png';
                }
            } else {
                $supervisor = $this->supervisor->find($id);
                echo ($supervisor->update($input))?'Data berhasil disimpan':'0';
            }        
        }
        else{
            echo 'Input tidak valid';
        }
    }


	
    public function postDelete(){
        cekAjax();
        $ids = Input::get('id');

        $data = $this->supervisor->find($ids);
        DB::table('users')->where('email', $data->email)->delete();

        if (is_array($ids)){
            foreach($ids as $id){
                $data = $this->supervisor->find($id);
                if($data->foto != ''){
                    if(file_exists(base_path().'/packages/upload/supervisor/'.$data->foto)){
                        unlink(base_path().'/packages/upload/supervisor/'.$data->foto);
                    }
                }
                $this->supervisor->find($id)->delete();
            }
            echo 'Data berhasil dihapus';
        }
        else{
            $data = $this->supervisor->find($ids);
            if($data->foto != ''){
                if(file_exists(base_path().'/packages/upload/supervisor/'.$data->foto)){
                    unlink(base_path().'/packages/upload/supervisor/'.$data->foto);
                }
            }
            echo ($this->supervisor->find($ids)->delete())?'Data berhasil dihapus':'0';
        }
    }

}
