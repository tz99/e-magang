<?php namespace App\Modules\laporan\laporanlogaktivitas\Models;
use Illuminate\Database\Eloquent\Model;


/**
* Laporanlogaktivitas Model
* @var Laporanlogaktivitas
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class LaporanlogaktivitasModel extends Model {
	protected $guarded = array();
	
	protected $table = "laporan_log_aktivitas";

	public static $rules = array(
    		'f' => 'required',

    );

	public static function all($columns = array('*')){
		$instance = new static;
		if (\PermissionsLibrary::hasPermission('mod-laporanlogaktivitas-listall')){
			return $instance->newQuery()->paginate($_ENV['configurations']['list-limit']);
		}else{
			return $instance->newQuery()
			->where('role_id', \Session::get('role_id'))
			->paginate($_ENV['configurations']['list-limit']);	
			
		}
	}

}
