<?php namespace App\Modules\laporan\laporanlogaktivitas\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\laporan\laporanlogaktivitas\Models\LaporanlogaktivitasModel;
use Input,View, Request, Form, File;

class LaporanlogaktivitasController extends Controller {

	/**
	 * Lap.logaktivitas Repository
	 *
	 * @var Lap.logaktivitas
	 */
	protected $lap.logaktivitas;

	public function __construct()
	{
	
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		cekAjax();
		return View::make('laporanlogaktivitas::index');
	}

		/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('laporanlogaktivitas::create');
	}
}
