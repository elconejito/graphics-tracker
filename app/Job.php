<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model {

	protected $fillable = [ 'graphic' ];

	/**
	 * @return BelongsTo
	 */
	public function project() {
		return $this->belongsTo('App\Project');
	}

	/**
	 * @return BelongsTo
	 */
	public function owner() {
		return $this->belongsTo('App\User', 'user_id');
	}

	/**
	 *  Set the 'new' flag based on whether or not any other graphic has the same name
	 *  regardless of the owner.
	 *
	 */
	public function setNew() {
		$count = Job::where('graphic', '=', $this->graphic)->count();

		$this->new = ( $count > 0 ? false:true );
	}

}
