<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Modal;
use App\Job;
use View;

class ModalController extends Controller {

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($model,$id)
	{
		$modal = new Modal();
		// get the modal, there's probably a cleaner way to do this
		switch ( $model ) {
			case 'job':
				$job = Job::find($id);
				$data = [
					'name' => $job->graphic,
					'type' => 'Job',
					'controller' => 'JobsController@destroy',
					'id' => $job->id,
				];
				break;
			default:
				$data = [
					'name' => 'unknown',
					'type' => 'unkown',
					'controller' => 'JobsController@index',
					'id' => '0',
				];
				break;
		}

		$modal->setDelete($data);

		return View::make('components.modals.modal', compact('modal'));
	}

}
