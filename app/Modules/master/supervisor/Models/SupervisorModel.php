<?php namespace App\Modules\master\supervisor\Models;
use Illuminate\Database\Eloquent\Model;

use DB;
/**
* Supervisor Model
* @var Supervisor
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class SupervisorModel extends Model {
	protected $guarded = array();
	
	protected $table = "ms_supervisor";

	public static $rules = array(
  //   	'nm_supervisor' => 'required',
		// 'jabatan' => 'required',
		// 'telepon' => 'required',
		// 'email' => 'required',
		// 'foto' => 'required',

    );

	public static function all($columns = array('*')){
		$instance = new static;
		if (\PermissionsLibrary::hasPermission('mod-supervisor-listall')){
			return $instance->newQuery()->paginate($_ENV['configurations']['list-limit']);
		}else{
			return $instance->newQuery()
			->where('role_id', \Session::get('role_id'))
			->paginate($_ENV['configurations']['list-limit']);	
			
		}
	}

	public function cek(){
		return "cek";
	}
}
