<?php namespace App\Modules\master\pengumuman\Models;
use Illuminate\Database\Eloquent\Model;


/**
* Pengumuman Model
* @var Pengumuman
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class PengumumanModel extends Model {
	protected $guarded = array();
	
	protected $table = "ms_pengumuman";

	public static $rules = array(
    		'isi_pengumuman' => 'required',
		'pub_pengumuman' => 'required',

    );

	public static function all($columns = array('*')){
		$instance = new static;
		if (\PermissionsLibrary::hasPermission('mod-pengumuman-listall')){
			return $instance->newQuery()->paginate($_ENV['configurations']['list-limit']);
		}else{
			return $instance->newQuery()
			->where('role_id', \Session::get('role_id'))
			->paginate($_ENV['configurations']['list-limit']);	
			
		}
	}

}
