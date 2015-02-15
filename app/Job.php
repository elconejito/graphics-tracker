<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Auth;

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
		if ( isset($times['job_end']) ) {
			$this->job_end = $times['job_end'];
			$this->duration = $times['duration'];
			$this->job_start = $times['job_end']->subMinutes($times['duration']);
		} elseif ( isset($times['job_start']) ) {
			$this->job_start = $times['job_start'];
			$this->duration = $times['duration'];
			$this->job_end = $times['job_start']->addMinutes($times['duration']);
		} elseif ( isset($times['duration']) ) {
			$this->job_start = $this->job_end->subMinutes($times['duration']);
		}
		
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
	
	public function scopeMine($query) {
		$query->where('user_id', '=', Auth::user()->id);
	}
	
	public function scopeDay($query, $day) {
		$dt = Carbon::now()->startOfWeek();
		$day = strtoupper($day);
		
		if ( $day === 'MONDAY' ) {
			$start = $dt->copy()->startOfDay();
			$end = $dt->copy()->endOfDay();
		} else {
			$start = $dt->copy()->next( constant("Carbon\Carbon::$day") )->startOfDay();
			$end = $dt->copy()->next( constant("Carbon\Carbon::$day") )->endOfDay();
		}
		
		$query->whereBetween('job_end', [ $start, $end ]);
	}
	
	public function scopeWeek($query) {
		$dt = Carbon::now()->startOfWeek()->startOfDay();
		$query->where('job_end', '>=', $dt);
	}

}
