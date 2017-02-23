<?php namespace App\Modules\master\siswamagang\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\master\siswamagang\Models\SiswamagangModel;
use Input,View, Request, Form, File;
use Auth;
use DB;
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
        $input = array(
            'no_induk' => Input::get('no_induk'),
            'nm_siswa' => Input::get('nm_siswa'),
            'asal_sekolah' => Input::get('asal_sekolah'),
            'jenjang_pddk' => Input::get('jenjang_pddk'),
            'alamat' => Input::get('alamat'),
            'no_telp' => Input::get('no_telp'),
            'email' => Input::get('email'),
            'tgl_mulai' => Input::get('tgl_mulai'),
            'tgl_selesai' => Input::get('tgl_selesai'),
            'nm_magang' => Input::get('nm_magang'),
            'nm_supervisior' => Input::get('nm_supervisior')
        );
        
        $image = Input::get('foto');
        unset($input['foto']);
        unset($input['_token']);
       
        $validation = \Validator::make($input, SiswamagangModel::$rules);
        
        if ($validation->passes()){
            $input['user_id'] = \Session::get('user_id');
            $input['role_id'] = \Session::get('role_id');
            $create = $this->siswamagang->create($input);
           if($create){
                if (Input::hasFile('foto')){
                    $img             = \Input::file('foto');
                    $destinationPath = base_path().'/packages/upload/siswamagang/';
                    $ext             = $img->getClientOriginalExtension();
                    if(strtolower($ext) == 'jpg' || strtolower($ext) == 'png' || strtolower($ext) == 'jpeg'){
                        $filename        = uniqid().'_'.time().'.'.$ext;
                        $uploadSuccess   = $img->move($destinationPath, $filename);
                        if($uploadSuccess){
                            chmod($destinationPath.$filename, 0777);
                            $gambar['foto'] = $filename;
                            $siswamagang = $this->siswamagang->find($create->id);
                            echo ($siswamagang->update($gambar))?'Data berhasil disimpan':'0';

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
        $siswamagang = $this->siswamagang->find($id);
        //if (is_null($siswamagang)){return \Redirect::to('master/siswamagang/index');}
        return View::make('siswamagang::edit', compact('siswamagang'));
    }
    
    public function postEdit(){
        cekAjax();
        $id = Input::get('id');
        /*$input = Input::all();*/
        $input = array(
            'no_induk' => Input::get('no_induk'),
            'nm_siswa' => Input::get('nm_siswa'),
            'asal_sekolah' => Input::get('asal_sekolah'),
            'jenjang_pddk' => Input::get('jenjang_pddk'),
            'alamat' => Input::get('alamat'),
            'no_telp' => Input::get('no_telp'),
            'email' => Input::get('email'),
            'tgl_mulai' => Input::get('tgl_mulai'),
            'tgl_selesai' => Input::get('tgl_selesai'),
            'nm_magang' => Input::get('nm_magang'),
            'nm_supervisior' => Input::get('nm_supervisior')
        );
        
        $image = Input::get('foto');
        unset($input['foto']);
        unset($input['_token']);
        $validation = \Validator::make($input, SiswamagangModel::$rules);
        
        if ($validation->passes()){
            if (Input::hasFile('foto')){
                $img             = \Input::file('foto');
                $destinationPath = base_path().'/packages/upload/siswamagang/';
                $ext             = $img->getClientOriginalExtension();
                if(strtolower($ext) == 'jpg' || strtolower($ext) == 'png' || strtolower($ext) == 'jpeg'){
                    $filename        = uniqid().'_'.time().'.'.$ext;
                    $uploadSuccess   = $img->move($destinationPath, $filename);

                    if($uploadSuccess){
                        chmod($destinationPath.$filename, 0777);
                        $data = $this->siswamagang->find($id);

                        $old_image = public_path().'/packages/upload/siswamagang/'.$data->foto;
                        $old_image = str_replace('public/', '', $old_image);

                        if($data->foto != ''){
                            if(\File::exists($old_image)) {
                                \File::delete($old_image);
                            }
                        }
                        $siswamagang = $this->siswamagang->find($id);
                        $input['foto'] = $filename;
                        echo ($siswamagang->update($input))?'Data berhasil disimpan':'0';
                        // echo $old_image;
                    } else {
                        echo 'Gagal menyimpan gambar';
                    }
                } else {
                    echo 'File yang diijinkan harus berekstensi jpg dan png';
                }
            } else {
                $siswamagang = $this->siswamagang->find($id);
                echo ($siswamagang->update($input))?'Data berhasil disimpan':'0';
            }
            /*$siswamagang = $this->siswamagang->find($id);
            echo ($siswamagang->update($input))?4:"Gagal Disimpan";*/
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
                $data = $this->siswamagang->find($id);
                if($data->image != ''){
                    if(file_exists(base_path().'/packages/upload/siswamagang/'.$data->image)){
                        unlink(base_path().'/packages/upload/siswamagang/'.$data->image);
                    }
                }
                $this->siswamagang->find($id)->delete();
            }
            echo 'Data berhasil dihapus';
        }
        else{
            $data = $this->siswamagang->find($ids);
            if($data->image != ''){
                if(file_exists(base_path().'/packages/upload/siswamagang/'.$data->image)){
                    unlink(base_path().'/packages/upload/siswamagang/'.$data->image);
                }
            }
            echo ($this->siswamagang->find($ids)->delete())?'Data berhasil dihapus':'0';
        }
    }
	
}
