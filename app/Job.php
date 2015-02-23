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
	
	public function setProject() {
		$trimmed = substr($this->graphic, 0, -3);	// remove the 3 digits at the end
		$project = Project::firstOrCreate(['shortcode' => $trimmed]);
		$this->project()->associate($project);
	}

	public function setTimes($times) {
		if ( isset($times['duration']) ) {
			$this->duration = $times['duration'];
		} else {
			$this->duration = ( $this->duration ? $this->duration : 60 );
		}
		if ( isset($times['job_end']) ) {
			$this->job_end = Carbon::createFromFormat('Y-m-d H:i:s', $times['job_end']);
			$this->job_start = $this->job_end->copy()->subMinutes($this->duration);
		} elseif ( isset($times['job_start']) ) {
			$this->job_start = Carbon::createFromFormat('Y-m-d H:i:s', $times['job_start']);
			$this->job_end = $this->job_start->copy()->addMinutes($this->duration);
		} elseif ( isset($times['duration']) ) {
			$this->job_start = $this->job_end->copy()->subMinutes($this->duration);
		}
		
	}

	public function getJobStart() {
		if ($this->job_start->isToday())
			return '<span title="'.$this->job_start->format('D M j, Y h:iA').'">'.$this->job_start->diffForHumans().'</span>';
		
		if ( $this->job_start->gte($this->job_start->copy()->startOfWeek()))
			return '<span title="'.$this->job_start->format('D M j, Y h:iA').'">'.$this->job_start->format('D h:iA').'</span>';
			
		if ( $this->job_start->year->gte(Carbon::now()->year) )
			return '<span title="'.$this->job_start->format('D M j, Y h:iA').'">'.$this->job_start->format('D M j, h:iA').'</span>';

		return $this->job_start->format('D M j, Y h:iA');
	}

	public function getJobEnd() {
		if ($this->job_end->isToday())
			return '<span title="'.$this->job_end->format('D M jS, Y h:i A').'">'.$this->job_end->diffForHumans().'</span>';
		
		if ( $this->job_end->gte($this->job_end->copy()->startOfWeek()))
			return '<span title="'.$this->job_end->format('D M j, Y h:iA').'">'.$this->job_end->format('D h:iA').'</span>';
			
		if ( $this->job_end->year->gte(Carbon::now()->year) )
			return '<span title="'.$this->job_end->format('D M j, Y h:iA').'">'.$this->job_end->format('D M j, h:iA').'</span>';
			
		return $this->job_end->format('D M j, Y h:iA');
	}
	
	public function scopeMine($query) {
		$query->where('user_id', '=', Auth::user()->id);
	}
	
	public function scopeProject($query, $id) {
		$query->where('project_id', '=', $id);
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
