<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Report extends Model {
    static protected $days = [
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday'
    ];
    
    static protected $colors = [
    	'#333333',
    	'#bbbbbb',
    	'#777777',
    	'#555555',
    	'#dddddd',
    	'#999999',
    	'#333333',
    	'#bbbbbb',
    	'#777777',
    	'#555555',
    	'#dddddd',
    	'#999999'
	];
    
    public static function pieProjectSummaries($projects, $timeframe='thisweek') {
    	$return = array();
    	$i = 0;
    	
    	foreach ( $projects as $project ) {
    		$return[] = [
    			"value" => $project->jobs()->$timeframe()->count(),
    			"label" => $project->getName(),
    			"color" => self::$colors[$i]
    			];
    		$i++;
    	}
    	
    	foreach ($return as $key => $row) {
			$counts[$key]  = $row["value"];
		}
		
		array_multisort($counts, SORT_DESC, $return);
		
		return json_encode($return);
    }
    
	public static function dailySummaries($user='mine', $timeframe='thisweek') {
	    $return = array();
	    $dt = Carbon::now();
	    
	    switch ($timeframe) {
	        case 'lastweek':
	            $dt->previous();
	            break;
	        case 'thismonth':
	            $dt->startOfMonth();
	            $dtEnd = Carbon::now();
	            break;
	        case 'lastmonth':
	            $dt->subMonth()->startOfMonth();
	            $dtEnd = Carbon::now()->subMonth()->endOfMonth();
	            break;
	    }
	    
	    // Loop through just once if only showing one week
	    if ( $timeframe == 'thisweek' || $timeframe == 'lastweek' ) {
	        foreach ( self::$days as $day ) {
    	       $return[] = Job::$user()->day($day, $dt)->count();
    	    }
	    }
	    
	    // loop through each day if showing a whole month
	    if ( $timeframe == 'thismonth' || $timeframe == 'lastmonth' ) {
	    	foreach ( self::$days as $day ) {
	    		$counter = 0;
				$dtPointer = $dt->copy();
				$sum = 0;
				$dayUC = strtoupper($day);
	        	
	        	while ( $dtPointer->lte($dtEnd) ) {
	        		$sum = $sum + Job::$user()->day($day, $dtPointer)->count();
	        		$dtPointer->addWeek();
	        		$counter++;
	        		if ($counter > 5) break;
	        	}
	        	$return[] = $sum;
    	    }
	    }
	    
	    return json_encode($return);
	}

}
