<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Project;

class ReportsController extends Controller {
	
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($timeframe='thisweek', $user='mine')
	{
		
		$projects = Project::whereHas('jobs', function($query) use ($timeframe, $user) {
			$query->$user()->$timeframe();
		})->get();
		return view('report.index', compact('projects','timeframe', 'user'));
	}

}
