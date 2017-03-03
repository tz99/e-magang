<?php namespace App\Modules\laporan\laporansiswamagang\Models;
use Illuminate\Database\Eloquent\Model;


/**
* Laporansiswamagang Model
* @var Laporansiswamagang
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class LaporansiswamagangModel extends Model {
	protected $guarded = array();
	
	protected $table = "lap_laporan_siswa_magang";

	public static $rules = array(
/*    		'nm_siswa' => 'required',
		'no_induk' => 'required',
		'asal_sekolah' => 'required',
		'jenjang_pddk' => 'required',
		'nm_magang' => 'required',
		'tgl_mulai' => 'required',
		'tgl_selesai' => 'required',*/

    );

	public static function all($columns = array('*')){
		$instance = new static;
		if (\PermissionsLibrary::hasPermission('mod-laporansiswamagang-listall')){
			return $instance->newQuery()->paginate($_ENV['configurations']['list-limit']);
		}else{
			return $instance->newQuery()
			->where('role_id', \Session::get('role_id'))
			->paginate($_ENV['configurations']['list-limit']);	
			
		}
	}

	public static function list_bulan($bulan_id='', $selected=''){
	    $bulan = array (
	      '1' =>'January',
	      '2' =>'February',
	      '3' =>'March',
	      '4' =>'April',
	      '5' =>'May',
	      '6' =>'June',
	      '7' =>'July',
	      '8' =>'August',
	      '9' =>'September',
	      '10' =>'October',
	      '11' =>'November',
	      '12' =>'December',
	    );
	    $html = '<select id="'.$bulan_id.'" name="'.$bulan_id.'" class="form-control">';
	    $html .= '<option value="">Pilih Bulan </option>';
	    $no=1;
	    foreach($bulan as $bln){
	      $html .= '<option value='.$no.' '.(($selected==$no)?'selected':'').'>'.$bln.'</option>';
	    $no++;  
	    }    
	    $html .= '</select>';    
	    return $html;
	  }

	  public static function get_bulan($id){
		$bulan = array (
	      '1' =>'January',
	      '2' =>'February',
	      '3' =>'March',
	      '4' =>'April',
	      '5' =>'May',
	      '6' =>'June',
	      '7' =>'July',
	      '8' =>'August',
	      '9' =>'September',
	      '10' =>'October',
	      '11' =>'November',
	      '12' =>'December',
	    );

		return ($bulan)?$bulan[$id]:'';
	}

}
