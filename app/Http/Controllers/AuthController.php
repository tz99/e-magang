<?php

namespace App\Http\Controllers;

use View, Validator, Input, Session, Redirect, Auth;

class AuthController extends Controller {
	
	public function getIndex(){
		return View::make("claravel::portal.index");
	}

	public function getTest(){
		die('Sukses Bro');
	}


	public function getPass(){
            cekAjax();
            return View::make("home::dashboard.pass");                
	}
	public function postPass(){
            cekAjax();
            $input = Input::all();
            unset($input['_token']);
            $a = \UsersModel::find($input['id']);
            $cek = \Hash::check($input['password'], $a->password);
            if(!$cek){
                die('Password Lama Anda Salah');
            }else{
                if($input['password_baru1'] === $input['password_baru2']){
                    if(!ctype_alnum($input['password_baru1'])){
                        die('Hanya Boleh Huruf dan Angka');
                    }
                    $ubah = $a->update(array('password' => \Hash::make($input['password_baru1'])));
                    echo ($ubah)?4:0;                    
                }else{
                    die('Konfirmasi Password Tidak Cocok');
                }
                
            }
	}
        
	public function getProfil(){
            cekAjax();
            return View::make("home::dashboard.profil");                
	}

	public function postProfil(){
            cekAjax();
            $input = Input::all();
            unset($input['_token']);
	        if (Input::hasFile('foto')){
	            $destinationPath = base_path().'/packages/upload/photo/'.\Session::get('user_id');
	            $mode = 0777;
	            $recursive = false;
	            $f = Input::file('foto');
	                if($f != ''){
	                    $destinationPath = str_replace("\\", '/', $destinationPath);
	                    if(!is_dir($destinationPath)){
	                        mkdir($destinationPath, $mode, $recursive);
	                    }
	    //                die($destinationPath);
	                    $tipefile = $f->getClientOriginalExtension();
	                    $filename = str_replace(' ', '-', $f->getClientOriginalName());
	                    @unlink($destinationPath.'/'.$filename);
	                    $f->move($destinationPath, $filename);
	                    $input['foto'] = $filename;                    
	                }
	        }else{
	        }
            $ubah = \UsersModel::find($input['id'])->update($input);
            echo ($ubah)?4:0;
	}



	public function postLogin(){
		// validate the info, create rules for the inputs
		$rules = array(
			'username'    => 'required', // make sure the email is an actual email
			'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);
		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('/')
				->withErrors($validator) // send back all errors to the login form
				->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
		} else {

			// create our user data for the authentication
			$userdata = array(
				'username' 	=> Input::get('username'),
				'password' 	=> Input::get('password')
			);

			// attempt to do the login
			if (Auth::attempt($userdata)) {

				$role = \DB::table('roles')
				->where('id','=',Auth::user()->role_id)
				->first()->name;

				$rolesModel = \RolesModel::find(Auth::user()->role_id);
				\Session::put('role_id', Auth::user()->role_id);
				\Session::put('role', $role);                                    
				\Session::put('user_id', Auth::user()->id);
				\Session::put('user_name', Auth::user()->username);
				\Session::put('name', Auth::user()->name);
				\Session::put('foto', Auth::user()->foto);
                
				
				$pms = \PermissionsmatrixModel::with(array('permissions'=> function($q){
					$q->where('name' ,'=', 'site-login');
				}))->where('role_id', \Session::get('role_id'))->get();
				
				if ($pms->count() > 0){
					return Redirect::to('/'.$rolesModel->login_destination);
				}else{
					Auth::logout();
					\Session::flash('message', 'You don\'t have permission to sign in into this applications.');
					return Redirect::to('/'); 
				}
				
				

			} else {	 	
				return Redirect::to('/');
				//return Redirect::to('/login');

			}

		}
	}

	public function getLogout(){
		Auth::logout();
		return Redirect::to('/'); 
	}
}
