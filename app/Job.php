<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model {

	protected $fillable = [ 'graphic' ];

	public function project() {
		return $this->belongsTo('App\Project');
	}
	
	public function owner() {
		return $this->belongsTo('App\User');
	}

}
