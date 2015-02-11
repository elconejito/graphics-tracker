<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Session, View;

class Flash extends Model {

	public static function message() {
		// Do we have any messages?
		$hasMessage =  ( Session::has('errors') || Session::has('message') || Session::has('success') ) ? true : false;
		
		if ( $hasMessage ) {
			if ( Session::has('message-type') ) {
				// if there is a message type, use it
				$messageType = Session::get('message-type');
			} elseif ( Session::has('errors') ) {
				// if there are errors, set the type to danger
				$messageType = 'danger';
			}
			
			switch ( $messageType ) {
				case 'success':
					$class = 'alert alert-success alert-dismissible';  // green
					$icon = 'fa fa-check-circle';
					$preText = '<strong>Success!</strong> ' . (Session::get('message') ? Session::get('message'):'');
					break;
				case 'warning':
					$class = 'alert alert-warning alert-dismissible';  // yellow
					$icon = 'fa fa-question-circle';
					$preText = '<strong>Warning!</strong> ' . (Session::get('message') ? Session::get('message'):'Looks like something went wrong');
					break;
				case 'danger':
					$class = 'alert alert-danger alert-dismissible';  // red
					$icon = 'fa fa-exclamation-circle';
					$preText = '<strong>Error!</strong>  ' . (Session::get('message') ? Session::get('message'):'Something has gone horribly wrong');
					break;
				case 'info':
					$class = 'alert alert-info alert-dismissible';  // blue
					$icon = 'fa fa-info-circle';
					$preText = '<strong>Information!</strong> ' . (Session::get('message') ? Session::get('message'):'');
					break;
				default:
					$class = 'alert alert-info alert-dismissible';  // blue
					$icon = 'fa fa-info-circle';
					$preText = Session::get('message') ? Session::get('message'):'';
					break;
			}
			return View::make('components.flash', compact('class', 'icon', 'preText'));
		}
	}
}