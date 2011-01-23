<?php

class sfPinbaStopFilter extends sfFilter
{
  public function execute($filterChain)
  {
  	
	// Filters don't have direct access to the request and user objects.
	// You will need to use the context object to get them
	$request = $this->getContext()->getRequest();
	$user    = $this->getContext()->getUser();

	//stop pinba

    // Execute next filter
    $filterChain->execute();  
  }
}