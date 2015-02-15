<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\UpdateJobRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

use App\Job;
use App\Http\Requests\CreateJobRequest;

use Auth, Response;

class JobsController extends Controller {

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
		$jobs = Job::latest('job_end')->mine()->get();
		
		return view('job.index', compact('jobs'));
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
	public function store(CreateJobRequest $request)
	{
		// create the new job
		$job = new Job($request->all());
		// associate the owner
		$job->owner()->associate(Auth::user());
		$job->setNew();
		$job->setTimes([
			'job_end' => Carbon::now(),
			'duration' => 60,
		]);
		$job->save();

		session()->flash('message', 'Job has been added');
		session()->flash('message-type', 'success');

		return Redirect('jobs');
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
	public function update($id, UpdateJobRequest $request)
	{
		// create the new job
		$job = Job::find($id);

		$job->update($request->all());
		
		$job->setTimes($request->only('job_start','job_end', 'duration'));
		
		$job->save();

		return response()->json([
			'status' => 'OK',
			'request' => $request->only('job_start','job_end', 'duration')
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
