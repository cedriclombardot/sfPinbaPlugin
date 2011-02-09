<?php
/*
 * Symfony Filter Class sfPinbaStopFilter
 * This class will START the pinba timer for the request
 */
class sfPinbaStartFilter extends sfFilter
{
  /**
   * Start timer for page
   * @param sfFilterChain $filterChain
   */
  public function execute($filterChain)
  {
  	
	// Filters don't have direct access to the request and user objects.
	// You will need to use the context object to get them
	$request = $this->getContext()->getRequest();
	$user    = $this->getContext()->getUser();

	//start pinba
	sfPinbaContext::getInstance()->startTimerForRequest();
	
	
    // Execute next filter
    $filterChain->execute();  
  }
}