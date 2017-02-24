<?php namespace App\Modules\laporan\laplogaktivitas\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\laporan\laplogaktivitas\Models\LaplogaktivitasModel;
use Input,View, Request, Form, File;

class LaplogaktivitasController extends Controller {

	/**
	 * Laplogaktivitas Repository
	 *
	 * @var Laplogaktivitas
	 */
	protected $laplogaktivitas;

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
		return View::make('laplogaktivitas::index');
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
}
