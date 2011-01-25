<?php

class sfPinbaPropelPDOStatement extends DebugPDOStatement{
	
	protected $timer;
	
	/**
	 * Executes a prepared statement.  Returns a boolean value indicating success.
	 * 
	 * Overridden for query counting and logging.
	 * 
	 * @return     bool
	 */
	public function execute($input_parameters = null)
	{
		$this->startPinbaTimer();
		
		$return = parent::execute($input_parameters);
		
		$this->timer->addTime();
		
		return $return;
	}
	
	protected function startPinbaTimer(){
		$tags= array(
			'group'=>$this->pdo->getAttribute(PDO::ATTR_DRIVER_NAME),
			'dbname'=>$this->pdo->getDbName(),
			'operation'=>$this->getOperationFromQuery(),
		);
		$this->timer = sfPinbaTimerManager::getTimer('sfPinbaPropelPDOStatement', $tags);
	}
	
	protected function getOperationFromQuery(){
		preg_match('/^(SELECT|UPDATE|INSERT|DELETE)/i',$this->getExecutedQueryString(),$matches);
		if(count($matches)>0){
			return strtolower($matches[1]);
		}
		return 'other';
	}
	
}