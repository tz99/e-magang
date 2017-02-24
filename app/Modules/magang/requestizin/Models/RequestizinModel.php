<?php namespace App\Modules\magang\requestizin\Models;
use Illuminate\Database\Eloquent\Model;


/**
* Requestizin Model
* @var Requestizin
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class RequestizinModel extends Model {
	protected $guarded = array();
	
	protected $table = "mg_request_izin";

	public static $rules = array(
  //   	'tgl_awal_izin' => 'required',
		// 'tgl_akhir_izin' => 'required',
		// 'jenis_izin' => 'required',
		// 'keterangan_izin' => 'required',
		// 'verifikator_izin' => 'required',
		// 'waktu_verifikasi_izin' => 'required',

    );

	public static function all($columns = array('*')){
		$instance = new static;
		if (\PermissionsLibrary::hasPermission('mod-requestizin-listall')){
			return $instance->newQuery()->paginate($_ENV['configurations']['list-limit']);
		}else{
			return $instance->newQuery()
			->where('role_id', \Session::get('role_id'))
			->paginate($_ENV['configurations']['list-limit']);	
			
		}
	}

}
