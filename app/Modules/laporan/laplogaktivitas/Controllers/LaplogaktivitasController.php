<?php namespace App\Modules\laporan\laplogaktivitas\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\laporan\laplogaktivitas\Models\LaplogaktivitasModel;
use Input,View, Request, Form, File;
use DB;

class LaplogaktivitasController extends Controller {
	//protected $laplogaktivitas;

	// public function __construct(LogaktivitasModel $laplogaktivitas){
 //        $this->laplogaktivitas = $laplogaktivitas;
 //    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	// public function getIndex()
	// {
	// 	cekAjax();
	// 	$data = DB::table('mg_log_aktivitas')->get();
	// 	return View::make('laplogaktivitas::index', compact('data'));
	// }

	public function getIndex(){
        cekAjax();
        if (empty(Input::get('siswa'))) {
        	$data = DB::table('mg_log_aktivitas')->get();
            return View::make('laplogaktivitas::index', compact('data'));
        }else{
        	$siswa = Input::get('siswa');
        	$bulan = Input::get('bulan');

	        $data = DB::table('mg_log_aktivitas')
        			->orWhere('siswa', 'LIKE', '%'.$siswa.'%')
	                ->paginate($_ENV['configurations']['list-limit']);
	        		return View::make('laplogaktivitas::index', compact('data'));
        }
        
    }


		/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('laplogaktivitas::create');
	}

	public function getSearch(Request $req){
		cekAjax();
		$siswa = Input::get('siswa');
		$bulan = Input::get('bulan');
		echo $siswa;
	}
}
