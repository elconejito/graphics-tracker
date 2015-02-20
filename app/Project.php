<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {
    protected $fillable = [ 'shortcode', 'name' ];

	public function graphics() {
	    return $this->hasMany('App\Graphic');
	}
	
	public function jobs() {
	    return $this->hasMany('App\Job');
	}
	
	public function getName() {
	    if ( $this->name ) return $this->name;
	    
	    if ( $this->shortcode ) return $this->shortcode;
	    
	    return 'unk';
	}

}
