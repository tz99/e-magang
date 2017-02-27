<?php namespace App\Modules\master\supervisor\Models;
use Illuminate\Database\Eloquent\Model;

use DB;
/**
* Supervisor Model
* @var Supervisor
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class SupervisorModel extends Model {
	protected $guarded = array();
	
	protected $table = "ms_supervisor";

	public static $rules = array(
  //   	'nm_supervisor' => 'required',
		// 'jabatan' => 'required',
		// 'telepon' => 'required',
		// 'email' => 'required',
		// 'foto' => 'required',

    );

	public static function all($columns = array('*')){
		$instance = new static;
		if (\PermissionsLibrary::hasPermission('mod-supervisor-listall')){
			return $instance->newQuery()->paginate($_ENV['configurations']['list-limit']);
		}else{
			return $instance->newQuery()
			->where('role_id', \Session::get('role_id'))
			->paginate($_ENV['configurations']['list-limit']);	
			
		}
	}
	
	public static function list_bulan($nm_var=''){
		$html = '<select id="'.$nm_var.'" name="'.$nm_var.'" class="form-control">';
		$html .= '<option value="0">Semua Bulan</option>';
		
		$no=1;
        $bln='';
        while ($no <= 12) {
            if ($no==1) {$bln='Januari';
            }else if ($no==2) {$bln='Februari';
            }else if ($no==3) {$bln='Maret';
            }else if ($no==4) {$bln='April';
            }else if ($no==5) {$bln='Mei';
            }else if ($no==6) {$bln='Juni';
            }else if ($no==7) {$bln='Juli';
            }else if ($no==8) {$bln='Agustus';
            }else if ($no==9) {$bln='September';
            }else if ($no==10) {$bln='Oktober';
            }else if ($no==11) {$bln='November';
            }else if ($no==12) {$bln='Desember';
            }
            $html .= '<option value='.$no.'>'.$bln.'</option>';
            $no++;     
        }
		$html .= '</select>';
		
		return $html;
	}

	public static function list_supervisor($nm_var='', $selected=''){
		
		$users = DB::table('ms_supervisor')
		            ->get();

		$html = '<select id="'.$nm_var.'" name="'.$nm_var.'" class="form-control">';
		$html .= '<option value="">Pilih Supervisor</option>';
		$no=1;
		foreach($users as $spr){
			$html .= '<option value='.$spr->id.' '.(($selected==$spr->id)?'selected':'').'>'.$spr->nm_supervisor.'</option>';
			$no++;
		}		
		$html .= '</select>';
		
		return $html;
	}

	public static function get_supervisor($id){
		$data = DB::table('ms_supervisor')
					->where('id',  $id)
		            ->first();
		            
		return ($data)?$data->nm_supervisor:'';
	}
}
