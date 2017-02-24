<?php namespace App\Modules\master\project\Models;
use Illuminate\Database\Eloquent\Model;


/**
* Project Model
* @var Project
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class ProjectModel extends Model {
	protected $guarded = array();
	
	protected $table = "ms_project";

	public static $rules = array(
    		'nm_project' => 'required',
		'deskripsi' => 'required',
		'status' => 'required',

    );

	public static function all($columns = array('*')){
		$instance = new static;
		if (\PermissionsLibrary::hasPermission('mod-project-listall')){
			return $instance->newQuery()->paginate($_ENV['configurations']['list-limit']);
		}else{
			return $instance->newQuery()
			->where('role_id', \Session::get('role_id'))
			->paginate($_ENV['configurations']['list-limit']);	
			
		}
	}

	public static function list_status($project_id='', $selected=''){
	    $project = array (
	      '1' =>'On Progress',
	      '2' =>'Finished',
	      '3' =>'Revision',
	    );
	    $html = '<select id="'.$project_id.'" name="'.$project_id.'" class="form-control">';
	    $html .= '<option value="">Pilih Status Project</option>';
	    $no=1;
	    foreach($project as $prj){
	      $html .= '<option value='.$no.' '.(($selected==$no)?'selected':'').'>'.$prj.'</option>';
	    $no++;  
	    }    
	    $html .= '</select>';    
	    return $html;
	  }

}
