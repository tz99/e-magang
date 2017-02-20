<?php namespace App\Modules\master\jenisizin\Models;
use Illuminate\Database\Eloquent\Model;


/**
* Jenisizin Model
* @var Jenisizin
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class JenisizinModel extends Model {
	protected $guarded = array();
	
	protected $table = "ms_jenis_izin";

	public static $rules = array(
    		'nm_izin' => 'required',
		'ket_izin' => 'required',

    );

	public static function all($columns = array('*')){
		$instance = new static;
		if (\PermissionsLibrary::hasPermission('mod-jenisizin-listall')){
			return $instance->newQuery()->paginate($_ENV['configurations']['list-limit']);
		}else{
			return $instance->newQuery()
			->where('role_id', \Session::get('role_id'))
			->paginate($_ENV['configurations']['list-limit']);	
			
		}
	}

}
