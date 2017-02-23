<?php namespace App\Modules\magang\logaktivitas\Models;
use Illuminate\Database\Eloquent\Model;


/**
* Logaktivitas Model
* @var Logaktivitas
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class LogaktivitasModel extends Model {
	protected $guarded = array();
	
	protected $table = "mg_log_aktivitas";

	public static $rules = array(
    	'siswa' => 'required',
		'tanggal' => 'required',
		'aktivitas' => 'required',

    );

	public static function all($columns = array('*')){
		$instance = new static;
		if (\PermissionsLibrary::hasPermission('mod-logaktivitas-listall')){
			return $instance->newQuery()->paginate($_ENV['configurations']['list-limit']);
		}else{
			return $instance->newQuery()
			->where('role_id', \Session::get('role_id'))
			->paginate($_ENV['configurations']['list-limit']);	
			
		}
	}

}
