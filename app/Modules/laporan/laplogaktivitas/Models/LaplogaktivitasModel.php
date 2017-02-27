<?php namespace App\Modules\magang\laplogaktivitas\Models;
use Illuminate\Database\Eloquent\Model;


/**
* laplogaktivitas Model
* @var laplogaktivitas
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class LaplogaktivitasModel extends Model {
	protected $guarded = array();
	
	protected $table = "mg_log_aktivitas";

	public static $rules = array(
    );

	public static function all($columns = array('*')){
		$instance = new static;
		if (\PermissionsLibrary::hasPermission('mod-laplogaktivitas-listall')){
			return $instance->newQuery()->paginate($_ENV['configurations']['list-limit']);
		}else{
			return $instance->newQuery()
			->where('role_id', \Session::get('role_id'))
			->paginate($_ENV['configurations']['list-limit']);	
			
		}
	}

}