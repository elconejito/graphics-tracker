<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UpdateJobRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		if ( Auth::user() )
			return true;

		return false;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'graphic' => 'alpha_num|min:2',
			'job_start' => 'date',
			'job_end' => 'date',
			'duration' => 'integer'
		];
	}

	public function response(array $errors)
	{
		// See what it does natively here:
		// https://github.com/laravel/framework/blob/master/src/Illuminate/Foundation/Http/FormRequest.php
		return new JsonResponse($errors, 422);
	}

}
