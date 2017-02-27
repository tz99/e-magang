<?php namespace App\Modules\magang\tugas\Models;
use Illuminate\Database\Eloquent\Model;


/**
* Tugas Model
* @var Tugas
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class TugasModel extends Model {
	protected $guarded = array();
	
	protected $table = "mg_tugas";

	public static $rules = array(
    	/*	'nm_siswa' => 'required',
		'nm_project' => 'required',
		'tugas' => 'required',
		'deskripsi' => 'required',
		'tgl_deadline' => 'required',
		'status' => 'required',
		'tgl_selesai' => 'required',*/

    );

	public static function all($columns = array('*')){
		$instance = new static;
		if (\PermissionsLibrary::hasPermission('mod-tugas-listall')){
			return $instance->newQuery()->paginate($_ENV['configurations']['list-limit']);
		}else{
			return $instance->newQuery()
			->where('role_id', \Session::get('role_id'))
			->paginate($_ENV['configurations']['list-limit']);	
			
		}
	}

		public static function list_status_tugas($tugas_id='', $selected=''){
	    $project = array (
	      '1' =>'On Progress',
	      '2' =>'Finished',
	      '3' =>'Revision',
	    );
	    $html = '<select id="'.$tugas_id.'" name="'.$tugas_id.'" class="form-control">';
	    $html .= '<option value="">Pilih Status Project</option>';
	    $no=1;
	    foreach($project as $tgs){
	      $html .= '<option value='.$no.' '.(($selected==$no)?'selected':'').'>'.$tgs.'</option>';
	    $no++;  
	    }    
	    $html .= '</select>';    
	    return $html;
	  }

	public static function get_status_tugas($id){
		$data = DB::table('mg_tugas')
					->where('id',  $id)
		            ->first();

		return ($data)?$data->status:'';
	}

}
