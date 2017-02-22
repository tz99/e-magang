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

	public function getJenjang($izin_id='', $selected=''){
		/*$array = [
		    ['jenjang' => ['id' => 1, 'nm_jenjang' => 'SMK']],
		    ['jenjang' => ['id' => 2, 'nm_jenjang' => 'D3']],
		    ['jenjang' => ['id' => 3, 'nm_jenjang' => 'D4']],
		    ['jenjang' => ['id' => 4, 'nm_jenjang' => 'Strata 1']],
		];*/
		$jenjang = array (
			'1' =>'SMK',
			'2' =>'D3',
			'3' =>'D4',
			'4' =>'Strata I',
		);
		$html = '<select id="jenjang_pddk" name="jenjang_pddk">';
		$html .= '<option value="">Pilih Jenis Izin</option>';
		$no=1;
		foreach($jenjang as $jjg){
			$html .= '<option value='.$jenjang[$jjg->$no].'>'.$jenjang[$jjg->$no].'</option>';
		$no++;	
		}		
		$html .= '</select>';		
		return $html;
	}

}
