<?php

namespace Drupal\exercise_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
* Provides a 'DaysLeft Block' Block. 
*@block(
* id = "exercise_block",
* admin_label = @Translation("DaysLeft block"),
* category = @Translation ("Block that provides the days left until the event starts"),
* )
*/
class ExerciseBlock extends BlockBase {
	/**
	*{@inheritdoc} 
	*/
	
	public function build(){
		$our_service = \Drupal::service('exercise_module.date');
		$node = \Drupal::routeMatch()->getParameter('node');
		if($node instanceof \Drupal\node\NodeInterface){
			if($node->hasField('field_event_date')){
				$eventDateString = $node->get('field_event_date')->getString();
				try{
					$eventDate = new \DateTime($eventDateString);
					$daysLeft = $our_service->daysLeft($eventDate);
				}
				catch (\Exception $e){
					$daysLeft = 'The service is currently not available.';
				}
			}
			else{
				$daysLeft = 'The service is currently not available.';
			}	
		}else{
			$daysLeft = 'The service is currently not available.';
		}
		
		
		
		return [
		  '#markup' => $daysLeft,
		];
	}  
	
	public function getCacheMaxAge() {
		return 0;
	}
	
}