<?php namespace App\Modules\master\siswamagang\Models;
use Illuminate\Database\Eloquent\Model;


/**
* Siswamagang Model
* @var Siswamagang
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class SiswamagangModel extends Model {
	protected $guarded = array();
	
	protected $table = "ms_siswa_magang";

	public static $rules = array(
    		'no_induk' => 'required',
		'nm_siswa' => 'required',
		'asal_sekolah' => 'required',
		'jenjang_pddk' => 'required',
		'alamat' => 'required',
		'no_telp' => 'required',
		'email' => 'required',
		'tgl_mulai' => 'required',
		'tgl_selesai' => 'required',
		'nm_magang' => 'required',
		'nm_supervisior' => 'required',

    );

	public static function all($columns = array('*')){
		$instance = new static;
		if (\PermissionsLibrary::hasPermission('mod-siswamagang-listall')){
			return $instance->newQuery()->paginate($_ENV['configurations']['list-limit']);
		}else{
			return $instance->newQuery()
			->where('role_id', \Session::get('role_id'))
			->paginate($_ENV['configurations']['list-limit']);	
			
		}
	}

	public static function listJenjang($jenjang_id='', $selected=''){
	    $jenjang = array (
	      '1' =>'SMK',
	      '2' =>'D3',
	      '3' =>'D4',
	      '4' =>'S1',
	    );
	    $html = '<select id="$jenjang_id" name="$jenjang_id" style="width:200px">';
	    $html .= '<option value="">Pilih Jenjang</option>';
	    $no=1;
	    foreach($jenjang as $jjg){
	      $html .= '<option value='.$no.' '.(($selected==$no)?'selected':'').'>'.$jjg.'</option>';
	    $no++;  
	    }    
	    $html .= '</select>';    
	    return $html;
	  }

}
