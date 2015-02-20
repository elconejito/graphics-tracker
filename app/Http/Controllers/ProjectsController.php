<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\UpdateProjectRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

use App\Project;

use Auth, Response;

class ProjectsController extends Controller {

	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$projects = Project::all();
		
		return view('project.index', compact('projects'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param CreateJobRequest $request
	 *
	 * @return Response
	 */
	public function store()
	{
		return Redirect('projects');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param                  $id
	 * @param UpdateJobRequest $request
	 *
	 * @return Response
	 * @internal param int $id
	 */
	public function update($id, UpdateProjectRequest $request)
	{
		// create the new job
		$project = Project::find($id);

		$project->update($request->all());
		
		$project->save();

		return response()->json([
			'status' => 'OK',
			'request' => $request->all()
		]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$result = Job::destroy($id);

		if ( $result ) {
			session()->flash('message', 'Job has been deleted');
			session()->flash('message-type', 'success');
			$response = [
				'status' => 1,
				'code' => 200,
				'message' => 'success',
				'data' => [
					'action' => 'redirect',
					'url' => action('JobsController@index')
				]
			];
		} else {
			session()->flash('message', 'Job has NOT been deleted');
			session()->flash('message-type', 'danger');
			$response = [
				'status' => 0,
				'code' => 300,
				'message' => 'fail',
				'data' => ''
			];
		}

		return Response::json($response);
	}

}
