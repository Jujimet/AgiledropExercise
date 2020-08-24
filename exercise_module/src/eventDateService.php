<?php

namespace Drupal\exercise_module;


/**
 * Service that provides how many days are left until the event starts
 */
class eventDateService {

  public function daysLeft($eventDate) {
	$eventDate->settime(0,0);
	$dateNow = new \DateTime();
	$dateNow->settime(0,0);
	$diff = $dateNow->diff($eventDate);
	
	if ($diff->days == 0){
		return 'This event is happening today.';
	}
	else{
		if ($dateNow>$eventDate){
			return 'This event already passed.';
		}
		else{
			return $diff->days.' days left until event starts.';
		}
	}
  }

}
