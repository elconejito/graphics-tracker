<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Job extends Model {

	protected $fillable = [ 'graphic' ];

	protected $dates = [ 'job_start', 'job_end' ];

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
		$this->new = ( $count >= 1 ? false:true );
	}

	public function setTimes($times) {
		$this->job_end = $times['job_end'];
		$this->duration = $times['duration'];
		$this->job_start = $times['job_end']->subMinutes($times['duration']);
	}

	public function getJobStart() {
		if ($this->job_start->isToday())
			return '<span title="'.$this->job_start->format('D M jS, Y h:i A').'">'.$this->job_start->diffForHumans().'</span>';

		return $this->job_start->format('D M jS, Y h:i A');
	}

	public function getJobEnd() {
		if ($this->job_end->isToday())
			return '<span title="'.$this->job_end->format('D M jS, Y h:i A').'">'.$this->job_end->diffForHumans().'</span>';

		return $this->job_end->format('D M jS, Y h:i A');
	}

}
